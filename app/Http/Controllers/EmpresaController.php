<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Mail;
use App\Mail\NotifyMail;

use App\Models\Empresa;
use App\Models\Legal;
use App\Models\Especialidad;
use App\Models\EspecialidadEmpresa;
use App\Models\Representante;
use App\Models\Socio;
use App\Models\Contable;
use App\Models\Tecnica;
use App\Models\Estado;
use App\Models\Folio;

use App\Mail\AccesoPlataforma;

use App\Http\Requests\storeEmpresa;
use App\Http\Requests\storeEmpresaMoralUpdate;
use App\Http\Requests\storeEmpresaFisicaUpdate;
use App\Http\Requests\storeLegal;
use App\Http\Requests\storeRepresentante;
use App\Http\Requests\storeContable;
use App\Http\Requests\storeTecnica;


class EmpresaController extends Controller
{

    public function validacion($uuid, $rfc)
    {

        if($folio = Folio::where('uuid', '=', $uuid)->first())
        {
            switch ($folio->empresa->estatus) {

                case 'N':
                        $estatus = 'bg-warning';
                    break;
                case 'R':
                        $estatus = 'bg-warning';
                    break;
                case 'O':
                        $estatus = 'bg-warning';
                    break;
                case 'V':
                        $estatus = 'bg-success';
                    break;
                case 'S':
                        $estatus = 'bg-danger';
                    break;
            }


            if($folio->empresa->rfc_empresa == $rfc){
                return view('administracion.empresas.validacion')->with(compact('folio', 'estatus'));
            }else{
                return view('administracion.empresas.errorValidacion');
            }
        }else{
            return view('administracion.empresas.errorValidacion');
        }

    }


    public function seleccion()
    {

        return view('contratista.seleccion');
    }


    public function redirigeSeleccion(Request $request)
    {

        $validated = $request->validate([
            'seleccion' => 'required',
        ]);

        $tipo = $request->seleccion;

        return redirect()->route('empresa.general', ['tipo' => $tipo]);

    }

    public function informativo()
    {
        $user = auth()->user();

        if (Empresa::where('user_id', '=', $user->id)->exists()) {
            $empresa = Empresa::where('user_id', '=', $user->id)->first();

            if($empresa->estatus == 'V'){
                return view('contratista.validado')->with(compact('empresa'));
            }else{
                return view('contratista.informativo')->with(compact('empresa'));
            }

        }else{
            return redirect()->route('empresa.seleccion')->withErrors('Debe crear una Empresa antes.');
        }
    }



    public function enviarARevision(Request $request)
    {

            $empresa = Empresa::find($request->input('empresa_id'));


            if ($empresa->tipo == 1) {
                if(!($empresa->socios()->exists() && $empresa->especialidades()->exists())){
                    $empresa->update(['empresa_nota'=> $request->input('empresa_nota')]);
                    return redirect()->route('empresa.informativo')->with(compact('empresa'))->withInput()->withErrors('Falta agregar Socios o Especialidades. Favor de Revisar su datos capturados. Moral');
                }

                if(!(($empresa->legales()->exists() && $empresa->contables()->exists()) && $empresa->tecnicas()->exists())){
                    $empresa->update(['empresa_nota'=> $request->input('empresa_nota')]);
                    return redirect()->route('empresa.informativo')->with(compact('empresa'))->withInput()->withErrors('Falta algunos Conceptos. Favor de Revisar su datos capturados. Moral');
                }
            }


            if ($empresa->tipo == 2) {
                if(!($empresa->especialidades()->exists())){
                    $empresa->update(['empresa_nota'=> $request->input('empresa_nota')]);
                    return redirect()->route('empresa.informativo')->with(compact('empresa'))->withInput()->withErrors('Falta agregar Especialidades. Favor de Revisar su datos capturados.');
                }

                if(!(($empresa->contables()->exists()) && $empresa->tecnicas()->exists())){
                    $empresa->update(['empresa_nota'=> $request->input('empresa_nota')]);
                    return redirect()->route('empresa.informativo')->with(compact('empresa'))->withInput()->withErrors('Falta algunos Conceptos. Favor de Revisar su datos capturados.');
                }
            }

            $empresa->update(['empresa_nota'=> $request->input('empresa_nota')]);
            $empresa->update(['estatus'=> 'R']);

            return view('contratista.index')->with(compact('empresa'));

    }


