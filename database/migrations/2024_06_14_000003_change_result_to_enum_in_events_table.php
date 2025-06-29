<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Cambiar el tipo de la columna result a enum
        Schema::table('events', function (Blueprint $table) {
            $table->enum('result', ['local', 'empate', 'visitante'])->nullable()->change();
        });
    }

    public function down(): void
    {
        // Volver a varchar(255) si haces rollback
        Schema::table('events', function (Blueprint $table) {
            $table->string('result', 255)->nullable()->change();
        });
    }
}; 