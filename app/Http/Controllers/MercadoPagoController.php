<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;

class MercadoPagoController extends Controller
{
    /**
     * Procesa la compra e inicia el flujo de Mercado Pago creando una preferencia con el SDK.
     */
    public function process(Request $request)
    {
        try {
            $cart = session()->get('cart', []);

            if (empty($cart)) {
                return redirect()->route('cart.index')->with('alert.message', 'El carrito de compras está vacío.');
            }

            $totalAmount = 0;
            foreach ($cart as $item) {
                $totalAmount += $item['q'] * $item['game']->price;
            }

            $purchase = new Purchase();
            $purchase->user_id = auth()->id();
            $purchase->total_amount = $totalAmount;
            $purchase->status = 0; 
            $purchase->save();

            foreach ($cart as $id => $item) {
                $purchase->games()->attach($id, [
                    'individual_price' => $item['game']->price * 100, // Almacenar en centavos
                    'quantity' => $item['q']
                ]);
            }

            $items = [];
            foreach ($cart as $item) {
                $items[] = [
                    'title' => $item['game']->title,
                    'quantity' => (int) $item['q'],
                    'unit_price' => (float) $item['game']->price,
                ];
            }

            MercadoPagoConfig::setAccessToken(config('mercadopago.access_token'));
          
            $factory = new PreferenceClient();
            $preference = $factory->create([
                'items' => $items,
                'external_reference' => (string) $purchase->id,
            ]);
            return view('mercadopago.pay-form', [
                'cart' => $cart,
                'preference' => $preference,
                'mpPublicKey' => config('mercadopago.public_key'),
            ]);

        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Acción de retorno exitoso.
     */
    public function success(Request $request)
    {
        $purchaseId = $request->query('external_reference');

        if (!$purchaseId) {
            return redirect()->route('cart.index')->with('alert.message', 'Referencia de pago no encontrada.');
        }

        $purchase = Purchase::with('games')->findOrFail($purchaseId);

        if ($purchase->user_id !== auth()->id()) {
            abort(403, 'Acción no autorizada.');
        }

        if ($purchase->status === 0) {
            $purchase->status = 1;
            $purchase->save();

            session()->forget('cart');
        }

        return view('checkout.success', ['purchase' => $purchase]);
    }

    /**
     * Acción de retorno pendiente.
     */
    public function pending(Request $request)
    {
        $purchaseId = $request->query('external_reference');
        $purchase = null;

        if ($purchaseId) {
            $purchase = Purchase::with('games')->find($purchaseId);
        }

        return view('checkout.pending', ['purchase' => $purchase]);
    }

    /**
     * Acción de retorno con fallo.
     */
    public function failure(Request $request)
    {
        $purchaseId = $request->query('external_reference');
        $purchase = null;

        if ($purchaseId) {
            $purchase = Purchase::with('games')->find($purchaseId);
        }

        return view('checkout.failure', ['purchase' => $purchase]);
    }
}
