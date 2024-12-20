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
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('church_id')->constrained('churches')->onDelete('cascade');
            $table->uuid('church_branch_id')->nullable();
            $table->date('entry_date');
            $table->text('description');
            $table->string('reference')->nullable();
            $table->decimal('amount', 10, 2);
            $table->boolean('is_deleted')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->enum('type', ['expense', 'revenue', 'equity', 'liability', 'asset']);
            $table->foreignUuid('user_id')->constrained()->onDelete('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_entries');
    }
};
