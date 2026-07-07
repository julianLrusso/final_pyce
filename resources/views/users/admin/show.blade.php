<x-layout>
    <x-slot:title>Usuario - {{$user->name}}</x-slot:title>

    <div class="card mt-4">
        <div class="card-title text-center border-bottom pb-3">
            <h1 class="fw-bold">{{$user->name}}</h1>
            <span class="badge bg-primary">{{$user->email}}</span>
            <span class="badge bg-secondary">{{$user->created_at->format('d-m-Y')}}</span>
        </div>
        <div class="card-body">
            <div class="px-5">
                <h2>Juegos comprados</h2>
                @if(count($purchases) > 0)
                    <div>
                        @foreach($purchases as $purchase)
                            <div class="card mb-4">
                                <div class="card-header {{$purchase->status === 0 ? 'bg-danger' : 'bg-navbar'}} text-white">
                                    <h5 class="mb-0">Compra {{$purchase->status === 0 ? 'abandonada' : ''}} #{{ $purchase->id }}</h5>
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

        </div>

    </div>
</x-layout>
