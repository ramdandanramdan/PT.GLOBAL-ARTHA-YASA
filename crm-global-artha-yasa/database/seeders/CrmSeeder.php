<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash; // Jangan lupa import Hash

class CrmSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Roles (atau cari jika sudah ada)
        // Ini adalah perbaikan untuk error duplicate entry
        $founderRole = Role::firstOrCreate(['name' => 'Founder']);
        $salesRole = Role::firstOrCreate(['name' => 'SPG Motoris']);

        // 2. Buat User (gunakan 'firstOrCreate' agar aman dijalankan ulang)
        $founder = User::firstOrCreate(
            ['email' => 'founder@gay.id'],
            [
                'name' => 'Founder Name',
                'role_id' => $founderRole->id,
                'password' => Hash::make('password'), // Ganti 'password' dengan password aman
            ]
        );

        $sales1 = User::firstOrCreate(
            ['email' => 'yohan@gay.id'],
            [
                'name' => 'Yohan Setiyawan',
                'role_id' => $salesRole->id,
                'password' => Hash::make('password'),
            ]
        );

        $sales2 = User::firstOrCreate(
            ['email' => 'dedy@gay.id'],
            [
                'name' => 'Dedy Ainun',
                'role_id' => $salesRole->id,
                'password' => Hash::make('password'),
            ]
        );

        // 3. Buat Produk & Pelanggan (gunakan 'firstOrCreate' juga)
        $productCR = Product::firstOrCreate(['name' => 'CR'], ['price' => 10000]);
        $productJA = Product::firstOrCreate(['name' => 'JA'], ['price' => 12000]);

        $customer1 = Customer::firstOrCreate(['name' => 'Toko A']);
        $customer2 = Customer::firstOrCreate(['name' => 'Toko B']);

        // 4. Buat Target untuk Sales
        $sales1->targets()->firstOrCreate(
            ['year' => now()->year, 'month' => now()->month],
            ['target_units' => 1820]
        );
        $sales2->targets()->firstOrCreate(
            ['year' => now()->year, 'month' => now()->month],
            ['target_units' => 1820]
        );

        // 5. Buat Transaksi Penjualan (Ini mungkin perlu logika berbeda agar tidak duplikat)
        // Untuk contoh, kita anggap order baru setiap di-seed
        $order1 = $sales1->saleOrders()->create([
            'customer_id' => $customer1->id,
            'order_date' => now(),
            'total_amount' => 7844000 // Total dari 500*10000 + 237*12000
        ]);

        // Cek agar tidak attach produk yang sama berulang kali jika seeder dijalankan tanpa migrate:fresh
        if (!$order1->products()->exists()) {
            $order1->products()->attach($productCR->id, ['quantity' => 500, 'unit_price' => 10000, 'subtotal' => 5000000]);
            $order1->products()->attach($productJA->id, ['quantity' => 237, 'unit_price' => 12000, 'subtotal' => 2844000]);
        }
    }
}