<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Ukuran maks 2MB dan hanya gambar
        ]);

        $file = $request->file('upload');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('materi_images', $filename, 'public');

        // Path gambar agar bisa diakses dari web (public/storage/...)
        $url = asset('storage/' . $path);

        // Format respons sesuai standar CKEditor
        return response()->json([
            'uploaded' => 1,
            'fileName' => $filename,
            'url' => $url
        ]);
    }
}
