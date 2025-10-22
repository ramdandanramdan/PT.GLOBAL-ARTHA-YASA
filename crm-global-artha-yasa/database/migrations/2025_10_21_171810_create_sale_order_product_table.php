<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Ini adalah tabel pivot
        Schema::create('sale_order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            $table->integer('quantity'); // Jumlah unit produk yg terjual
            $table->decimal('unit_price', 15, 2); // Harga satuan saat itu
            $table->decimal('subtotal', 15, 2); // quantity * unit_price
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sale_order_product');
    }
};