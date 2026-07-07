<x-layout>
    <x-slot:title>Iniciar sesión</x-slot:title>
    <div class="card mt-3">
        <div class="card-title">
            <h1 class="fw-bold text-center">Inciar sesión</h1>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger" id="error-tags">Error en las credenciales.</div>
            @endif
            <form action="{{route('auth.doLogin')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" type="email" name="email" id="email" value="{{old('email')}}">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>
                <button class="btn btn-warning w-100" type="submit">Iniciar sesión</button>
            </form>
        </div>

    </div>
</x-layout>
