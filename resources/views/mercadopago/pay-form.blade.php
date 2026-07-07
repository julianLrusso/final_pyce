<x-layout>
    <x-slot:title>Confirmar Pago</x-slot:title>
    
    <div class="mt-4 bg-white rounded p-4 shadow-sm">
        <h2 class="text-center mb-4">Confirmar y Pagar</h2>
        
        <div class="row">
            <div class="col-md-7 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-navbar text-white">
                        <h4 class="mb-0 fs-5"><i class="fa-solid fa-cart-shopping me-2"></i>Resumen del Carrito</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Juego</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-end">Precio</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0; @endphp
                                    @foreach($cart as $item)
                                        @php $total += $item['q'] * $item['game']->price; @endphp
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($item['game']->image)
                                                        <img src="{{ url($item['game']->image) }}" class="img-thumbnail me-2" style="width: 45px; height: 45px; object-fit: cover;" alt="{{ $item['game']->title }}">
                                                    @endif
                                                    <span class="fw-semibold">{{ $item['game']->title }}</span>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ $item['q'] }}</td>
                                            <td class="text-end">${{ number_format($item['game']->price, 2, ',', '.') }}</td>
                                            <td class="text-end">${{ number_format($item['q'] * $item['game']->price, 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-5 mb-4">
                <div class="card h-100 shadow-sm border-primary">
                    <div class="card-header bg-navbar text-white text-center">
                        <h4 class="mb-0 fs-5"><i class="fa-solid fa-credit-card me-2"></i>Pasarela de Pago</h4>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between p-4">
                        <div class="mb-4 text-center">
                            <span class="text-muted d-block mb-1">Monto Total a Pagar</span>
                            <span class="fs-1 fw-bold text-success">${{ number_format($total, 2, ',', '.') }}</span>
                        </div>
                        
                        <!-- Mercado Pago Wallet Brick Button Container -->
                        <div id="wallet_container"></div>

                        <!-- Botón de respaldo directo a Mercado Pago -->
                        <div id="mp-fallback" class="mt-3" style="display: none;">
                            <a href="{{ $preference->init_point }}" class="btn btn-lg w-100 text-white" style="background-color: #009ee3;">
                                <i class="fa-solid fa-credit-card me-2"></i>Pagar con Mercado Pago
                            </a>
                        </div>
                        
                        <div class="mt-4 text-center">
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-danger w-100">
                                <i class="fa-solid fa-arrow-left me-2"></i>Cancelar y volver al carrito
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mercado Pago SDK JS -->
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mpPublicKey = "{{ $mpPublicKey }}";
        const preferenceId = "{{ $preference->id }}";

       const mp = new MercadoPago(mpPublicKey);
       mp.bricks().create('wallet', 'wallet_container', {
            initialization: {
                preferenceId: preferenceId,
            },
        });
    </script>
</x-layout>
