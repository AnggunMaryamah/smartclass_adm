<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            
            // Foreign keys - HARUS nullable() supaya ON DELETE SET NULL bisa jalan
            $table->uuid('admin_id')->nullable();  // ← Tambahkan ->nullable()
            $table->uuid('guru_id')->nullable();   // ← Tambahkan ->nullable()
            
            $table->string('nama_lengkap', 50);
            $table->string('nisn', 15);
            $table->string('email', 50);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->string('alamat', 100)->nullable();
            $table->string('nama_orangtua', 50);
            $table->string('email_orangtua', 50)->nullable();
            $table->string('no_hp_orangtua', 20)->nullable();  // Kolom baru
            $table->enum('status_akun', ['Aktif', 'Nonaktif'])->default('Aktif');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('siswas');
    }
};
