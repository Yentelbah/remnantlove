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
        Schema::create('group_leaders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('church_id')->constrained('churches')->onDelete('cascade');
            $table->uuid('church_branch_id')->nullable();
            $table->foreignUuid('group_id')->constrained('groups')->onDelete('cascade');
            $table->foreignUuid('member_id')->constrained('members')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->date('date_appointed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_leaders');
    }
};