    public function informacionGeneral(Request $request)
    {

        $user = auth()->user();

        if (Empresa::where('rfc_empresa', '=', $user->rfc)->exists()) {

            $empresa = Empresa::where('rfc_empresa', '=', $user->rfc)->first();

            if($empresa->estatus == "R" || $empresa->estatus == "V" ){
                return view('contratista.index')->with(compact('empresa'));
            }

            return redirect()->route('empresa.gral.update');
        }


        $tipo = $request->tipo;

        if(empty($request->tipo)){
            return redirect()->route('empresa.seleccion');
        }


        $estados = Estado::all();

        switch ($tipo) {

            case 1:
                    return view('contratista.moral')->with(compact('estados', 'tipo'));
                break;
            case 2:
                    return view('contratista.fisica')->with(compact('estados', 'tipo'));
                break;
        }
    }


    public function informacionGeneralStore(storeEmpresa $request)
    {

            Empresa::create($request->all());
            return redirect()->route('inicio');

    }



    public function informacionGralUpdate()
    {

        $user = auth()->user();

        if (Empresa::where('user_id', '=', $user->id)->exists()) {

            $user = auth()->user();
            $empresa = Empresa::where('rfc_empresa', '=', $user->rfc)->first();
            $estados = Estado::all();


            switch ($empresa->tipo) {

                case 1:
                        $tipoPersona = "Moral";
                        return view('contratista.moralUpdate')->with(compact('tipoPersona', 'empresa', 'estados'));
                    break;
                case 2:
                        $tipoPersona = "Física";
                        return view('contratista.fisicaUpdate')->with(compact('tipoPersona', 'empresa', 'estados'));
                    break;

            }

        }else{
            return redirect()->route('empresa.seleccion')->withErrors('Debre crear una Empresa antes.');
        }

    }


    public function gralMoralUpdate(storeEmpresaMoralUpdate $request)
    {

        $empresa = Empresa::find($request->empresa_id);

        $empresa->update($request->all());
        return redirect()->route('inicio');

    }

    public function gralFisicaUpdate(storeEmpresaFisicaUpdate $request)
    {

        $empresa = Empresa::find($request->empresa_id);

        $empresa->update($request->all());
        return redirect()->route('inicio');

    }

    public function informacionLegal()
    {

        $user = auth()->user();

        if (Empresa::where('user_id', '=', $user->id)->exists()) {

            $empresa = Empresa::where('rfc_empresa', '=', $user->rfc)->first();

            if($empresa->estatus == "R"  || $empresa->estatus == "V"){
                return view('contratista.index')->with(compact('empresa'));
            }

            if (Legal::where('empresa_id', '=', $empresa->id)->exists()) {
                return redirect()->route('empresa.legal.update');
            }

            switch ($empresa->tipo) {

                case 1:
                        $tipoPersona = "Moral";
                    break;
                case 2:
                        $tipoPersona = "Física";
                    break;
            }

            $estados = Estado::all();

            return view('contratista.legal')->with(compact('tipoPersona', 'empresa', 'estados'));
        }else{
            return redirect()->route('empresa.seleccion')->withErrors('Debre crear una Empresa antes.');
        }

    }


    public function informacionLegalUpdate()
    {

        $user = auth()->user();

        if (Empresa::where('user_id', '=', $user->id)->exists()) {

            $user = auth()->user();
            $empresa = Empresa::where('rfc_empresa', '=', $user->rfc)->first();
            switch ($empresa->tipo) {

                case 1:
                        $tipoPersona = "Moral";
                    break;
                case 2:
                        $tipoPersona = "Física";
                    break;
            }

            $estados = Estado::all();

            return view('contratista.legalUpdate')->with(compact('tipoPersona', 'empresa', 'estados'));
        }else{
            return redirect()->route('empresa.seleccion')->withErrors('Debre crear una Empresa antes.');
        }

    }


