<?php

namespace Inadores\Autorizador\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutorizadorRolUsuariosRequest extends FormRequest
{
    /**
     * funcion sin uso
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * reglas de validacion
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'rol_id' => 'required|numeric',
            'user_id' => 'required|numeric'
        ];
    }
}