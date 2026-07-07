<x-layout>
    <x-slot:title>Eliminar - {{$user->name}}</x-slot:title>

    <div class="alert alert-danger text-center mt-3" role="alert">
        <span>¿Estás seguro de querer eliminar este usuario?</span>
        <form action="{{route('admin.users.destroy', $user->id)}}" method="POST">
            @csrf
            <button class="btn btn-danger w-100 mt-3" type="submit">Eliminar</button>
        </form>
    </div>

    <div class="card mt-4">
        <div class="card-title text-center border-bottom pb-3">
            <h1 class="fw-bold">{{$user->name}}</h1>
            <span class="badge bg-primary">{{$user->email}}</span>
            <span class="badge bg-secondary">{{$user->created_at}}</span>
        </div>
        <div class="card-body">
            <div class="px-5">
                <h2>Juegos comprados</h2>
                @if(count($user->games->toArray()) > 0)
                    <ul>
                        @foreach($user->games as $game)
                            <li>{{$game->title}}</li>
                        @endforeach
                    </ul>
                @else
                    <p>Todavía no compró ningún juego.</p>
                @endif
            </div>

        </div>

    </div>
</x-layout>
