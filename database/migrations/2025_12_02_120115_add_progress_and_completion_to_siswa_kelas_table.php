<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('siswa_kelas', function (Blueprint $table) {
            // Cek dulu kolom mana yang belum ada
            if (!Schema::hasColumn('siswa_kelas', 'progress')) {
                $table->integer('progress')->default(0)->after('kelas_id');
            }
            
            if (!Schema::hasColumn('siswa_kelas', 'is_completed')) {
                $table->boolean('is_completed')->default(false)->after('progress');
            }
            
            if (!Schema::hasColumn('siswa_kelas', 'completed_at')) {
                $table->timestamp('completed_at')->nullable()->after('is_completed');
            }
        });
    }

    public function down()
    {
        Schema::table('siswa_kelas', function (Blueprint $table) {
            if (Schema::hasColumn('siswa_kelas', 'progress')) {
                $table->dropColumn('progress');
            }
            if (Schema::hasColumn('siswa_kelas', 'is_completed')) {
                $table->dropColumn('is_completed');
            }
            if (Schema::hasColumn('siswa_kelas', 'completed_at')) {
                $table->dropColumn('completed_at');
            }
        });
    }
};
