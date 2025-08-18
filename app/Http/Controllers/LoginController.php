<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
        //SE VALIDA LOS DATOS INGRESADOS POR EL USUARIO
        $request->validate([
            'email'                     => ['required', 'email'],
            'password'                  => ['required'], 
        ]);

        //Se comprueban las credenciales, si son incorrectas vuelve a la vista que la llamo con una variable mensaje = 'credenciales incorrectas'
        //remember input de la vista para mantener sesión iniciada, crea una cookie y guarda un token en la BD
        if(!auth()->attempt($request->only('email','password'), $request->remember)){
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }
        //Si se autentico correctamente se puede redirigir al usuario al muro
        return redirect()->route('post.index', auth()->user());
    }
}
