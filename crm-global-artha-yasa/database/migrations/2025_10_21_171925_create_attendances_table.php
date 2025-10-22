<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            // Relasi ke siapa sales-nya
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('date');
            $table->enum('status', ['H', 'S', 'I', 'A']); // Hadir, Sakit, Izin, Alpha
            $table->text('notes')->nullable(); // Alasan jika S/I
            $table->timestamps();

            // 1 user hanya bisa punya 1 record absensi per hari
            $table->unique(['user_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};