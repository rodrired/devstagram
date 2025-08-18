<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(Request $request, User $user){
        //UNA MANERA DE GUARDARLO
        // Follower::create([
        //     'user_id'     => $user->id,
        //     'follower_id' => auth()->user()->id,
        // ]);

        //OTRA MANERA CON LA RELACIÓN EN EL MODELO
        $user->followers()->attach(auth()->user()->id); 
        //SE USA ATTACH PORQUE LAS RELACIONES EN LA TABLA NO SIGUEN LAS CONVENCIONES, YA QUE TIENE COMO CLAVE FORANEA UN FOLLOWER_ID
        //NO GUARDA EL CREATED_AT NI UPDATED_AT
        return back();
    }

      public function destroy(Request $request, User $user){
        //UNA MANERA DE ELIMINAR
        //Follower::where('user_id', $user->id)->where('follower_id', auth()->user()->id)->delete();
        $user->followers()->detach(auth()->user()->id); 
        //SE USA ATTACH PORQUE LAS RELACIONES EN LA TABLA NO SIGUEN LAS CONVENCIONES, YA QUE TIENE COMO CLAVE FORANEA UN FOLLOWER_ID

        return back();
    }
}
