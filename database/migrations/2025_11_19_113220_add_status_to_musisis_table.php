<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('musisis', function (Blueprint $table) {
            // Tambah kolom status (pending / approved / rejected)
            if (!Schema::hasColumn('musisis', 'status')) {
                $table->enum('status', ['pending', 'approved', 'rejected'])
                      ->default('pending')
                      ->after('file_mp3');
            }

            // Tambah kolom approved_at (kapan disetujui admin)
            if (!Schema::hasColumn('musisis', 'approved_at')) {
                $table->timestamp('approved_at')
                      ->nullable()
                      ->after('status');
            }
        });
    }

    public function down(): void {
        Schema::table('musisis', function (Blueprint $table) {
            if (Schema::hasColumn('musisis', 'approved_at')) {
                $table->dropColumn('approved_at');
            }
            if (Schema::hasColumn('musisis', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
