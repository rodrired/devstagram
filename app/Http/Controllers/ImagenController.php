<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class ImagenController extends Controller
{
    //GUARDAR UN FICHERO EN EL SERVIDOR
    public function store(Request $request){
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No se recibió archivo'], 400);
        }

        $imagen = $request->file('file');

        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        $imagenServidor = Image::read($imagen);
        $imagenServidor->crop(1000, 1000); //CORTAR LA IMAGEN. VER DOCUMENTACIÓN EN LA WEB
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
}
