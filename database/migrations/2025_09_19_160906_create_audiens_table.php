<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('audiens', function (Blueprint $table) {
            $table->id('id_audiens');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('umur')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']); // L = Laki-laki, P = Perempuan
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('audiens');
    }
};

