<?php

namespace Inadores\Autorizador\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AutorizadorRolUsuario extends Model
{
    use HasFactory;

    protected $table = "autorizador_roles_usuarios";
    protected $fillable = ['user_id', 'rol_id'];
    public $timestamps = false;
    
    public function roles()
    {
        return $this->hasMany('Inadores\Autorizador\Models\AutorizadorRol', 'rol_id');
    }

    public function usuarios()
    {
        return $this->hasMany('App\Models\User', 'user_id');
    }


}