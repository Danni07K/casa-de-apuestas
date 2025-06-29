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
        Schema::create('bets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->enum('bet_type', ['1x2', 'primer_gol', 'ambos_marcan']);
            $table->string('selection'); // Ejemplo: 'INTER', 'EMPATE', 'PSG', 'SI', 'NO'
            $table->decimal('odds', 6, 2);
            $table->decimal('amount', 10, 2);
            $table->string('status')->default('pending'); // pending, won, lost
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bets');
    }
}; 