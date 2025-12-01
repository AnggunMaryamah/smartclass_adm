<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('guru_id');
            
            $table->string('nama_kelas', 255);
            $table->text('deskripsi')->nullable();
            $table->enum('jenjang_pendidikan', ['SD', 'SMP', 'SMA'])->default('SD');
            
            $table->unsignedBigInteger('harga')->default(0);
            
            // UBAH INI - Tambahkan ->nullable()
            $table->string('durasi', 100)->nullable();
            
            $table->json('jadwal_kelas')->nullable();
            $table->text('materi_pembelajaran')->nullable();
            $table->unsignedInteger('jumlah_siswa')->default(0);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('guru_id');
            $table->index('jenjang_pendidikan');
            $table->index('status');
            
            $table->foreign('guru_id')
                  ->references('id')
                  ->on('gurus')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
