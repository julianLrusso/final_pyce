<x-layout>
    <x-slot:title>Blog</x-slot:title>
    <h1 class="text-center my-3 fw-bold">Blog de la carreta ambulante</h1>
    <div class="row mt-5">
        @foreach($entries as $entry)
            <div class="col-xl-3 col-md-6 d-flex align-items-stretch mb-4">
                <div class="card">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex flex-column min-h-150">
                            <h2 class="card-title text-center w-100">{{$entry->title}}</h2>
                            <div class="mt-auto">
                                <span class="card-subtitle mb-2 text-body-secondary">Por: {{$entry->user->name}}</span>
                                <span
                                    class="badge {{$entry->category->id == 1 ? 'bg-success' : 'bg-danger'}} w-100 mt-auto mb-2">{{$entry->category->name}}</span>
                            </div>
                        </div>
                        <p class="card-text mb-4">{{$entry->text}}</p>
                        <div class="border-top mt-auto">
                            <div class="border-bottom py-2">
                                @foreach($entry->tags as $tag)
                                    <span class="badge bg-primary">{{$tag->name}}</span>
                                @endforeach
                            </div>
                            <a href="{{route('blogs.show',[$entry->id])}}"
                               class="btn btn-warning mt-3 w-100 align-self-start">Ver más</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
