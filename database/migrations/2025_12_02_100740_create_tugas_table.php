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
            $table->char('kelas_id', 36);
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->enum('status', ['pending', 'selesai'])->default('pending');
            $table->timestamps();
            $table->uuid('materi_id')->nullable()->after('kelas_id');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
