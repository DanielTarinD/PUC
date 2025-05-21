<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Models\Preregistro;
use App\Models\User;
use App\Mail\AccesoPlataforma;

use App\DataTables\PreregistroDataTable;
use App\Mail\PreregistroPlataforma;

class PreregistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PreregistroDataTable $dataTable)
    {
        return $dataTable->render('administracion.preregistros.index');
    }



    public function show(Preregistro $preregistro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Preregistro  $preregistro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $preregistro = Preregistro::find($id);

        if (User::where('rfc', '=', strtoupper($preregistro->rfc_empresa))->exists()) {
            return "El Preregistro ya cuenta con un Acceso concedido, no puede ser eliminado.";
        }else{
            $preregistro->delete();
            return "Registro Eliminado Correctamente";
        }

    }



    public function acceso($id_preregistro)
    {

        $preregistro = Preregistro::find($id_preregistro);

        if(User::where('email', '=',  $preregistro->correo_contacto)->exists()){
            return view('modales.accesoBloqueado')->with(compact('preregistro'));
        }else{
            return view('modales.acceso')->with(compact('preregistro'));
        }

    }


    public function crearAcceso(Request $request)
    {
        $request->validate([
            'preregistro_id' => 'required',
            'rfc' => 'required|string|min:12|max:13|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        if(!isset($request->password)){
            $password = Str::random(8);
        }else{
            $password = $request->password;
        }

        $user = User::create([
            'preregistro_id' => $request->preregistro_id,
            'rfc' => strtoupper($request->rfc),
            'name' => strtoupper($request->name),
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);

        $user->assignRole('Contratista');


        $usuario = strtoupper($request->rfc);
        $contraseña =  $password;

        try{
            Mail::mailer('smtp')->to($request->email)->send(new AccesoPlataforma($usuario, $contraseña));
        }
        catch(\Exception $e){
            $user->delete();

            return redirect('/preregistros')->withErrors(['mensaje'=>'Hubo un problema al enviar el correo, vuelva a generar el Acceso.']);
        }

        return redirect('/preregistros');

    }


    public function registro()
    {


        return view('registro.index');

    }


    public function registroStore(Request $request)
    {


        $request->validate([
            'nombre_empresa' => 'required',
            'nombre_responsable' => 'required',
            'rfc_empresa' => 'required|unique:preregistros',
            'telefono_contacto' => 'required|min:10|max:10',
            'correo_contacto' => 'required|email',
            'agreementCheckbox' =>'accepted'

        ],
        [

            'nombre_empresa.required'=> 'El Nombre de la Empresa es requerida.', // custom message
            'nombre_responsable.required'=> 'El Nombre del Responsable es requerido.', // custom message
            'rfc_empresa.required'=> 'El RFC es requerido.', // custom message
            'rfc_empresa.unique'=> 'Este RFC ya se encuentra registrado.', // custom message
            'telefono_contacto.required'=> 'El Teléfono es requerido.', // custom message
            'telefono_contacto.min'=> 'El Teléfono debe tener mínimo 10 dígitos.', // custom message
            'telefono_contacto.max'=> 'El Teléfono debe tener máximo 10 dígitos', // custom message
            'correo_contacto.required'=> 'Debe ingresar un correo electrónico.', // custom message
            'correo_contacto.email'=> 'Debe ingresar un correo eletrónico válido.', // custom message
            'agreementCheckbox.accepted' => 'Debe confirmar haber leido y aceptado el Aviso de Privacidad.'

        ]);



        try{

            $preregistro = Preregistro::create([
                'nombre_empresa' => strtoupper($request->nombre_empresa),
                'nombre_responsable' => strtoupper($request->nombre_responsable),
                'rfc_empresa' => strtoupper($request->rfc_empresa),
                'telefono_contacto' => $request->telefono_contacto,
                'correo_contacto' => $request->correo_contacto,
            ]);

            Mail::mailer('smtp')->to($request->correo_contacto)->send(new PreregistroPlataforma());
        }
        catch(\Exception $e){

            return redirect('/registro')->withErrors(['mensaje'=>'Hubo un problema al generar su preregistros , vuelva a intentarlo o comuniquese con nosotros.']);
        }

        return redirect('/registro')->withErrors(['mensaje'=>'Tu Pre-Registro se guardo correctamente, en breve te llegara tu acceso para continuar con tu proceso.']);




    }


}
