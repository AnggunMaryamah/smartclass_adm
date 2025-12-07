<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->string('qris_image')->nullable()->after('password');
            $table->string('qris_nama_bank')->nullable()->after('qris_image');
            $table->string('qris_nama_rekening')->nullable()->after('qris_nama_bank');
            $table->string('qris_no_hp')->nullable()->after('qris_nama_rekening');
        });
    }

    public function down()
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->dropColumn(['qris_image', 'qris_nama_bank', 'qris_nama_rekening', 'qris_no_hp']);
        });
    }
};
