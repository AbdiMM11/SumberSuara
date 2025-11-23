<?php
// database/migrations/2025_01_01_000010_create_artikels_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('artikels', function (Blueprint $table) {
            $table->id('id_artikel');
            $table->string('author');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('konten');
            $table->string('metatag')->nullable();
            $table->string('cover_path')->nullable();     // untuk gambar
            $table->timestamp('published_at')->nullable(); // tanggal rilis
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('artikels'); }
};
