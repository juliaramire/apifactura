<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
//aqui se autorizan los campos que fueron validados
//que columnas permite ingresar datos
protected $fillable= [
        'nombre',
        'ruc',
        'razon_social',
        'direccion',
        'telefono'
];
}
