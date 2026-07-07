<x-layout>
    <x-slot:title>Compra Exitosa</x-slot:title>

    <div class="mt-4 bg-white rounded p-5 shadow-sm text-center">
        <div class="mb-4">
            <span class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-circle fs-1 shadow-sm" style="width: 80px; height: 80px;">
                <i class="fa-solid fa-check"></i>
            </span>
        </div>

        <h1 class="fw-bold text-success mb-2">¡Gracias por tu compra!</h1>
        <p class="text-muted fs-5 mb-5">Tu pago ha sido procesado de manera exitosa a través de Mercado Pago.</p>

        <div class="card text-start mx-auto mb-5" style="max-width: 800px;">
            <div class="card-header bg-navbar text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Detalle de la Compra #{{ $purchase->id }}</h5>
                <span class="badge bg-success">Aprobado</span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <span class="text-muted d-block small">Fecha y Hora</span>
                        <strong>{{ $purchase->created_at->format('d/m/Y H:i') }} hs</strong>
                    </div>
                    <div class="col-sm-6 text-sm-end">
                        <span class="text-muted d-block small">Usuario</span>
                        <strong>{{ auth()->user()->name }} ({{ auth()->user()->email }})</strong>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Videojuego</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-end">Precio Unitario</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchase->games as $game)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($game->image)
                                                <img src="{{ url($game->image) }}" class="img-thumbnail me-3" style="width: 50px; height: 50px; object-fit: cover;" alt="{{ $game->title }}">
                                            @endif
                                            <span class="fw-semibold">{{ $game->title }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $game->pivot->quantity }}</td>
                                    <td class="text-end">${{ number_format($game->pivot->individual_price / 100, 2, ',', '.') }}</td>
                                    <td class="text-end fw-semibold">${{ number_format(($game->pivot->quantity * $game->pivot->individual_price) / 100, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end fs-5">Total Pagado:</th>
                                <th class="text-end text-success fs-5 fw-bold">${{ number_format($purchase->total_amount, 2, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
            <a href="{{ route('games.index') }}" class="btn btn-outline-primary btn-lg">
                <i class="fa-solid fa-store me-2"></i>Seguir Comprando
            </a>
            <a href="{{ route('user.index', auth()->id()) }}" class="btn btn-primary btn-lg fondo-violeta border-0">
                <i class="fa-solid fa-gamepad me-2"></i>Ir a mis Juegos
            </a>
        </div>
    </div>
</x-layout>
