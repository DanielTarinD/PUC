<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


use App\Models\User;
use App\Models\Empresa;
use App\Models\Refrendo;
use App\Models\EspecialidadEmpresa;
use App\Models\Folio;

use App\Http\Requests\storeConstancia;


use App\Mail\Constancia;
use App\Mail\ConstanciaRefrendo;


class JefaturaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('jefatura.empresas.index');
    }


    public function indexRefrendos()
    {

        return view('jefatura.empresas.indexRefrendos');
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



                if($data->folio()->count() > 0){
                    switch ($data->folio->estatus) {
                            case 'I':
                                    return "<span class='badge bg-info'>Impreso</span>";
                                break;
                    }
                }else{

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

                    $actionBtn = "<a href='constancia/ver/".$data->id."' target='_blank' class='btn btn-xs btn-green w-30px me-1' id='constancia' data-id='".$data->id."'><i class='fas fa-file-export'></i></a>";

                    switch ($data->folio->estatus) {
                        case 'I':
                                $actionBtn .= "<a href='empresas/ver/".$data->id."' class='btn btn-xs btn-green w-30px me-1' id='ver' data-id='".$data->id."'><i class='fas fa-eye'></i></a>";
                            break;
                        default:
                                $actionBtn .= "<a href='empresas/ver/".$data->id."' class='btn btn-xs btn-gray w-30px me-1' id='ver' data-id='".$data->id."'><i class='fas fa-eye'></i></a>";
                    }

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

                if(isset($data->impreso)){
                    return "<span class='badge bg-primary'>Impresa</span>";
                }

                if(isset($data->folio_jefatura)){
                    return "<span class='badge bg-warning'>Generada</span>";
                }else{
                    return "<span class='badge bg-danger'>N/D</span>";
                }

                /*switch ($data->) {
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
                }*/
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

                    $actionBtn = "<a href='constancia/refrendo/ver/".$data->id."' target='_blank' class='btn btn-xs btn-green w-30px me-1' id='constancia' data-id='".$data->id."'><i class='fas fa-file-export'></i></a>";

                    if(isset($data->impreso)){
                        $actionBtn .= "<a href='refrendos/ver/".$data->id."' class='btn btn-xs btn-green w-30px me-1' id='ver' data-id='".$data->id."'><i class='fas fa-eye'></i></a>";
                    }else{
                        $actionBtn .= "<a href='refrendos/ver/".$data->id."' class='btn btn-xs btn-gray w-30px me-1' id='ver' data-id='".$data->id."'><i class='fas fa-eye'></i></a>";
                    }


                    /*$actionBtn = "<a href='constancia/ver/".$data->id."' target='_blank' class='btn btn-xs btn-green w-60px me-1' id='constancia' data-id='".$data->id."'>Const.</a>";*/
                    //$actionBtn = "<a href='refrendos/ver/".$data->id."' class='btn btn-xs btn-green w-60px me-1' id='ver' data-id='".$data->id."'>Ver</a>";
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



    public function ver($id)
    {

        if($empresa = Empresa::find($id)){

            return view('jefatura.empresas.ver')->with(compact('empresa'));
        }

        return view('jefatura.empresas.index');

    }

    public function verRefrendo($id)
    {

        if($refrendo = Refrendo::find($id)){

            return view('jefatura.refrendos.ver')->with(compact('refrendo'));
        }

        return view('jefatura.empresas.indexRefrendos');

    }


    public function constancia(storeConstancia $request)
    {

        $request->validate([
            'empresa_id' => 'required',
        ]);

        $ejercicio = date('Y');

        $empresa = Empresa::find($request->empresa_id);

        $empresa->update(['estatus'=> $request->estatus]);

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

            $folio->folio_jefatura = 'SDUOPOT-J-DCPLC-'.str_pad($request->folio_jefatura, 4, "0", STR_PAD_LEFT).'-'.$ejercicio;
            $folio->fecha_expedicion = Carbon::createFromFormat('d/m/Y', $request->fecha_expedicion)->format('Y-m-d');
            $folio->observacion = $request->observacion;

            if(isset($request->impreso)){
                $folio->estatus = 'I';
            }else{
                $folio->estatus = null;
            }

            $folio->update();

            return redirect()->route('jefatura.ver', ['id' => $empresa->id]);
        }



        $request->merge([
            'uuid' => (string) Str::orderedUuid(),
            'folio_jefatura' => 'SDUOPOT-J-DCPLC-'.str_pad($request->folio_jefatura, 4, "0", STR_PAD_LEFT).'-'.$ejercicio,
            'fecha_expedicion' => Carbon::createFromFormat('d/m/Y', $request->fecha_expedicion)->format('Y-m-d'),
            'vigencia' => Carbon::createFromFormat('d/m/Y', '30/06/2025')->format('Y-m-d'),
        ]);

        $folioNuevo = Folio::create($request->all());

        $folioNuevo->folio = 'SDUOPOT-RUPC-'.str_pad($folioNuevo->id, 4, "0", STR_PAD_LEFT).'-'.$ejercicio;

        $folioNuevo->update();


        try{
            Mail::mailer('smtp')->to($empresa->user->email)->send(new Constancia($empresa));
        }
        catch(\Exception $e){

            return redirect('/')->withErrors(['mensaje'=>'Hubo un problema al enviar el correo. Notifique al Contratista directamente.']);

        }


        return redirect()->route('jefatura.ver', ['id' => $empresa->id]);

    }

    public function constanciaRefrendo(storeConstancia $request)
    {


        $request->validate([
            'empresa_id' => 'required',
        ]);


        $ejercicio = '2024';

        $refrendo = Refrendo::find($request->refrendo_id);

        $refrendo->update(['estatus'=> $request->estatus]);

        if(isset($refrendo->folio_jefatura)){


            if($request->hasFile('file')){
                $constancia = $request->file('file');
                $filename =  $refrendo->empresa->rfc_empresa.'.' . $constancia->getClientOriginalExtension();

                $path = $constancia->storeAs(
                    'public/refrendos/2024/', $filename
                );

                $refrendo->constancia_digitalizada = $filename;
            }

            $refrendo->folio_jefatura = 'SDUOPOT-J-DCPLC-'.str_pad($request->folio_jefatura, 4, "0", STR_PAD_LEFT).'-'.$ejercicio;
            $refrendo->fecha_expedicion = Carbon::createFromFormat('d/m/Y', $request->fecha_expedicion)->format('Y-m-d');
            $refrendo->observacion = $request->observacion;
            $refrendo->impreso = $request->impreso;

            $refrendo->update();

            return redirect()->route('jefatura.ver.refrendo', ['id' => $refrendo->id]);
        }



        $refrendo->folio_jefatura = 'SDUOPOT-J-DCPLC-'.str_pad($request->folio_jefatura, 4, "0", STR_PAD_LEFT).'-2024';
        $refrendo->fecha_expedicion = Carbon::createFromFormat('d/m/Y', $request->fecha_expedicion)->format('Y-m-d');
        $refrendo->vigencia = Carbon::createFromFormat('d/m/Y', '30/06/2025')->format('Y-m-d');
        $refrendo->update();


        try{
            Mail::mailer('smtp')->to($refrendo->empresa->user->email)->send(new ConstanciaRefrendo($refrendo));
        }
        catch(\Exception $e){


            return redirect()->route('empresas.ver.refrendos', ['id' => $refrendo->id])->withErrors(['mensaje'=>'Hubo un problema al enviar el correo. Notifique al Contratista directamente.']);

        }

        return redirect()->route('jefatura.ver.refrendo', ['id' => $refrendo->id]);

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

    public function constanciaRefrendoVer($id)
    {


        $refrendo = Refrendo::find($id);

        setlocale(LC_TIME, "es_MX");

        $fecha = strtotime($refrendo->getRawOriginal('fecha_expedicion'));

        $fechaExpedicion =  strftime("%d de %B de %Y", $fecha);


        if($refrendo->empresa->especialidades()->count() < 13){
            return view('contratista.constanciaRefrendo')->with(compact('refrendo', 'fechaExpedicion'));

        }elseif($refrendo->empresa->especialidades()->count() > 12 && $refrendo->empresa->especialidades()->count() < 19){
            return view('contratista.constanciaMayorRefrendo')->with(compact('refrendo', 'fechaExpedicion'));

        }elseif($refrendo->empresa->especialidades()->count() > 18 && $refrendo->empresa->especialidades()->count() < 25){
            return view('contratista.constanciaExtendidoRefrendo')->with(compact('refrendo', 'fechaExpedicion'));

        }else{
            return view('contratista.constanciaMaxRefrendo')->with(compact('refrendo', 'fechaExpedicion'));
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


    public function destroyEspecialidades(Request $request)
    {

            $especialidad = EspecialidadEmpresa::find($request->input('id'));

            $especialidad->delete();

            $response = array(
                "message" => 'Especialidad Eliminada',
            );

            return json_encode($response);

    }

    public function perfilVer($id) {

        $perfil = User::find($id);

        if($perfil->hasRole('Contratista'))
        {
            $empresa = $perfil->empresas->first();


            return view('jefatura.usuarios.profileContratista')->with(compact('perfil', 'empresa'));
        }

        $empresa = null;

        return view('jefatura.usuarios.profileUsuario')->with(compact('perfil', 'empresa'));

    }


    public function perfilUpdate(Request $request) {


        $perfil = User::find($request->identificador);

        if($perfil->hasRole('Contratista'))
        {
            $empresa = $perfil->empresas->first();

            $perfil->update(['rfc'=> $request->rfc_empresa]);

            $perfil->update(['email'=> $request->email]);


            if($request->password != ""){
                $perfil->update(['password'=> Hash::make($request->password)]);
            }


            if($empresa->tipo == '1'){
                $empresa->update(['nombre_empresa'=> $request->nombre]);

            }else{
                $empresa->update(['nombre_persona'=> $request->nombre]);
            }

            $empresa->update(['rfc_empresa'=> $request->rfc_empresa]);


        }else{

            $perfil->update(['rfc'=> $request->rfc_empresa]);

            $perfil->update(['name'=> $request->nombre]);

            $perfil->update(['email'=> $request->email]);


            if($request->password != ""){
                $perfil->update(['password'=> Hash::make($request->password)]);
            }

        }


        return redirect()->route('usuarios.index');


    }



}
