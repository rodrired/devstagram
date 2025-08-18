<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DevStagram - @yield('titulo')</title>         <!-- inyecta codigo que trae desde la vista que utilice esta plantilla -->

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
        <link rel="preload" as="style" href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap">
        <link rel="stylesheet" href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" media="all">        
        
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])       
        @endif

        <!-- Styles / Scripts -->
        @stack('styles') <!--CARGAR STYLOS EN VISTAS DIFERENTES -->
        
        @livewireStyles

    </head>
    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">
                <a href="{{route('home')}}">
                    <h1 class="text-3xl font-black">
                        Devstagram
                    </h1>
                </a>
                {{-- MANERAS DE SABER SI UN USUARIO ESTA AUTENTICADO --}}
                @auth
                    <nav class="flex gap-2 items-center">
                        <a class="flex item-center gap-2 bg-white border p-2 text.gray-600 rounded text-sm uppercase font-bold cursor-pointer" href="{{route('post.create')}}">
                            {{-- ICONOS DE heroicons.com copiado svg --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                            </svg>
                            Crear
                        </a>
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('post.index', auth()->user())}}">Hola <span class="font-normal lowercase">{{auth()->user()->username}} </span></a>
                        {{-- PARA DARLE MÁS SEGURIDAD AL CERRAR SESIÓN YA QUE INTERACTURA CON LA BD --}}
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button type="submit" class="font-bold uppercase text-gray-600 text-sm cursor-pointer"> Cerrar Sesión </button>
                        </form>
                    </nav>
                @endauth
                
                @guest
                    <nav class="flex gap-2">
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('login')}}">Login</a>
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('register')}}">
                            Crear Cuenta</a>
                    </nav>
                @endguest

                {{-- MANERAS DE SABER SI UN USUARIO ESTA AUTENTICADO UTILIZANDO IF--}}

                {{-- @if(Auth::user())
                      <nav class="flex gap-2">
                        <a class="font-bold uppercase text-gray-600 text-sm" href="#">Mi Perfil</a>
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('register')}}">
                            Cerrar Sesión</a>
                    </nav>
                @else
                    <nav class="flex gap-2">
                        <a class="font-bold uppercase text-gray-600 text-sm" href="#">Login</a>
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('register')}}">
                            Crear Cuenta</a>
                    </nav>                 
                @endif --}}

            </div>
        </header>

        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">
                @yield('titulo')
            </h2>

            @yield('contenido')
        </main>

        <footer class="mt-10 text-center p-5 text-gray-500 font-bold">
            DevStagram - Todos los derechos recervados {{ now()->year }}
            <!-- { { } } es para inyectar codigo php, en vez de abrir un bloque < ? php, que tambien se puede utilizar @ php @ endphp (TODO SIN ESPACIOS)-->
        </footer>
        {{-- @stack('scripts') --}} <!--CARGAR JS EN VISTAS DIFERENTES -->
        @livewireScripts
    </body>
</html>
