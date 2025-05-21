<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeRefrendo extends FormRequest
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
            'solicitud_refrendo' => 'required',
            'domicilio_texto_refrendo' => 'required_with:domicilio_refrendo',
            'constancia_refrendo' => 'required',
            'declaracion_refrendo' => 'required',
        ];

    }

    public function attributes()
    {
        return [
            'empresa_id' => 'ERROR FATAL',
            'solicitud_refrendo' => 'Solicitud de Refrendo',
            'constancia_refrendo' => 'Constancia de Capacitación del año en curso',
            'declaracion_refrendo' => 'Declaracion Fiscal',
            'domicilio_refrendo' => 'Comprobante de Domicilio',
            'domicilio_texto_refrendo' => 'Domicilio',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
