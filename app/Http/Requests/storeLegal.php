<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeLegal extends FormRequest
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
            'empresa_id' => 'required',
            'folio_escritura' => 'required',
            'fecha_escritura' => 'required',
            'estado_expedicion' => 'required',
            'ciudad_expedicion' => 'required',
            'nombre_notario' => 'required',
            'numero_notario' => 'required',
            'folio_mercantil' => 'required',
            'fecha_mercantil' => 'required',
            'estado_formalizacion' => 'required',
            'ciudad_formalizacion' => 'required',
        ];

    }

    public function attributes()
    {
        return [
            'empresa_id' => 'Empresa',
            'folio_escritura' => 'Folio de Escritura',
            'fecha_escritura' => 'Fecha de Escritura',
            'estado_expedicion' => 'Estado de la Expedicion de la Escritura',
            'ciudad_expedicion' => 'Ciudad de la Expedicion de la Escritura',
            'nombre_notario' => 'Nombre del Notario/Corredor',
            'numero_notario' => 'Número del Notario/Corredor',
            'folio_mercantil' => 'Folio Mercantil',
            'fecha_mercantil' => 'Fecha del Folio Mercantil',
            'estado_formalizacion' => 'Estado de Formalización',
            'ciudad_formalizacion' => 'Ciudad de Formalización',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
