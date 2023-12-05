<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excel extends Model
{
    use HasFactory; 
    protected $table = 'excel'; // Reemplaza 'nombre_de_la_tabla' con el nombre real de tu tabla
//protected $primaryKey = 'Id'; // Reemplaza 'Id' con el nombre de la clave primaria si es diferente

    protected $fillable = [
        'Nombre', 'Apellido', 'Fecha Nacimiento', 'Correo Electronico', 'Contraseña', 'Curso', 'Direccion',
         'Boton' //esto es para aumentar campo en la tabla solo vista (boton)
    ];
}
