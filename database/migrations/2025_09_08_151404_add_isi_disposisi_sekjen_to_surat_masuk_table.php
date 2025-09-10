<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            // Menambahkan kolom baru sebelum kolom 'ringkasan_isi_surat'
            $table->text('isi_disposisi_sekjen_deputi')->nullable()->after('tgl_diterima');
        });
    }

    public function down(): void
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            // Menghapus kolom jika migrasi di-rollback
            $table->dropColumn('isi_disposisi_sekjen_deputi');
        });
    }
};
