<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('kontak'); // atau 'contact' jika kamu pakai nama view lain
    }

    public function kirim(Request $request)
    {
        // validasi sederhana
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim!'
        ]);
    }

}
