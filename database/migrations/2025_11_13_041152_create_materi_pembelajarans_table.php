<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materi_pembelajaran', function (Blueprint $table) {
            $table->id();
            $table->uuid('kelas_id');
            $table->integer('bab')->default(1);           // ✅ TAMBAH kolom BAB
            $table->integer('urutan')->default(1);
            $table->string('judul');
            $table->enum('tipe', ['bacaan', 'kuis', 'ujian']); // ✅ UBAH enum sesuai form
            $table->text('konten')->nullable();
            $table->string('file_path')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materi_pembelajaran');
    }
};
