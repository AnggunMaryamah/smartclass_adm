<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('laporan_hasil_belajars', function (Blueprint $table) {
            // kondisi di SERVER nanti: masih pakai nama lama `catatan`
            if (Schema::hasColumn('laporan_hasil_belajars', 'catatan')) {
                $table->renameColumn('catatan', 'catatan_guru');
            }
        });
    }
    public function down()
    {
        Schema::table('laporan_hasil_belajars', function (Blueprint $table) {
            if (Schema::hasColumn('laporan_hasil_belajars', 'catatan_guru')) {
                $table->renameColumn('catatan_guru', 'catatan');
            }
        });
    }
};

