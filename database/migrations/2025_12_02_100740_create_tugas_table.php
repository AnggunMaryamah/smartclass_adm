<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('tugas', function (Blueprint $table) {
        $table->uuid('id')->primary(); // ✅ PERBAIKAN BARIS 13

        // relasi
        $table->uuid('kelas_id');
        $table->uuid('materi_id')->nullable();

        // data tugas
        $table->string('judul');
        $table->text('deskripsi')->nullable();
        $table->timestamp('deadline')->nullable();
        $table->enum('status', ['pending', 'active', 'selesai'])->default('pending');
        $table->enum('tipe', ['kuis', 'ujian_bab', 'tugas_biasa'])->nullable(); // ✅ TAMBAHAN

        $table->timestamps();

        // foreign key
        //$table->foreign('kelas_id')
          //  ->references('id')
            //->on('kelas')
           // ->cascadeOnDelete();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
