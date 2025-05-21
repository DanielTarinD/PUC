<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\DataTables\EmpresaContralorDataTable;

use App\Models\Empresa;
use App\Models\Observacion;

use App\Mail\Observaciones;

class ContralorController extends Controller {

    public function index(EmpresaContralorDataTable $dataTable)
    {
        return $dataTable->render('contralor.index');
    }


    public function revisar($id)
    {
        $empresa = Empresa::find($id);

        return view('contralor.revisar')->with(compact('empresa'));


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

        if($empresa->estatus == 'R' && $empresa->observaciones->obras != ''){
            $empresa->update(['estatus'=> 'O']);

            try{
                Mail::mailer('observaciones')->to($empresa->user->email)->send(new Observaciones($empresa->user->rfc));
            }
            catch(\Exception $e){
                return redirect('/')->withErrors(['mensaje'=>'Hubo un problema al enviar el correo.']);
            }
        }

        return redirect()->route('contralor.index');
    }

    public function validar(Request $request)
    {

        $empresa = Empresa::find($request->id);

        $observaciones = $empresa->observaciones;

        $observaciones->update(['contraloria_validacion'=> '1']);

        return json_encode("Success");

    }

    public function ver($id)
    {

        if($empresa = Empresa::find($id)){
            return view('contralor.ver')->with(compact('empresa'));
        }

        return redirect()->route('contralor.index');


    }
}
