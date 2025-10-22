<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Produk (mis: 'CR', 'JA', 'CC16')
            $table->string('sku')->unique()->nullable(); // Kode unik produk
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2)->default(0); // Harga Jual Satuan
            $table->decimal('cost', 15, 2)->default(0); // Harga Pokok / HPP
            $table->integer('stock_quantity')->default(0); // Jumlah stok (opsional)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};