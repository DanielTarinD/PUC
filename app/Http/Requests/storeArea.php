<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class storeArea extends FormRequest
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
            'nombre' => ['required',Rule::unique('areas')
                        ->where('entidadejecutora_id', $this->entidadejecutora_id)],
            'descripcion' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'entidadejecutora_id' => 'Entidad Ejecutora',
            'nombre' => 'Nombre del Area',
            'descripcion' => 'Descripción del Area',
        ];
    }

    public function messages()
    {
        return [
            'nombre.unique' => "El nombre del Area ya existe.",
        ];
    }
}
