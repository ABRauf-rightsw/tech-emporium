@php
  $inWishlist = auth()->check() && auth()->user()->wishlists()->where('product_id', $product->id)->exists();
  $discount = ($product->sale_price && $product->sale_price < $product->price)
    ? round((1 - $product->sale_price / $product->price) * 100)
    : 0;
@endphp
<div class="col-6 col-md-6 col-lg-4 col-xl-3">
  <article class="product-card">
    <div class="product-image-wrapper">
      @if($product->sale_price && $discount > 0)
      <span class="product-badge product-badge--sale">-{{ $discount }}%</span>
      @elseif($product->is_best_seller)
      <span class="product-badge product-badge--bestseller">Best Seller</span>
      @endif
      @auth
      <div class="wishlist-btn-pos">
        <form action="{{ $inWishlist ? route('wishlist.remove') : route('wishlist.add') }}" method="POST">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          <button type="submit" class="btn-wishlist {{ $inWishlist ? 'active' : '' }}" aria-label="Wishlist"><i class="bi bi-heart-fill"></i></button>
        </form>
      </div>
      @endauth
      <a href="{{ route('shop.show', $product) }}" class="product-image-link hover-zoom">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image" loading="lazy" onerror="this.onerror=null;this.src='{{ asset(placeholder_image_path('product')) }}';">
      </a>
      <a href="{{ route('shop.show', $product) }}" class="product-quick-view">
        <i class="bi bi-eye me-1"></i> Quick View
      </a>
    </div>
    <div class="product-details">
      <span class="product-brand">{{ $product->brand->name }}</span>
      <a href="{{ route('shop.show', $product) }}" class="product-title">{{ $product->name }}</a>
      <div class="product-price">
        <span class="price-current">{{ format_pkr($product->effective_price) }}</span>
        @if($product->sale_price)
        <span class="price-old">{{ format_pkr($product->price) }}</span>
        @endif
      </div>
      <form action="{{ route('cart.add') }}" method="POST" class="product-cart-form">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <button type="submit" class="btn product-add-btn w-100">
          <i class="bi bi-cart-plus"></i>
          <span>Add to Cart</span>
        </button>
      </form>
    </div>
  </article>
</div>
