<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sale_orders', function (Blueprint $table) {
            $table->id();
            // Relasi ke siapa sales-nya (dari tabel users)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // Relasi ke siapa pelanggannya
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');

            $table->timestamp('order_date'); // Tanggal transaksi
            $table->decimal('total_amount', 15, 2)->default(0); // Total Rupiah
            $table->string('status')->default('Completed'); // Mis: Pending, Completed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sale_orders');
    }
};