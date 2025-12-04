<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function sd()
    {
        $grades = [
            ['icon' => '🎯', 'name' => 'Kelas 1-2 SD', 'desc' => 'Pembelajaran dasar membaca, menulis, dan berhitung'],
            ['icon' => '📐', 'name' => 'Kelas 3-4 SD', 'desc' => 'Penguatan konsep matematika dan bahasa'],
            ['icon' => '🔬', 'name' => 'Kelas 5-6 SD', 'desc' => 'Persiapan masuk SMP dengan materi lengkap'],
        ];

        $subjects = [
            ['icon' => '🔢', 'name' => 'Matematika'],
            ['icon' => '📚', 'name' => 'Bahasa Indonesia'],
            ['icon' => '🌍', 'name' => 'IPA'],
            ['icon' => '🗺️', 'name' => 'IPS'],
            ['icon' => '🇬🇧', 'name' => 'Bahasa Inggris'],
            ['icon' => '🎨', 'name' => 'Seni & Budaya'],
        ];

        $features = [
            ['icon' => '👨‍🏫', 'title' => 'Guru Berpengalaman', 'desc' => 'Pengajar tersertifikasi dan berpengalaman'],
            ['icon' => '📱', 'title' => 'Fleksibel', 'desc' => 'Belajar online atau tatap muka sesuai kebutuhan'],
            ['icon' => '📊', 'title' => 'Laporan Berkala', 'desc' => 'Progress belajar anak terpantau dengan baik'],
            ['icon' => '💰', 'title' => 'Harga Terjangkau', 'desc' => 'Biaya les yang ramah di kantong'],
            ['icon' => '🏆', 'title' => 'Metode Interaktif', 'desc' => 'Pembelajaran menyenangkan dan efektif'],
            ['icon' => '⏰', 'title' => 'Jadwal Fleksibel', 'desc' => 'Atur waktu belajar sesuai keinginan'],
        ];

        $testimonials = [
            ['rating' => 5, 'text' => 'Anak saya jadi lebih semangat belajar matematika!', 'name' => 'Ibu Sari', 'grade' => 'Orang Tua Siswa Kelas 4'],
            ['rating' => 5, 'text' => 'Gurunya sabar dan metodenya mudah dipahami anak.', 'name' => 'Bapak Budi', 'grade' => 'Orang Tua Siswa Kelas 3'],
            ['rating' => 5, 'text' => 'Nilai rapor anak meningkat pesat sejak ikut SmartClass!', 'name' => 'Ibu Dewi', 'grade' => 'Orang Tua Siswa Kelas 6'],
            ['rating' => 5, 'text' => 'Sistem online-nya bagus, anak bisa belajar dari rumah.', 'name' => 'Ibu Rina', 'grade' => 'Orang Tua Siswa Kelas 2'],
        ];

        return view('sd.index', compact('grades', 'subjects', 'features', 'testimonials'));
    }

    public function smp()
    {
        $grades = [
            ['icon' => '📚', 'name' => 'Kelas 7 SMP', 'desc' => 'Adaptasi dari SD ke SMP dengan pendampingan'],
            ['icon' => '🎯', 'name' => 'Kelas 8 SMP', 'desc' => 'Pendalaman materi inti dan persiapan ujian'],
            ['icon' => '🏆', 'name' => 'Kelas 9 SMP', 'desc' => 'Persiapan UN dan masuk SMA favorit'],
        ];

        $subjects = [
            ['icon' => '🔢', 'name' => 'Matematika'],
            ['icon' => '📚', 'name' => 'Bahasa Indonesia'],
            ['icon' => '🇬🇧', 'name' => 'Bahasa Inggris'],
            ['icon' => '🧪', 'name' => 'IPA Terpadu'],
            ['icon' => '🗺️', 'name' => 'IPS Terpadu'],
            ['icon' => '💻', 'name' => 'TIK'],
        ];

        $features = [
            ['icon' => '👨‍🏫', 'title' => 'Guru Berkualitas', 'desc' => 'Lulusan universitas terbaik'],
            ['icon' => '📊', 'title' => 'Try Out Berkala', 'desc' => 'Simulasi ujian nasional rutin'],
            ['icon' => '📱', 'title' => 'Belajar Hybrid', 'desc' => 'Kombinasi online dan offline'],
            ['icon' => '🏆', 'title' => 'Target Oriented', 'desc' => 'Fokus pada pencapaian nilai'],
            ['icon' => '💰', 'title' => 'Harga Bersaing', 'desc' => 'Investasi pendidikan terjangkau'],
            ['icon' => '⏰', 'title' => 'Jadwal Fleksibel', 'desc' => 'Sesuaikan dengan aktivitas siswa'],
        ];

        $testimonials = [
            ['rating' => 5, 'text' => 'Nilai UN anak saya meningkat drastis!', 'name' => 'Ibu Maya', 'grade' => 'Orang Tua Siswa Kelas 9'],
            ['rating' => 5, 'text' => 'Gurunya menjelaskan sampai paham, tidak buru-buru.', 'name' => 'Bapak Andi', 'grade' => 'Orang Tua Siswa Kelas 8'],
        ];

        return view('smp.index', compact('grades', 'subjects', 'features', 'testimonials'));
    }

    public function sma()
    {
        // Placeholder untuk halaman SMA
        return view('sma.index');
    }
}