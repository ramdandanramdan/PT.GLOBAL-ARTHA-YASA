<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED
            $table->string('name')->unique(); // Contoh: Founder, Manager, PIC, SPG Motoris, SPG
            $table->timestamps();
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};