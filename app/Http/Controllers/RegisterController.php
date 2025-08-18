<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\View\View;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function index()
    {
        return view('.auth/register');
    }
    public function store(Request $request){
        //dd($request); imprime los valores que recibimos

        $request->request->add(['username' => Str::lower($request->username)]); //SE RESCRIBE PARA QUE SALTE LA VALIDACIÓN ANTES DE INTENTAR GUARDAR EN LA BD

        //VALIDACIÖN
        $request->validate([
            'name'                      => 'required|min:5' , // o como array ['required', 'min:20']
            'username'                  => 'required|unique:users|min:3|max:20|regex:/^\S*$/', //NO HA Q DEJAR ESPACIOS
            'email'                     => ['required', 'unique:users', 'email', 'max:60'],
            'password'                  => ['required', 'confirmed', 'min:6'], //uiliza el campo password_confirmation para comprobar q sean iguales
        ]);

        User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);

        //AUTENTICAR AL USUARIO
            //UTILIZANDO LOS DATOS DE ACCESO
        // auth()->attempt([
        //     'email'     => $request->name,
        //     'password'  => $request->password,
        // ]);

            //UTILIZANDO ONLY
        //auth()->attempt($request->only('email', 'password'));
        //UTILIZANDO CLASE Auth
        // Auth::attempt(['email' => $email, 'password' => $password]);
         Auth::attempt($request->only('email', 'password'));

        return redirect()->route('post.index',Auth::user());        
    }
}
