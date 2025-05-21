<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }



    public function customLogin(Request $request)
    {
        $request->validate([
            'rfc' => 'required',
            'password' => 'required',
        ]);


        $user = User::where('rfc', $request->rfc)->first();

        if(!$user) return Redirect::back()->withInput()->withErrors('No existe el Usuario.');

        if(!$user->active) return Redirect::back()->withInput()->withErrors('El Usuario esta inhabilitado.');


        if (Auth::attempt(['rfc' => strtoupper($request->rfc), 'password' => $request->password, 'active' => 1])) {
            return redirect()->intended('/');
        }

        return Redirect::back()->withInput()->withErrors('Contraseña incorrecta.');

    }




    public function registration()
    {



        $role = auth()->user()->roles->first();

        switch ($role->name) {
            case 'Jefatura':
                return view('jefatura.usuarios.register');
                break;
            case 'Supervisor':
                return view('supervision.usuarios.register');
                break;
            case 'Administrador':
                return view('administracion.usuarios.register');
                break;
        }

    }



    public function customRegistration(Request $request)
    {
        $request->validate([
            'rol' => 'required',
            'name' => 'required',
            'rfc' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect('/usuarios');
    }





    public function create(array $data)
    {

        $user = User::create([
                'rfc' => strtoupper($data['rfc']),
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
        ]);

        return  $user->assignRole($data['rol']);

    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }





    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
