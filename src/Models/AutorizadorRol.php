<?php

namespace Inadores\Autorizador\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AutorizadorRol extends Model
{
    use HasFactory;

    protected $table = "autorizador_roles";
    protected $fillable = ['rol', 'descripcion'];
    public $timestamps = false;

    public function acciones()
    {
        return $this->hasMany('Inadores\Autorizador\Models\AutorizadorRolAccion', 'rol_id');
    }

    public function usuarios()
    {
        return $this->belongsToMany('App\Models\User', 'autorizador_roles_usuarios', 'user_id', 'rol_id');
    }
}