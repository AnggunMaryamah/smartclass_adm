<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\RedirectResponse;

class AdminGuruController extends Controller
{
    public function verifikasi(Guru $guru): RedirectResponse
    {
        if ($guru->status_akun === 'Aktif') {
            return back()->with('info', 'Guru sudah aktif');
        }

        $guru->update([
            'status_akun' => 'Aktif',
            'admin_id' => auth()->id(), // admin yang verifikasi
        ]);

        return back()->with('success', 'Guru berhasil diverifikasi');
    }
}