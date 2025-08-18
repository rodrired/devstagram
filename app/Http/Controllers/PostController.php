<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //PROTEJER ACCESO A DIRECCIONES SIN INICIAR SESIÓN
    public function __construct(){
        $this->middleware('auth')->except(['show', 'index']); //SIEMPRE REDIRECCIONA AL USUARIO A UNA VISTA /login
        //SE EXCEPTUAN METODOS QUE SE PUEDE ACCEDER SI NO ESTA AUTENTICADO
    }
         
    
    public function index(User $user){
            $posts = Post::where('user_id', $user->id)->paginate(4); //BUSCA EN LA BD LOS POST CON EL USER ID DEL USUARIO MURO, GET TRAE LOS DATOS

            return view('dashboard', [
                'user' => $user,
                'posts' => $posts,
            ]);
    }

    public function create(){
        return view('post.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'titulo'        => 'required|max:255',
            'descripcion'   => 'required',
            'imagen'        => 'required',
        ]);

        Post::create([
            'titulo' => $request->descripcion,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);

        //OTRA FORMA DE ALMACENAR DATOS A LA BD
            // $post = new Post;
            // $post->titulo       = $request->titulo;
            // $post->descripcion  = $request->descripcion;
            // $post->imagen       = $request->imagen;
            // $post->user_id      = auth()->user()->id;
            // $post->save();

        //UTILIZANDO LA RELACION DE USER CON POST
            // $request->user()->posts()->create([
            //     'titulo' => $request->descripcion,
            //     'descripcion' => $request->descripcion,
            //     'imagen' => $request->imagen,
            //     'user_id' => auth()->user()->id,
            // ]);

        return redirect()->route('post.index' , Auth::user());


    }   
    
    public function show(User $user, Post $post){
        return view ('post.show', [
            'post' => $post,
            //Se puede mandar el usuario para obtener los datos
            //'user' => $user,
    ]);
    }

    public function destroy(Post $post){
        //USO DE POLICY
        $this->authorize('delete', $post);
        
        $post->comentarios()->delete(); //SI TIENE COMENTARIOS RELACIONADOS PRIMERO HAY QUE BORRARLOS. TAMBIEN SE PUEDE MODIFICAR LA MIGRACIÓN DE COMENTARIOS PARA BORRAR EN CASCADA
        $post->delete();
        $imagen_path = public_path('uploads/' . $post->imagen);

        //SE COMPRUEBA SI EL ARCHIVO EXISTE. FILE ES HELPER DE LARAVEL
        if(File::exists($imagen_path))
            unlink($imagen_path); //UNLINK ES DE PHP
            //TAMBIEN EXISTE File::delete($imagen_path);

        return redirect()->route('post.index', auth()->user());
    }
}
