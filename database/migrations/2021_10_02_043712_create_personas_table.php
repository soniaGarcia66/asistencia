<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            //metodo foreign+ nombbre de columna + constrained(agrega las restricciones para q a nivel de BD cuando queremos agregar un registro, pida forzosamente el id del registro)
            $table->foreignId('user_id')->constrained();//hacer migrate fresh para que vuelva a crear la tabla ahora con userid
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno')->nullable();
            $table->string('codigo');
            $table->string('telefono', 50)->default('');
            $table->string('correo')->default('');
            $table->string('archivo_original');
            $table->string('archivo_ruta');
            $table->string('mime', 30);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
