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
        Schema::create('converts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('church_id')->constrained('churches')->onDelete('cascade');
            $table->uuid('church_branch_id')->nullable();
            $table->string('name');
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('location');
            $table->enum('status', ['Joined ', 'Pending', 'Not Interested'])->default('Pending');
            $table->date('joined_at')->nullable();
            $table->uuid('evangelism_id')->nullable();
            $table->string('follow_up_status')->nullable();
            $table->text('notes')->nullable();
            $table->uuid('member_id')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('converts');
    }
};
