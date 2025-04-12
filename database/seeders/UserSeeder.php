<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role; // Tambahkan ini


class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Cek dan buat Admin PMR hanya jika belum ada
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],  // Cek berdasarkan email
            [
                'name' => 'Admin PMR',
                'password' => bcrypt('password'),
            ]
        );
        // Assign role 'super_admin' ke admin
        $admin->roles()->sync(Role::where('name', 'super_admin')->first()->id);

        // Cek dan buat Staf PMR hanya jika belum ada
        $staf = User::firstOrCreate(
            ['email' => 'staf@example.com'],  // Cek berdasarkan email
            [
                'name' => 'Staf PMR',
                'password' => bcrypt('password'),
            ]
        );
        // Assign role 'staf' ke staf
        $staf->roles()->sync(Role::where('name', 'staf')->first()->id);
    }
}
