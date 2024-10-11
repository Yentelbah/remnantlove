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
        Schema::create('foundation_school_modules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('church_id')->constrained('churches')->onDelete('cascade');
            $table->uuid('church_branch_id')->nullable();
            $table->uuid('foundation_school_id');
            $table->uuid('module_id');
            $table->date('completion_date')->nullable();
            $table->enum('progress_status', ['In Progress','Missed', 'Completed', 'Not Started'])->default('Not Started');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foundation_school_modules');
    }
};
