<div class="home-hero-product-wrap">
  <div class="home-hero-product-glow"></div>
  <a href="{{ route('shop.show', $heroProduct) }}" class="home-hero-product-card text-decoration-none">
    <span class="home-hero-product-badge"><i class="bi bi-lightning-fill me-1"></i> Featured Deal</span>
    <div class="home-hero-product-image">
      <img src="{{ $heroProduct->image_url }}" alt="{{ $heroProduct->name }}" loading="eager" decoding="async" onerror="this.onerror=null;this.src='{{ asset(placeholder_image_path('product')) }}';">
    </div>
    <div class="home-hero-product-body">
      <span class="home-hero-product-brand">{{ $heroProduct->brand->name }}</span>
      <h3 class="home-hero-product-name">{{ $heroProduct->name }}</h3>
      <div class="home-hero-product-footer">
        <p class="home-hero-product-price">{{ format_pkr($heroProduct->effective_price) }}</p>
        <span class="home-hero-product-cta">View <i class="bi bi-arrow-right"></i></span>
      </div>
    </div>
  </a>
</div>
