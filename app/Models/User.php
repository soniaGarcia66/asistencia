<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [//lista de atributos q queremos q manipule el usuario, todas las demas variables no mencionadas son campos internos q se manejan de otra forma
        'name', 'email', 'password', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [//Similar al fillable pero hace los contrario, ej: tenemos una api y regresamos un json con los datos del usuario pero no los regresa porque son confidenciales
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [//Verifica el correo
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function personas() //funcion para crear una instancia del usuario y a traves dela instancia del usuario llamar al metodo personas con todas las personas
    {
        return $this->hasMany(Persona::class);//mi modelo users tiene muchas personas
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
