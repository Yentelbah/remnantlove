<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('family_members', function (Blueprint $table) {
            DB::statement("ALTER TABLE family_members MODIFY relation ENUM('Spouse', 'Child', 'Parent', 'Sibling', 'Other', 'Head') DEFAULT 'Other'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('family_members', function (Blueprint $table) {
            DB::statement("ALTER TABLE family_members MODIFY relation ENUM('Spouse', 'Child', 'Parent', 'Sibling', 'Other') DEFAULT 'Other'");
        });
    }
};
