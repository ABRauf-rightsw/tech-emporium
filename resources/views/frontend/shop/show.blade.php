@extends('frontend.layouts.app', ['mainMargin' => '100px'])

@section('seo_title', $product->name . ' | Buy Online at Tech Emporium')
@section('meta_description', Str::limit(strip_tags($product->description ?: $product->name . ' — available at Tech Emporium Pakistan with official warranty and fast delivery.'), 155))
@section('meta_keywords', $product->name . ', ' . $product->brand->name . ', ' . $product->category->name . ', buy online Pakistan, Tech Emporium')
@section('og_type', 'product')
@section('og_image', image_path_or_placeholder($product->image, 'product'))
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
  $galleryItems = $product->gallery_items;
  $descriptionParts = split_product_description($product->description);
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
          <img
            src="{{ $galleryItems[0]['url'] }}"
            alt="{{ $galleryItems[0]['alt'] }}"
            id="product-main-image"
            class="product-gallery-image"
            data-placeholder="{{ asset(placeholder_image_path('product')) }}"
            onerror="this.onerror=null;this.src=this.dataset.placeholder;"
          >
          <button
            type="button"
            class="product-gallery-view-btn"
            data-bs-toggle="modal"
            data-bs-target="#productImageModal"
            aria-label="View full size image"
          >
            <i class="bi bi-arrows-fullscreen"></i>
            <span>View</span>
          </button>
        </div>

        @if(count($galleryItems) > 1)
        <div class="product-gallery-thumbs" role="list" aria-label="Product image gallery">
          @foreach($galleryItems as $index => $item)
          <button
            type="button"
            class="product-gallery-thumb {{ $index === 0 ? 'is-active' : '' }}"
            data-image="{{ $item['url'] }}"
            data-placeholder="{{ asset(placeholder_image_path('product')) }}"
            aria-label="Show image {{ $index + 1 }}"
            aria-pressed="{{ $index === 0 ? 'true' : 'false' }}"
            role="listitem"
          >
            <img
              src="{{ $item['url'] }}"
              alt="{{ $item['alt'] }} — thumbnail {{ $index + 1 }}"
              loading="lazy"
              onerror="this.onerror=null;this.src='{{ asset(placeholder_image_path('product')) }}';"
            >
          </button>
          @endforeach
        </div>
        @endif
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

        @if($descriptionParts['excerpt'])
          @if($descriptionParts['has_more'])
          <p class="product-detail-desc product-detail-desc--excerpt">{{ $descriptionParts['excerpt'] }}</p>
          @else
          <div class="product-detail-desc product-rich-content">{!! $descriptionParts['excerpt'] !!}</div>
          @endif
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

  @if($descriptionParts['has_more'] && $descriptionParts['body'])
  <section class="product-description-section">
    <div class="product-description-card">
      <div class="product-description-header">
        <h2 class="product-description-title">Product Description</h2>
        <div class="product-description-line"></div>
      </div>
      <div class="product-description-body product-rich-content">{!! $descriptionParts['body'] !!}</div>
    </div>
  </section>
  @endif

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

<div class="modal fade product-image-modal" id="productImageModal" tabindex="-1" aria-labelledby="productImageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header border-0 pb-0">
        <h2 class="modal-title h6 text-truncate pe-3" id="productImageModalLabel">{{ $product->name }}</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pt-2 text-center">
        <img
          src="{{ $galleryItems[0]['url'] }}"
          alt="{{ $product->name }}"
          id="product-modal-image"
          class="product-modal-image"
          data-placeholder="{{ asset(placeholder_image_path('product')) }}"
          onerror="this.onerror=null;this.src=this.dataset.placeholder;"
        >
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const mainImage = document.getElementById('product-main-image');
  const modalImage = document.getElementById('product-modal-image');
  const thumbs = document.querySelectorAll('.product-gallery-thumb');

  if (!mainImage || !thumbs.length) {
    return;
  }

  const setActiveImage = (url) => {
    mainImage.src = url;
    if (modalImage) {
      modalImage.src = url;
    }
  };

  thumbs.forEach((thumb) => {
    thumb.addEventListener('click', () => {
      const url = thumb.dataset.image;
      if (!url) {
        return;
      }

      setActiveImage(url);

      thumbs.forEach((item) => {
        const isActive = item === thumb;
        item.classList.toggle('is-active', isActive);
        item.setAttribute('aria-pressed', isActive ? 'true' : 'false');
      });
    });
  });
});
</script>
@endpush
