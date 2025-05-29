<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('santris', function (Blueprint $table) {
            // Hapus foreign key terlebih dahulu jika sebelumnya memakai constrained()
            $table->dropForeign(['pengajar_id']);
            $table->dropColumn('pengajar_id');

            // Tambahkan kolom baru pembimbing_id
            $table->foreignId('pembimbing_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('santris', function (Blueprint $table) {
            $table->dropForeign(['pembimbing_id']);
            $table->dropColumn('pembimbing_id');

            $table->foreignId('pengajar_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
        });
    }
};
