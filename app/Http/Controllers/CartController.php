<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\UpdateCartItemRequest;


class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(fn ($row) => $row['product']->price * $row['qty']);

        return view('cart.index', compact('cart','subtotal'));
    }


    public function add(AddToCartRequest $request, Product $product)
    {
        $qty  = $request->validated()['qty'];
        $cart = session('cart', []);

        if (!isset($cart[$product->id])) {
            $cart[$product->id] = ['product' => $product, 'qty' => 0];
        }
        $cart[$product->id]['qty'] = min($cart[$product->id]['qty'] + $qty, 999);

        session(['cart' => $cart]);

        return back()->with('success', 'Item added to cart.');
    }

    public function update(UpdateCartItemRequest $request, Product $product)
    {
        $qty  = $request->validated()['qty'];
        $cart = session('cart', []);

        if (isset($cart[$product->id])) {
            if ($qty <= 0) unset($cart[$product->id]);
            else $cart[$product->id]['qty'] = min($qty, 999);
            session(['cart' => $cart]);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }

    public function remove(Product $product)
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Item removed.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Cart cleared.');
    }
}
