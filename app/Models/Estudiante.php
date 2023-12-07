<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $table = 'estudiante';
    protected $fillable = ['observacion','curso_id'];
    protected $guarded = [];

    public function user() {
        return $this->morphOne(User::class, 'userable');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }

}
