@extends('frontend.layouts.app', ['mainMargin' => '100px'])

@section('seo_title', $product->name . ' | Buy Online at Tech Emporium')
@section('meta_description', Str::limit(strip_tags($product->description ?: $product->name . ' — available at Tech Emporium Pakistan with official warranty and fast delivery.'), 155))
@section('meta_keywords', $product->name . ', ' . $product->brand->name . ', ' . $product->category->name . ', buy online Pakistan, Tech Emporium')
@section('og_type', 'product')
@section('og_image', $product->image)
@section('canonical', route('shop.show', $product))

@push('json_ld')
  @include('frontend.partials.schema.product', ['product' => $product])
  @include('frontend.partials.schema.breadcrumb', ['items' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Shop', 'url' => route('shop.index')],
    ['name' => $product->name, 'url' => route('shop.show', $product)],
  ]])
@endpush

@section('body-class')
class="product-detail-page"
@endsection

@php
  $discount = ($product->sale_price && $product->sale_price < $product->price)
    ? round((1 - $product->sale_price / $product->price) * 100)
    : 0;
@endphp

@section('content')
<div class="product-detail-header">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb product-breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Products</a></li>
        <li class="breadcrumb-item active">{{ Str::limit($product->name, 40) }}</li>
      </ol>
    </nav>
  </div>
</div>

<div class="container product-detail-content pb-5">
  <div class="row g-4 g-lg-5">
    <div class="col-lg-6">
      <div class="product-gallery-card">
        @if($discount > 0)
        <span class="product-gallery-badge">-{{ $discount }}% OFF</span>
        @elseif($product->is_best_seller)
        <span class="product-gallery-badge product-gallery-badge--bestseller">Best Seller</span>
        @endif
        <div class="product-gallery-image-wrap">
          <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-gallery-image">
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="product-info-card">
        <div class="product-info-meta">
          <span class="product-brand-chip">{{ $product->brand->name }}</span>
          <span class="product-category-chip">{{ $product->category->name }}</span>
        </div>

        <h1 class="product-detail-title">{{ $product->name }}</h1>

        <div class="product-detail-price-row">
          <span class="product-detail-price">{{ format_pkr($product->effective_price) }}</span>
          @if($product->sale_price)
          <span class="product-detail-price-old">{{ format_pkr($product->price) }}</span>
          @if($discount > 0)
          <span class="product-detail-save">Save {{ format_pkr($product->price - $product->sale_price) }}</span>
          @endif
          @endif
        </div>

        @if($product->description)
        <div class="product-detail-desc product-rich-content">{!! $product->description !!}</div>
        @endif

        <div class="product-detail-highlights">
          <div class="product-highlight-item">
            <i class="bi bi-box-seam"></i>
            <span><strong>{{ $product->stock }}</strong> in stock</span>
          </div>
          <div class="product-highlight-item">
            <i class="bi bi-truck"></i>
            <span>Fast delivery across Pakistan</span>
          </div>
          <div class="product-highlight-item">
            <i class="bi bi-shield-check"></i>
            <span>Official warranty included</span>
          </div>
        </div>

        <div class="product-purchase-panel">
          <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <label for="product-qty" class="product-qty-label">Quantity</label>
            <div class="product-purchase-row">
              <input type="number" id="product-qty" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control product-qty-input">
              <div class="product-action-form">
                <button type="submit" class="btn product-btn-cart">
                  <i class="bi bi-cart-plus"></i>
                  <span>Add to Cart</span>
                </button>
              </div>
              <div class="product-action-form">
                <button type="submit" class="btn product-btn-buy" formaction="{{ route('cart.buy-now') }}">
                  <i class="bi bi-lightning-fill"></i>
                  <span>Buy Now</span>
                </button>
              </div>
            </div>
          </form>

          @auth
          @php $inWishlist = auth()->user()->wishlists()->where('product_id', $product->id)->exists(); @endphp
          <form action="{{ $inWishlist ? route('wishlist.remove') : route('wishlist.add') }}" method="POST" class="mt-3">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="btn product-btn-wishlist w-100">
              <i class="bi bi-heart{{ $inWishlist ? '-fill' : '' }}"></i>
              {{ $inWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' }}
            </button>
          </form>
          @endauth
        </div>
      </div>
    </div>
  </div>

  @if($related->count())
  <section class="product-related-section">
    <div class="product-related-header">
      <h2>Related Products</h2>
      <div class="product-related-line"></div>
    </div>
    <div class="row g-4">
      @foreach($related as $relatedProduct)
        @include('frontend.partials.product-card', ['product' => $relatedProduct])
      @endforeach
    </div>
  </section>
  @endif
</div>

@endsection
