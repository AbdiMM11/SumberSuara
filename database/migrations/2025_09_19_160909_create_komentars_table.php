<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('komentars', function (Blueprint $table) {
            $table->id('id_komentar');

            // relasi ke tabel artikels
            // NOTE:
            // - kalau PK di tabel artikels kamu = "id_artikel", biarkan seperti ini
            // - kalau PK-nya = "id", ubah 'id_artikel' jadi 'id'
            $table->unsignedBigInteger('artikel_id');
            $table->foreign('artikel_id')
                  ->references('id_artikel')   // SESUAIKAN dengan PK di tabel artikels
                  ->on('artikels')
                  ->cascadeOnDelete();

            // relasi ke users (yang komentar)
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // isi komentar
            $table->text('isi');

            $table->timestamps();

            // index tambahan (optional, tapi bagus untuk performa)
            $table->index(['artikel_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('komentars');
    }
};
