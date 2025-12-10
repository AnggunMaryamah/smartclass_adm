<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus data lama dulu (opsional, kalau ada data penting backup dulu)
        DB::table('materi_progress')->truncate();
        
        // Hapus kolom id INT auto increment
        Schema::table('materi_progress', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        // Tambah kolom id UUID sebagai primary key
        Schema::table('materi_progress', function (Blueprint $table) {
            $table->uuid('id')->primary()->first();
        });
    }

    public function down(): void
    {
        // Kembalikan ke INT auto increment
        Schema::table('materi_progress', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        Schema::table('materi_progress', function (Blueprint $table) {
            $table->id()->first();
        });
    }
};
