<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // KOSONGKAN semua data lama di kolom pengolah_id untuk menghindari error
        DB::table('surat_masuk')->update(['pengolah_id' => null]);

        Schema::table('surat_masuk', function (Blueprint $table) {
            // Ubah tipe kolom menjadi string (CHAR 26) agar cocok dengan ULID
            $table->string('pengolah_id', 26)->nullable()->change();

            // Tambahkan foreign key baru yang mengarah ke tabel 'users'
            $table->foreign('pengolah_id')
                  ->references('id')->on('users')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            // (Untuk rollback) Kembalikan ke kondisi semula
            $table->dropForeign(['pengolah_id']);
            $table->unsignedBigInteger('pengolah_id')->nullable()->change();
            $table->foreign('pengolah_id')->references('id')->on('pengolah')->onDelete('set null');
        });
    }
};