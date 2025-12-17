<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        echo "🔧 Mengubah tugas_soals.id menjadi UUID...\n";
        
        // 1. DROP FOREIGN KEY dari tabel tugas_jawaban_details
        Schema::table('tugas_jawaban_details', function (Blueprint $table) {
            $table->dropForeign(['tugas_soal_id']);
        });
        echo "✅ Foreign key dihapus dari tugas_jawaban_details\n";
        
        // 2. Hapus AUTO_INCREMENT dari tugas_soals.id
        DB::statement('ALTER TABLE tugas_soals MODIFY id BIGINT UNSIGNED NOT NULL');
        
        // 3. Drop PRIMARY KEY di tugas_soals
        DB::statement('ALTER TABLE tugas_soals DROP PRIMARY KEY');
        
        // 4. Ubah tugas_soals.id ke VARCHAR(36)
        DB::statement('ALTER TABLE tugas_soals MODIFY id VARCHAR(36) NOT NULL');
        echo "✅ tugas_soals.id diubah ke varchar(36)\n";
        
        // 5. Ubah tugas_jawaban_details.tugas_soal_id ke VARCHAR(36)
        DB::statement('ALTER TABLE tugas_jawaban_details MODIFY tugas_soal_id VARCHAR(36)');
        echo "✅ tugas_jawaban_details.tugas_soal_id diubah ke varchar(36)\n";
        
        // 6. Generate UUID untuk data existing di tugas_soals
        $soals = DB::table('tugas_soals')->get();
        $mapping = []; // simpan mapping id lama -> id baru
        
        foreach ($soals as $soal) {
            $newUuid = (string) Str::uuid();
            $mapping[$soal->id] = $newUuid;
            
            DB::table('tugas_soals')
                ->where('id', $soal->id)
                ->update(['id' => $newUuid]);
        }
        echo "✅ UUID di-generate untuk {$soals->count()} soal\n";
        
        // 7. Update tugas_soal_id di tugas_jawaban_details sesuai mapping
        foreach ($mapping as $oldId => $newUuid) {
            DB::table('tugas_jawaban_details')
                ->where('tugas_soal_id', $oldId)
                ->update(['tugas_soal_id' => $newUuid]);
        }
        echo "✅ Foreign key values di tugas_jawaban_details diupdate\n";
        
        // 8. Set PRIMARY KEY baru di tugas_soals
        DB::statement('ALTER TABLE tugas_soals ADD PRIMARY KEY (id)');
        
        // 9. RESTORE FOREIGN KEY di tugas_jawaban_details
        Schema::table('tugas_jawaban_details', function (Blueprint $table) {
            $table->foreign('tugas_soal_id')
                  ->references('id')->on('tugas_soals')
                  ->onDelete('cascade');
        });
        echo "✅ Foreign key di-restore\n";
        
        echo "🎉 SELESAI! Kolom id sekarang UUID.\n";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback: kembali ke bigint auto_increment
        Schema::table('tugas_jawaban_details', function (Blueprint $table) {
            $table->dropForeign(['tugas_soal_id']);
        });
        
        DB::statement('ALTER TABLE tugas_soals DROP PRIMARY KEY');
        DB::statement('ALTER TABLE tugas_soals MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
        DB::statement('ALTER TABLE tugas_soals ADD PRIMARY KEY (id)');
        
        DB::statement('ALTER TABLE tugas_jawaban_details MODIFY tugas_soal_id BIGINT UNSIGNED');
        
        Schema::table('tugas_jawaban_details', function (Blueprint $table) {
            $table->foreign('tugas_soal_id')->references('id')->on('tugas_soals');
        });
    }
};
