<?php

namespace Inadores\Autorizador\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutorizadorRequest extends FormRequest
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
            'user_id' => 'required|numeric',
            'accion' => 'required|string|max:255'
        ];
    }
}