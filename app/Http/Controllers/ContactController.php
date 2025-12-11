<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReceived;

class ContactController extends Controller
{
    // TAMPILKAN HALAMAN KONTAK
    public function page()
    {
        // resources/views/contact.blade.php
        return view('contact');
    }

    // TERIMA FORM KONTAK (kalau kamu pakai form POST)
    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|max:2000',
        ]);

        // kalau belum mau kirim email, bagian ini bisa kamu comment dulu
        // Mail::to('windanur337@gmail.com')->send(new ContactReceived($data));

        if ($request->expectsJson()) {
            return response()->json([
                'ok' => true,
                'message' => 'Pesan berhasil dikirim. Terima kasih!',
            ]);
        }

        return back()->with('success', 'Pesan berhasil dikirim. Terima kasih!');
    }
}