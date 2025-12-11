<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aktivitas', function (Blueprint $table) {
            $table->id();
            $table->char('guru_id', 36)->nullable();  // UUID guru
            $table->char('siswa_id', 36)->nullable(); // UUID siswa (opsional)
            $table->char('kelas_id', 36)->nullable(); // UUID kelas (opsional)
            $table->string('tipe', 50);               // jenis aktivitas: siswa_masuk, kelas_baru, dll
            $table->string('judul', 255);             // judul singkat
            $table->text('deskripsi');                // deskripsi lengkap
            $table->timestamp('waktu');               // kapan aktivitas terjadi
            $table->timestamps();

            // Index untuk performance
            $table->index('guru_id');
            $table->index('waktu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas');
    }
};
