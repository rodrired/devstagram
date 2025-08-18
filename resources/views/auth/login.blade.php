@extends('layouts.app')

@section('titulo')
    Inicia Sesión en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{asset('img/registrar.jpg')}}">
        </div>
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl" alt="Imagen Login de Usuario">
            <form action="{{route('login')}}" method="POST" novalidate> <!-- novalidate para que valide laravel unicamente -->
                @csrf <!-- PARA VALIDAR EL FORMULARIO SIEMPRE UTILIZAR -->
                @if(session('mensaje'))
                    <p class="text-red-500 my-2 rounded-lg text-sm">{{session('mensaje')}}</p>                        
                @endif

                    
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold"> Email </label>
                    <input id="email" name="email" type="email" placeholder="Tu Email" class="border p-3 w-full rounded-lg" value="{{ old('email') }}">
                        @error('email')
                        <p class="text-red-500 my-2 rounded-lg text-sm">{{$message}}</p>                        
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold"> Password </label>
                    <input id="password" name="password" type="password" placeholder="Tu Password" class="border p-3 w-full rounded-lg" value="{{ old('password') }}">
                        @error('password')
                        <p class="text-red-500 my-2 rounded-lg text-sm">{{$message}}</p>                        
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember"> 
                    <label class="text-gray-500 text-sm"> Mantener mi sesión abierta </label>
                </div>

                <input type="submit" value="Iniciar Sesión" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>

    </div>

    
@endsection