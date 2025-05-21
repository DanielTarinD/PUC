<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class storeFuente extends FormRequest
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
            'ejercicio_id' => 'required',
            'nombre' => ['required',Rule::unique('fuentes')
                        ->where('ejercicio_id', $this->ejercicio_id)],
            'descripcion' => 'required',
            'techo_presupuestal' => 'numeric|min:1',
        ];
    }

    public function attributes()
    {
        return [
            'entidadejecutora_id' => 'Entidad Ejecutora',
            'ejercicio_id' => 'Ejercicio',
            'nombre' => 'Nombre de la Fuente',
            'descripcion' => 'Descripcion de la Fuente',
            'techo_presupuestal' => 'Techo Presupuestal',
        ];
    }

    public function messages()
    {
        return [
            'nombre.unique' => "El nombre de la Fuente ya existe.",
            'monto_original.min' => "Debe especificar un Techo Presupuestal Válido"
        ];
    }
}
