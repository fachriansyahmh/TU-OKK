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
            // Menambahkan foreign key ke tabel 'disposisi_kepada'
            $table->foreignId('disposisi_kepada_id')
                  ->nullable()
                  ->constrained('disposisi_kepada')
                  ->onDelete('set null');

            // Menambahkan foreign key ke tabel 'disposisi'
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
            // Hapus foreign key terlebih dahulu, menggunakan nama kolomnya
            $table->dropForeign(['disposisi_kepada_id']);
            $table->dropForeign(['disposisi_id']);

            // Kemudian hapus kolomnya
            $table->dropColumn(['disposisi_kepada_id', 'disposisi_id', 'isi_disposisi']);
        });
    }
};
