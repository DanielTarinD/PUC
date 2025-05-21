<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeContable extends FormRequest
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
            'capital_contable' => 'numeric|nullable',
            'balance_contable' => 'numeric|nullable',
            'link_declaracion' => 'required',
        ];

    }

    public function attributes()
    {
        return [
            'capital_contable' => 'Capital Contable',
            'balance_contable' => 'Capital Contable del Balance General',
            'fecha_balance_general' => 'Fecha del Balance General',
            'link_declaracion' => 'Link a la Declaración Contable',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
