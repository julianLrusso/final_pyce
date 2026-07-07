<x-layout>
    <x-slot:title>Eliminar - {{$entry->title}}</x-slot:title>

    <div class="alert alert-danger text-center mt-3" role="alert">
        <span>¿Estás seguro de querer eliminar esta entrada de blog?</span>
        <form action="{{route('admin.blogs.destroy', $entry->id)}}" method="POST">
            @csrf
            <button class="btn btn-danger w-100 mt-3" type="submit">Eliminar</button>
        </form>
    </div>

    <div class="card mt-4">
        <div class="card-title text-center border-bottom">
            <h1 class="fw-bold">{{$entry->title}}</h1>
            @foreach($entry->tags as $tag)
                <span class="badge bg-primary">{{$tag->name}}</span>
            @endforeach
            <div class="my-2">
                    <span class="badge {{$entry->category->id == 1 ? 'bg-success' : 'bg-danger'}} mt-auto">
                    {{$entry->category->name}}
                    </span>
                <span class="card-subtitle mb-2 text-body-secondary">Por: {{$entry->user->name}}</span>
            </div>
        </div>
        <div class="card-body">
            <div class="px-5">
                <p>{{$entry->text}}</p>
            </div>

        </div>

    </div>
</x-layout>
