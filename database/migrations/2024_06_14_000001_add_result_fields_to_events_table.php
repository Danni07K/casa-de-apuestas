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
            // $table->enum('result', ['local', 'empate', 'visitante'])->nullable()->after('away_odds');
            $table->string('first_goal')->nullable()->after('result');
            $table->enum('both_score', ['SI', 'NO'])->nullable()->after('first_goal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['first_goal', 'both_score']);
        });
    }
}; 