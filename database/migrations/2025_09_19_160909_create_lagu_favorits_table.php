<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('lagu_favorit', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // relasi ke karyas (id_karya)
            $table->unsignedBigInteger('karya_id');
            $table->foreign('karya_id')
                ->references('id_karya')
                ->on('karyas')
                ->onDelete('cascade');

            $table->timestamps();

            // 1 user tidak boleh punya duplikat untuk karya yang sama
            $table->unique(['user_id', 'karya_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('lagu_favorit');
    }
};
