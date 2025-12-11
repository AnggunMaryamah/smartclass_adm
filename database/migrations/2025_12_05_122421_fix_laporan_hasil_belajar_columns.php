<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('laporan_hasil_belajars', function (Blueprint $table) {
            // Tambah kolom jenis_penilaian: bacaan, kuis, ujian
            $table->enum('jenis_penilaian', ['bacaan', 'kuis', 'ujian'])->default('kuis')->after('siswa_id');
            // Ganti nama deskripsi jadi capaian_kompetensi agar jelas
            $table->renameColumn('deskripsi', 'capaian_kompetensi');
        });
    }

    public function down()
    {
        Schema::table('laporan_hasil_belajars', function (Blueprint $table) {
            $table->dropColumn('jenis_penilaian');
            $table->renameColumn('capaian_kompetensi', 'deskripsi');
        });
    }
};