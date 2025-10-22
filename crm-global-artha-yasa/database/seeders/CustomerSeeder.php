<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = [
            ['name' => 'PT Surya Kencana', 'email' => 'surya@test.com', 'phone' => '08123456701', 'created_at' => Carbon::now()->subMonths(5)],
            ['name' => 'Budi Hartono', 'email' => 'budi.h@mail.com', 'phone' => '08123456702', 'created_at' => Carbon::now()->subMonths(2)],
            ['name' => 'Dewi Lestari', 'email' => 'dewi.l@email.com', 'phone' => '08123456703', 'created_at' => Carbon::now()->subDays(15)], // Pelanggan baru
            ['name' => 'Toko Makmur Jaya', 'email' => 'makmur@jaya.co.id', 'phone' => '08123456704', 'created_at' => Carbon::now()->subYears(1)],
            ['name' => 'Ahmad R', 'email' => 'ahmad.r@gmail.com', 'phone' => '08123456705', 'created_at' => Carbon::now()->subDays(25)],
        ];

        foreach ($customers as $customer) {
            DB::table('customers')->insert([
                'name' => $customer['name'],
                'email' => $customer['email'],
                'phone' => $customer['phone'],
                'created_at' => $customer['created_at'],
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}