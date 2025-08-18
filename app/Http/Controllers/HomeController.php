<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //AL TENER UN SOLO METODO SE PUEDE UTILIZAR __invoke, esto hace que lo mande a llamar cuando se instancia la clase
    public function __invoke(){
        //OBTENER USUARIOS QUE SE SIGUEN
        $ids = auth()->user()->followings->pluck('id')->toArray();

        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20); //




        return view('home', [
            'posts' => $posts,
        ]);
    }
}
