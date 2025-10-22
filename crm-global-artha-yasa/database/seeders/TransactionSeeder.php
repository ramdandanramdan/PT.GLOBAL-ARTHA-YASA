<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // --- BARU: Ambil ID dari salah satu Sales User ---
        // Asumsi 'users' memiliki kolom 'role' dengan nilai 'sales'
        $salesUser = DB::table('users')->where('role', 'sales')->first();

        // Cek jika sales user tidak ditemukan
        if (!$salesUser) {
            $this->command->warn('Tidak ada user dengan role "sales" ditemukan. Transaksi Seeder dilewati.');
            return;
        }

        $salesUserId = $salesUser->id; // ID Sales yang akan kita gunakan untuk semua transaksi


        // Data transaksi Anda
        $transactions = [
            // Customer 1 (Top Spender)
            ['customer_id' => 1, 'amount' => 5000000, 'date' => Carbon::now()->subDays(30)],
            ['customer_id' => 1, 'amount' => 7500000, 'date' => Carbon::now()->subDays(15)],
            ['customer_id' => 1, 'amount' => 6000000, 'date' => Carbon::now()->subDays(5)],
            // Customer 2
            ['customer_id' => 2, 'amount' => 1000000, 'date' => Carbon::now()->subDays(40)],
            ['customer_id' => 2, 'amount' => 1250000, 'date' => Carbon::now()->subDays(10)],
            // Customer 3 (Baru, 1 transaksi)
            ['customer_id' => 3, 'amount' => 3000000, 'date' => Carbon::now()->subDays(8)],
            // Customer 4
            ['customer_id' => 4, 'amount' => 2000000, 'date' => Carbon::now()->subDays(60)],
            ['customer_id' => 4, 'amount' => 2500000, 'date' => Carbon::now()->subDays(20)],
            // Customer 5
            ['customer_id' => 5, 'amount' => 1500000, 'date' => Carbon::now()->subDays(12)],
        ];

        foreach ($transactions as $tx) {
            DB::table('sale_orders')->insert([
                'customer_id' => $tx['customer_id'],
                'user_id' => $salesUserId, // BARU: Menambahkan ID sales yang bertanggung jawab
                'total_amount' => $tx['amount'],
                'order_date' => $tx['date'],
                'created_at' => $tx['date'],
                'updated_at' => $tx['date'],
            ]);
        }
    }
}