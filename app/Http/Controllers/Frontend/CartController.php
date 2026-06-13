<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private CartService $cart)
    {
    }

    public function index()
    {
        $totals = $this->cart->totals();

        return view('frontend.cart.index', [
            'cartItems' => $totals['items'],
            'subtotal' => $totals['subtotal'],
            'shipping' => $totals['shipping'],
            'total' => $totals['total'],
        ]);
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        try {
            $this->cart->add((int) $data['product_id'], $data['quantity'] ?? 1);
        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Product added to cart.');
    }

    public function buyNow(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        try {
            $this->cart->buyNow((int) $data['product_id'], $data['quantity'] ?? 1);
        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('checkout.index');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'cart_id' => 'nullable|exists:carts,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $this->cart->update($data['cart_id'] ?? null, (int) $data['product_id'], (int) $data['quantity']);
        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Cart updated.');
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'cart_id' => 'nullable|exists:carts,id',
            'product_id' => 'required|exists:products,id',
        ]);

        $this->cart->remove($data['cart_id'] ?? null, (int) $data['product_id']);

        return back()->with('success', 'Item removed from cart.');
    }
}
