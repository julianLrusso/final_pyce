<x-layout>
    <x-slot:title>Error en el Pago</x-slot:title>

    <div class="mt-4 bg-white rounded p-5 shadow-sm text-center">
        <div class="mb-4">
            <span class="d-inline-flex align-items-center justify-content-center bg-danger text-white rounded-circle fs-1 shadow-sm" style="width: 80px; height: 80px;">
                <i class="fa-solid fa-xmark"></i>
            </span>
        </div>

        <h1 class="fw-bold text-danger mb-2">No se pudo procesar el pago</h1>
        <p class="text-muted fs-5 mb-5 font-bold">La transacción fue rechazada, cancelada o no pudo completarse. Tu carrito de compras sigue guardado para que puedas volver a intentarlo.</p>

        @if($purchase)
            <div class="card text-start mx-auto mb-5" style="max-width: 600px;">
                <div class="card-header bg-navbar text-white">
                    <h5 class="mb-0 fw-bold">Detalle de la Compra Fallida #{{ $purchase->id }}</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Estado:</span>
                            <span class="badge bg-danger fw-semibold text-white">Rechazado / Cancelado</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Total intentado:</span>
                            <strong class="text-danger">${{ number_format($purchase->total_amount, 2, ',', '.') }}</strong>
                        </li>
                    </ul>
                </div>
            </div>
        @endif

        <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
            <a href="{{ route('cart.index') }}" class="btn btn-danger btn-lg">
                <i class="fa-solid fa-cart-shopping me-2"></i>Volver al Carrito
            </a>
            <a href="{{ route('games.index') }}" class="btn btn-outline-secondary btn-lg">
                <i class="fa-solid fa-store me-2"></i>Ver Tienda
            </a>
        </div>
    </div>
</x-layout>
