<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_disposisi', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('surat_masuk_id')->nullable()->constrained('surat_masuk')->onDelete('set null');
            $table->string('action');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_disposisi');
    }
};
