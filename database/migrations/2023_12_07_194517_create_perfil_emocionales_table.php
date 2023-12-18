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
        Schema::create('perfil_emocionales', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('estudiante_id');
            $table->integer('resume_positivo')->nullable();
            $table->integer('resume_negativo')->nullable();
            $table->integer('resume_neutral')->nullable();


            $table->foreign('estudiante_id')->references('id')->on('estudiante');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfil_emocionales');
    }
};
