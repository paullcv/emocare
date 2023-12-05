<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consejero extends Model
{
    use HasFactory;
    protected $table = 'consejero';
    protected $fillable = ['especialidad'];
    protected $guarded = [];

    public function user() {
        return $this->morphOne(User::class, 'userable');
    }
}
