<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('status')->default('Kirim');
            $table->foreignId('pengolah_id')
                  ->nullable()
                  ->constrained('pengolah')
                  ->onDelete('set null');
            $table->string('sifat_naskah');
            $table->foreignId('jenis_naskah_id')
                  ->nullable()
                  ->constrained('jenis_surat')
                  ->onDelete('set null');
            $table->string('nama_pengirim');
            $table->string('jabatan_pengirim');
            $table->string('instansi_pengirim');
            $table->string('nomor_naskah');
            $table->date('tgl_naskah');
            $table->date('tgl_diterima');
            $table->text('ringkasan_isi_surat');
            $table->string('lampiran');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuk');
    }
};
