@extends('layouts.app')

@section('titulo')
    Perfil {{$user->usarname}}
@endsection

@section('contenido')
    @if(session('mensaje'))
        <p class="text-green-500 my-2 rounded-lg text-sm">{{session('mensaje')}}</p>                        
    @endif
    <div class="flex justify-center">
        <div class="w-full md:w-8/112 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="8/12 lg:w-6/12 px-5">
                <img src=" {{ asset(  $user->imagen ? 'perfiles/'. $user->imagen : 'img/usuario.svg')}}" alt="Imagen de usuario">
            </div>
            <div class="md:8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10">
                {{-- <p class="text-gray-700 text-2xl">{{ auth()->user()->username }} </p> INFORMACIÓN DEL USUARIO AUTENTICADO--}}
                {{-- TRAE LA INFO DEL USUARIO QUE SE ENVIA DESDE EL CONTROLLER --}}
                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2xl">{{ $user->username }} </p>  
                    {{-- EDITAR EL PERFIL --}}
                    @auth
                        @if($user->id === auth()->user()->id)
                            <a href=" {{ route('perfil.index')}}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    {{$user->followers()->count()}} <span class="font-normal"> @choice('Seguidor|Seguidores', $user->followers()->count())</span> {{-- choice elije automaticamente que termino elejir en base a la cantidad --}}
                </p>

                 <p class="text-gray-800 text-sm mb-3 font-bold">                    
                    {{$user->followings()->count()}} <span class="font-normal"> Siguiendo</span>
                </p>

                 <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->posts->count()}} <span class="font-normal"> Post</span>
                </p>

                @auth         
                    @if($user->id != auth()->user()->id)
                    {{-- SE COMPRUEBA UTILIZANDO LA RELACIÓN CREADA EN EL MODEL PARA SABER SI SIGO AL USUARIO QUE ESTOY VISITANDO --}}
                        @if(!$user->followers->find(auth()->user()->id)) 
                        {{-- OTRA FORMA DE COMPROBAR ES UTILIZANDO UNA FUNCIÓN EN EL MODELO --}}
                        {{-- @if(!$user->siguiendo(auth()->user())) --}}
                            <form action="{{route('user.follow', $user)}} " method="POST">
                                @csrf
                                <input type="submit" class="bg-blue-500 hover:bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="Seguir">
                            </form>
                        @else
                            <form action="{{route('user.unfollow', $user)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit" class="bg-red-500 hover:bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="Dejar de Seguir">
                            </form>
                        @endif
                    @endif
                @endauth

            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text center font-black my-10">Publicaciones</h2>

        {{-- CONTAR SI EL USUARIO TIENE POST A MOSTRAR --}}
        @if($posts->count())        {{-- SE PUEDE USAR EL OTRO METODO $user->posts, Y EN TODOS LOS LUGARES DONDE SE USA POSTS, MENOS EN LA PAGINACIÓN --}}
            <div class="grid md:grid-col-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($posts as $post)
                    @if(file_exists(public_path('uploads/' . $post->imagen)))                    
                        <div>
                            <a href="{{route('post.show',[ Auth::user(), $post])}}">
                                <img src="{{asset('uploads') . '/' . $post->imagen}}" alt="Imagen del post {{$post->titulo}}">
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="my-10">
                {{$posts->links("pagination::tailwind")}}
            </div>

        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No has publicado nada aun</p>
        @endif
        
        {{-- OTRA FORMA DE OBTENER LOS POST DEL USUARIO --}}
            {{-- {{dd($user->posts)}} PODEMOS ACCEDER A LA RELACIÓN CREADA EN USER, TRAE TODOS LOS RESULTADOS PERO NO TIENE PAGINACIÓN. --}}
    </section>
@endsection