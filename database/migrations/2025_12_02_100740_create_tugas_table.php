<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();

            // relasi
            $table->uuid('kelas_id');
            $table->uuid('materi_id')->nullable(); // ❌ TANPA after()

            // data tugas
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->enum('status', ['pending', 'selesai'])->default('pending');

            $table->timestamps();

            // foreign key
            $table->foreign('kelas_id')
                ->references('id')
                ->on('kelas')
                ->cascadeOnDelete();

            // opsional (aktifkan kalau tabel materi sudah ada)
            // $table->foreign('materi_id')
            //     ->references('id')
            //     ->on('materis')
            //     ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
