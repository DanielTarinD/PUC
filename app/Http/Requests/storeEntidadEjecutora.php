<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class storeEntidadEjecutora extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => ['required',Rule::unique('entidades_ejecutoras')],
            'siglas' => 'required',
            'domicilio' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'nombre' => 'Nombre',
            'siglas' => 'Siglas',
            'domicilio' => 'Domicilio',

        ];
    }

    public function messages()
    {
        return [
            'nombre.unique' => "El nombre de la Entidad Ejecutora ya existe.",
        ];
    }
}
