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
        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('church_id')->constrained('churches')->onDelete('cascade');
            $table->foreignUuid('church_branch_id')->nullable()->constrained('church_branches')->onDelete('set null');
            $table->string('batch')->nullable();
            $table->string('title');
            $table->string('recipient');
            $table->string('message');
            $table->string('sender');
            $table->enum('type', ['quick', 'scheduled','bulk'])->defualt('quick');
            $table->enum('mode', ['single', 'bulk']);
            $table->integer('credits')->nullable();
            $table->string('response')->nullable();
            $table->datetime('send_at')->nullable();
            $table->string('repeat')->nullable();
            $table->enum('status', ['pending', 'sent', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
