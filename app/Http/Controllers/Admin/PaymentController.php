<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Halaman utama pembayaran admin:
     * - Menampilkan QRIS admin
     * - Menampilkan daftar pembayaran siswa
     */
    public function index()
    {
        // Ambil admin (sumber QRIS)
        $admin = Auth::user()->admin ?? Admin::first();

        // Ambil semua pembayaran dengan relasi pemesanan, siswa, kelas
        $pembayarans = Pembayaran::with(['pemesanan.siswa', 'pemesanan.kelas'])
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPembayaran = $pembayarans->count();
        $menunggu        = $pembayarans->where('status_pembayaran', 'menunggu')->count();
        $lunas           = $pembayarans->where('status_pembayaran', 'lunas')->count();
        $totalNominal    = $pembayarans->where('status_pembayaran', 'lunas')
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
     * Simpan / update QRIS admin ke tabel admins
     */
    public function updateQris(Request $request)
    {
        $admin = Auth::user()->admin ?? Admin::firstOrFail();

        $request->validate([
            'bank'          => 'required|string|max:100',
            'nama_rekening' => 'required|string|max:100',
            'no_wa'         => 'required|string|max:20',
            'qris_image'    => $admin->qris_image
                ? 'nullable|image|mimes:jpg,jpeg,png|max:2048'
                : 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'qris_nama_bank'     => $request->bank,
            'qris_nama_rekening' => $request->nama_rekening,
            'no_wa'              => $request->no_wa,
        ];

        if ($request->hasFile('qris_image')) {
            if ($admin->qris_image && Storage::disk('public')->exists($admin->qris_image)) {
                Storage::disk('public')->delete($admin->qris_image);
            }

            $path = $request->file('qris_image')->store('qris', 'public');
            $data['qris_image'] = $path;
        }

        $admin->update($data);

        return back()->with('success', 'QRIS pembayaran admin berhasil disimpan');
    }

    /**
     * Detail satu pembayaran (dipakai route admin.payments.show)
     */
    public function show($id)
    {
        $payment = Pembayaran::with(['pemesanan.siswa', 'pemesanan.kelas'])
            ->findOrFail($id);

        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Verifikasi pembayaran (dipakai route admin.payments.verify)
     * Kamu bisa kembangkan: set lunas / gagal, update pemesanan, aktifkan siswa di kelas, dll.
     */
    public function verify(Request $request, $id)
    {
        $payment = Pembayaran::findOrFail($id);

        // contoh sederhana: set status ke 'lunas'
        $payment->status_pembayaran = $request->input('status', 'lunas');
        $payment->save();

        return redirect()
            ->route('admin.payments.index')
            ->with('success', 'Pembayaran berhasil diverifikasi!');
    }
}
