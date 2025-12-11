<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function index()
    {
        $guru = Auth::user(); // ← GANTI dari Auth::guard('guru')->user()

        $pembayarans = Pembayaran::whereHas('pemesanan.kelas', function ($query) use ($guru) {
                $query->where('guru_id', $guru->id);
            })
            ->with(['pemesanan.siswa', 'pemesanan.kelas'])
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPembayaran = $pembayarans->count();
        $menunggu        = $pembayarans->where('status_pembayaran', 'menunggu')->count();
        $lunas           = $pembayarans->where('status_pembayaran', 'lunas')->count();
        $totalPemasukan  = $pembayarans->where('status_pembayaran', 'lunas')
                                       ->sum('nominal_pembayaran');

        return view('guru.pembayaran.index', compact(
            'guru',
            'pembayarans',
            'totalPembayaran',
            'menunggu',
            'lunas',
            'totalPemasukan'
        ));
    }

    public function uploadQris(Request $request)
    {
        $guru = Auth::user();  // ← GANTI dari Auth::guard('guru')->user()

        $request->validate([
            'qris_image' => $guru->qris_image
                ? 'nullable|image|mimes:jpg,jpeg,png|max:2048'
                : 'required|image|mimes:jpg,jpeg,png|max:2048',
            'qris_nama_bank'     => 'required|string|max:100',
            'qris_nama_rekening' => 'required|string|max:100',
            'qris_no_hp'         => 'required|string|max:20',
            'current_password'   => 'required',
        ]);

        if (! Hash::check($request->current_password, $guru->password)) {
            return back()->with('error', 'Password yang Anda masukkan salah!');
        }

        $updateData = [
            'qris_nama_bank'     => $request->qris_nama_bank,
            'qris_nama_rekening' => $request->qris_nama_rekening,
            'no_hp'              => $request->qris_no_hp,
        ];

        if ($request->hasFile('qris_image')) {
            if ($guru->qris_image && Storage::disk('public')->exists($guru->qris_image)) {
                Storage::disk('public')->delete($guru->qris_image);
            }

            $qrisPath = $request->file('qris_image')->store('qris', 'public');
            $updateData['qris_image'] = $qrisPath;
        }

        $guru->update($updateData);

        return redirect()->route('guru.pembayaran.index')
                         ->with('success', 'QRIS dan informasi rekening berhasil disimpan!');
    }

    public function deleteQris()
    {
        $guru = Auth::user(); // ← GANTI dari Auth::guard('guru')->user()

        if ($guru->qris_image && Storage::disk('public')->exists($guru->qris_image)) {
            Storage::disk('public')->delete($guru->qris_image);
        }

        $guru->update([
            'qris_image'         => null,
            'qris_nama_bank'     => null,
            'qris_nama_rekening' => null,
        ]);

        return redirect()->route('guru.pembayaran.index')
                         ->with('success', 'QRIS dan informasi rekening berhasil dihapus!');
    }

    public function verify(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $guru       = Auth::user(); // ← GANTI dari Auth::guard('guru')->user()

        if ($pembayaran->pemesanan->kelas->guru_id != $guru->id) {
            return back()->with('error', 'Anda tidak memiliki akses ke pembayaran ini!');
        }

        $data = ['status_pembayaran' => $request->status];

        if ($request->status === 'gagal') {
            $request->validate([
                'rejected_reason' => 'required|string|max:500',
            ]);

            $data['rejected_reason'] = $request->rejected_reason;
        }

        $pembayaran->update($data);

        $message = $request->status === 'lunas'
            ? 'Pembayaran berhasil diverifikasi sebagai LUNAS!'
            : 'Pembayaran berhasil ditolak!';

        return redirect()->route('guru.pembayaran.index')->with('success', $message);
    }
}
