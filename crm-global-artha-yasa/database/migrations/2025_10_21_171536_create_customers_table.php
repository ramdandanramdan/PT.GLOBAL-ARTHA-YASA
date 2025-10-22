<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama pelanggan atau nama toko
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('category')->nullable(); // Misal: 'Retail', 'Grosir', 'Agen'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};