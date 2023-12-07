<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuestionario extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'descripcion'];

    //Relacion uno a muchos con cuestionario
    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }

    // En el modelo Cuestionario
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'cuestionario_usuario', 'cuestionario_id', 'user_id');
    }

    
    public function estudiantes()
    {
        return $this->belongsToMany(User::class, 'cuestionario_usuario', 'cuestionario_id', 'user_id');
    }
}
