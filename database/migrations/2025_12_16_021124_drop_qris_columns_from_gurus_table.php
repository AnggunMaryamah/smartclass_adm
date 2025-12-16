<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
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

    public function down(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->string('qris_image')->nullable();
            $table->string('qris_nama_bank', 100)->nullable();
            $table->text('qris_catatan')->nullable();
        });
    }
};