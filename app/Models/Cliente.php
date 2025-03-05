<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
///agregar primero aqui antes de trabjar con el store
    protected $fillable= [
        'nombre',
        'apellido',
        'ruc',
        'razon_social',
        'email',
        'fecha_nacimiento',
        'direccion',
        'telefono'
];
}
