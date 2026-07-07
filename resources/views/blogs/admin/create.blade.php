<x-layout>
    <x-slot:title>Administrador - Crear entrada de blog</x-slot:title>
    <h1 class="text-center my-3 fw-bold">Publicar entrada de blog</h1>

    @if($errors->any())
        <div class="alert alert-danger">Hay errores en los datos ingresados. Por favor, revisá los mensajes para
            corregir los problemas.
        </div>
    @endif

    <div class="card">
        <form action="{{route('admin.blogs.store')}}" class="card-body" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="title">Título</label>
                <input id="title" name="title" type="text" class="form-control" value="{{old('title')}}">
                @error('title')
                <div class="text-danger" id="error-title">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="text">Texto</label>
                <textarea class="form-control" name="text" id="text" cols="30" rows="10">{{old('text')}}</textarea>
                @error('text')
                <div class="text-danger" id="error-text">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="category_id">Categoría</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option value="">Seleccionar una categoría...</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"
                                @selected(old('category_id') == $category->id)
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
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <div class="mb-3">
                <label for="alt_image" class="form-label">Descripción de la Portada</label>
                <input
                    type="text"
                    name="alt_image"
                    id="alt_image"
                    class="form-control"
                    value="{{ old('alt_image') }}"
                >
            </div>
            <div class="mb-3">
                <span class="form-label">Tags</span>
                <div class="row px-3 mt-2">
                    @foreach($tags as $tag)
                        <div class="form-check col-md-6">
                            <input class="form-check-input" type="checkbox" value="{{$tag->id}}" id="tag-{{$tag->id}}"
                                   name="tags[]" @checked(old('tags') && in_array($tag->id, old('tags')))>
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
                <button class="btn btn-warning w-100" type="submit">Crear</button>
            </div>
        </form>
    </div>
</x-layout>
