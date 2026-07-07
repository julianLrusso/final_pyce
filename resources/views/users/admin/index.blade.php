<x-layout>
    <x-slot:title>Administrador - Usuarios</x-slot:title>
    <h1 class="text-center my-3 fw-bold">Panel administrador de usuarios</h1>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Fecha de Creación</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.users.show', ['id' => $user->id]) }}" class="btn btn-warning">Ver</a>

                        @if(!$user->admin)
                            <a href="{{ route('admin.users.delete', ['id' => $user->id]) }}" class="btn btn-danger">Eliminar</a>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-layout>
