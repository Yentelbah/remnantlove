<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('converts', function (Blueprint $table) {
            // Assuming 'id' on members table is a UUID, add the shepherd column as UUID
            $table->uuid('shepherd_id')->nullable();  // Nullable in case not every convert has a shepherd

            // Adding the foreign key constraint to the members table (assuming 'id' is UUID in members table)
            $table->foreign('shepherd')->references('id')->on('members')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('converts', function (Blueprint $table) {
            // Drop the foreign key and column during rollback
            $table->dropForeign(['shepherd']);
            $table->dropColumn('shepherd');
        });
    }
};
