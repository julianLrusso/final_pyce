@php use Illuminate\Support\Facades\Storage; @endphp
<x-layout>
    <x-slot:title>Administrador - Editar {{$entry->title}}</x-slot:title>
    <h1 class="text-center my-3 fw-bold">Editar {{$entry->title}}</h1>

    @if($errors->any())
        <div class="alert alert-danger">Hay errores en los datos ingresados. Por favor, revisá los mensajes para
            corregir los problemas.
        </div>
    @endif

    <div class="card">
        <form action="{{route('admin.blogs.update', $entry->id)}}" class="card-body" method="POST"
              enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="title">Título</label>
                <input id="title" name="title" type="text" class="form-control"
                       value="{{old('title') ?? $entry->title}}">
                @error('title')
                <div class="text-danger" id="error-title">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="text">Texto</label>
                <textarea class="form-control" name="text" id="text" cols="30"
                          rows="10">{{old('text') ?? $entry->text}}</textarea>
                @error('text')
                <div class="text-danger" id="error-text">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="category_id">Categoría</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option value="">Seleccionar una categoría...</option>
                    @foreach($categories as $category)
                        <option
                            value="{{$category->id}}"
                            @selected(old('category_id') ? old('category_id') == $category->id : $entry->category_id == $category->id)
                        >
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="text-danger" id="error-category_id">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Imagen de portada</label>
                @if($entry->image && Storage::exists($entry->image))
                    <div class="mb-2 max-w-400">
                        <img class="img-fluid max-h-400" src="{{Storage::url($entry->image)}}" alt="{{$entry->alt_image}}">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <div class="mb-3">
                <label for="alt_image" class="form-label">Descripción de la Portada</label>
                <input
                    type="text"
                    name="alt_image"
                    id="alt_image"
                    class="form-control"
                    value="{{ old('alt_image', $entry->alt_image) }}"
                >
            </div>
            <div class="mb-3">
                <span class="form-label">Tags</span>
                <div class="row px-3 mt-2">
                    @foreach($tags as $tag)
                        <div class="form-check col-md-6">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                value="{{$tag->id}}"
                                id="tag-{{$tag->id}}"
                                name="tags[]"
                                @checked(old('tags') ? in_array($tag->id, old('tags')) : $entry->tags->contains($tag->id))
                            >
                            <label class="form-check-label" for="tag-{{$tag->id}}">
                                {{$tag->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('tags')
                <div class="text-danger" id="error-tags">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <button class="btn btn-warning w-100" type="submit">Editar</button>
            </div>
        </form>
    </div>
</x-layout>
