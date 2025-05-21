<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeObra extends FormRequest
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
            'nombre' => 'required',
            'cct' => 'required',
            'localidad' => 'required',
            'domicilio' => 'required',
            'fuente_id' => 'required',
            'pgo' => 'required|unique:obras',
            'modalidadcontratacion_id' => 'required',
            'acuerdo' => 'required',
            'monto_original' => 'numeric|min:1',
            'file' => 'mimes:pdf|max:2048',
        ];
    }

    public function attributes()
    {
        return [
            'pgo' => 'Número de PGO',
            'nombre' => 'Nombre de la Escuela',
            'cct' => 'CCT',
            'localidad' => 'Municipio o Localidad',
            'domicilio' => 'Domicilio',
            'fuente_id' => 'Fuente de Financiamiento',
            'modalidadcontratacion_id' => 'Modalidad de Contratación',
            'acuerdo' => 'Acuerdo',
            'monto_original' => 'Monto Original',
            'file' => 'Anexo Digital',
        ];
    }

    public function messages()
    {
        return [
            'pgo.unique' => "El Número de PGO ya existe.",
            'monto_original.min' => "Debe especificar un Monto Original Válido.",
            'file.mimes' => 'Solo puede cargar archivos PDF.',
            'file.max' => 'Solo puede cargar archivos de hasta 2MB.',
        ];
    }
}
