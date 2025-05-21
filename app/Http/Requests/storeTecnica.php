<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeTecnica extends FormRequest
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
            'nombre_representante' => 'required',
            'cedula_representante' => 'required',
            'link_aceptacion' => 'required',
            'anexo_maquinaria' => 'required',
        ];

    }

    public function attributes()
    {
        return [
            'nombre_representante' => 'Nombre del Representante Técnico',
            'cedula_representante' => 'Cedula del Representante Técnico',
            'link_aceptacion' => 'Linl de la Aceptación del Representante Técnico',
            'anexo_maquinaria' => 'Link a las Facturas o Contratos de Maquinaria',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
