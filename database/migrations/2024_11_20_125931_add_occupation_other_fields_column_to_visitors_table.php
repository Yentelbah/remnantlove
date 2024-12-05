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
        Schema::table('visitors', function (Blueprint $table) {
            $table->date('dob')->nullable();
            $table->string('preferred_contact')->nullable();
            $table->string('best_time')->nullable();
            $table->string('occupation')->nullable();
            $table->string('invitee')->nullabe();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visitors', function (Blueprint $table) {
            // Drop the foreign key and column during rollback
        });
    }
};
