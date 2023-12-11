<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesionApoyo extends Model
{
    use HasFactory;

    protected $fillable = ['motivo','fecha','hora','estudiante_id','observacion','recomendacion'];

    public function estudiante(){
        return $this->belongsTo(Estudiante::class);
    }
}
