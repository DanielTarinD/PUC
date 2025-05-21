<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeRepresentante extends FormRequest
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
            'nombre_representante' => 'required',
            'numero_poder' => 'required',
            'fecha_poder' => 'required',
            'estado_expedicion' => 'required',
            'ciudad_expedicion' => 'required',
            'nombre_notario' => 'required',
            'numero_notario' => 'required',
            'nombre_corredor' => 'required',
            'numero_corredor' => 'required',
            'estado_corredor' => 'required',
            'ciudad_corredor' => 'required',
            'numero_mercantil' => 'required',
            'fecha_mercantil' => 'required',
            'estado_registro' => 'required',
            'ciudad_registro' => 'required',
        ];

    }

    public function attributes()
    {
        return [
            'empresa_id' => 'Empresa',
            'nombre_representante' => 'Nombre del Administrdor/Representante Legal',
            'numero_poder' => 'Número de la Escritura Pública donde se otorga el poder',
            'fecha_poder' => 'Fecha de la Escritura Pública donde se otorga el poder',
            'estado_expedicion' => 'Estado de Expedición del poder',
            'ciudad_expedicion' => 'Ciudad de Expedicion del poder',
            'nombre_notario' => 'Nombre del Notario Público que da fe',
            'numero_notario' => 'Número del Notario Público que da fe',
            'nombre_corredor' => 'Nombre del Corredor Público que da fe',
            'numero_corredor' => 'Nombre del Corredor Público que da fe',
            'estado_corredor' => 'Estado Sede del Notario/Corredor Público',
            'ciudad_corredor' => 'Ciudad Sede del Notario/Corredor Público',
            'numero_mercantil' => 'Número del Folio Mercantil del Registro Público de la Propiedad',
            'fecha_mercantil' => 'Fecha del Folio Mercantil del Registro Público de la Propiedad',
            'estado_registro' => 'Estado en que se formalizo el Registro Público de la Propiedad',
            'ciudad_registro' => 'Ciudad en que se formalizo el Registro Público de la Propiedad',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
