<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('pemesanan_id')->constrained('pemesanans')->onDelete('cascade');
            $table->date('tanggal_pembayaran')->nullable(); // tanggal ketika siswa bayar
            $table->string('qris_reference')->nullable();   // kode unik/ID transaksi dari QRIS
            $table->decimal('nominal_pembayaran', 10, 2);
            $table->string('bukti_pembayaran', 255)->nullable(); // foto/ss bukti bayar
            $table->enum('status_pembayaran', ['menunggu', 'lunas', 'gagal'])->default('menunggu');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pembayarans');
    }
};
