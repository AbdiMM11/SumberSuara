<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('musisis', function (Blueprint $table) {
            $table->id('id_musisi');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('no_telp')->nullable();
            $table->string('domisili')->nullable();
            $table->string('genre')->nullable();
            $table->string('spotify')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('file_mp3')->nullable();
            $table->timestamps();

            $table->index(['user_id','domisili','genre']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('musisis');
    }
};