    public function informacionLegalStore(storeLegal $request)
    {


        $request->merge([
            'fecha_escritura' => Carbon::createFromFormat('d/m/Y', $request->fecha_escritura)->format('Y-m-d'),
            'fecha_mercantil' => Carbon::createFromFormat('d/m/Y', $request->fecha_mercantil)->format('Y-m-d'),
        ]);


        Legal::create($request->all());
        return redirect()->route('inicio');

    }


    public function legalUpdate(storeLegal $request)
    {

        $legal = Legal::find($request->legal_id);

        $request->merge([
            'fecha_escritura' => Carbon::createFromFormat('d-m-Y', $request->fecha_escritura)->format('Y-m-d'),
            'fecha_mercantil' => Carbon::createFromFormat('d-m-Y', $request->fecha_mercantil)->format('Y-m-d'),
        ]);


        $legal->update($request->all());
        return redirect()->route('inicio');

    }



    public function informacionRepresentante()
    {

        $user = auth()->user();

        if (Empresa::where('user_id', '=', $user->id)->exists()) {

            $empresa = Empresa::where('rfc_empresa', '=', $user->rfc)->first();

            if($empresa->estatus == "R"|| $empresa->estatus == "V"){
                return view('contratista.index')->with(compact('empresa'));
            }

            if ($empresa->tipo == 2) {
                return redirect()->route('inicio')->withErrors('El Tipo de Persona no requiere la captura de un Representante Legal.');
            }

            if (Representante::where('empresa_id', '=', $empresa->id)->exists()) {
                return redirect()->route('empresa.representante.update');
            }

            switch ($empresa->tipo) {

                case 1:
                        $tipoPersona = "Moral";
                    break;
                case 2:
                        $tipoPersona = "Física";
                    break;
            }

            $estados = Estado::all();

            return view('contratista.representante')->with(compact('tipoPersona', 'empresa', 'estados'));
        }else{
            return redirect()->route('empresa.seleccion')->withErrors('Debre crear una Empresa antes.');
        }

    }

    public function informacionRepresentanteStore(storeRepresentante $request)
    {


        $request->merge([
            'fecha_poder' => Carbon::createFromFormat('d/m/Y', $request->fecha_poder)->format('Y-m-d'),
            'fecha_mercantil' => Carbon::createFromFormat('d/m/Y', $request->fecha_mercantil)->format('Y-m-d'),
        ]);


        Representante::create($request->all());
        return redirect()->route('inicio');

    }

    public function informacionRepresentanteUpdate()
    {

        $user = auth()->user();

        if (Empresa::where('user_id', '=', $user->id)->exists()) {

            $user = auth()->user();
            $empresa = Empresa::where('rfc_empresa', '=', $user->rfc)->first();
            switch ($empresa->tipo) {

                case 1:
                        $tipoPersona = "Moral";
                    break;
                case 2:
                        $tipoPersona = "Física";
                    break;
            }

            $estados = Estado::all();

            return view('contratista.representanteUpdate')->with(compact('tipoPersona', 'empresa', 'estados'));
        }else{
            return redirect()->route('empresa.seleccion')->withErrors('Debre crear una Empresa antes.');
        }

    }


    public function representanteUpdate(storeRepresentante $request)
    {

        $representante = Representante::find($request->representante_id);

        $request->merge([
            'fecha_poder' => Carbon::createFromFormat('d-m-Y', $request->fecha_poder)->format('Y-m-d'),
            'fecha_mercantil' => Carbon::createFromFormat('d-m-Y', $request->fecha_mercantil)->format('Y-m-d'),
        ]);


        $representante->update($request->all());
        return redirect()->route('inicio');

    }



