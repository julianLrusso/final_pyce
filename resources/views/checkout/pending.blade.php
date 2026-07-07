<x-layout>
    <x-slot:title>Pago Pendiente</x-slot:title>

    <div class="mt-4 bg-white rounded p-5 shadow-sm text-center">
        <div class="mb-4">
            <span class="d-inline-flex align-items-center justify-content-center bg-warning text-white rounded-circle fs-1 shadow-sm" style="width: 80px; height: 80px;">
                <i class="fa-solid fa-clock"></i>
            </span>
        </div>

        <h1 class="fw-bold text-warning mb-2">Pago en Proceso</h1>
        <p class="text-muted fs-5 mb-5">Mercado Pago está procesando tu transacción. Te notificaremos una vez que sea aprobada.</p>

        @if($purchase)
            <div class="card text-start mx-auto mb-5" style="max-width: 600px;">
                <div class="card-header bg-navbar text-white">
                    <h5 class="mb-0 fw-bold">Resumen de la Compra #{{ $purchase->id }}</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Estado del Pago:</span>
                            <span class="badge bg-warning text-dark fw-semibold">Pendiente / En Proceso</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Fecha:</span>
                            <strong>{{ $purchase->created_at->format('d/m/Y H:i') }} hs</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Total a Pagar:</span>
                            <strong class="text-warning">${{ number_format($purchase->total_amount, 2, ',', '.') }}</strong>
                        </li>
                    </ul>
                </div>
            </div>
        @endif

        <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
            <a href="{{ route('games.index') }}" class="btn btn-outline-primary btn-lg">
                <i class="fa-solid fa-store me-2"></i>Ir a la Tienda
            </a>
            <a href="{{ route('user.index', auth()->id()) }}" class="btn btn-primary btn-lg fondo-violeta border-0">
                <i class="fa-solid fa-user me-2"></i>Ir a mi Cuenta
            </a>
        </div>
    </div>
</x-layout>
