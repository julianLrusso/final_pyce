@php use Illuminate\Support\Facades\Storage; @endphp
<x-layout>
    <x-slot:title>Blog - {{$entry->title}}</x-slot:title>

    <div class="card mt-4">
        <div class="card-title text-center border-bottom">
            <h1 class="fw-bold">{{$entry->title}}</h1>
            @foreach($entry->tags as $tag)
                <span class="badge bg-primary">{{$tag->name}}</span>
            @endforeach
            @if($entry->image && Storage::exists($entry->image))
                <div class="my-2 d-flex justify-content-center w-100">
                    <img class="img-fluid max-w-400 max-h-400" src="{{Storage::url($entry->image)}}" alt="{{$entry->alt_image}}">
                </div>
            @endif

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
