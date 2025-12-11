<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Pastikan tabel ada
        if (!Schema::hasTable('kelas')) {
            // Jika tabel tidak ada, hentikan (agar tidak error)
            return;
        }

        // Tambah kolom hanya kalau belum ada
        if (!Schema::hasColumn('kelas', 'status')) {
            Schema::table('kelas', function (Blueprint $table) {
                $table->enum('status', ['aktif', 'nonaktif'])
                    ->default('aktif')
                    ->after('durasi'); // sesuaikan kalau kolom durasi tidak ada
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('kelas') && Schema::hasColumn('kelas', 'status')) {
            Schema::table('kelas', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};
