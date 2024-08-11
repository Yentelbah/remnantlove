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
        Schema::create('pastors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('church_id')->constrained('churches')->onDelete('cascade');
            $table->uuid('church_branch_id')->nullable();
            $table->foreign('church_branch_id')->references('id')->on('church_branches')->onDelete('set null');
            $table->uuid('member_id')->nullable();
            $table->date('ordination_date');
            $table->text('family_details')->nullable();
            $table->string('education_background')->nullable();
            $table->text('ministry_training')->nullable();
            $table->text('church_roles')->nullable();
            $table->text('publications')->nullable();
            $table->text('hobbies_interests')->nullable();
            $table->text('health_status')->nullable();
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pastors');
    }
};
