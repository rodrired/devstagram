@extends('layouts.app')

{{-- CARGAR FICHEROS CSS UTILIZANDO @ STACK EN EL APP.BLADE Y CARGARLO UTILIZANDO AQUI PUSH --}}
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush   

@section('titulo')
    Creando Post
@endsection

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{ route('imagenes.store') }}" id="dropzone" class="dropzone border-dashed border-2 m-full h-96 rounded flex flex-col justify-center items-center" enctype="multipart/form-data" method="POST">
                {{-- PARA SUBIR IMAGENER UTILIZAR SIEMPRE enctype="multipart/form-data" --}}                
                @csrf
            </form>
        </div>
        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
             <form action="{{route('post.store')}}" method="POST" novalidate> <!-- novalidate para que valide laravel unicamente -->
                @csrf <!-- PARA VALIDAR EL FORMULARIO SIEMPRE UTILIZAR -->

                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold"> Titulo </label>
                    <input id="titulo" name="titulo" type="text" placeholder="Titulo de Publicación" class="border p-3 w-full rounded-lg @error('titulo') border-red-500 @enderror" value="{{ old('titulo') }}">
                    @error('titulo')
                        <p class="text-red-500 my-2 rounded-lg text-sm">{{$message}}</p>                        
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold"> Descripción </label>
                    <textarea id="descripcion" name="descripcion" placeholder="Descripción de Publicación" class="border p-3 w-full rounded-lg @error('descripcion') border-red-500 @enderror">                    
                        {{ old('descripcion') }}
                    </textarea>
                    @error('descripcion')
                        <p class="text-red-500 my-2 rounded-lg text-sm">{{$message}}</p>                        
                    @enderror
                </div>
                
                <div class="mb-5">
                    <input type='hidden' name='imagen' value="{{old('imagen')}}">
                    @error('imagen')
                        <p class="text-red-500 my-2 rounded-lg text-sm">{{$message}}</p>                        
                    @enderror
                </div>

                <input type="submit" value="Crear Post" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">

            </form>
        </div>
    </div>
@endsection