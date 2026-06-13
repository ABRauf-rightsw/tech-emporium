<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __construct(private CartService $cart)
    {
    }

    public function index()
    {
        $totals = $this->cart->totals();

        if ($totals['items']->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('frontend.checkout.index', [
            'cartItems' => $totals['items'],
            'subtotal' => $totals['subtotal'],
            'shipping' => $totals['shipping'],
            'total' => $totals['total'],
        ]);
    }

    public function placeOrder(Request $request)
    {
        $data = $request->validate([
            'billing-name' => 'required|string|max:255',
            'billing-email' => 'required|email',
            'billing-phone' => 'required|string|max:20',
            'billing-city' => 'required|string|max:100',
            'billing-address' => 'required|string',
            'paymentMethod' => 'required|in:cod,easypaisa,jazzcash,bank',
        ]);

        $totals = $this->cart->totals();
        $cartItems = $totals['items'];

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return back()->with('error', "{$item->product->name} does not have enough stock.");
            }
        }

        $orderNumber = DB::transaction(function () use ($cartItems, $data, $totals) {
            do {
                $orderNumber = 'TE-' . random_int(100000, 999999);
            } while (Order::where('order_number', $orderNumber)->exists());

            $order = Order::create([
                'user_id' => auth()->id(),
                'guest_name' => auth()->check() ? null : $data['billing-name'],
                'guest_email' => auth()->check() ? null : $data['billing-email'],
                'order_number' => $orderNumber,
                'total_amount' => $totals['total'],
                'payment_method' => $data['paymentMethod'],
                'payment_status' => 'pending',
                'order_status' => 'processing',
                'address' => $data['billing-address'],
                'city' => $data['billing-city'],
                'phone' => $data['billing-phone'],
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'price' => $item->product->effective_price,
                    'quantity' => $item->quantity,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            $this->cart->clear();

            return $orderNumber;
        });

        return redirect()
            ->route('checkout.success', ['order' => $orderNumber])
            ->with('order_placed', $orderNumber);
    }

    public function success(string $order)
    {
        $orderModel = Order::where('order_number', $order)
            ->with('items.product')
            ->firstOrFail();

        $justPlaced = session('order_placed') === $order;

        if (auth()->check()) {
            if ($orderModel->user_id && $orderModel->user_id !== auth()->id()) {
                abort(403);
            }
        } elseif (! $justPlaced) {
            abort(404);
        }

        return view('frontend.checkout.success', [
            'orderModel' => $orderModel,
            'showSuccessModal' => $justPlaced,
        ]);
    }
}
