<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tugas_jawaban_details', function (Blueprint $table) {
            // Tidak perlu tambah kolom karena sudah ada semua yang dibutuhkan
            // Hanya pastikan kolom 'benar' bertipe tinyint(1)
        });
    }

    public function down()
    {
        Schema::table('tugas_jawaban_details', function (Blueprint $table) {
            //
        });
    }
};
