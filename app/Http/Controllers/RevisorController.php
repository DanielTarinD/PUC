<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\DataTables\EmpresaRevisorDataTable;
use App\DataTables\EmpresaSeguimientoRevisorDataTable;
use App\DataTables\EmpresaRefrendoRevisorDataTable;
use App\DataTables\EmpresaRefrendoSeguimientoRevisorDataTable;

use App\Models\Empresa;
use App\Models\Observacion;
use App\Models\Refrendo;
use App\Models\ObservacionRefrendo;


use App\Mail\Observaciones;
use App\Mail\ObservacionesRefrendo;

class RevisorController extends Controller {

    public function index(EmpresaRevisorDataTable $dataTable)
    {
        return $dataTable->render('revisor.index');
    }

    public function indexSeguimiento(EmpresaSeguimientoRevisorDataTable $dataTable)
    {

        return $dataTable->render('revisor.indexSeguimiento');
    }



    public function indexRefrendos(EmpresaRefrendoRevisorDataTable $dataTable)
    {

        return $dataTable->render('revisor.indexRefrendos');
    }

    public function indexRefrendosSeguimiento(EmpresaRefrendoSeguimientoRevisorDataTable $dataTable)
    {

        return $dataTable->render('revisor.indexRefrendosSeguimiento');
    }




    public function revisar($id)
    {
        $empresa = Empresa::find($id);

        return view('revisor.revisar')->with(compact('empresa'));


    }


    public function revisarRefrendo($id)
    {

        $refrendo = Refrendo::find($id);


        return view('revisor.revisarRefrendo')->with(compact('refrendo'));

    }

    public function observaciones(Request $request)
    {
        $empresa = Empresa::find($request->empresa_id);

        if($empresa->observaciones()->exists()){
            $observaciones = Observacion::where('empresa_id', '=', $empresa->id);
            $observaciones->update(['obras_id'=> $request->input('obras_id')]);
            $observaciones->update(['obras'=> $request->input('obras')]);
        }else{
            Observacion::create($request->all());
        }

        if($empresa->estatus == 'R'){
            $empresa->update(['estatus'=> 'O']);

            try{
                Mail::mailer('smtp')->to($empresa->user->email)->send(new Observaciones($empresa->user->rfc));
            }
            catch(\Exception $e){
                $empresa->update(['estatus'=> 'R']);
                return redirect('/')->withErrors(['mensaje'=>'Hubo un problema al enviar el correo, reenvie las observaciones nuevamente.']);

            }
        }

        return redirect()->route('revisor.index');
    }

    public function observacionesRefrendo(Request $request)
    {
        $refrendo = Refrendo::find($request->refrendo_id);


        if($refrendo->observacionesRefrendos()->exists()){
            $observacionesRefrendos = ObservacionRefrendo::where('refrendo_id', '=', $refrendo->id);
            $observacionesRefrendos->update(['obras_id'=> $request->input('obras_id')]);
            $observacionesRefrendos->update(['obras'=> $request->input('obras')]);
            $observacionesRefrendos->update(['ejercicio'=> '2024']);
        }else{
            ObservacionRefrendo::create($request->all());
        }

        if($refrendo->estatus == 'N' || $refrendo->estatus == 'R'){


            $refrendo->update(['estatus'=> 'O']);


            try{
                Mail::mailer('smtp')->to($refrendo->empresa->user->email)->send(new ObservacionesRefrendo($refrendo->empresa->user->rfc));
            }
            catch(\Exception $e){



                $refrendo->update(['estatus'=> 'R']);


                return redirect('revisor/refrendos/seguimiento/')->withErrors(['mensaje'=>'Hubo un problema al enviar el correo, reenvie las observaciones nuevamente.']);

            }
        }

        return redirect()->route('revisor.refrendos.index');
    }


    public function validar(Request $request)
    {

        $user =   $user = auth()->user();
        $empresa = Empresa::find($request->id);

        if($empresa->observaciones()->exists()){
            $observaciones = $empresa->observaciones;

            $observaciones->update(['obras_validacion'=> '1', 'obras' => $request->obras]);

        }else{
            Observacion::create([
                    'empresa_id' => $empresa->id,
                    'obras_id' => $user->id,
                    'obras_validacion' => true,
                ]);
        }

        $empresa->update(['estatus'=> 'V']);

        return json_encode('Success');

        //return redirect()->route('revisor.index');

    }

    public function validarRefrendo(Request $request)
    {


        $user =   $user = auth()->user();
        $refrendo = Refrendo::find($request->refrendo_id);

        if($refrendo->observacionesRefrendos()->exists()){
            $observaciones = $refrendo->observacionesRefrendos;

            $observaciones->update(['obras_validacion'=> '1', 'obras' => $request->obras]);

        }else{
            ObservacionRefrendo::create([
                    'empresa_id' => $refrendo->empresa->id,
                    'obras_id' => $user->id,
                    'refrendo_id' => $refrendo->id,
                    'obras_validacion' => true,
                    'obras' => $request->obras,
                ]);
        }

        $refrendo->update(['estatus'=> 'V']);

        return json_encode('Success');

        //return redirect()->route('revisor.index');

    }


    public function ver($id)
    {

        if($empresa = Empresa::find($id)){
            return view('revisor.ver')->with(compact('empresa'));
        }

        return redirect()->route('revisor.index');


    }


}
