<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('targets', function (Blueprint $table) {
            $table->id();
            // Relasi ke siapa sales-nya
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedSmallInteger('year');
            $table->unsignedTinyInteger('month'); // 1-12
            $table->integer('target_units'); // Target unit (misal: 1820)
            $table->decimal('target_amount', 15, 2)->nullable(); // Target Rupiah
            $table->timestamps();

            // 1 user hanya punya 1 target per bulan
            $table->unique(['user_id', 'year', 'month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('targets');
    }
};