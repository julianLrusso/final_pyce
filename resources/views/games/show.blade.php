<x-layout>
    <x-slot:title>Juego - {{$game->title}}</x-slot:title>
    <div class="text-center mt-3">
        <h1 class="fw-bold">{{$game->title}} </h1>
        <span class="badge bg-secondary rounded-pill">
            {{$game->release_date}}
        </span>
    </div>
    <div class="card my-4">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6">
                <img src="{{url($game->image)}}" class="card-img-top" alt="{{$game->title}}">
            </div>
            <div class="col-xl-9 col-lg-8 col-md-6 card-body">
                <div class="d-flex flex-column">
                    <span class="border-bottom border-warning border-2 fs-5">Resumen</span>
                    <p>{{$game->description}}</p>
                </div>

                <div class="d-flex flex-column">
                    <span class="border-bottom border-warning border-2 fs-5">Género: {{$game->genre->name}}</span>
                </div>

            </div>
            <div class="card-footer col-12 text-center fs-4">
                <span class="badge bg-dark fs-3 w-100">$ {{$game->price}}</span>
                <form action="{{route('cart.add')}}" method="post">
                    @csrf
                    <input type="hidden" name="game" value="{{$game->id}}">
                    <input type="hidden" name="q" value="1">
                    <button class="btn btn-warning w-100">Comprar</button>
                </form>
            </div>
        </div>

    </div>
</x-layout>
