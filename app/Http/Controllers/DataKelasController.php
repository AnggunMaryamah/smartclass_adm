<?php

namespace App\Http\Controllers;

use App\Models\DataKelas;
use Illuminate\Http\Request;

class DataKelasController extends Controller
{
    public function index()
    {
        $data = DataKelas::all();
        return view('admin.data_kelas', compact('data'));
    }
}