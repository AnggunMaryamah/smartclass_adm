<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('gurus', function (Blueprint $table) {
            // Cek dulu apakah kolom sudah ada
            if (!Schema::hasColumn('gurus', 'qris_image')) {
                $table->string('qris_image', 255)->nullable()->after('email');
            }
            if (!Schema::hasColumn('gurus', 'qris_nama_bank')) {
                $table->string('qris_nama_bank', 100)->nullable()->after('qris_image');
            }
            if (!Schema::hasColumn('gurus', 'qris_catatan')) {
                $table->text('qris_catatan')->nullable()->after('qris_nama_bank');
            }
        });
    }

    public function down()
    {
        Schema::table('gurus', function (Blueprint $table) {
            if (Schema::hasColumn('gurus', 'qris_image')) {
                $table->dropColumn('qris_image');
            }
            if (Schema::hasColumn('gurus', 'qris_nama_bank')) {
                $table->dropColumn('qris_nama_bank');
            }
            if (Schema::hasColumn('gurus', 'qris_catatan')) {
                $table->dropColumn('qris_catatan');
            }
        });
    }
};
