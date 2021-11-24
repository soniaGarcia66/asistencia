<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pagos extends Model
{
    use HasFactory;

    protected $fillable = [//LISTA DE COLUMNAS PERMITIDAS/CAMPOS ACEPTADOS
      
        'name',
        'service_id',
        'price',
    ];
}
