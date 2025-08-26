<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_surat_masuk', function (Blueprint $table) {
            $table->id();
            // Menggunakan foreignUlid agar cocok dengan tipe data ULID di tabel users
            $table->foreignUlid('user_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->foreignId('surat_masuk_id')->constrained('surat_masuk')->onDelete('cascade');
            $table->string('action'); // e.g., DIBUAT, DIPERBARUI, DIHAPUS
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_surat_masuk');
    }
};
