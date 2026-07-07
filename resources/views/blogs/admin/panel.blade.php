<x-layout>
    <x-slot:title>Administrador - Blogs</x-slot:title>
    <h1 class="text-center my-3 fw-bold">Panel administrador de blogs</h1>
    <div class="text-center mb-3">
        <a href="{{route('admin.blogs.create')}}" class="btn btn-success w-75">Crear <span class="fw-bolder">+</span></a>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descripción</th>
            <th>Fecha de Creación</th>
            <th>Categoría</th>
            <th>Tags</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($entries as $entry)
            <tr>
                <td>{{ $entry->id }}</td>
                <td>{{ $entry->title }}</td>
                <td>{{ $entry->shortDescription(10) }}</td>
                <td>{{ $entry->created_at }}</td>
                <td>{{ $entry->category->name }}</td>
                <td>
                    @foreach($entry->tags as $tag)
                        <span class="badge bg-primary">{{ $tag->name }}</span>
                    @endforeach
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('blogs.show', ['id' => $entry->id]) }}" class="btn btn-warning">Ver</a>

                        <a href="{{ route('admin.blogs.edit', ['id' => $entry->id]) }}" class="btn btn-secondary">Editar</a>

                        <a href="{{ route('admin.blogs.delete', ['id' => $entry->id]) }}" class="btn btn-danger">Eliminar</a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-layout>
