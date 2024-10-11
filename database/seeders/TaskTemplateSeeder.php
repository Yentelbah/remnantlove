<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('task_templates')->insert([
            [
                'name' => 'Follow-up on First-time Visitors',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Weekly Group Check-ins',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Prepare for Sunday Worship Service',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'New Convert Follow-up',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tithes and Offerings Reconciliation',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Organize Outreach Event',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Call Absentee Members',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Annual Budget Review',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Volunteer Scheduling for Events',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Foundation School Progress Review',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Social Media Post Scheduling',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Youth Group Meeting Planning',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Church Maintenance Check',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Midweek Bible Study Preparation',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Prayer Requests Follow-up',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
