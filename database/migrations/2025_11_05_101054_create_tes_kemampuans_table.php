<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tes_kemampuans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->foreignUuid('guru_id')->nullable()->constrained('gurus')->onDelete('set null');
            $table->date('tanggal_tes');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tes_kemampuans');
    }
};

