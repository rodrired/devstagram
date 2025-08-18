<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user){
        //dd("desde index perfil");
        return view('perfil.index',['user' => $user]);
    }

    public function store(Request $request){
        $request->request->add(['username' => Str::lower($request->username)]); //SE RESCRIBE PARA QUE SALTE LA VALIDACIÓN ANTES DE INTENTAR GUARDAR EN LA BD

        $this->validate($request, [
            //'username'  => 'required|unique:users|min:3|max:20|regex:/^\S*$/', //NO HA Q DEJAR ESPACIOS
            //cuando son mas de tres validaciones laravel recomienda que sea en un array
            'username'  => ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20','regex:/^\S*$/', 'not_in:twitter,editar-perfil'], //not_in: EXCLUYA LOS QUE PONGAMOS, SE PUEDE USAR  'in: para que elija de una lista
            //username,'.auth()->user()->id, ESTO ES POR SI EL USUARIO NO CAMBIA SU USERNAME Y SOLO SU EMAIL NO LE DA ERROR DE QUE EL USERNAME YA EXISTE
            'email'     => ['required', 'unique:users,email,'.auth()->user()->id, 'email', 'max:60'],
            'password'  => ['required', 'min:6'], //uiliza el campo password_confirmation para comprobar q sean iguales
        ]);

        if(!auth()->attempt($request->only('password'), $request->remember)){
            return back()->with('mensaje', 'Credencial Incorrectas. No puede modificar el perfil.');
        }


        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email    = $request->email;


        if($request->imagen){
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            $imagenServidor = Image::read($imagen);
            $imagenServidor->crop(1000, 1000); //CORTAR LA IMAGEN. VER DOCUMENTACIÓN EN LA WEB
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);

            $usuario->imagen = $nombreImagen;
        }
        //TAMBIEN SE PUEDE
        //$usuario->imagen = $nombreImagen ?? ''; SI NO HAY NOMBRE DE IMAGEN PONE VACIO '', SINO GUARDA EL NOMBRE. SE PUEDEN PONER MULTIPLES CONDICIONES $nombreImagen ?? auth()->user()->imagen ?? '';
        $usuario->save();

        return redirect()->route('post.index', $usuario)->with('mensaje', 'El usuario se modifico correctamente');
    }
}
