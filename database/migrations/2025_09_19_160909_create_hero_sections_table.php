<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id('id_heroSec');
            $table->string('banner');          // gambar hero utama (desktop & mobile slide-1)
            $table->text('desk')->nullable();  // deskripsi overlay
            $table->string('sec1')->nullable(); // gambar sekunder 1 (mobile slide-2 & grid 1)
            $table->string('sec2')->nullable(); // gambar sekunder 2 (mobile slide-3 & grid 2)
            $table->string('sec3')->nullable(); // gambar sekunder 3 (mobile slide-4 & grid 3)
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('hero_sections');
    }
};
