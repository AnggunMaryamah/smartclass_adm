<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Ubah tipe kolom 'tipe' dari enum lama ke string dulu
        DB::statement("ALTER TABLE `materi_pembelajaran` MODIFY COLUMN `tipe` VARCHAR(20) NOT NULL");
        
        // 2. Tambah kolom bab
        Schema::table('materi_pembelajaran', function (Blueprint $table) {
            if (!Schema::hasColumn('materi_pembelajaran', 'bab')) {
                $table->integer('bab')->default(1)->after('kelas_id');
            }
        });
        
        // 3. Update nilai tipe yang mungkin sudah ada
        // (misal: 'video' -> 'bacaan', 'pdf' -> 'bacaan')
        DB::table('materi_pembelajaran')
            ->whereIn('tipe', ['video', 'pdf', 'gambar'])
            ->update(['tipe' => 'bacaan']);
    }

    public function down(): void
    {
        // Revert changes
        Schema::table('materi_pembelajaran', function (Blueprint $table) {
            if (Schema::hasColumn('materi_pembelajaran', 'bab')) {
                $table->dropColumn('bab');
            }
        });
    }
};
