@extends('frontend.layouts.app', ['mainMargin' => '100px'])

@section('seo_title', 'Wishlist | Tech Emporium')

@section('content')
<div class="container mb-5">
  <h1 class="text-white mb-4">My Wishlist</h1>
  @if($wishlistItems->isEmpty())
  <div class="text-center py-5 border border-secondary rounded glass-card">
    <i class="bi bi-heart text-muted" style="font-size: 4rem;"></i>
    <h3 class="text-white mt-3">Your Wishlist is Empty</h3>
    <a href="{{ route('shop.index') }}" class="btn btn-electric mt-3">Browse Products</a>
  </div>
  @else
  <div class="row">
    @foreach($wishlistItems as $item)
    <div class="col-md-6 col-lg-3 mb-4">
      <div class="product-card">
        <div class="product-image-wrapper">
          <a href="{{ route('shop.show', $item->product) }}">
            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="img-fluid" style="max-height: 180px;" onerror="this.onerror=null;this.src='{{ asset(placeholder_image_path('product')) }}';">
          </a>
        </div>
        <div class="product-details">
          <a href="{{ route('shop.show', $item->product) }}" class="product-title">{{ $item->product->name }}</a>
          <div class="product-price mt-2"><span class="price-current">{{ format_pkr($item->product->effective_price) }}</span></div>
          <div class="d-flex gap-2 mt-2">
            <form action="{{ route('wishlist.move') }}" method="POST" class="w-100">
              @csrf
              <input type="hidden" name="product_id" value="{{ $item->product->id }}">
              <button type="submit" class="btn btn-electric w-100"><i class="bi bi-cart-plus me-1"></i>Move To Cart</button>
            </form>
            <form action="{{ route('wishlist.remove') }}" method="POST">
              @csrf
              <input type="hidden" name="product_id" value="{{ $item->product->id }}">
              <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @endif
</div>
@endsection
