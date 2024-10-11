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
        Schema::create('attendances', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('church_id')->constrained('churches')->onDelete('cascade');
            $table->foreignUuid('service_id')->constrained('church_services')->onDelete('cascade');
            $table->uuid('church_branch_id')->nullable();
            $table->integer('children_males');
            $table->integer('children_females');
            $table->integer('adult_males');
            $table->integer('adult_females');
            $table->integer('total_attendance');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
