<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            // Mengubah kolom menjadi string biasa, bukan foreign key
            $table->string('disposisi_kepada')->nullable();

            // Kolom ini tetap sebagai foreign key
            $table->foreignId('disposisi_id')
                  ->nullable()
                  ->constrained('disposisi')
                  ->onDelete('set null');

            $table->text('isi_disposisi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            // Menghapus foreign key dan kolom yang benar
            $table->dropForeign(['disposisi_id']);
            $table->dropColumn(['disposisi_kepada', 'disposisi_id', 'isi_disposisi']);
        });
    }
};
