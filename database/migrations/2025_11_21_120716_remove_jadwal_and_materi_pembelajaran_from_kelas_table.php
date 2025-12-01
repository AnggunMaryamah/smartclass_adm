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
        Schema::table('kelas', function (Blueprint $table) {
            // Drop kolom jadwal_kelas dan materi_pembelajaran
            $table->dropColumn(['jadwal_kelas', 'materi_pembelajaran']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            // Restore kolom jika rollback
            $table->json('jadwal_kelas')->nullable()->after('durasi');
            $table->text('materi_pembelajaran')->nullable()->after('jadwal_kelas');
        });
    }
};
