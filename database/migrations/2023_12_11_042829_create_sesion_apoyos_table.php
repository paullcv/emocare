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
        Schema::create('sesion_apoyos', function (Blueprint $table) {
            $table->id();

            $table->string('motivo');
            $table->date('fecha');
            $table->time('hora');
            $table->unsignedBigInteger('estudiante_id');
            
            $table->foreign('estudiante_id')->references('id')->on('estudiante');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesion_apoyos');
    }
};
