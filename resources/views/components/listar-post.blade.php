<div>
   {{-- @if($posts->count())
        @foreach ($posts as $post )
            <h1> {{$post->titulo}} </h1>
        @endforeach 
    @else
        <h1>No hay post a mostrar </h1>
    @endif --}}

    {{-- ↑ SE PUEDE RESUMIR ↓ --}}

    {{-- @forelse ($posts as $post )
        <h1> {{$post->titulo}} </h1>
    @empty
        <h1>No hay post a mostrar </h1>
    @endforelse --}}

    {{-- @if($posts->count())
        <div class="grid md:grid-col-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($posts as $post)
                    <div>
                        <a href="{{route('post.show',[ Auth::user(), $post])}}">
                            <img src="{{ File::exists(public_path('uploads') . '/' . $post->imagen)
                            ? asset('uploads') . '/' . $post->imagen 
                            : asset('img/Imagen-vacia.jpg') }}" 
                            alt="Imagen del post {{$post->titulo}}">
                        </a>
                    </div>
            @endforeach
        </div>
    @else
        <p class="text-center">No hay post. No has seguido a nadie o tus seguidos no han publicado nada aún. </p>        
    @endif --}}

    {{-- CON SLOTS --}}
    @if($posts->count())
        <div class="grid md:grid-col-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($posts as $post)
                    <div>
                        <a href="{{route('post.show',[ Auth::user(), $post])}}">
                            <img src="{{ File::exists(public_path('uploads') . '/' . $post->imagen)
                            ? asset('uploads') . '/' . $post->imagen 
                            : asset('img/Imagen-vacia.jpg') }}" 
                            alt="Imagen del post {{$post->titulo}}">
                        </a>
                    </div>
            @endforeach
        </div>
    @else
        <p class="text-center">No hay post. No has seguido a nadie o tus seguidos no han publicado nada aún. </p>        
    @endif
</div>