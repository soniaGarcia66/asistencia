<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();//Definido desde la BD, validacion para que el campo sea unico
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');//cadena para la contraseña, guarda un hash para proteccion, cada vez q el usuario se loggea se vuelve a hacer el hash y se compara con el hash guardado
            $table->rememberToken();//permite cerrar el navegador y seguir loggeados
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();//cadena para poner una ruta hacia una foto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
