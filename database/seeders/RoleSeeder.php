<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['name' => 'System_admin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Church_admin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Branch_admin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Accountant', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Leader', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cashier', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'User', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