    public function informacionSocios()
    {

        $user = auth()->user();

        if (Empresa::where('user_id', '=', $user->id)->exists()) {

            $empresa = Empresa::where('rfc_empresa', '=', $user->rfc)->first();


            if($empresa->estatus == "R" || $empresa->estatus == "V"){
                return view('contratista.index')->with(compact('empresa'));
            }

            if ($empresa->tipo == 2) {
                return redirect()->route('inicio')->withErrors('El Tipo de Persona no requiere la captura de socios.');
            }


            switch ($empresa->tipo) {

                case 1:
                        $tipoPersona = "Moral";
                    break;
                case 2:
                        $tipoPersona = "Física";
                    break;
            }

            return view('contratista.socios')->with(compact('tipoPersona', 'empresa'));
        }else{
            return redirect()->route('empresa.seleccion')->withErrors('Debre crear una Empresa antes.');
        }

    }

    public function informacionSociosStore(Request $request)
    {

        $request->validate([
            'empresa_id' => 'required',
            'tipo' => 'required',
            'rfc_socio' => 'required',
            'nombre_socio' => 'required',
            'monto_acciones' => 'required|numeric',
        ]);

        Socio::create($request->all());

        $response = array(
            "message" => "Agregado",
        );

        return json_encode($response);

    }

