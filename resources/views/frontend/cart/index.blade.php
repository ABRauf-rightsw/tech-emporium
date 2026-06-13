@extends('frontend.layouts.app', ['mainMargin' => '100px'])

@section('seo_title', 'Shopping Cart | Tech Emporium')

@section('content')
<div class="container mb-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb small">
      <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-electric">Home</a></li>
      <li class="breadcrumb-item active text-white">Shopping Cart</li>
    </ol>
  </nav>
  <h1 class="text-white mb-4">Shopping Cart</h1>

  @if($cartItems->isEmpty())
  <div class="text-center py-5 border border-secondary rounded glass-card">
    <i class="bi bi-cart-x text-muted" style="font-size: 4rem; opacity: 0.5;"></i>
    <h3 class="text-white mt-3">Your Cart is Empty</h3>
    <a href="{{ route('shop.index') }}" class="btn btn-electric px-4 py-2 rounded-pill mt-3">Shop Products</a>
  </div>
  @else
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card glass-card p-3 border border-secondary">
        <div class="table-responsive">
          <table class="table cart-table align-middle text-white mb-0">
            <thead>
              <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th class="text-center">Remove</th>
              </tr>
            </thead>
            <tbody>
              @foreach($cartItems as $item)
              <tr class="cart-item-row">
                <td data-label="Product">
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset($item->product->image) }}" width="60" height="60" class="cart-item-img" alt="">
                    <a href="{{ route('shop.show', $item->product) }}" class="text-white">{{ $item->product->name }}</a>
                  </div>
                </td>
                <td data-label="Price">{{ format_pkr($item->product->effective_price) }}</td>
                <td data-label="Quantity">
                  <form action="{{ route('cart.update') }}" method="POST" class="d-flex gap-1 cart-qty-form">
                    @csrf
                    @if($item->id)<input type="hidden" name="cart_id" value="{{ $item->id }}">@endif
                    <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="form-control custom-input cart-qty-input">
                    <button type="submit" class="btn btn-sm btn-electric">Update</button>
                  </form>
                </td>
                <td data-label="Subtotal">{{ format_pkr($item->product->effective_price * $item->quantity) }}</td>
                <td class="text-center cart-remove-cell" data-label="Remove">
                  <form action="{{ route('cart.remove') }}" method="POST">
                    @csrf
                    @if($item->id)<input type="hidden" name="cart_id" value="{{ $item->id }}">@endif
                    <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card glass-card p-4 border border-secondary">
        <h4 class="text-white mb-4">Order Summary</h4>
        <div class="d-flex justify-content-between mb-2 text-muted small"><span>Subtotal:</span><span class="text-white">{{ format_pkr($subtotal) }}</span></div>
        <div class="d-flex justify-content-between mb-2 text-muted small"><span>Shipping:</span><span class="text-white">{{ format_pkr($shipping) }}</span></div>
        <div class="d-flex justify-content-between mb-4 border-top border-secondary pt-3 text-white fs-5"><span>Total:</span><strong class="text-orange">{{ format_pkr($total) }}</strong></div>
        <a href="{{ route('checkout.index') }}" class="btn btn-electric w-100 py-2">Proceed to Checkout</a>
      </div>
    </div>
  </div>
  @endif
</div>
@endsection
