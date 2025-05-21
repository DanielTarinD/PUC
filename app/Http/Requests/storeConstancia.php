<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeConstancia extends FormRequest
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
            'folio_jefatura' => 'required',
            'fecha_expedicion' => 'required',
        ];

    }

    public function attributes()
    {
        return [
            'folio_jefatura' => 'Folio de Jefatura',
            'fecha_expedicion' => 'Fecha de Expedición de la Constancia',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
