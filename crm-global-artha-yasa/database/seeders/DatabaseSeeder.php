<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    // Trait ini berfungsi untuk menonaktifkan event model saat seeding,
    // yang dapat meningkatkan performa seeding, terutama pada data dalam jumlah besar.
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil semua seeder kustom yang dibutuhkan untuk mengisi data awal.
        // Urutan pemanggilan sangat penting: Role harus ada sebelum User.
        $this->call([
                // 1. Base Data (Foundation)
            RoleSeeder::class,        // Harus dijalankan pertama
            UserSeeder::class,        // Membutuhkan data dari RoleSeeder

                // 2. Data Master/Pendukung
            CustomerSeeder::class,
                // ProductSeeder::class,   // Tambahkan ProductSeeder jika ada

                // 3. Data Transaksional/Simulasi
            TransactionSeeder::class, // Membutuhkan data dari User dan Customer

            // Tambahkan seeder lain (misalnya, TargetSeeder, AttendanceSeeder) di sini.
        ]);
    }
}