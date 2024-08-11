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
        Schema::create('credits_purchases', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('church_id')->constrained('churches')->onDelete('cascade');
            $table->foreignUuid('church_branch_id')->contrained('church_branches')->onDelete('set null');
            $table->string('uniqueId')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('number_of_credits')->nullable();
            $table->enum('status', ['Pending', 'Confirmed', 'Hold'])->default('Pending');
            $table->string('transaction_id')->nullable();
            $table->string('confirmation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credits_purchases');
    }
};
