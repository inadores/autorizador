<?php

namespace Inadores\Autorizador\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inadores\Autorizador\Controladores;
use Inadores\Autorizador\Http\Requests\AutorizadorRequest;
use Inadores\Autorizador\Http\Requests\AutorizadorRolAccionesRequest;
use Inadores\Autorizador\Http\Requests\AutorizadorRolUsuariosRequest;
use Inadores\Autorizador\Http\Requests\AutorizadorRolRequest;
use Inadores\Autorizador\Models\AutorizadorAccion;
use Inadores\Autorizador\Models\AutorizadorRol;
use Inadores\Autorizador\Models\AutorizadorRolAccion;
use Inadores\Autorizador\Models\AutorizadorRolUsuario;

class AutorizadorController extends Controller
{
    /**
     * listado de controladores y funciones de la carpeta controller
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Controladores::todos());
    }

    /**
     * listado de controladores y funciones habilidatas para el usuario
     * estas dos funciones van en el modelo User
        public function acciones(){return $this->hasMany('Inadores\Autorizador\Models\AutorizadorAccion');}
        public function roles(){return $this->belongsToMany('Inadores\Autorizador\Models\AutorizadorRolUsuario');}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mostrarUsuario($id)
    {
        $user = User::findOrFail($id);
        $user->roles;
        $user->acciones;
        return $user;
    }

    /**
     * info del rol y listado de controladores y funciones habilidatas para el rol
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mostrarRol($id)
    {
        $rol = AutorizadorRol::findOrFail($id);
        $rol->acciones;
        return $rol;
    }

    /**
     * info del rol y listado de controladores y funciones habilidatas para el rol
     * @return \Illuminate\Http\Response
     */
    public function listarRoles()
    {
        //return AutorizadorRol::all();

        $roles = AutorizadorRolAccion::join('autorizador_roles', 'autorizador_rol_acciones.rol_id', '=', 'autorizador_roles.id')
            ->selectRaw('autorizador_rol_acciones.id as accion_id,
                autorizador_rol_acciones.accion as controlador,
                autorizador_roles.id as rol_id,
                autorizador_roles.rol as rol,
                autorizador_roles.descripcion as descripcion'
            )->orderBy('rol')->get();    
        return response()->json($roles);
    }

    /**
     * crea un nuevo rol
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response json
     */
    public function nuevoRol(AutorizadorRolRequest $request)
    {
        $rol = AutorizadorRol::create($request->all());
        return response()->json(['id' => $rol->id]);
    }

    /**
     * modifica el rol
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response json
     */
    public function modificarRol(AutorizadorRolRequest $request, int $id)
    {
        $rol = AutorizadorRol::findOrFail($id);
        $rol->fill($request->all());
        $rol->save();
        return response()->json();
    }

    /**
     * agrega una accion al rol
     * @param  int  $id
     * @return \Illuminate\Http\Response json
     */
    public function eliminarRol(int $id)
    {
        $rows = AutorizadorRol::destroy($id);
        return response()->json();
    }

    /**
     * agrega una accion al rol
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response json
     */
    public function autorizarRol(AutorizadorRolAccionesRequest $request)
    {
        $rol = AutorizadorRolAccion::create($request->all());
        return response()->json(['id' => $rol->id]);
    }

    /**
     * quitar una accion al rol
     * @param  int  $id
     * @return \Illuminate\Http\Response json
     */
    public function desautorizarRol(AutorizadorRolAccionesRequest $request)
    {
        $rows = AutorizadorRolAccion::where('rol_id', $request->rol_id)->where('accion', $request->accion)->delete();
        return response()->json();
    }

    /**
     * le asigna un rol a un usuario
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response json
     */
    public function asignarRol(AutorizadorRolUsuariosRequest $request)
    {
        $rol = AutorizadorRolUsuario::create($request->all());
        return response()->json(['id' => $rol->id]);
    }

    /**
     * le de quita un rol a un usuario
     * @param  int  $id
     * @return \Illuminate\Http\Response json
     */
    public function denegarRol(AutorizadorRolUsuariosRequest $request)
    {
        $rows = AutorizadorRolUsuario::where('rol_id', $request->rol_id)->where('user_id', $request->user_id)->delete();
        return response()->json();
    }

    /**
     * agrega una accion al usuario
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response json
     */
    public function asignarAccion(AutorizadorRequest $request)
    {
        $accion = AutorizadorAccion::create($request->all());
        return response()->json(['id' => $accion->id]);
    }

    /**
     * denegar una accion al usuario
     * @param  int  $id
     * @return \Illuminate\Http\Response json
     */
    public function denegarAccion(int $id)
    {
        $rows = AutorizadorRolUsuario::destroy($id);
        return response()->json();
    }

    /**
     * quita todos los permisos a un usuario
     * @param  int  $id
     * @return \Illuminate\Http\Response json
     */
    public function resetearUsuario(int $id)
    {
        $accionesEliminadas = AutorizadorAccion::where('user_id', '=', $id)->delete();
        $rolesEliminados = AutorizadorRolUsuario::where('user_id', '=', $id)->delete();
        return response()->json(['rol'=>$rolesEliminados, 'accion'=>$accionesEliminadas]);
    }

    /**
     * quita todos los permisos a un rol
     * @param  int  $id
     * @return \Illuminate\Http\Response json
     */
    public function resetearRol(int $id)
    {
        $eliminados = AutorizadorRol::where('user_id', '=', $id)->delete();
        return response()->json(['rol'=>$eliminados]);
    }

}