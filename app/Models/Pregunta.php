<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable = ['pregunta','cuestionario_id'];

    //Relacion uno a muchos con cuestionario
    public function cuestionario(){
        return $this->belongsTo(Cuestionario::class);
    }

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }
}
