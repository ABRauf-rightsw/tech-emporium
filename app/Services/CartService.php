<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Collection;

class CartService
{
    private const SESSION_KEY = 'guest_cart';

    public function getItems(): Collection
    {
        if (auth()->check()) {
            return Cart::where('user_id', auth()->id())
                ->with('product')
                ->get()
                ->map(fn (Cart $cart) => (object) [
                    'id' => $cart->id,
                    'product_id' => $cart->product_id,
                    'product' => $cart->product,
                    'quantity' => $cart->quantity,
                    'guest' => false,
                ]);
        }

        $guestCart = session(self::SESSION_KEY, []);
        if (empty($guestCart)) {
            return collect();
        }

        $products = Product::whereIn('id', array_keys($guestCart))->get()->keyBy('id');

        return collect($guestCart)
            ->map(function ($quantity, $productId) use ($products) {
                if (! $products->has($productId)) {
                    return null;
                }

                return (object) [
                    'id' => null,
                    'product_id' => (int) $productId,
                    'product' => $products[$productId],
                    'quantity' => (int) $quantity,
                    'guest' => true,
                ];
            })
            ->filter()
            ->values();
    }

    public function getCount(): int
    {
        return (int) $this->getItems()->sum('quantity');
    }

    public function add(int $productId, int $quantity = 1): void
    {
        $product = Product::findOrFail($productId);

        if (auth()->check()) {
            $cart = Cart::firstOrNew([
                'user_id' => auth()->id(),
                'product_id' => $productId,
            ]);
            $newQty = ($cart->exists ? $cart->quantity : 0) + $quantity;

            if ($newQty > $product->stock) {
                throw new \RuntimeException('Not enough stock available.');
            }

            $cart->quantity = $newQty;
            $cart->save();

            return;
        }

        $guestCart = session(self::SESSION_KEY, []);
        $newQty = ($guestCart[$productId] ?? 0) + $quantity;

        if ($newQty > $product->stock) {
            throw new \RuntimeException('Not enough stock available.');
        }

        $guestCart[$productId] = $newQty;
        session([self::SESSION_KEY => $guestCart]);
    }

    public function update(?int $cartId, int $productId, int $quantity): void
    {
        if (auth()->check()) {
            $cart = Cart::where('user_id', auth()->id())->findOrFail($cartId);

            if ($quantity > $cart->product->stock) {
                throw new \RuntimeException('Not enough stock available.');
            }

            $cart->update(['quantity' => $quantity]);

            return;
        }

        $product = Product::findOrFail($productId);

        if ($quantity > $product->stock) {
            throw new \RuntimeException('Not enough stock available.');
        }

        $guestCart = session(self::SESSION_KEY, []);
        $guestCart[$productId] = $quantity;
        session([self::SESSION_KEY => $guestCart]);
    }

    public function remove(?int $cartId, int $productId): void
    {
        if (auth()->check()) {
            Cart::where('user_id', auth()->id())->where('id', $cartId)->delete();

            return;
        }

        $guestCart = session(self::SESSION_KEY, []);
        unset($guestCart[$productId]);
        session([self::SESSION_KEY => $guestCart]);
    }

    public function clear(): void
    {
        if (auth()->check()) {
            Cart::where('user_id', auth()->id())->delete();
        } else {
            session()->forget(self::SESSION_KEY);
        }
    }

    public function buyNow(int $productId, int $quantity = 1): void
    {
        $product = Product::findOrFail($productId);

        if ($quantity > $product->stock) {
            throw new \RuntimeException('Not enough stock available.');
        }

        $this->clear();

        if (auth()->check()) {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);

            return;
        }

        session([self::SESSION_KEY => [$productId => $quantity]]);
    }

    public function mergeGuestIntoUser(): void
    {
        if (! auth()->check()) {
            return;
        }

        $guestCart = session(self::SESSION_KEY, []);

        foreach ($guestCart as $productId => $quantity) {
            try {
                $this->add((int) $productId, (int) $quantity);
            } catch (\RuntimeException) {
                // Skip items that exceed stock when merging
            }
        }

        session()->forget(self::SESSION_KEY);
    }

    public function totals(): array
    {
        $items = $this->getItems();
        $subtotal = $items->sum(fn ($item) => $item->product->effective_price * $item->quantity);
        $shipping = shipping_cost($subtotal);

        return [
            'items' => $items,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $subtotal + $shipping,
        ];
    }
}
