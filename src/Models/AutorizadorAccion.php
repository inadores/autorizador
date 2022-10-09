<?php

namespace Inadores\Autorizador\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AutorizadorAccion extends Model
{
    use HasFactory;

    protected $table = "autorizador_acciones";
    protected $fillable = ['user_id', 'accion'];
    public $timestamps = false;

    /**
     * relacion muchos a uno
     * @return Inadores\Autorizador\Models
     */
    public function usuario()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}