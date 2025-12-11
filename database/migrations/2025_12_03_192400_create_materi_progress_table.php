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
        Schema::create('materi_progress', function (Blueprint $table) {
            $table->uuid('id')->primary();   // ganti dari $table->id();
            $table->uuid('user_id');
            $table->uuid('kelas_id');
            $table->unsignedBigInteger('materi_id'); // atau uuid juga, sesuaikan
            $table->boolean('is_completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi_progress');
    }
};
