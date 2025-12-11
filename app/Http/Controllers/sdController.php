<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SdController extends Controller
{
    public function index()
    {
        $grades = [
            ['icon'=>'1️⃣','name'=>'Kelas 1','desc'=>'Mengenal huruf & angka, dasar membaca'],
            ['icon'=>'2️⃣','name'=>'Kelas 2','desc'=>'Peningkatan membaca & berhitung'],
            ['icon'=>'3️⃣','name'=>'Kelas 3','desc'=>'Penguatan konsep & logika'],
            ['icon'=>'4️⃣','name'=>'Kelas 4','desc'=>'Pengembangan keterampilan berpikir'],
            ['icon'=>'5️⃣','name'=>'Kelas 5','desc'=>'Latihan lanjutan & penerapan konsep'],
            ['icon'=>'6️⃣','name'=>'Kelas 6','desc'=>'Persiapan ujian & penguatan materi'],
        ];

        $subjects = [
            ['icon'=>'📘','name'=>'Matematika','color'=>'cyan'],
            ['icon'=>'🔤','name'=>'Bahasa Indonesia','color'=>'blue'],
            ['icon'=>'🔬','name'=>'IPA','color'=>'emerald'],
            ['icon'=>'🎨','name'=>'SBK','color'=>'pink'],
        ];
        foreach ($subjects as &$s) { $s['border_class'] = 'hover:border-' . $s['color'] . '-400'; }
        unset($s);

        $features = [
            ['icon'=>'🎯','title'=>'Pendekatan Personal','desc'=>'Pembelajaran sesuai kebutuhan siswa.'],
            ['icon'=>'🧩','title'=>'Latihan Interaktif','desc'=>'Soal adaptif dan evaluasi rutin.'],
            ['icon'=>'👨‍🏫','title'=>'Guru Berpengalaman','desc'=>'Guru sabar & profesional.'],
        ];

        $testimonials = [
            ['rating'=>5,'text'=>'Nilai anak saya meningkat drastis!','name'=>'Ibu Rina','grade'=>'Kelas 2'],
            ['rating'=>4,'text'=>'Pengajar sabar dan jelas.','name'=>'Pak Agus','grade'=>'Kelas 3'],
        ];

        $pageTitle = 'Les Privat SD — SmartClass';

        return view('sd.index', compact('grades','subjects','features','testimonials','pageTitle'));
    }
}