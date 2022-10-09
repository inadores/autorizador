<?php
namespace Inadores\Autorizador;

use Inadores\Autorizador\Models\AutorizadorAccion;
use Inadores\Autorizador\Models\AutorizadorRolAccion;
use Inadores\Autorizador\Models\AutorizadorRolUsuario;

class Validador
{
    private string $usuario;
    private string $controlador;

    public function __construct($usuario, $controlador)
    {
        $this->usuario = $usuario;
        $controladorArray = explode('\\', $controlador);
        $this->controlador = end($controladorArray);
        //$this->controlador = str_replace('App\\Http\\Controllers\\', '', $controlador);
        // $this->usuario = ['user_id', '=', $usuario];
        // $this->controlador = ['accion', '=', str_replace('App\\Http\\Controllers\\', '', $controlador)];
    }

    public function porAccion():bool
    {
        //var_dump($this->controlador);
        $autorizado = AutorizadorAccion::where('user_id', $this->usuario)->where('accion', $this->controlador)->first();
        return !is_null($autorizado);
    }

    public function porRol():bool
    {
        $roles = AutorizadorRolAccion::where('accion', $this->controlador)->get();
        return $this->tieneElRol($roles);
    }

    private function tieneElRol($roles)
    {
        foreach ($roles as $rol)
        {
            $tieneElRol = AutorizadorRolUsuario::where('rol_id', $rol->id)->where('user_id', $this->usuario)->get();
            if(!is_null($tieneElRol))
            {
                return true;
            }
        }
        return false;
    }
}