<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Models\User;

use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;

class UsuarioController extends Controller
{


    public function index()
    {
        $usuarios_totales = User::count();

        $role = auth()->user()->roles->first();

        switch ($role->name) {
            case 'Jefatura':
                return view('jefatura.usuarios.index')->with(compact('usuarios_totales'));
                break;
            case 'Supervisor':
                return view('supervision.usuarios.index')->with(compact('usuarios_totales'));
                break;
            case 'Administrador':
                return view('administracion.usuarios.index')->with(compact('usuarios_totales'));
                break;
        }

    }


    public function perfil() {

        $perfil = Auth::user();

        return view('auth.profile')->with(compact('perfil'));
    }


    public function updatePerfil(Request $request) {

        if($request->hasFile('file')){
            $avatar = $request->file('file');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            Image::make($avatar)->resize(300, 300)->save(storage_path('app/public/avatars/' . $filename ) );

            $affected = User::find(auth()->user()->id)->update(['avatar'=> $filename]);
        }

        if($request->password != ""){
            $affected = User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);
            return redirect()->route('logout');
        }

        return redirect()->route('perfil');

    }


    public function destroy($id)
    {

        if(auth()->user()->hasRole('Jefatura') || auth()->user()->hasRole('Supervisor') || auth()->user()->hasRole('Administrador')){
            $user = User::find($id);

            if($user->empresas()->count() > 0){
                return "Este Usuario cuenta con un Empresa Activa, no puede ser eliminado.";
            }else{
                if($user->avatar != "default.png"){
                    Storage::delete('public/avatars/'.$user->avatar);
                }

                $user->delete();
                return "Usuario Eliminado Correctamente.";
            }

        }else{
            return "No tiene Permisos Suficientes.";
        }


    }


    public function updatePassword($id, $password)
    {

        if(is_null($password) || empty($password)){
            $response = array(
                "message" => "La contraseña no puede estar vacía.",
            );
        }else{
                $user = User::find($id);
                $user->update(['password'=> Hash::make($password)]);

                $response = array(
                    "message" => "La contraseña se cambio correctamente.",
                );
        }


        return json_encode($response);

    }


    public function getUsuarios(Request $request)
    {
            $data = User::with("roles", "preregistro")->whereHas("roles", function($q) {
                $q->whereIn("name", ["Contratista"]);
            })->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('avatar', function (User $data) {
                    $url = asset('storage/avatars/'.$data->avatar);
                    return '<img src='.$url.' class="rounded h-30px" />';
                })
                ->addColumn('action', function(User $data){
                    $actionBtn = "<a href='#' class='btn btn-xs btn-info w-60px me-1' id='password' data-id='".$data->id."'>Pass</a>";

                    $actionBtn .= "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";

                    if($data->active){
                        $actionBtn .= "<a href='#' class='btn btn-xs btn-gray w-60px me-1' id='habilitar' data-id='".$data->id."'>Desact.</a>";
                    }else{
                        $actionBtn .= "<a href='#' class='btn btn-xs btn-primary w-60px me-1' id='habilitar' data-id='".$data->id."'>Act.</a>";
                    }

                    return $actionBtn;
                })
                ->addColumn('rol', function(User $data){
                    return $data->getRoleNames()->first();
                })
                ->addColumn('telefono', function(User $data){

                    if(isset($data->preregistro->telefono_contacto)){
                        return $data->preregistro->telefono_contacto;
                    }else{
                        return 'N/A';
                    }

                })
                ->rawColumns(['action','avatar','rol','telefono'])
                ->make(true);

    }

    public function getUsuariosSupervision(Request $request)
    {
            $data = User::with("roles", "preregistro")->whereHas("roles", function($q) {
                $q->whereIn("name", ["Administrador", "Supervisor", "Revisor", "Contralor", "Contratista" ]);
            })->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('avatar', function (User $data) {
                    $url = asset('storage/avatars/'.$data->avatar);
                    return '<img src='.$url.' class="rounded h-30px" />';
                })
                ->addColumn('action', function(User $data){
                    $actionBtn = "<a href='/jefatura/perfil/".$data->id."' class='btn btn-xs btn-info w-60px me-1' id='password' data-id='".$data->id."'>Editar</a>";

                    $actionBtn .= "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";

                    if($data->active){
                        $actionBtn .= "<a href='#' class='btn btn-xs btn-gray w-60px me-1' id='habilitar' data-id='".$data->id."'>Desact.</a>";
                    }else{
                        $actionBtn .= "<a href='#' class='btn btn-xs btn-primary w-60px me-1' id='habilitar' data-id='".$data->id."'>Act.</a>";
                    }

                    return $actionBtn;
                })
                ->addColumn('rol', function(User $data){
                    return $data->getRoleNames()->first();
                })
                ->addColumn('telefono', function(User $data){

                    if(isset($data->preregistro->telefono_contacto)){
                        return $data->preregistro->telefono_contacto;
                    }else{
                        return 'N/A';
                    }

                })
                ->rawColumns(['action','avatar','rol','telefono'])
                ->make(true);

    }

    public function getUsuariosJefatura(Request $request)
    {
            $data = User::with("roles", "preregistro")->whereHas("roles", function($q) {
                $q->whereIn("name", ["Jefatura", "Supervisor", "Administrador", "Revisor", "Contralor", "Contratista" ]);
            })->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('avatar', function (User $data) {
                    $url = asset('storage/avatars/'.$data->avatar);
                    return '<img src='.$url.' class="rounded h-30px" />';
                })
                ->addColumn('action', function(User $data){
                    $actionBtn = "<a href='/jefatura/perfil/".$data->id."' class='btn btn-xs btn-info w-60px me-1' id='password' data-id='".$data->id."'>Editar</a>";

                    $actionBtn .= "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";

                    if($data->active){
                        $actionBtn .= "<a href='#' class='btn btn-xs btn-gray w-60px me-1' id='habilitar' data-id='".$data->id."'>Desact.</a>";
                    }else{
                        $actionBtn .= "<a href='#' class='btn btn-xs btn-primary w-60px me-1' id='habilitar' data-id='".$data->id."'>Act.</a>";
                    }

                    return $actionBtn;
                })
                ->addColumn('rol', function(User $data){
                    return $data->getRoleNames()->first();
                })
                ->addColumn('telefono', function(User $data){

                    if(isset($data->preregistro->telefono_contacto)){
                        return $data->preregistro->telefono_contacto;
                    }else{
                        return 'N/A';
                    }


                })
                ->rawColumns(['action','avatar','rol','telefono'])
                ->make(true);

    }


    public function desactivar($id)
    {

        $user = User::find($id);

        if($user->active){
            $user->update(['active'=> '0']);

            return "Usuario Desactivado";
        }else{
            $user->update(['active'=> '1']);

            return "Usuario Activado";
        }
    }



}
