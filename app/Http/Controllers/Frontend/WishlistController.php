<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', auth()->id())
            ->with('product')
            ->get();

        return view('frontend.wishlist.index', compact('wishlistItems'));
    }

    public function add(Request $request)
    {
        $data = $request->validate(['product_id' => 'required|exists:products,id']);

        Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $data['product_id'],
        ]);

        return back()->with('success', 'Added to wishlist.');
    }

    public function remove(Request $request)
    {
        $data = $request->validate(['product_id' => 'required|exists:products,id']);

        Wishlist::where('user_id', auth()->id())
            ->where('product_id', $data['product_id'])
            ->delete();

        return back()->with('success', 'Removed from wishlist.');
    }

    public function moveToCart(Request $request)
    {
        $data = $request->validate(['product_id' => 'required|exists:products,id']);
        $product = Product::findOrFail($data['product_id']);

        Cart::updateOrCreate(
            ['user_id' => auth()->id(), 'product_id' => $product->id],
            ['quantity' => 1]
        );

        Wishlist::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->delete();

        return back()->with('success', 'Moved to cart.');
    }
}
