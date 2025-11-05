<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID sebagai primary key
            $table->uuid('guru_id'); // relasi ke tabel guru
            $table->string('nama_kelas');
            $table->text('deskripsi')->nullable();
            $table->string('jenjang_pendidikan'); // SD, SMP, SMA, dst
            $table->decimal('harga', 10, 2); // harga bisa punya angka desimal
            $table->string('durasi'); // contoh: “1 bulan”, “1 semester”
            $table->string('jadwal_kelas')->nullable(); // misal Senin & Rabu pukul 10.00
            $table->text('materi_pembelajaran')->nullable(); // bisa berupa ringkasan materi
            $table->timestamps();

            // Foreign key ke tabel guru
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};


