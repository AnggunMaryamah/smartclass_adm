<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign keys dulu jika ada
            // $table->dropForeign(['user_id']); // sesuaikan dengan FK Anda
            
            $table->dropPrimary('PRIMARY');
            $table->uuid('id')->primary()->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropPrimary('PRIMARY');
            $table->bigIncrements('id')->change();
        });
    }
};