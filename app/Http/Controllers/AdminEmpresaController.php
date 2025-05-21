<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;


use App\Models\Empresa;
use App\Models\Refrendo;
use App\Models\EspecialidadEmpresa;
use App\Models\Folio;

use App\Http\Requests\storeConstancia;


use App\Mail\Constancia;
use App\Mail\ConstanciaRefrendo;


class AdminEmpresaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('administracion.empresas.index');
    }


    public function indexRefrendos()
    {
        $user = auth()->user();
        return view('administracion.empresas.indexRefrendos');
    }


    public function getRefrendos(){

        $data = Refrendo::with(['empresa' => function ($query) {
                                $query->select('id','rfc_empresa', 'nombre_empresa', 'nombre_persona');
                            }])->get();


        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('rfc_empresa', function(Refrendo $data) {
                return $data->empresa->rfc_empresa;
            })
            ->editColumn('nombre_empresa', function(Refrendo $data) {
                return $data->empresa->nombre_empresa;
            })
            ->editColumn('nombre_persona', function(Refrendo $data) {
                return $data->empresa->nombre_persona;
            })
            ->editColumn('estatus', function(Refrendo $data) {
                switch ($data->estatus) {
                    case 'N':
                            return "<span class='badge bg-secondary'>Nuevo</span>";
                        break;
                    case 'R':
                            return "<span class='badge bg-warning'>Revisión</span>";
                        break;
                    case 'O':
                            return "<span class='badge bg-danger'>Observado</span>";
                        break;
                    case 'V':
                            return "<span class='badge bg-primary'>Validado</span>";
                        break;
                }
            })
            ->addColumn('validaciones', function(Refrendo $data){

                if(isset($data->observacionesRefrendos->obras_validacion)){
                    $padronValidacion = 'bg-success';
                }elseif(isset($data->observacionesRefrendos->obras)){
                    $padronValidacion = 'bg-warning';
                }else{
                    $padronValidacion = 'bg-danger';
                }

                if(isset($data->observacionesRefrendos->contraloria_validacion)){
                    $contraloriaValidacion = 'bg-success';
                }elseif(isset($data->observacionesRefrendos->contraloria)){
                    $contraloriaValidacion = 'bg-warning';
                }else{
                    $contraloriaValidacion = 'bg-danger';
                }

                $validacionesBtn = "<span class='badge ". $padronValidacion ."'>P</span> ";
                $validacionesBtn .= "<span class='badge ". $contraloriaValidacion ."'>C</span>";

                return $validacionesBtn;
            })
            ->addColumn('action', function(Refrendo $data){

                if(isset($data->folio_jefatura)){
                    /*$actionBtn = "<a href='constancia/ver/".$data->id."' target='_blank' class='btn btn-xs btn-green w-60px me-1' id='constancia' data-id='".$data->id."'>Const.</a>";*/
                    $actionBtn = "<a href='refrendos/ver/".$data->id."' class='btn btn-xs btn-green w-60px me-1' id='ver' data-id='".$data->id."'>Ver</a>";
                    /*$actionBtn .= "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";*/
                }else{
                    $actionBtn = "<a href='refrendos/ver/".$data->id."' class='btn btn-xs btn-gray w-60px me-1' id='ver' data-id='".$data->id."'>Ver</a>";
                    /*$actionBtn .= "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";*/
                }

                if(isset($data->constancia_digitalizada)){
                    $actionBtn .= "<a href='". asset('storage/refrendos/2024/'.$data->constancia_digitalizada) ."' target='_blank' class='btn btn-xs btn-primary w-30px me-1'><i class='fas fa-file-pdf'></i></a>";
                }

                return $actionBtn;
            })
            ->rawColumns(['estatus', 'validaciones', 'action'])
            ->make(true);


    }




    public function getEmpresas(){

        $data = Empresa::all();

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('tipo', function(Empresa $data) {
                switch ($data->tipo) {
                    case '1':
                            return 'Moral';
                        break;
                    case '2':
                            return 'Física';
                        break;
                }
            })
            ->editColumn('estatus', function(Empresa $data) {
                switch ($data->estatus) {
                    case 'N':
                            return "<span class='badge bg-secondary'>Incompleta</span>";
                        break;
                    case 'R':
                            return "<span class='badge bg-warning'>Revisión</span>";
                        break;
                    case 'O':
                            return "<span class='badge bg-danger'>Observada</span>";
                        break;
                    case 'V':
                            return "<span class='badge bg-primary'>Validada</span>";
                        break;
                }
            })
            ->editColumn('motivo_empresa', function(Empresa $data) {
                switch ($data->motivo_empresa) {
                    case '1':
                            return "Inscripción";
                        break;
                    case '2':
                            return "Refrendo";
                        break;
                }
            })
            ->addColumn('action', function(Empresa $data){

                if($data->folio()->count() > 0){
                    /*$actionBtn = "<a href='constancia/ver/".$data->id."' target='_blank' class='btn btn-xs btn-green w-60px me-1' id='constancia' data-id='".$data->id."'>Const.</a>";*/
                    $actionBtn = "<a href='empresas/ver/".$data->id."' class='btn btn-xs btn-green w-60px me-1' id='ver' data-id='".$data->id."'>Ver</a>";
                    /*$actionBtn .= "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";*/
                }else{
                    $actionBtn = "<a href='empresas/ver/".$data->id."' class='btn btn-xs btn-gray w-60px me-1' id='ver' data-id='".$data->id."'>Ver</a>";
                    /*$actionBtn .= "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";*/
                }

                if(isset($data->folio->constancia_digitalizada)){
                    $actionBtn .= "<a href='". asset('storage/constancias/'.$data->folio->constancia_digitalizada) ."' target='_blank' class='btn btn-xs btn-primary w-30px me-1'><i class='fas fa-file-pdf'></i></a>";
                }

                return $actionBtn;
            })
            ->addColumn('validaciones', function(Empresa $data){

                if(isset($data->observaciones->obras_validacion)){
                    $padronValidacion = 'bg-success';
                }elseif(isset($data->observaciones->obras)){
                    $padronValidacion = 'bg-warning';
                }else{
                    $padronValidacion = 'bg-danger';
                }

                if(isset($data->observaciones->contraloria_validacion)){
                    $contraloriaValidacion = 'bg-success';
                }elseif(isset($data->observaciones->contraloria)){
                    $contraloriaValidacion = 'bg-warning';
                }else{
                    $contraloriaValidacion = 'bg-danger';
                }

                $validacionesBtn = "<span class='badge ". $padronValidacion ."'>P</span> ";
                $validacionesBtn .= "<span class='badge ". $contraloriaValidacion ."'>C</span>";

                return $validacionesBtn;
            })
            ->rawColumns(['action', 'estatus', 'validaciones', 'motivo_empresa'])
            ->make(true);


    }


    public function ver($id)
    {

        if($empresa = Empresa::find($id)){

            return view('administracion.empresas.ver')->with(compact('empresa'));
        }

        return view('administracion.empresas.index');

    }


    public function verRefrendos($id)
    {

        if($refrendo = Refrendo::find($id)){

            return view('administracion.refrendos.ver')->with(compact('refrendo'));
        }

        return view('administracion.empresas.indexRefrendos');

    }


    public function constancia(storeConstancia $request)
    {

        $request->validate([
            'empresa_id' => 'required',
        ]);

        $empresa = Empresa::find($request->empresa_id);

        $ejercicio = date('Y');

        if($empresa->folio()->count() > 0){

            $folio = $empresa->folio;

            if($request->hasFile('file')){
                $constancia = $request->file('file');
                $filename =  $empresa->rfc_empresa.'.' . $constancia->getClientOriginalExtension();

                $path = $constancia->storeAs(
                    'public/constancias/', $filename
                );

                $folio->constancia_digitalizada = $filename;
            }

            $folio->observacion = $request->observacion;
            $folio->update();

            return redirect()->route('empresas.ver', ['id' => $empresa->id]);
        }



        $request->merge([
            'uuid' => (string) Str::orderedUuid(),
            //'folio_jefatura' => 'SDUOPOT-J-DCPLC-'.str_pad($request->folio_jefatura, 4, "0", STR_PAD_LEFT).'-'.$ejercicio,
            'folio_jefatura' => 'SDUOPOT-J-DCPLC-'.str_pad($request->folio_jefatura, 4, "0", STR_PAD_LEFT).'-2025',
            'fecha_expedicion' => Carbon::createFromFormat('d/m/Y', $request->fecha_expedicion)->format('Y-m-d'),
            'vigencia' => Carbon::createFromFormat('d/m/Y', '30/06/2025')->format('Y-m-d'),
        ]);

        $folioNuevo = Folio::create($request->all());
        $folioNuevo->folio = 'SDUOPOT-RUPC-'.str_pad($folioNuevo->id, 4, "0", STR_PAD_LEFT).'-'.$ejercicio;
        $folioNuevo->update();

        $empresa->update(['estatus'=> 'V']);

        try{
            Mail::mailer('smtp')->to($empresa->user->email)->send(new Constancia($empresa));
        }
        catch(\Exception $e){

            return redirect('/')->withErrors(['mensaje'=>'Hubo un problema al enviar el correo. Notifique al Contratista directamente.']);

        }


        return redirect()->route('empresas.ver', ['id' => $empresa->id]);

    }

    public function constanciaRefrendo(storeConstancia $request)
    {

        $request->validate([
            'refrendo_id' => 'required',
        ]);


        $refrendo = Refrendo::find($request->refrendo_id);

        //$ejercicio = date('Y');

        $ejercicio = '2024';

        if($request->hasFile('file')){
            $constancia = $request->file('file');
            $filename =  $refrendo->empresa->rfc_empresa.'.' . $constancia->getClientOriginalExtension();

            $path = $constancia->storeAs(
                'public/refrendos/2024/', $filename
            );

            $refrendo->constancia_digitalizada = $filename;
        }

        $refrendo->folio_jefatura = 'SDUOPOT-J-DCPLC-'.str_pad($request->folio_jefatura, 4, "0", STR_PAD_LEFT).'-2025';
        $refrendo->fecha_expedicion = Carbon::createFromFormat('d/m/Y', $request->fecha_expedicion)->format('Y-m-d');
        $refrendo->vigencia = Carbon::createFromFormat('d/m/Y', '30/06/2025')->format('Y-m-d');
        $refrendo->observacion = $request->observacion;
        $refrendo->update();

        try{
            Mail::mailer('smtp')->to($refrendo->empresa->user->email)->send(new ConstanciaRefrendo($refrendo));
        }
        catch(\Exception $e){


            return redirect()->route('empresas.ver.refrendos', ['id' => $refrendo->id])->withErrors(['mensaje'=>'Hubo un problema al enviar el correo. Notifique al Contratista directamente.']);

        }


        return redirect()->route('empresas.ver.refrendos', ['id' => $refrendo->id]);

    }


    public function constanciaVer($id)
    {

        setlocale(LC_TIME, "es_MX");

        $empresa = Empresa::find($id);

        $fecha = strtotime($empresa->folio->getRawOriginal('fecha_expedicion'));

        $fechaExpedicion =  strftime("%d de %B de %Y", $fecha);

        if($empresa->especialidades()->count() < 13){
            return view('contratista.constancia')->with(compact('empresa', 'fechaExpedicion'));

        }elseif($empresa->especialidades()->count() > 12 && $empresa->especialidades()->count() < 19){
            return view('contratista.constanciaMayor')->with(compact('empresa', 'fechaExpedicion'));

        }else{
            return view('contratista.constanciaExtendido')->with(compact('empresa', 'fechaExpedicion'));
        }


    }


    public function getEspecialidades(Request $request)
    {

            $empresa = Empresa::find($request->id);

            $data = EspecialidadEmpresa::where('empresa_id', '=', $empresa->id)->with('Especialidad')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('link_especialidad', function(EspecialidadEmpresa $data) {
                    return "<a href='".$data->link_especialidad."' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a> ";
                })
                ->addColumn('action', function(EspecialidadEmpresa $data){
                    $actionBtn = "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action', 'link_especialidad'])
                ->make(true);

    }

    public function getEspecialidadesRefrendos(Request $request)
    {

            $empresa = Empresa::find($request->id);

            $data = EspecialidadEmpresa::where('empresa_id', '=', $empresa->id)->with('Especialidad')->get();



            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('link_especialidad', function(EspecialidadEmpresa $data) {
                    return "<a href='".$data->link_especialidad."' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a> ";
                })
                ->addColumn('action', function(EspecialidadEmpresa $data){

                    if($data->ejercicio == '2025')
                    {
                        $actionBtn = "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";

                    } else{
                        $actionBtn = '';
                    }

                    return $actionBtn;
                })
                ->rawColumns(['action', 'link_especialidad'])
                ->make(true);

    }


    public function destroyEspecialidades(Request $request)
    {

            $especialidad = EspecialidadEmpresa::find($request->input('id'));

            $especialidad->delete();

            $response = array(
                "message" => 'Especialidad Eliminada',
            );

            return json_encode($response);

    }



}
