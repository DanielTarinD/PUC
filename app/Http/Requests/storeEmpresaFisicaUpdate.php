<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeEmpresaFisicaUpdate extends FormRequest
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
            'nombre_persona' => 'required',
            'cargo_persona' => 'required',
            'link_acta' => 'required',
            'link_cv' => 'required',
            'link_domicilio' => 'required',
            'estado_id' => 'required',
            'municipio_id' => 'required',
            'localidad_id' => 'required',
            'colonia' => 'required',
            'domicilio' => 'required',
            'codigo_postal' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'url_empresa' => 'required',
            'imss' => 'required',
            'link_registro' => 'required',
            'folio_capacitacion' => 'required',
            'nombre_expide' => 'required',
            'link_constancia' => 'required',
            'estratificacion' => 'required',
            'link_estratificacion' => 'required',
            'link_solicitud' => 'required',
        ];

    }

    public function attributes()
    {
        return [
            'nombre_empresa' => 'Nombre de la Empresa',
            'nombre_persona' => 'Nombre de la Persona Física',
            'estado_id' => 'Estado',
            'municipio_id' => 'Municipio',
            'localidad_id' => 'Localidad',
            'colonia' => 'Colonia',
            'domicilio' => 'Domicilio',
            'codigo_postal' => 'Codigo Postal',
            'link_acta' => 'Acta Constitutiva o Acta de Nacimiento y CURP',
            'link_cv' => 'Link al Curriculum de la Persona o Empresa',
            'link_domicilio' => 'required',
            'telefono' => 'Telefono de la Empresa',
            'telefono_representante' => 'Telefono del Representante',
            'email' => 'Correo de la Empresa',
            'email_representante' => 'Correo del Representante',
            'url_empresa' => 'Sitio Web de la Empresa',
            'rfc_empresa' => 'RFC',
            'imss' => 'Registro del IMSS',
            'link_registro' => 'Link al Registro del IMSS',
            'folio_capacitacion' => 'Número/Folio de la constancia de Capacitación',
            'nombre_expide' => 'Nombre de quien expide la constancia de Capacitación',
            'link_constancia' => 'Link a la Constancia de Capacitación',
            'estratificacion' => 'Estratificacion',
            'link_estratificacion' => 'Link del Documento que acredite la Estratificación',
            'link_solicitud' => 'Link al Documento donde se Solicita la Inscripcion al Padrón de Contratistas',
        ];
    }

    public function messages()
    {
        return [
            'rfc_empresa.unique' => "Ya existe un registro con ese RFC.",
        ];
    }
}
