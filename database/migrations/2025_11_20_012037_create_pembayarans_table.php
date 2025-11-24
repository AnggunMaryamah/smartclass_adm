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
        Schema::create('pembayarans', function (Blueprint $table) {
        $table->id();
        $table->string('nama');              // nama orang yang bayar
        $table->integer('jumlah');           // nominal
        $table->date('tanggal');             // tanggal
        $table->string('qr_code');           // hasil scan QR
        $table->string('qr_image')->nullable(); // file gambar QR (opsional)
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
