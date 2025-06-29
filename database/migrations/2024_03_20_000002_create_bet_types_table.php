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
        Schema::create('bet_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description');
            $table->boolean('status')->default(true);
            $table->integer('min_selections')->default(1);
            $table->integer('max_selections')->default(1);
            $table->decimal('min_stake', 10, 2)->default(1.00);
            $table->decimal('max_stake', 10, 2)->default(1000.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bet_types');
    }
}; 