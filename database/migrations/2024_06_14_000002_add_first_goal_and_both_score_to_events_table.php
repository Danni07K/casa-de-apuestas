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
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'first_goal')) {
                $table->string('first_goal')->nullable()->after('result');
            }
            if (!Schema::hasColumn('events', 'both_score')) {
                $table->enum('both_score', ['SI', 'NO'])->nullable()->after('first_goal');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'first_goal')) {
                $table->dropColumn('first_goal');
            }
            if (Schema::hasColumn('events', 'both_score')) {
                $table->dropColumn('both_score');
            }
        });
    }
}; 