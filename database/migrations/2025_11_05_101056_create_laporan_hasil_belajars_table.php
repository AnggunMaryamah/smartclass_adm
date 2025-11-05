<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('laporan_hasil_belajars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->string('mata_pelajaran', 50);
            $table->integer('nilai')->nullable();
            $table->integer('kehadiran')->nullable();
            $table->text('catatan')->nullable();
            $table->enum('status_laporan', ['dikirim', 'belum dikirim'])->default('belum dikirim');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('laporan_hasil_belajars');
    }
};

