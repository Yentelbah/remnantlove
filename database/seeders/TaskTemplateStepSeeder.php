<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTemplateStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('task_template_steps')->insert([
            // Follow-up on First-time Visitors
            ['template_id' => 1, 'description' => 'Collect contact information', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 1, 'description' => 'Call or message the visitor to thank them', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 1, 'description' => 'Share details about the next church event', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 1, 'description' => 'Invite them to join a small group', 'created_at' => now(), 'updated_at' => now()],

            // Weekly Group Check-ins
            ['template_id' => 2, 'description' => 'Review attendance from last week\'s group', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 2, 'description' => 'Check on any absent members', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 2, 'description' => 'Plan the agenda for the next meeting', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 2, 'description' => 'Send a reminder message to group members', 'created_at' => now(), 'updated_at' => now()],

            // Prepare for Sunday Worship Service
            ['template_id' => 3, 'description' => 'Confirm the worship team lineup', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 3, 'description' => 'Prepare the audio/visual setup', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 3, 'description' => 'Ensure all equipment is ready and functioning', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 3, 'description' => 'Review the service flow with the pastor or service leader', 'created_at' => now(), 'updated_at' => now()],

            // New Convert Follow-up
            ['template_id' => 4, 'description' => 'Send a welcome message to the new convert', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 4, 'description' => 'Share next steps in the church\'s discipleship program', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 4, 'description' => 'Assign a mentor for further follow-up', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 4, 'description' => 'Schedule the new convert for the Foundation School', 'created_at' => now(), 'updated_at' => now()],

            // Organize Outreach Event
            ['template_id' => 5, 'description' => 'Plan event agenda and activities', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 5, 'description' => 'Recruit volunteers for the event', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 5, 'description' => 'Confirm the event location and permits', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 5, 'description' => 'Send reminders to members and volunteers', 'created_at' => now(), 'updated_at' => now()],

            // Call Absentee Members
            ['template_id' => 6, 'description' => 'Review attendance from last Sunday', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 6, 'description' => 'Identify members who were absent', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 6, 'description' => 'Reach out to absent members', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 6, 'description' => 'Record any feedback from the member', 'created_at' => now(), 'updated_at' => now()],

            // Annual Budget Review
            ['template_id' => 7, 'description' => 'Review last year\'s financial reports', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 7, 'description' => 'Set budget expectations for the new year', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 7, 'description' => 'Meet with the finance team to finalize the budget', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 7, 'description' => 'Present the budget to church leadership for approval', 'created_at' => now(), 'updated_at' => now()],

            // Tithes and Offerings Reconciliation
            ['template_id' => 8, 'description' => 'Collect offering data from last Sunday', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 8, 'description' => 'Input data into the church financial system', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 8, 'description' => 'Verify totals with the finance team', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 8, 'description' => 'Prepare the financial report for the leadership team', 'created_at' => now(), 'updated_at' => now()],

            // Volunteer Scheduling for Events
            ['template_id' => 9, 'description' => 'Identify events that require volunteers', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 9, 'description' => 'Assign volunteers to their respective roles', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 9, 'description' => 'Share the event schedule with volunteers', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 9, 'description' => 'Send reminders before the event', 'created_at' => now(), 'updated_at' => now()],

            // Foundation School Progress Review
            ['template_id' => 10, 'description' => 'Review the list of new converts attending Foundation School', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 10, 'description' => 'Check the progress of each convert', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 10, 'description' => 'Schedule a follow-up meeting with each student', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 10, 'description' => 'Prepare a final report for the pastor', 'created_at' => now(), 'updated_at' => now()],

            ['template_id' => 11, 'description' => 'Create a weekly content calendar for social media', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 11, 'description' => 'Draft posts for upcoming events and messages', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 11, 'description' => 'Get approval from church leadership on the posts', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 11, 'description' => 'Schedule approved posts on social media platforms', 'created_at' => now(), 'updated_at' => now()],

            // Youth Group Meeting Planning
            ['template_id' => 12, 'description' => 'Set the agenda for the youth group meeting', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 12, 'description' => 'Prepare necessary materials and activities', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 12, 'description' => 'Coordinate with youth leaders and parents for participation', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 12, 'description' => 'Ensure all materials are ready before the meeting', 'created_at' => now(), 'updated_at' => now()],

            // Church Maintenance Check
            ['template_id' => 13, 'description' => 'Conduct a walk-through of the church premises', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 13, 'description' => 'Identify maintenance needs or repairs', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 13, 'description' => 'Create a report on needed repairs and maintenance', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 13, 'description' => 'Schedule repairs to be completed before upcoming events', 'created_at' => now(), 'updated_at' => now()],

            // Midweek Bible Study Preparation
            ['template_id' => 14, 'description' => 'Gather and prepare teaching materials', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 14, 'description' => 'Organize the venue for the Bible study', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 14, 'description' => 'Ensure all technical equipment is set up and functioning', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 14, 'description' => 'Test all equipment before the study begins', 'created_at' => now(), 'updated_at' => now()],

            // Prayer Requests Follow-up
            ['template_id' => 15, 'description' => 'Review prayer requests submitted during service', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 15, 'description' => 'Reach out to individuals who submitted prayer requests', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 15, 'description' => 'Offer support and prayer to those in need', 'created_at' => now(), 'updated_at' => now()],
            ['template_id' => 15, 'description' => 'Document follow-up actions and responses', 'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}
