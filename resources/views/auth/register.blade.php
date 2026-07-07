<x-layout>
    <x-slot:title>Registrarse</x-slot:title>
    <div class="card mt-3">
        <div class="card-title">
            <h1 class="fw-bold text-center">Registrarse</h1>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger" id="error-tags">Algunos campos contienen errores. Por favor revíselos.
                </div>
            @endif
            <form action="{{route('auth.doRegister')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control" type="email" name="email" id="email" value="{{old('email')}}" required>
                    @error('email')
                    <div class="text-danger" id="error-email">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{old('name')}}" required>
                    @error('name')
                    <div class="text-danger" id="error-name">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input class="form-control" type="password" name="password" id="password" required>
                    @error('password')
                    <div class="text-danger" id="error-password">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Repetir contraseña</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation"
                           required>
                    @error('password_confirmation')
                    <div class="text-danger" id="error-password_confirmation">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-warning w-100" type="submit">Registrarse</button>
            </form>
        </div>

    </div>
</x-layout>
