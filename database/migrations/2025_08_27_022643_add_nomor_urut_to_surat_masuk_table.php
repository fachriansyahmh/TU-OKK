<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\SuratMasuk\Models\SuratMasuk;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            // Menambahkan kolom baru untuk nomor urut
            $table->integer('nomor_urut')->unsigned()->nullable()->after('id');
        });

        // Mengisi nomor urut untuk data yang sudah ada
        // Pastikan tidak ada data yang sedang berjalan saat migrasi ini dijalankan
        DB::statement('SET @row_number = 0;');
        DB::statement('UPDATE surat_masuk SET nomor_urut = (@row_number:=@row_number + 1) ORDER BY id ASC;');
    }

    public function down(): void
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            $table->dropColumn('nomor_urut');
        });
    }
};
