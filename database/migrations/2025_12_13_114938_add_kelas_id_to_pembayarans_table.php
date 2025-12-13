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
        Schema::table('pembayarans', function (Blueprint $table) {
            // Tambah kolom kelas_id setelah siswa_id
            $table->uuid('kelas_id')->nullable()->after('siswa_id');
            
            // Tambah foreign key constraint
            $table->foreign('kelas_id')
                  ->references('id')
                  ->on('kelas')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            // Hapus foreign key dulu
            $table->dropForeign(['kelas_id']);
            
            // Baru hapus kolom
            $table->dropColumn('kelas_id');
        });
    }
};
