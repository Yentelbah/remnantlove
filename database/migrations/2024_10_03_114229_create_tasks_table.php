<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('church_id')->constrained('churches')->onDelete('cascade');
            $table->foreignUuid('church_branch_id')->nullable()->constrained('church_branches')->onDelete('set null');
            $table->foreignUuid('created_by')->constrained('users')->onDelete('cascade');
            $table->string('title');  // Title of the task
            $table->text('description')->nullable();  // Detailed description of the task
            $table->foreignUuid('category_id')->nullable()->constrained('task_categories', 'id')->onDelete('cascade');
            $table->enum('status', ['to_do', 'in_progress', 'completed'])->default('to_do');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->date('due_date');  // When the task should be completed by
            $table->unsignedInteger('progress')->default(0);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
