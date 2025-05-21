<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storePresupuestoOriginal extends FormRequest
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
            'obra_nueva' => 'required|numeric|nullable',
            'reparaciones' => 'numeric|nullable',
            'adaptaciones' => 'numeric|nullable',
            'mobiliario' => 'numeric|nullable',
            'prefabricado' => 'numeric|nullable',
            'otros' => 'numeric|nullable',
            'file' => 'mimes:pdf|max:2048',
        ];
    }

    public function attributes()
    {
        return [
            'obra_nueva' => 'Obra Nueva',
            'reparaciones' => 'Reparaciones',
            'adaptaciones' => 'Adaptaciones',
            'mobiliario' => 'Mobiliario',
            'prefabricado' => 'Prefabricado',
            'otros' => 'Otros',
            'file' => 'Acuerdo',
        ];
    }

    public function messages()
    {
        return [
            'file.max' => 'Solo puede cargar archivos de hasta 2MB.',
        ];
    }
}
