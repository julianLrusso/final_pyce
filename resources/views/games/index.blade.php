<x-layout>
    <x-slot:title>Juegos</x-slot:title>

    <h1 class="text-center my-3 fw-bold">Listado de juegos</h1>


    @if(!empty($games))

        <div class="row mt-5">
            @foreach($games as $game)
                <div class="col-xl-3 col-md-6 d-flex align-items-stretch mb-4">
                    <div class="card">
                        <div class="card-img-top d-flex bg-black">
                            <img src="{{url($game->image)}}" class="img-fluid m-auto max-h-200"
                                 alt="{{$game->title}}">
                        </div>
                        <div class="card-body d-flex flex-column">

                            <h2 class="card-title">{{$game->title}}</h2>
                            <span class="badge bg-secondary rounded-pill mb-2">{{$game->release_date}}</span>

                            <p class="card-text mb-4">{{$game->description}}</p>
                            <div class="mt-auto">
                                <span class="badge bg-dark w-100">Genero: {{$game->genre->name}}</span>
                                <a href="{{route('games.show',[$game->id])}}"
                                   class="btn btn-warning mt-3 w-100 align-self-start">Ver más</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @else

        <div class="bg-white mt-3 p-3 rounded">
            <h2>No hay nada aquí...</h2>
            <p>Lo lamento, caminante, no dispongo de aquello que buscas.</p>
            <img src="{{url('img/empty.webp')}}" alt="Inventario vacío">
        </div>

    @endif
</x-layout>
