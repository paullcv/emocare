<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilEmocionale extends Model
{
    use HasFactory;

    protected $fillable = ['estudiante_id','resume_positivo','resume_negativo','resume_neutral'];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
}
