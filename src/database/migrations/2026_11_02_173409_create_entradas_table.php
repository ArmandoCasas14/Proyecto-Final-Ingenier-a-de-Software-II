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
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funcion_id')->constrained('funcions')->restrictOnDelete();
            $table->foreignId('asiento_id')->constrained('asientos')->restrictOnDelete();
            $table->string('codigo',20)->unique();
            $table->string('nombre_cliente',70);
            $table->string('estado',20)->default('activa');
            $table->unsignedBigInteger('asiento_activo_id')->nullable()->storedAs(
                "CASE WHEN estado IN ('activa', 'utilizada') THEN asiento_id ELSE
                NULL END"
            );
            $table->unique(['funcion_id', 'asiento_activo_id'], 'entradas_funcion_asiento_activo_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
