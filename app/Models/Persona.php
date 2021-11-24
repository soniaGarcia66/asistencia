<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [//LISTA DE COLUMNAS PERMITIDAS/CAMPOS ACEPTADOS
        'user_id', //OPC 2
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'codigo',
        'correo',
        'telefono',
        'archivo_original',
        'archivo_ruta',
        'mime',
    ];

    public function user() // nombre del modelo en singular ya que una persona solo puede pertenecer a un usuario
    {
        return $this->belongsTo(User::class);// el metodo  regresa a si mismo y pertenece a user
    }//esto significa que cuando estemos en una instancia de mi persona podemos acceder al metodo user y a toda la info del usuario

    public function areas(){
        return $this->belongsToMany(Area::class);
    }

    public function getNombreCompletoAttribute()
    {
        return $this->nombre . ' ' . $this->apellido_paterno . ' ' . $this->apellido_materno;
    }

    public function setNombreAttribute($nombre)
    {
        return $this->attributes['nombre'] =strtoupper($nombre);
    }
}
