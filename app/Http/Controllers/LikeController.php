<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post){
        //DOS MANERAS DE CREAR, UTILIZANDO LA RELACION EN POST.PHP

        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        //UTILIZANDO EL MODELO LIKE
        // Like::create([
        //     'user_id' => $request->user()->id,
        //     'post_id' => $post->id, //DEBE ESTAR EN EL FILLABLE AGREGADO
        // ]);

        return back();
    }

    public function destroy (Request $request, Post $post){
        //dd("ELIMINANDO LIKE");
        //CON LA RELACIÓN CREADA EN EL MODELO USER SE PUEDE BUSCAR POR EL ID DEL USUARIO, Y EL ID DEL POST Y ELIMINARLO
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
