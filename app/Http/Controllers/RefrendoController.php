<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;

use App\Models\Empresa;
use App\Models\EspecialidadEmpresa;
use App\Models\Folio;
use App\Models\Refrendo;


use App\Http\Requests\storeRefrendo;
use App\Http\Requests\storerRefrendoUpdate;


class RefrendoController extends Controller
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


    public function informacionRefrendoStore(storeRefrendo $request)
    {


        try {

            Refrendo::create($request->all());

        } catch (Throwable $e) {


            report($e);
            return false;
        }


        return redirect()->route('inicio');


    }


    public function refrendoUpdate(storeRefrendo $request)
    {

        $refrendo = Refrendo::find($request->refrendo_id);

        $refrendo->update($request->all());

        $refrendo->update(['estatus'=> 'R']);

        return redirect()->route('inicio');

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



    public function getEspecialidades(Request $request)
    {

            $user = auth()->user();

            $empresa = Empresa::where('rfc_empresa', '=', $user->rfc)->first();

            $data = EspecialidadEmpresa::where('empresa_id', '=', $empresa->id)->with('Especialidad')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('link_especialidad', function(EspecialidadEmpresa $data) {
                    $linkBtn = "<a href='$data->link_especialidad' target='_blank' class='btn btn-xs btn-red w-60px me-1' '>Enlace</a>";
                    return $linkBtn;
                })
                ->addColumn('action', function(EspecialidadEmpresa $data){

                    $actionBtn = "";

                    if($data->ejercicio == '2025'){
                        $actionBtn = "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";
                    }

                    return $actionBtn;
                })
                ->rawColumns(['action', 'link_especialidad'])
                ->make(true);

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


        EspecialidadEmpresa::create([
            'empresa_id' => $request->input('empresa_id'),
            'especialidad_id' => $request->input('especialidad_id'),
            'link_especialidad' => $request->input('link_especialidad'),
            'ejercicio' => '2025'
        ]);

        //EspecialidadEmpresa::create($request->all());

        $response = array(
            "message" => "Agregado",
        );

        return json_encode($response);

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








}
