<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->foreignUuid('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->date('tanggal_pesan');
            $table->decimal('nominal_tagihan', 10, 2);
            $table->enum('status_pemesanan', ['booking', 'dibatalkan'])->default('booking');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pemesanans');
    }
};

