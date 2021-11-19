<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $fillable = [//LISTA DE COLUMNAS/CAMPOS ACEPTADOS
        'user_id', //OPC 2
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'codigo',
        'correo',
        'telefono',
    ];

    public function user() // nombre del modelo en singular ya que una persona solo puede pertenecer a un usuario
    {
        return $this->belongsTo(User::class);// el metodo  regresa a si mismo y pertenece a user
    }//esto significa que cuando estemos en una instancia de mi persona podemos acceder al metodo user y a toda la info del usuario

    public function areas(){
        return $this->belongsToMany(Area::class);
    }
}
