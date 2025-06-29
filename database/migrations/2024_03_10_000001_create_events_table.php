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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('home_team');
            $table->string('away_team');
            $table->string('league');
            $table->enum('status', ['scheduled', 'live', 'finished', 'cancelled'])->default('scheduled');
            $table->date('date');
            $table->datetime('start_time');
            $table->decimal('home_odds', 6, 2);
            $table->decimal('draw_odds', 6, 2);
            $table->decimal('away_odds', 6, 2);
            $table->enum('result', ['local', 'empate', 'visitante'])->nullable();
            $table->string('first_goal')->nullable();
            $table->enum('both_score', ['SI', 'NO'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
}; 