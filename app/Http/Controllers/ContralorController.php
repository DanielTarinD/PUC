<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\DataTables\EmpresaContralorDataTable;
use App\DataTables\EmpresaRefrendoContralorDataTable;
use App\DataTables\EmpresaRefrendoSeguimientoContralorDataTable;



use App\Models\Empresa;
use App\Models\Observacion;
use App\Models\Refrendo;
use App\Models\ObservacionRefrendo;


use App\Mail\Observaciones;

class ContralorController extends Controller {

    public function index(EmpresaContralorDataTable $dataTable)
    {
        return $dataTable->render('contralor.index');
    }

    public function indexRefrendos(EmpresaRefrendoContralorDataTable $dataTable)
    {

        return $dataTable->render('contralor.indexRefrendos');
    }

    public function indexRefrendosSeguimiento(EmpresaRefrendoSeguimientoContralorDataTable $dataTable)
    {

        return $dataTable->render('contralor.indexRefrendosSeguimiento');
    }

    public function revisar($id)
    {
        $empresa = Empresa::find($id);

        return view('contralor.revisar')->with(compact('empresa'));

    }

    public function revisarRefrendo($id)
    {

        $refrendo = Refrendo::find($id);


        return view('contralor.revisarRefrendo')->with(compact('refrendo'));

    }

    public function observaciones(Request $request)
    {

        $empresa = Empresa::find($request->empresa_id);

        if($empresa->observaciones()->exists()){
            $observaciones = Observacion::where('empresa_id', '=', $empresa->id);
            $observaciones->update(['contraloria_id'=> $request->input('contraloria_id')]);
            $observaciones->update(['contraloria'=> $request->input('contraloria')]);
        }else{
            Observacion::create($request->all());
        }


        return redirect()->route('contralor.index');
    }

    public function observacionesRefrendo(Request $request)
    {

        $refrendo = Refrendo::find($request->refrendo_id);

        if($refrendo->observacionesRefrendos()->exists()){
            $observacionesRefrendos = ObservacionRefrendo::where('refrendo_id', '=', $refrendo->id);
            $observacionesRefrendos->update(['contraloria_id'=> $request->input('contraloria_id')]);
            $observacionesRefrendos->update(['contraloria'=> $request->input('contraloria')]);
        }else{
            ObservacionRefrendo::create($request->all());
        }

        /*
        if($refrendo->estatus == 'N' || $refrendo->estatus == 'R'){
            $refrendo->update(['estatus'=> 'O']);

            try{
                Mail::mailer('observaciones')->to('$refrendo->empresa->user->email')->send(new ObservacionesRefrendo($refrendo->empresa->user->rfc));
            }
            catch(\Exception $e){
                $refrendo->update(['estatus'=> 'R']);
                return redirect('/')->withErrors(['mensaje'=>'Hubo un problema al enviar el correo, reenvie las observaciones nuevamente.']);

            }
        }*/

        return redirect()->route('contralor.refrendos.index');
    }

    public function validar(Request $request)
    {

        $user =   $user = auth()->user();
        $empresa = Empresa::find($request->id);

        if($empresa->observaciones()->exists()){
            $observaciones = $empresa->observaciones;

            $observaciones->update(['contraloria_validacion'=> '1', 'contraloria' => $request->obras]);
        }else{
            Observacion::create([
                    'empresa_id' => $empresa->id,
                    'contraloria_id' => $user->id,
                    'contraloria_validacion' => true,
                ]);
        }

        return json_encode('Success');

        //$empresa->update(['estatus'=> 'V']);

        //return redirect()->route('revisor.index');

    }

    public function validarRefrendo(Request $request)
    {

        $user =   $user = auth()->user();
        $refrendo = Refrendo::find($request->refrendo_id);

        if($refrendo->observacionesRefrendos()->exists()){
            $observaciones = $refrendo->observacionesRefrendos;

            $observaciones->update(['contraloria_validacion'=> '1', 'contraloria' => $request->contraloria]);

            return 'Success';

        }else{
            ObservacionRefrendo::create([
                    'empresa_id' => $refrendo->empresa->id,
                    'contraloria_id' => $user->id,
                    'refrendo_id' => $refrendo->id,
                    'contraloria_validacion' => true,
                    'contraloria' => $request->contraloria,
                ]);
        }

        //$refrendo->update(['estatus'=> 'V']);

        return json_encode('Success');

        //return redirect()->route('revisor.index');

    }

    public function ver($id)
    {

        if($empresa = Empresa::find($id)){
            return view('contralor.ver')->with(compact('empresa'));
        }

        return redirect()->route('contralor.index');


    }
}
