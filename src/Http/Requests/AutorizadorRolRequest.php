<?php

namespace Inadores\Autorizador\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutorizadorRolRequest extends FormRequest
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
            'rol' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255'
        ];
    }
}