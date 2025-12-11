<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->enum('tipe', ['kuis', 'ujian_subbab', 'ujian_bab', 'ujian_akhir'])
                  ->default('kuis')
                  ->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropColumn('tipe');
        });
    }
};
