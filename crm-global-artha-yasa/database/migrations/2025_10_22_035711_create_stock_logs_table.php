<?php

// database/migrations/..._create_stock_logs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_logs', function (Blueprint $table) {
            $table->id();
            // Tipe transaksi: 'in' (masuk dari pabrik) atau 'out' (keluar ke sales)
            $table->enum('type', ['in', 'out']);

            // Produk yang terlibat
            $table->foreignId('product_id')->constrained('products');

            // User yang menerima atau mencatat (Manager yang mencatat, atau Sales yang menerima)
            $table->foreignId('user_id')->constrained('users');

            $table->integer('quantity'); // Jumlah kuantitas
            $table->text('notes')->nullable(); // Catatan, misal: nama supplier (untuk Stock In)

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_logs');
    }
};