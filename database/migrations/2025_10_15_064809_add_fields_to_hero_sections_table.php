<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('hero_sections', function (Blueprint $table) {
            // kolom gambar sekunder (nullable)
            if (!Schema::hasColumn('hero_sections', 'sec1')) $table->string('sec1')->nullable()->after('desk');
            if (!Schema::hasColumn('hero_sections', 'sec2')) $table->string('sec2')->nullable()->after('sec1');
            if (!Schema::hasColumn('hero_sections', 'sec3')) $table->string('sec3')->nullable()->after('sec2');

            // flag aktif
            if (!Schema::hasColumn('hero_sections', 'is_active')) $table->boolean('is_active')->default(true)->after('sec3');
        });
    }

    public function down(): void
    {
        Schema::table('hero_sections', function (Blueprint $table) {
            if (Schema::hasColumn('hero_sections', 'is_active')) $table->dropColumn('is_active');
            if (Schema::hasColumn('hero_sections', 'sec3')) $table->dropColumn('sec3');
            if (Schema::hasColumn('hero_sections', 'sec2')) $table->dropColumn('sec2');
            if (Schema::hasColumn('hero_sections', 'sec1')) $table->dropColumn('sec1');
        });
    }
};
