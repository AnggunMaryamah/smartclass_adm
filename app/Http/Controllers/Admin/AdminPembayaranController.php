<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Pembayaran;

class AdminPembayaranController extends Controller
{
    /**
     * Halaman index pembayaran
     */
    public function index()
    {
        $admin = auth()->user();

        $pembayarans = Pembayaran::with([
            'siswa',
            'kelas',
            'pemesanan'
        ])->latest()->get();

        $totalPembayaran = $pembayarans->count();
        $menunggu = $pembayarans->where('status_pembayaran', 'menunggu')->count();
        $lunas = $pembayarans->where('status_pembayaran', 'lunas')->count();
        $totalNominal = $pembayarans
            ->where('status_pembayaran', 'lunas')
            ->sum('nominal_pembayaran');

        return view('admin.pembayaran.index', compact(
            'admin',
            'pembayarans',
            'totalPembayaran',
            'menunggu',
            'lunas',
            'totalNominal'
        ));
    }

    /**
     * Update QRIS & Informasi Rekening
     */
    public function updateQris(Request $request)
    {
        $request->validate([
            'qris_image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'bank'             => 'required|string',
            'nama_rekening'    => 'required|string|max:150',
            'no_wa'            => 'required|string|max:20',
            'other_bank'       => 'nullable|string|max:100',
        ]);

        $admin = auth()->user();

        /* =====================
           Upload QRIS Image
        ===================== */
        if ($request->hasFile('qris_image')) {

            if ($admin->qris_image && Storage::disk('public')->exists($admin->qris_image)) {
                Storage::disk('public')->delete($admin->qris_image);
            }

            $admin->qris_image = $request->file('qris_image')
                ->store('qris', 'public');
        }

        /* =====================
           SIMPAN KE KOLOM YANG BENAR
        ===================== */
        $admin->qris_nama_bank = $request->bank === 'other'
            ? $request->other_bank
            : $request->bank;

        $admin->qris_nama_rekening = $request->nama_rekening;
        $admin->no_wa = $request->no_wa;

        $admin->save();

        return back()->with('success', 'Informasi pembayaran berhasil disimpan');
    }

    /**
     * Hapus QRIS
     */
    public function deleteQris()
    {
        $admin = auth()->user();

        if ($admin->qris_image && Storage::disk('public')->exists($admin->qris_image)) {
            Storage::disk('public')->delete($admin->qris_image);
        }

        $admin->qris_image = null;
        $admin->save();

        return back()->with('success', 'QRIS berhasil dihapus');
    }

    /**
     * Verifikasi / Tolak Pembayaran
     */
    public function verify(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        if ($request->status === 'lunas') {
            $pembayaran->status_pembayaran = 'lunas';
            $pembayaran->verified_by = auth()->id();
            $pembayaran->save();

            return back()->with('success', 'Pembayaran berhasil diverifikasi');
        }

        $request->validate([
            'rejected_reason' => 'required|string'
        ]);

        $pembayaran->status_pembayaran = 'gagal';
        $pembayaran->rejected_reason = $request->rejected_reason;
        $pembayaran->verified_by = auth()->id();
        $pembayaran->save();

        return back()->with('success', 'Pembayaran ditolak');
    }
}
