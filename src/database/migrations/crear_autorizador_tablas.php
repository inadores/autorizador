<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    
    public function up()
    {
        $this->crearTablaAcciones();
        $this->crearTablaRoles();
        $this->crearTablaRolesAcciones();
        $this->crearTablaRolesUsuaros();
    }

    public function down()
    {
        Schema::dropIfExists('autorizador_rol_usuarios');
        Schema::dropIfExists('autorizador_rol_acciones');
        Schema::dropIfExists('autorizador_roles');
        Schema::dropIfExists('autorizador_acciones');
    }

    private function crearTablaAcciones()
    {
        Schema::create('autorizador_acciones', function (Blueprint $table) 
        {
            $table->id();
            $table->string('accion');
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
        echo ("\n....tabla autorizador_acciones DONE\n");
    } 

    private function crearTablaRoles()
    {
        Schema::create('autorizador_roles', function(Blueprint $table)
        {
            $table->id();
            $table->string('rol');
            $table->string('descripcion');
        });
        echo ("....tabla autorizador_roles DONE\n");
    }

    private function crearTablaRolesAcciones()
    {
        Schema::create('autorizador_rol_acciones', function (Blueprint $table)
        {
            $table->id();
            $table->string('accion');
            $table->unsignedBigInteger('rol_id');

            $table->foreign('rol_id')->references('id')->on('autorizador_roles')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        echo ("....tabla autorizador_rol_acciones DONE\n");
    }

    private function crearTablaRolesUsuaros()
    {
        Schema::create('autorizador_roles_usuarios', function (Blueprint $table)
        {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('rol_id');

            $table->foreign('rol_id')->references('id')->on('autorizador_roles')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
        echo ("....tabla autorizador_rol_acciones DONE\n  crear_autorizador_tablas ");
    }
};