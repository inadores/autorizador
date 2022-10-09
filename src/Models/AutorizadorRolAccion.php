<?php

namespace Inadores\Autorizador\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AutorizadorRolAccion extends Model
{
    use HasFactory;

    protected $table = "autorizador_rol_acciones";
    protected $fillable = ['accion', 'rol_id'];
    public $timestamps = false;

    public function rol()
    {
        return $this->belongsTo('Inadores\Autorizador\Models\AutorizadorRol', 'rol_id');
    }
}