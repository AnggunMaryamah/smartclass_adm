<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            // Cek dulu apakah kolom sudah ada
            if (!Schema::hasColumn('pembayarans', 'verified_by')) {
                $table->char('verified_by', 36)->nullable()->after('status_pembayaran');
            }
            if (!Schema::hasColumn('pembayarans', 'verified_at')) {
                $table->timestamp('verified_at')->nullable()->after('verified_by');
            }
            
            // Foreign key ke gurus (opsional, bisa comment dulu kalau error)
            // Cek dulu apakah foreign key sudah ada
            // if (!Schema::hasColumn('pembayarans', 'verified_by')) {
            //     $table->foreign('verified_by')->references('id')->on('gurus')->onDelete('set null');
            // }
        });
    }

    public function down()
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            // $table->dropForeign(['verified_by']);
            if (Schema::hasColumn('pembayarans', 'verified_by')) {
                $table->dropColumn('verified_by');
            }
            if (Schema::hasColumn('pembayarans', 'verified_at')) {
                $table->dropColumn('verified_at');
            }
        });
    }
};
