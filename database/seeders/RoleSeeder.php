<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            ['name' => 'super_admin', 'guard_name' => 'web'],
            ['name' => 'staf', 'guard_name' => 'web'],
            ['name' => 'user', 'guard_name' => 'web'],
        ]);
    }
}
