<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('profils', function (Blueprint $table) {
            $table->id('id_profil');
            $table->foreignId('id_musisi')
                  ->constrained('musisis', 'id_musisi')
                  ->onDelete('cascade');

            $table->string('nama_panggung')->nullable();

            // media
            $table->string('foto')->nullable(); // hero / cover utama
            $table->string('logo')->nullable();

            // galeri
            $table->string('foto_pilihan1')->nullable();
            $table->string('foto_pilihan2')->nullable();
            $table->string('foto_pilihan3')->nullable();

            // deskripsi
            $table->text('desk_musisi')->nullable();

            $table->timestamps();

            $table->index('id_musisi');
            $table->index('nama_panggung');
        });
    }

    public function down(): void {
        Schema::dropIfExists('profils');
    }
};
