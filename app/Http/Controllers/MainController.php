<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Models\Empresa;
use App\Models\Preregistro;
use App\Models\Especialidad;
use App\Models\EspecialidadEmpresa;
use App\Models\Refrendo;
use App\Models\Estado;

use App\Mail\CorreoPrueba;

class MainController extends Controller {

    public function index() {

        $rol = auth()->user()->roles->first();


        switch ($rol->name) {
            case "Administrador":
                    $completas = Empresa::where('estatus', '=', 'V')->count();
                    $observadas = Empresa::where('estatus', '=', 'O')->count();
                    $incompletas = Empresa::where('estatus', '=', 'N')->count();
                    $preregistros = Preregistro::all()->count();

                    return view('administracion.index')->with(compact('completas','preregistros', 'incompletas', 'observadas'));
                break;
            case "Revisor":
                    return redirect()->route('revisor.index');
                break;
            case "Contralor":
                    return redirect()->route('contralor.index');
                break;
            case "Supervisor":
                    $completas = Empresa::where('estatus', '=', 'V')->count();
                    $observadas = Empresa::where('estatus', '=', 'O')->count();
                    $incompletas = Empresa::where('estatus', '=', 'N')->count();
                    $preregistros = Preregistro::all()->count();

                    return view('supervision.index')->with(compact('completas','preregistros', 'incompletas', 'observadas'));
                break;
            case "Jefatura":
                    $completas = Empresa::where('estatus', '=', 'V')->count();
                    $observadas = Empresa::where('estatus', '=', 'O')->count();
                    $incompletas = Empresa::where('estatus', '=', 'N')->count();
                    $preregistros = Preregistro::all()->count();

                    return view('supervision.index')->with(compact('completas','preregistros', 'incompletas', 'observadas'));
                break;
            case "Contratista":
                    $user = auth()->user();

                    $empresa = Empresa::where('rfc_empresa', '=', $user->rfc)->first();

                    if($empresa){

                        $record = $empresa->folio;

                        if($record){


                            $refrendo = Refrendo::where('ejercicio', '=', '2025')->where('empresa_id', '=', $empresa->id)->first();


                            if($refrendo){


                                $especialidades = Especialidad::all();
                                $estados = Estado::all();

                                switch ($refrendo->estatus) {
                                    case 'O':
                                            return view('contratista.refrendoUpdate')->with(compact('empresa', 'especialidades', 'refrendo', 'estados'));
                                        break;
                                    case 'R':
                                            return view('contratista.informativoRefrendo')->with(compact('empresa', 'especialidades', 'estados'));
                                        break;
                                    case 'N':
                                            return view('contratista.informativoRefrendoBloqueado')->with(compact('empresa', 'especialidades', 'estados'));
                                        break;
                                    case 'V':
                                        return view('contratista.informativoRefrendoValidado')->with(compact('empresa', 'especialidades', 'estados'));
                                        break;
                                }

                            }else{


                                $especialidades = Especialidad::all();
                                $estados = Estado::all();


                                //return view('contratista.informativoRefrendoBloqueado')->with(compact('empresa', 'especialidades', 'estados'));

                                return view('contratista.refrendo')->with(compact('empresa', 'especialidades', 'estados'));

                            }

                        }else{
                            return view('contratista.index')->with(compact('empresa'));
                        }

                    }else{
                        return view('contratista.index')->with(compact('empresa'));
                    }



                break;
        }
    }


    public function correo()
    {

        //return (string) Str::orderedUuid();
        Mail::mailer('smtp')->to('danieltarind@hotmail.com')->send(new CorreoPrueba());

    }

    public function sql(){

        $model = new Empresa;

        return $model->query();

    }


    public function reportesIndex()
    {

        return view('reportes.index');


    }


    public function reportesGenerar(Request $request)
    {

        $reporte = $request->reporte;

        return view('reportes.generado')->with(compact('reporte'));


    }

    public function reportesInscripciones()
    {

        $inscripciones = Empresa::has('folio')->where('motivo_empresa', '=', '1')->get();

        return view('reportes.inscripciones')->with(compact('inscripciones'));


    }

    public function reportesRefrendos()
    {


        $refrendos = Empresa::has('folio')->where('motivo_empresa', '=', '2')->get();

        return view('reportes.refrendos')->with(compact('refrendos'));


    }



    public function prueba()
    {

        $user = auth()->user();

        return  Refrendo::with('empresa')->whereHas('observacionesRefrendos', function($q) use ($user) {
            $q->where('contraloria_id', '=', '862');
        })->select(['refrendos.id','refrendos.ejercicio', 'refrendos.estatus', 'empresa_id'])->get();

    }

}
