@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username}}
@endsection


@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form class="mt-10 md:mt-0" acction=" route{{'perfil.store'}}" method= 'POST' enctype="multipart/form-data"> {{-- enctype="multipart/form-data" porq estamos enviando un archivo--}} 
                 @csrf <!-- PARA VALIDAR EL FORMULARIO SIEMPRE UTILIZAR -->

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold"> UserName </label>
                    <input id="username" name="username" type="text" placeholder="Tu nombre de usuario" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value="{{ auth()->user()->username }}">
                    @error('username')
                        <p class="text-red-500 my-2 rounded-lg text-sm">{{$message}}</p>                        
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold"> Email </label>
                    <input id="email" name="email" type="text" placeholder="Tu nombre" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value="{{ auth()->user()->email }}">
                    @error('email')
                        <p class="text-red-500 my-2 rounded-lg text-sm">{{$message}}</p>                        
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold"> Imagen Perfil </label>
                    <input id="imagen" name="imagen" type="file" class="border p-3 w-full rounded-lg "  accept=".jpg,.jpeg,.png">                    
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold"> password </label>
                    <input id="password" name="password" type="text" placeholder="Tu password" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 my-2 rounded-lg text-sm">{{$message}}</p>                        
                    @enderror
                </div>

                <input type="submit" value="Guardar Perfil" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

                @if(session('mensaje'))
                    <p class="text-red-500 my-2 rounded-lg text-sm">{{session('mensaje')}}</p>                        
                @endif
            </form>
        </div>
    </div>
@endsection