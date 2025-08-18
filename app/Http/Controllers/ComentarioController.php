<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post){
        //VALIDAR
        $this->validate($request, [
            'comentario' => 'required|max:255',
        ]);

        //ALMACENAR
        Comentario::create([
            'user_id'       => Auth::user()->id, //USUARIO AUTENTICADO QUE ESTA COMENTANDO
            'post_id'       => $post->id,
            'comentario'    => $request->comentario,
        ]);
        //IMPRIMIR MENSAJE
        return back()->with('mensaje', 'Mensaje enviado correctamente');
    }

}
