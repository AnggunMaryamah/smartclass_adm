<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE tugas MODIFY COLUMN status ENUM('pending', 'active', 'selesai') DEFAULT 'pending'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE tugas MODIFY COLUMN status ENUM('pending', 'selesai') DEFAULT 'pending'");
    }
};
