<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pemesanan; // Tambahkan ini
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        
    $pembayarans = Pembayaran::all();
    $pemesanan = Pemesanan::all();   // Tambahkan ini!
    return view('admin.pembayaran', compact('pembayarans', 'pemesanan'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'pemesanan_id' => 'required',
            'tanggal_pembayaran' => 'required|date',
            'qris_reference' => 'required|string',
            'nominal_pembayaran' => 'required|integer',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'status_pembayaran' => 'required|string',
        ]);

        $data = $request->only([
            'pemesanan_id',
            'tanggal_pembayaran',
            'qris_reference',
            'nominal_pembayaran',
            'status_pembayaran'
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['bukti_pembayaran'] = 'uploads/' . $filename;
        }

        Pembayaran::create($data);

        return redirect()->route('admin.pembayarans.index')
            ->with('success', 'Pembayaran berhasil ditambahkan.');
    }


    public function edit(Pembayaran $pembayaran)
    {
        return view('pembayarans.edit', compact('pembayaran'));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'pemesanan_id' => 'required',
            'tanggal_pembayaran' => 'required|date',
            'qris_reference' => 'required|string',
            'nominal_pembayaran' => 'required|integer',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'status_pembayaran' => 'required|string',
        ]);

        $data = $request->only([
            'pemesanan_id',
            'tanggal_pembayaran',
            'qris_reference',
            'nominal_pembayaran',
            'status_pembayaran'
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['bukti_pembayaran'] = 'uploads/' . $filename;
        }

        $pembayaran->update($data);

        return redirect()->route('admin.pembayarans.index')
            ->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->route('admin.pembayarans.index')
            ->with('success', 'Pembayaran berhasil dihapus.');
    }
}

