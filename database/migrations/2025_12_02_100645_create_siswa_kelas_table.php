<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswa_kelas', function (Blueprint $table) {
            $table->id();
            
            // Foreign keys
            $table->char('siswa_id', 36); // UUID siswa
            $table->char('kelas_id', 36); // UUID kelas
            
            // Status enrollment
            $table->enum('status', ['aktif', 'selesai', 'berhenti'])->default('aktif');
            
            // Timestamps
            $table->timestamp('enrolled_at')->useCurrent(); // Tanggal daftar
            $table->timestamp('completed_at')->nullable(); // Tanggal selesai
            
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('siswa_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            
            // Unique constraint: satu siswa hanya bisa daftar 1x di kelas yang sama
            $table->unique(['siswa_id', 'kelas_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_kelas');
    }
};