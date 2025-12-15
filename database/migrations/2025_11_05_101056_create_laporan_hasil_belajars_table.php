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
        Schema::table('laporan_hasil_belajars', function (Blueprint $table) {
            // Tambahkan kolom komentar_guru jika belum ada
            if (!Schema::hasColumn('laporan_hasil_belajars', 'komentar_guru')) {
                $table->text('komentar_guru')->nullable();
            }

            // Tambahkan kolom catatan_admin jika belum ada
            if (!Schema::hasColumn('laporan_hasil_belajars', 'catatan_admin')) {
                $table->text('catatan_admin')->nullable();
            }

            // Tambahkan kolom status_validasi jika belum ada
            if (!Schema::hasColumn('laporan_hasil_belajars', 'status_validasi')) {
                $table->enum('status_validasi', ['pending', 'valid', 'invalid'])->default('pending');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_hasil_belajars', function (Blueprint $table) {
            if (Schema::hasColumn('laporan_hasil_belajars', 'komentar_guru')) {
                $table->dropColumn('komentar_guru');
            }

            if (Schema::hasColumn('laporan_hasil_belajars', 'catatan_admin')) {
                $table->dropColumn('catatan_admin');
            }

            if (Schema::hasColumn('laporan_hasil_belajars', 'status_validasi')) {
                $table->dropColumn('status_validasi');
            }
        });
    }
};
