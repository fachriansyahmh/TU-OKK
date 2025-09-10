<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            // Mengubah nama kolom dari 'instansi_pengirim' menjadi 'asal_pengirim'
            $table->renameColumn('instansi_pengirim', 'asal_pengirim');
        });
    }

    public function down(): void
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            // Mengembalikan nama kolom jika migrasi di-rollback
            $table->renameColumn('asal_pengirim', 'instansi_pengirim');
        });
    }
};
