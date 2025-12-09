<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tugas_jawabans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tugas_id')->constrained('tugas')->onDelete('cascade');
            // siswa_id di projectmu pakai UUID, jadi:
            $table->char('siswa_id', 36);
            $table->unsignedInteger('total_soal');
            $table->unsignedInteger('total_benar')->default(0);
            $table->unsignedTinyInteger('skor')->default(0); // 0-100
            $table->enum('status', ['pending', 'selesai'])->default('selesai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tugas_jawabans');
    }
};
