<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('karyas', function (Blueprint $t) {
            $t->id('id_karya');

            // Relasi ke musisi
            $t->foreignId('id_musisi')
              ->constrained('musisis', 'id_musisi')
              ->cascadeOnDelete();

            // Kolom utama
            $t->string('judul');

            // Tahun (opsional)
            $t->unsignedSmallInteger('tahun')->nullable();

            // Slug unik (untuk identifikasi karya)
            $t->string('slug')->unique();

            // File audio & cover
            $t->string('file_mp3')->nullable();
            $t->string('cover_path')->nullable();

            // Durasi lagu (opsional)
            $t->unsignedInteger('durasi_detik')->nullable();

            $t->timestamps();

            // Index
            $t->index(['id_musisi']);
            $t->index('judul');
        });
    }

    public function down(): void {
        Schema::dropIfExists('karyas');
    }
};
