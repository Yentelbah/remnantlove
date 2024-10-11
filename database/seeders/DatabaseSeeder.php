<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(SystemSeeder::class);
        $this->call(TaskTemplateSeeder::class);
        $this->call(TaskTemplateStepSeeder::class);
    }
}
