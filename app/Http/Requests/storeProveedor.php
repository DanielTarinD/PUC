<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class storeProveedor extends FormRequest
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
            'entidadejecutora_id' => 'required',
            'rfc' => ['required',Rule::unique('proveedores')],
            'nombre' => ['required', Rule::unique('proveedores')],
            'representante_legal' => 'required',
            'direccion_fiscal' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'entidadejecutora_id' => 'Entidad Ejecutora',
            'nombre' => 'Nombre de la Empresa',
            'direccion_fiscal' => 'Domicilio Fiscal de la Empresa',
            'representante_legal' => 'Representante Legal',
            'rfc' => 'RFC',

        ];
    }

    public function messages()
    {
        return [
            'nombre.unique' => "Este nombre de Empresa ya existe.",
            'rfc.unique' => "Este RFC ya existe.",
        ];
    }
}
