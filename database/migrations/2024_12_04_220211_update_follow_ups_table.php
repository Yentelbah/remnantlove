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
        Schema::table('follow_ups', function (Blueprint $table) {
            $table->string('method')->nullable()->change(); // Make 'method' nullable
            $table->text('notes')->nullable()->change(); // Make 'method' nullable
            $table->text('message')->nullable(); // Add 'message' column
            $table->uuid('contact_id'); // Add 'contact_id' column
            $table->enum('contact_type', ['member', 'convert', 'visitor'])->nullable();
            $table->dropColumn('convert_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('follow_ups', function (Blueprint $table) {
            $table->string('method')->nullable(false)->change(); // Revert 'method' to not nullable
            $table->dropColumn('message'); // Remove 'message' column
            $table->dropColumn('contact_id'); // Remove 'contact_id' column
            $table->enum('contact_type', ['member', 'convert', 'visitor'])->nullable();
            $table->uuid('convert_id')->unique();
        });
    }
};
