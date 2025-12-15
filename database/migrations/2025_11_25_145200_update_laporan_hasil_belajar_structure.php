<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporan_hasil_belajars', function (Blueprint $table) {

            // Tambah kolom jenis_penilaian jika belum ada
            if (!Schema::hasColumn('laporan_hasil_belajars', 'jenis_penilaian')) {
                $table->enum('jenis_penilaian', ['bacaan', 'kuis', 'ujian'])
                      ->default('kuis')
                      ->after('siswa_id');
            }

            // Rename kolom deskripsi -> capaian_kompetensi (jika ada)
            if (
                Schema::hasColumn('laporan_hasil_belajars', 'deskripsi') &&
                !Schema::hasColumn('laporan_hasil_belajars', 'capaian_kompetensi')
            ) {
                $table->renameColumn('deskripsi', 'capaian_kompetensi');
            }
        });
    }

    public function down(): void
    {
        Schema::table('laporan_hasil_belajars', function (Blueprint $table) {

            if (Schema::hasColumn('laporan_hasil_belajars', 'jenis_penilaian')) {
                $table->dropColumn('jenis_penilaian');
            }

            if (
                Schema::hasColumn('laporan_hasil_belajars', 'capaian_kompetensi') &&
                !Schema::hasColumn('laporan_hasil_belajars', 'deskripsi')
            ) {
                $table->renameColumn('capaian_kompetensi', 'deskripsi');
            }
        });
    }
};
