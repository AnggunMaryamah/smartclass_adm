<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('pembayarans', function (Blueprint $table) {
        $table->uuid('siswa_id')->after('id');

        $table->foreign('siswa_id')
              ->references('id')
              ->on('siswas')
              ->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('pembayarans', function (Blueprint $table) {
        $table->dropForeign(['siswa_id']);
        $table->dropColumn('siswa_id');
    });
}
};
