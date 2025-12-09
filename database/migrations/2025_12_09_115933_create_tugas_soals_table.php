<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tugas_soals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tugas_id')->constrained('tugas')->onDelete('cascade');
            $table->text('pertanyaan');
            $table->string('pilihan_a');
            $table->string('pilihan_b');
            $table->string('pilihan_c')->nullable();
            $table->string('pilihan_d')->nullable();
            $table->enum('jawaban_benar', ['A', 'B', 'C', 'D']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tugas_soals');
    }
};
