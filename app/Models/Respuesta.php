<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;

    
    protected $fillable = ['respuesta', 'pregunta_id', 'estudiante_id'];

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
}
