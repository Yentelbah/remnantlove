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
        Schema::create('foundation_schools', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('church_id')->constrained('churches')->onDelete('cascade');
            $table->uuid('church_branch_id')->nullable();
            $table->uuid('convert_id')->unique();
            $table->date('enrollment_date')->nullable();
            $table->date('graduation_date')->nullable();
            $table->enum('progress_status', ['In Progress', 'Completed', 'Dropped', 'Graduated', 'Not Started'])->default('Not Started');
            $table->integer('attendance')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foundation_schools');
    }
};
