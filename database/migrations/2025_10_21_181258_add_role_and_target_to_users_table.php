<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom role
            $table->string('role')->default('sales')->after('password');
            // Tambahkan kolom target (hanya relevan untuk sales)
            $table->unsignedInteger('target')->default(0)->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->dropColumn('target');
        });
    }
};