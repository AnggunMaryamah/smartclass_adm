<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tugas_jawaban_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tugas_jawaban_id')->constrained('tugas_jawabans')->onDelete('cascade');
            $table->foreignId('tugas_soal_id')->constrained('tugas_soals')->onDelete('cascade');
            $table->enum('jawaban_siswa', ['A', 'B', 'C', 'D'])->nullable();
            $table->boolean('benar')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tugas_jawaban_details');
    }
};
