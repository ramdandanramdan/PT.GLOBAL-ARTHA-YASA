<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role; // Pastikan model Role sudah ada dan diimpor
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Opsional: Membersihkan tabel sebelum seeding untuk migrate:fresh
        // Namun, jika Anda menggunakan migrate:fresh, ini mungkin tidak diperlukan
        // karena tabel sudah di-drop, tetapi tetap aman untuk jaga-jaga.
        // DB::table('roles')->truncate();

        // Daftar peran yang akan dimasukkan
        $roles = [
            'founder',
            'manager',
            'pic',
            'spg motoris',
            'sales',
            'admin', // Tambahkan admin (atau ganti 'founder' jika itu peran utama)
            'spg', // Tambahkan 'spg' jika digunakan terpisah dari 'spg motoris'
        ];

        // Memasukkan data peran
        foreach ($roles as $roleName) {
            Role::create(['name' => $roleName]);
        }
    }
}