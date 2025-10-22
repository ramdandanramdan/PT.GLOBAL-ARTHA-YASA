<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Role; // Impor Model Role
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. DAFTAR PERAN DAN PENGAMBILAN ROLE ID
        // Tambahkan 'sales' ke daftar peran yang akan dicari.
        $requiredRoles = ['founder', 'manager', 'pic', 'spg motoris', 'spg', 'sales'];
        $roles = [];

        foreach ($requiredRoles as $roleName) {
            // Gunakan Model Role (jika sudah diimpor) atau DB::table
            $role = Role::where('name', $roleName)->first();

            if (!$role) {
                // Hentikan seeder dan tampilkan pesan error jika peran tidak ditemukan
                $this->command->error("Gagal menjalankan UserSeeder: Peran '{$roleName}' tidak ditemukan di tabel roles.");
                return;
            }
            $roles[$roleName] = $role->id;
        }

        // 2. DATA USER INTI (SINGLE USER PER ROLE)
        $coreUsers = [
            [
                'name' => 'Founder Global Artha Yasa',
                'email' => 'founder@globalartha-yasa.local',
                'role_key' => 'founder',
                'history_months' => 10,
            ],
            [
                'name' => 'Bambang Manager',
                'email' => 'manager@globalartha-yasa.local',
                'role_key' => 'manager',
                'history_months' => 8,
            ],
            [
                'name' => 'Susi PIC',
                'email' => 'pic@globalartha-yasa.local',
                'role_key' => 'pic',
                'history_months' => 6,
            ],
            // FIX KRITIS: Tambahkan user 'sales' yang dicari TransactionSeeder
            [
                'name' => 'Dani Sales (General)',
                'email' => 'sales@globalartha-yasa.local',
                'role_key' => 'sales',
                'target' => 2000,
                'total_sales' => 1500,
                'history_months' => 7,
            ],
        ];

        foreach ($coreUsers as $user) {
            $data = [
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password'),
                'role_id' => $roles[$user['role_key']],
                'role' => $user['role_key'],
                'is_active' => true,
                'target' => $user['target'] ?? 0, // Gunakan 0 jika target tidak diset
                'total_sales' => $user['total_sales'] ?? 0,
                'created_at' => Carbon::now()->subMonths($user['history_months']),
                'updated_at' => Carbon::now(),
            ];
            DB::table('users')->insert($data);
        }

        // 3. DATA USER MASSAL (SPG MOTORIS)
        $massUsers = [
            [
                'name' => 'Yohan Setiyawan',
                'email' => 'yohan@gay.id',
                'role_key' => 'spg motoris',
                'target' => 1820,
                'is_active' => true,
                'total_sales' => 737
            ],
            [
                'name' => 'Dedy Amun',
                'email' => 'dedy@gay.id',
                'role_key' => 'spg motoris',
                'target' => 1820,
                'is_active' => true,
                'total_sales' => 0
            ],
            [
                'name' => 'Rina Sari',
                'email' => 'rina@gay.id',
                'role_key' => 'spg',
                'target' => 1800,
                'is_active' => false,
                'total_sales' => 1256
            ],
            [
                'name' => 'Maya SPG',
                'email' => 'maya@gay.id',
                'role_key' => 'spg',
                'target' => 1500,
                'is_active' => true,
                'total_sales' => 1500
            ],
        ];

        foreach ($massUsers as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password'),
                'role_id' => $roles[$user['role_key']],
                'role' => $user['role_key'],
                'is_active' => $user['is_active'],
                'target' => $user['target'],
                'total_sales' => $user['total_sales'],
                'created_at' => Carbon::now()->subMonths(rand(1, 12)),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}