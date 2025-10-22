<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;

class InitialRoleUserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat roles dasar bila belum ada
        $roles = ['Founder', 'Manager', 'PIC', 'SPG Motoris', 'SPG'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Ambil role Founder
        $founderRole = Role::where('name', 'Founder')->first();

        // Buat user Founder (dummy)
        $founder = User::firstOrCreate(
            ['email' => 'founder@globalartha-yasa.local'],
            [
                'name' => 'Founder Global Artha Yasa',
                'password' => Hash::make('P@ssw0rd123'), // password dummy
                'role_id' => $founderRole->id,
                'is_active' => true,
                'email_verified_at' => Carbon::now(), // agar bypass verifikasi saat testing
            ]
        );

        // Contoh akun tambahan (opsional)
        $managerRole = Role::where('name', 'Manager')->first();

        User::firstOrCreate(
            ['email' => 'manager@globalartha-yasa.local'],
            [
                'name' => 'Manager CV Global Artha Yasa',
                'password' => Hash::make('Manager#2025'),
                'role_id' => $managerRole->id,
                'is_active' => true,
                'email_verified_at' => Carbon::now(),
            ]
        );

        // Kamu bisa tambahkan user PIC / SPG dsb dengan pola yang sama
    }
}