    public function getSocios(Request $request)
    {

            $user = auth()->user();

            $empresa = Empresa::where('rfc_empresa', '=', $user->rfc)->first();

            $data = Socio::where('empresa_id', '=', $empresa->id)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function(Socio $data){
                    $actionBtn = "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);

    }


    public function destroySocios(Request $request)
    {

            $socio = Socio::find($request->input('id'));

            $socio->delete();

            $response = array(
                "message" => "Eliminado",
            );

            return json_encode($response);

    }


    public function informacionEspecialidades()
    {

        $user = auth()->user();

        if (Empresa::where('user_id', '=', $user->id)->exists()) {

            $empresa = Empresa::where('rfc_empresa', '=', $user->rfc)->first();

            if($empresa->estatus == "R" || $empresa->estatus == "V"){
                return view('contratista.index')->with(compact('empresa'));
            }

            switch ($empresa->tipo) {

                case 1:
                        $tipoPersona = "Moral";
                    break;
                case 2:
                        $tipoPersona = "Física";
                    break;
            }

            $especialidades = Especialidad::all();

            return view('contratista.especialidades')->with(compact('tipoPersona', 'empresa', 'especialidades'));
        }else{
            return redirect()->route('empresa.seleccion')->withErrors('Debre crear una Empresa antes.');
        }

    }

    public function informacionEspecialidadesStore(Request $request)
    {

        $empresa = Empresa::find($request->empresa_id);

        $rules = [
            'empresa_id' => 'required',
            'especialidad_id' => 'unique:especialidades_empresas,especialidad_id,NULL,id,empresa_id,' . $request->empresa_id, 'empresa_id',
            'link_especialidad' => 'required',
        ];

        $customMessages = [
            'especialidad_id.required' => 'Se requiere seleccionar una especialidad.',
            'link_especialidad.required' => 'Es obligatorio el enlace al o los contratos que acrediten la especialidad.',
            'link_especialidad.unique' => 'La especialidad ya se encuentra registrada.'
        ];

        $this->validate($request, $rules, $customMessages);

        EspecialidadEmpresa::create($request->all());

        $response = array(
            "message" => "Agregado",
        );

        return json_encode($response);

    }

    public function getEspecialidades(Request $request)
    {

            $user = auth()->user();

            $empresa = Empresa::where('rfc_empresa', '=', $user->rfc)->first();

            $data = EspecialidadEmpresa::where('empresa_id', '=', $empresa->id)->with('Especialidad')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function(EspecialidadEmpresa $data){
                    $actionBtn = "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);

    }


    public function destroyEspecialidades(Request $request)
    {

            $socio = EspecialidadEmpresa::find($request->input('id'));

            $socio->delete();

            $response = array(
                "message" => "Eliminado",
            );

            return json_encode($response);

    }


    public function informacionContable()
    {

        $user = auth()->user();

        if (Empresa::where('user_id', '=', $user->id)->exists()) {

            $empresa = Empresa::where('rfc_empresa', '=', $user->rfc)->first();

            if($empresa->estatus == "R" || $empresa->estatus == "V"){
                return view('contratista.index')->with(compact('empresa'));
            }

            if (Contable::where('empresa_id', '=', $empresa->id)->exists()) {
                return redirect()->route('empresa.contable.update');
            }

            switch ($empresa->tipo) {

                case 1:
                        $tipoPersona = "Moral";
                    break;
                case 2:
                        $tipoPersona = "Física";
                    break;
            }

            return view('contratista.contable')->with(compact('tipoPersona', 'empresa'));
        }else{
            return redirect()->route('empresa.seleccion')->withErrors('Debre crear una Empresa antes.');
        }

    }

    public function informacionContableStore(storeContable $request)
    {

        if($request->input('fecha_balance_general') != ''){
            $request->merge([
                'fecha_balance_general' => Carbon::createFromFormat('d-m-Y', $request->fecha_balance_general)->format('Y-m-d'),
            ]);
        }

        Contable::create($request->all());
        return redirect()->route('inicio');


    }



    public function informacionContableUpdate()
    {

        $user = auth()->user();

        if (Empresa::where('user_id', '=', $user->id)->exists()) {

            $user = auth()->user();
            $empresa = Empresa::where('rfc_empresa', '=', $user->rfc)->first();
            switch ($empresa->tipo) {
                case 1:
                        $tipoPersona = "Moral";
                    break;
                case 2:
                        $tipoPersona = "Física";
                    break;
            }

            return view('contratista.contableUpdate')->with(compact('tipoPersona', 'empresa'));
        }else{
            return redirect()->route('empresa.seleccion')->withErrors('Debre crear una Empresa antes.');
        }

    }


    public function contableUpdate(storeContable $request)
    {

        $contable = Contable::find($request->contable_id);

        $request->merge([
            'fecha_balance_general' => Carbon::createFromFormat('d-m-Y', $request->fecha_balance_general)->format('Y-m-d'),
        ]);


        $contable->update($request->all());
        return redirect()->route('inicio');

    }


    public function informacionTecnica()
    {

        $user = auth()->user();

        if (Empresa::where('user_id', '=', $user->id)->exists()) {

            $empresa = Empresa::where('rfc_empresa', '=', $user->rfc)->first();

            if($empresa->estatus == "R" || $empresa->estatus == "V"){
                return view('contratista.index')->with(compact('empresa'));
            }

            if (Tecnica::where('empresa_id', '=', $empresa->id)->exists()) {
                return redirect()->route('empresa.tecnica.update');
            }

            switch ($empresa->tipo) {

                case 1:
                        $tipoPersona = "Moral";
                    break;
                case 2:
                        $tipoPersona = "Física";
                    break;
            }

            return view('contratista.tecnica')->with(compact('tipoPersona', 'empresa'));
        }else{
            return redirect()->route('empresa.seleccion')->withErrors('Debre crear una Empresa antes.');
        }

    }

    public function informacionTecnicaStore(storeTecnica $request)
    {

        Tecnica::create($request->all());
        return redirect()->route('inicio');

    }



    public function informacionTecnicaUpdate()
    {

        $user = auth()->user();

        if (Empresa::where('user_id', '=', $user->id)->exists()) {

            $user = auth()->user();
            $empresa = Empresa::where('rfc_empresa', '=', $user->rfc)->first();
            switch ($empresa->tipo) {
                case 1:
                        $tipoPersona = "Moral";
                    break;
                case 2:
                        $tipoPersona = "Física";
                    break;
            }

            return view('contratista.tecnicaUpdate')->with(compact('tipoPersona', 'empresa'));
        }else{
            return redirect()->route('empresa.seleccion')->withErrors('Debre crear una Empresa antes.');
        }

    }


    public function tecnicaUpdate(storeTecnica $request)
    {

        $tecnica = Tecnica::find($request->tecnica_id);

        $tecnica->update($request->all());
        return redirect()->route('inicio');

    }


    public function generarPDFConstancia()
    {

        return view('contratista.constancia');

        //$pdf = \PDF::loadView('contratista.constancia');
        //return $pdf->download('constancia.pdf');

    }

}
