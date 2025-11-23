<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('nama_event');
            $table->string('lokasi');
            $table->date('tanggal');
            $table->text('deskripsi')->nullable();
            $table->string('pengisi')->nullable();
            $table->string('flyer')->nullable(); // path file flyer
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
