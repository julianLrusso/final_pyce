<x-layout>
    <x-slot:title>Carrito de compras</x-slot:title>
    <div class="mt-3 bg-white rounded p-4">
        <h2 class="text-center">Carrito de compras</h2>
        @if(!empty($cart))
            <div class="row mt-5">
                @foreach($cart as $id => $item)
                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mb-4">
                        <div class="card">
                            <div class="card-img-top d-flex bg-black">
                                <img src=" {{url($item['game']['image'])}}" class="img-fluid m-auto max-h-200"
                                     alt="<?= $item['game']['title'] ?>">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="mt-auto">
                                    <h3 class="card-title"><?= $item['game']['title'] ?></h3>
                                </div>
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex gap-2 align-items-end">
                                        <span>Cantidad: {{$item['q']}}</span>
                                        <a class="btn-q" href="{{route('cart.addQuantity', $id)}}">+</a>
                                        <a class="btn-q" href="{{route('cart.removeQuantity', $id)}}">-</a>
                                    </div>
                                    <span>(<?= $item['q'] ?>) x $<?= number_format($item['game']['price'], 2, ',', '.') ?></span>
                                    <span
                                        class="badge fondo-violeta w-100 fs-6">Total producto: $<?= $item['q'] * $item['game']['price'] ?></span>
                                    <a role="button"
                                       class="badge bg-danger w-100 text-decoration-none"
                                       href="{{route('cart.remove', $id)}}"
                                    >
                                        Quitar del carrito
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div>
                    <span
                        class="badge bg-secondary w-100 fs-3">Total de la compra: ${{number_format($totalAmount, 2, ',', '.')}}</span>
                    <a class="btn btn-success w-100 mt-4" href="{{ route('checkout.process') }}">Pagar con Mercado Pago</a>
                </div>
                <div>
                    <a role="button" class="btn btn-danger w-100 mt-4" href="{{route('cart.clear')}}">Vaciar carrito</a>
                </div>
            </div>
        @else
            <div>
                <p>Todavía no te ha interesado nada, por favor revisa nuestra tienda...</p>
            </div>
        @endif
    </div>
</x-layout>
