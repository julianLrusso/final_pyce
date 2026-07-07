<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {

        $gameId = $request->input('game');
        $game = Game::with('genre')->findOrFail($gameId);

        $cart = $this->getCart();

        // Verificar si el producto ya está en el carrito
        if (isset($cart[$game['id']])) {
            $cart[$game['id']]['q'] = $cart[$game['id']]['q'] + 1;
        } else {
            $cart[$game['id']]['game'] = $game;
            $cart[$game['id']]['q'] = 1;
        }

        $this->setCart($cart);

        return redirect()->route('games.index')->with('feedback.message', '<b>' . e($game['title']) . '</b> se agregó al carrito con éxito.');
    }

    public function getCart(): array
    {
        return session()->get('cart', []);
    }

    public function setCart(array $cart)
    {
        session()->put('cart', $cart);
    }

    public function removeFromCart(int $id)
    {
        $cart = $this->getCart();
        $gameTitle = '';
        if (isset($cart[$id])) {
            $gameTitle = $cart[$id]['game']['title'];
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('feedback.message', '<b>' . e($gameTitle) . '</b> se eliminó del carrito con éxito.');
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->route('cart.index');
    }

    public function addQuantity(int $id)
    {
        $cart = $this->getCart();
        if (isset($cart[$id])) {
            $cart[$id]['q'] = $cart[$id]['q'] + 1;
            $this->setCart($cart);
        }

        return redirect()->route('cart.index');
    }

    public function removeQuantity(int $id)
    {
        $cart = $this->getCart();
        if (isset($cart[$id])) {

            if ($cart[$id]['q'] <= 1) {
                unset($cart[$id]);
            } else {
                $cart[$id]['q'] = $cart[$id]['q'] - 1;
            }

            $this->setCart($cart);
        }

        return redirect()->route('cart.index');
    }

    public function index()
    {
        $cart = $this->getCart();
        $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['q'] * $item['game']->price;
        }
        return view('checkout.cart', ['cart' => $cart, 'totalAmount' => $totalAmount]);
    }
}
