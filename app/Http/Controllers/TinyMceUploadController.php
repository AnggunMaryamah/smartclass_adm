<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TinyMceUploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/tinymce', $filename, 'public');
            $url = asset('storage/' . $path);

            // Ini sudah BENAR untuk upload sukses
            return response()->json(['location' => $url], 200, [], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        }
        // Ini return untuk error, HARUS beda key/value!
        return response()->json(['error' => 'Gagal upload'], 400);
    }
}