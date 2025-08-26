<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('log_surat_masuk', function (Blueprint $table) {
            // 1. Hapus foreign key yang lama agar kolom bisa diubah
            $table->dropForeign(['surat_masuk_id']);

            // 2. Ubah kolom agar bisa menerima nilai NULL
            // Catatan: Method ->change() membutuhkan package `doctrine/dbal`.
            // Jika Anda mendapatkan error baru, jalankan: composer require doctrine/dbal
            $table->foreignId('surat_masuk_id')->nullable()->change();

            // 3. Tambahkan kembali foreign key dengan aturan baru
            $table->foreign('surat_masuk_id')
                  ->references('id')->on('surat_masuk')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('log_surat_masuk', function (Blueprint $table) {
            // Mengembalikan ke aturan lama jika di-rollback
            $table->dropForeign(['surat_masuk_id']);
            $table->foreignId('surat_masuk_id')->nullable(false)->change();
            $table->foreign('surat_masuk_id')
                  ->references('id')->on('surat_masuk')
                  ->onDelete('cascade');
        });
    }
};
