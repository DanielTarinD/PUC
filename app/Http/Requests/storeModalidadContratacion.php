<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeModalidadContratacion extends FormRequest
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
            'nombre' => 'required|unique:modalidades_contratacion',
            'descripcion' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'nombre' => 'Nombre de la Modalidad de Contratación',
            'descripcion' => 'Descripcion de la Modalidad de Contratación',
        ];
    }

    public function messages()
    {
        return [
            'nombre.unique' => "El nombre de la Modalidad de Contrtación ya existe.",
        ];
    }
}
