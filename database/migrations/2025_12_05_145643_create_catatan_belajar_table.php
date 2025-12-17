<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catatan_belajar', function (Blueprint $table) {
            $table->unsignedBigInteger('materi_id')->nullable();
            // primary key
            $table->uuid('id')->primary();

            // relasi
            $table->uuid('siswa_id');
            $table->uuid('kelas_id');

            // ⬇⬇⬇ INI KUNCI PERBAIKAN
            $table->unsignedBigInteger('materi_id')->nullable();

            // data
            $table->text('body');
            $table->timestamps();

            // foreign keys
            $table->foreign('siswa_id')
                ->references('id')
                ->on('siswas')
                ->cascadeOnDelete();

            $table->foreign('kelas_id')
                ->references('id')
                ->on('kelas')
                ->cascadeOnDelete();

            $table->foreign('materi_id')
                ->references('id')
                ->on('materi_pembelajaran')
                ->nullOnDelete();

            // index
            $table->index(['siswa_id', 'kelas_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catatan_belajar');
    }
};
