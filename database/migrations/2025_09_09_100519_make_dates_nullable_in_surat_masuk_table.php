<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            // Mengubah kolom tanggal agar boleh kosong (nullable)
            $table->date('tgl_naskah')->nullable()->change();
            $table->date('tgl_diterima')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            // (Untuk rollback) Mengembalikan ke kondisi semula
            $table->date('tgl_naskah')->nullable(false)->change();
            $table->date('tgl_diterima')->nullable(false)->change();
        });
    }
};