<x-layout>
    <x-slot:title>Cuenta - {{$user->name}}</x-slot:title>

    <div class="card mt-4">
        <div class="card-title text-center border-bottom pb-3">
            <h1 class="fw-bold">{{$user->name}}</h1>
            <span class="badge bg-primary">{{$user->email}}</span>
            <span class="badge bg-secondary">{{$user->created_at->format('d-m-Y')}}</span>
        </div>
        <div class="card-body">
            <div class="px-5">
                <h2>Juegos comprados</h2>
                @if(count($user->purchases) > 0)
                    <div>
                        @foreach($user->purchases as $purchase)
                            <div class="card mb-4">
                                <div class="card-header bg-navbar text-white">
                                    <h5 class="mb-0">Compra #{{ $purchase->id }}</h5>
                                    <small>Fecha: {{ $purchase->created_at->format('d/m/Y') }}</small>
                                </div>

                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Unidades</th>
                                            <th>Precio Unitario</th>
                                            <th>Subtotal</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($purchase->games as $game)
                                            <tr>
                                                <td>{{ $game->title }}</td>
                                                <td>{{ $game->pivot->quantity }}</td>
                                                <td>${{ number_format($game->pivot->individual_price/100, 2) }}</td>
                                                <td>${{ number_format($game->pivot->quantity * ($game->pivot->individual_price/100), 2) }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="card-footer text-end">
                                    <strong>Total: ${{ number_format($purchase->total_amount, 2) }}</strong>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Todavía no compró ningún juego.</p>
                @endif
            </div>
            <div class="mt-3 px-5">
                <h2>Acciones</h2>
                <h3>Cambiar contraseña</h3>
                <form action="{{route('user.changePassword', $user->id)}}" method="post">
                    @csrf
                    <div class="mt-3">
                        <label class="form-label" for="old_password">Contraseña actual</label>
                        <input class="form-control" name="old_password" id="old_password" type="password"/>
                        @error('old_password')
                        <div class="text-danger" id="error-title">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label class="form-label" for="password">Nueva contraseña</label>
                        <input class="form-control" name="password" id="password" type="password"/>
                        @error('password')
                        <div class="text-danger" id="error-title">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label class="form-label" for="password_confirmation">Repetir nueva contraseña</label>
                        <input class="form-control" name="password_confirmation" id="password_confirmation" type="password"/>
                        @error('password_confirmation')
                        <div class="text-danger" id="error-title">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-3 text-end">
                        <button class="btn btn-danger">Cambiar contraseña</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</x-layout>
