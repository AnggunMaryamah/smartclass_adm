<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('siswas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('admin_id')->constrained('admins')->onDelete('cascade');
            $table->foreignUuid('guru_id')->nullable()->constrained('gurus')->onDelete('set null');
            $table->string('nisn', 15)->unique();
            $table->string('nama_lengkap', 50);
            $table->string('email', 50)->unique();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->string('alamat', 100)->nullable();
            $table->string('nama_orangtua', 50);
            $table->string('email_orangtua', 50)->nullable();
            $table->enum('status_akun', ['Aktif', 'Nonaktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('siswas');
    }
};

