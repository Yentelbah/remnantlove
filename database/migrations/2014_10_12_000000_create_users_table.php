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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('church_id')->nullable();
            $table->foreign('church_id')->references('id')->on('churches')->onDelete('set null');
            $table->uuid('church_branch_id')->nullable();
            $table->foreign('church_branch_id')->references('id')->on('church_branches')->onDelete('set null');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->uuid('church_role_id')->nullable();
            $table->foreign('church_role_id')->references('id')->on('church_roles')->onDelete('set null');
            $table->uuid('member_id')->unique()->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->enum('status', ['Active', 'Inactive', 'Blocked'])->default('Active');
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
