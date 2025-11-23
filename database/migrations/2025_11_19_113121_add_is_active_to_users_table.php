<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom is_active kalau belum ada
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')
                      ->default(true) // default: akun aktif
                      ->after('password');
            }
        });
    }

    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
};
