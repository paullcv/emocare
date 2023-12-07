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
        Schema::create('respuestas', function (Blueprint $table) {
            $table->id();
            $table->text('respuesta'); // Cambiado a 'respuesta' según tu preferencia

            $table->unsignedBigInteger('pregunta_id');
            $table->unsignedBigInteger('estudiante_id');
            $table->string('sentimiento')->default('neutral'); // Valor predeterminado 'neutral'

            // Clave foránea para la relación con preguntas
            $table->foreign('pregunta_id')->references('id')->on('preguntas');

            // Clave foránea para la relación con estudiantes
            $table->foreign('estudiante_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuestas');
    }
};
