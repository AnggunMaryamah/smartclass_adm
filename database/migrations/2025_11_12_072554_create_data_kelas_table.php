<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_guru');
            $table->string('nama_kelas');
            $table->string('durasi_pengajaran');
            $table->string('tahun_ajaran');
            $table->string('status_guru');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_kelas');
    }
};