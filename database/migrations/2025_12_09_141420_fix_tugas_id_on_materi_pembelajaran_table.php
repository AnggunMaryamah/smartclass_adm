<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('materi_pembelajaran', function (Blueprint $table) {
            $table->dropColumn('tugas_id');
        });

        Schema::table('materi_pembelajaran', function (Blueprint $table) {
            $table->unsignedBigInteger('tugas_id')->nullable()->after('kelas_id');
        });
    }

    public function down()
    {
        Schema::table('materi_pembelajaran', function (Blueprint $table) {
            $table->dropColumn('tugas_id');
        });
    }
};

