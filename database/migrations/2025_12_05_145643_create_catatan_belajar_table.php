<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catatan_belajar', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('siswa_id');
            $table->uuid('kelas_id');
            $table->uuid('materi_id')->nullable();
            $table->text('body'); // Isi catatan
            $table->timestamps();

            // Foreign keys
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('materi_id')->references('id')->on('materi_pembelajaran')->onDelete('cascade');

            // Index untuk performa query
            $table->index(['siswa_id', 'kelas_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catatan_belajar');
    }
};
