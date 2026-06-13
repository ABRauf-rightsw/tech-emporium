@extends('frontend.layouts.app')

@section('seo_title', 'Tech Emporium | Buy Laptops & Computer Accessories in Lahore, Pakistan')
@section('meta_description', 'Tech Emporium — Pakistan\'s trusted store for gaming laptops, business laptops, monitors, SSDs, and accessories. Official warranty, PKR pricing, and delivery nationwide. Visit us at Hafeez Center Lahore.')
@section('meta_keywords', 'Tech Emporium, laptops Lahore, Hafeez Center laptops, gaming laptops Pakistan, buy laptop online, computer shop Lahore')

@section('body-class')
class="home-page"
@endsection

@push('json_ld')
  @include('frontend.partials.schema.website')
  @include('frontend.partials.schema.breadcrumb', ['items' => [
    ['name' => 'Home', 'url' => route('home')],
  ]])
@endpush

@php $heroProduct = $featuredProducts->first(); @endphp

@section('content')

{{-- Hero --}}
<section class="home-hero" style="background-image: url('{{ asset(hero_background()) }}');">
  <div class="home-hero-blob home-hero-blob--1"></div>
  <div class="home-hero-blob home-hero-blob--2"></div>
  <div class="home-hero-blob home-hero-blob--3"></div>
  <div class="home-hero-grid"></div>
  <div class="home-hero-overlay"></div>

  <div class="container position-relative">
    <div class="row align-items-center g-5">
      <div class="col-lg-7 home-hero-content">
        <span class="home-hero-eyebrow"><span class="home-hero-eyebrow-dot"></span> Pakistan's Ultimate Hardware Hub</span>
        <h1 class="home-hero-title">Premium Laptops &amp; <span class="home-hero-accent">Tech Gear</span> in Pakistan</h1>
        <p class="home-hero-subtitle">Official laptops, gaming rigs, monitors, SSDs &amp; accessories — genuine warranty, competitive PKR prices, nationwide delivery.</p>

        <div class="home-hero-chips">
          <a href="{{ route('shop.index', ['category' => 'gaming']) }}" class="home-hero-chip"><i class="bi bi-controller"></i> Gaming</a>
          <a href="{{ route('shop.index', ['category' => 'business']) }}" class="home-hero-chip"><i class="bi bi-briefcase"></i> Business</a>
          <a href="{{ route('shop.index', ['category' => 'accessories']) }}" class="home-hero-chip"><i class="bi bi-headphones"></i> Accessories</a>
        </div>

        <div class="home-hero-actions">
          <a href="{{ route('shop.index') }}" class="btn btn-electric btn-lg px-4 home-hero-btn-primary"><i class="bi bi-bag-check me-2"></i>Shop Now</a>
          <a href="{{ route('categories.index') }}" class="btn home-hero-btn-outline btn-lg px-4">Explore Categories</a>
        </div>

        <div class="home-hero-stats">
          <div class="home-hero-stat-card">
            <i class="bi bi-box-seam"></i>
            <div>
              <strong>{{ $totalProducts }}+</strong>
              <span>Products</span>
            </div>
          </div>
          <div class="home-hero-stat-card">
            <i class="bi bi-grid"></i>
            <div>
              <strong>{{ $categories->count() }}</strong>
              <span>Categories</span>
            </div>
          </div>
          <div class="home-hero-stat-card">
            <i class="bi bi-patch-check"></i>
            <div>
              <strong>100%</strong>
              <span>Genuine</span>
            </div>
          </div>
        </div>
      </div>

      @if($heroProduct)
      <div class="col-lg-5 d-none d-lg-block">
        <div class="home-hero-product-wrap">
          <div class="home-hero-product-glow"></div>
          <a href="{{ route('shop.show', $heroProduct) }}" class="home-hero-product-card text-decoration-none">
            <span class="home-hero-product-badge"><i class="bi bi-lightning-fill me-1"></i> Featured Deal</span>
            <div class="home-hero-product-image">
              <img src="{{ asset($heroProduct->image) }}" alt="{{ $heroProduct->name }}" loading="eager">
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
      </div>
      @endif
    </div>
  </div>
  <div class="home-hero-aurora"></div>
  <svg class="home-hero-wave" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true">
    <path d="M0,48 C360,90 720,0 1080,40 C1260,60 1380,55 1440,48 L1440,80 L0,80 Z" fill="#f0f4f8"/>
  </svg>
</section>

{{-- Trust strip --}}
<section class="home-trust-strip">
  <div class="container">
    <div class="home-trust-grid">
      <div class="home-trust-card">
        <div class="home-trust-icon"><i class="bi bi-truck"></i></div>
        <div>
          <strong>Free Shipping</strong>
          <span>Orders above Rs. 10,000</span>
        </div>
      </div>
      <div class="home-trust-card">
        <div class="home-trust-icon"><i class="bi bi-shield-check"></i></div>
        <div>
          <strong>Official Warranty</strong>
          <span>100% authentic products</span>
        </div>
      </div>
      <div class="home-trust-card">
        <div class="home-trust-icon"><i class="bi bi-cash-coin"></i></div>
        <div>
          <strong>COD Available</strong>
          <span>Pay on delivery</span>
        </div>
      </div>
      <div class="home-trust-card">
        <div class="home-trust-icon"><i class="bi bi-geo-alt"></i></div>
        <div>
          <strong>Hafeez Center</strong>
          <span>Lahore, 3rd Floor</span>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Quick nav --}}
<section class="home-quick-nav">
  <div class="container">
    <div class="home-quick-nav-inner">
      <span class="home-quick-nav-label">Quick Shop:</span>
      <div class="home-quick-nav-scroll">
        @foreach($categories->take(6) as $category)
        <a href="{{ route('shop.index', ['category' => str_replace(['gaming-laptops','business-laptops','student-laptops'], ['gaming','business','student'], $category->slug)]) }}" class="home-quick-pill">{{ $category->name }}</a>
        @endforeach
        <a href="{{ route('shop.index') }}" class="home-quick-pill home-quick-pill--accent">All Products</a>
      </div>
    </div>
  </div>
</section>

{{-- Social proof --}}
<section class="home-social home-reveal">
  <div class="container">
    <div class="home-social-inner">
      <div class="home-social-rating">
        <div class="home-social-stars">
          @for($i = 0; $i < 5; $i++)<i class="bi bi-star-fill"></i>@endfor
        </div>
        <strong>4.9/5</strong>
        <span>from happy customers</span>
      </div>
      <div class="home-social-divider"></div>
      <div class="home-social-stat"><strong>5,000+</strong><span>Orders Delivered</span></div>
      <div class="home-social-divider"></div>
      <div class="home-social-stat"><strong>{{ $brands->count() - 1 }}+</strong><span>Global Brands</span></div>
      <div class="home-social-divider d-none d-md-block"></div>
      <div class="home-social-stat d-none d-md-flex"><strong>7-Day</strong><span>Return Policy</span></div>
    </div>
  </div>
</section>

{{-- Categories bento --}}
<section class="home-section home-reveal">
  <div class="container">
    <div class="home-section-header">
      <span class="home-section-eyebrow">Browse by Type</span>
      <h2 class="home-section-title">Featured Categories</h2>
      <p class="home-section-desc">Gaming, business, student laptops, monitors, accessories &amp; more.</p>
      <div class="home-section-line"></div>
    </div>
    <div class="row g-4 home-bento align-items-stretch">
      @foreach($categories as $index => $category)
      @php
        $catUrl = route('shop.index', ['category' => str_replace(['gaming-laptops','business-laptops','student-laptops'], ['gaming','business','student'], $category->slug)]);
        $bentoClass = match($index) {
          0 => 'col-12 col-lg-8',
          1 => 'col-12 col-md-6 col-lg-4',
          default => 'col-md-6 col-lg-4',
        };
        $cardClass = $index === 0 ? 'home-category-card home-category-card--wide' : ($index === 1 ? 'home-category-card home-category-card--tall' : 'home-category-card');
      @endphp
      <div class="{{ $bentoClass }}">
        <a href="{{ $catUrl }}" class="{{ $cardClass }} hover-zoom">
          <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" loading="lazy">
          <div class="home-category-overlay">
            <span class="home-category-tag">Category</span>
            <h3>{{ $category->name }}</h3>
            <span class="home-category-link">Shop Now <i class="bi bi-arrow-right"></i></span>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Featured Products --}}
<section class="home-section home-section--alt home-reveal">
  <div class="container">
    <div class="home-section-header d-flex flex-wrap align-items-end justify-content-between gap-3">
      <div>
        <span class="home-section-eyebrow">Handpicked for You</span>
        <h2 class="home-section-title mb-0">Featured Products</h2>
      </div>
      <a href="{{ route('shop.index') }}" class="home-section-link">View All <i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="home-product-shell">
      <div class="row g-4">
        @foreach($featuredProducts as $product)
          @include('frontend.partials.product-card', ['product' => $product])
        @endforeach
      </div>
    </div>
  </div>
</section>

{{-- Best Sellers --}}
<section class="home-section home-reveal">
  <div class="container">
    <div class="home-section-header">
      <span class="home-section-eyebrow">Top Picks</span>
      <h2 class="home-section-title">Best Selling Laptops</h2>
      <p class="home-section-desc">Most popular machines trusted by gamers, professionals &amp; students.</p>
      <div class="home-section-line"></div>
    </div>
    <div class="row g-4">
      @foreach($bestSellers as $product)
        @include('frontend.partials.product-card', ['product' => $product])
      @endforeach
    </div>
  </div>
</section>

{{-- Why Choose Us --}}
<section class="home-section home-section--mesh home-reveal">
  <div class="container">
    <div class="home-section-header">
      <span class="home-section-eyebrow">Why Tech Emporium</span>
      <h2 class="home-section-title">Built for Smart Buyers</h2>
      <div class="home-section-line"></div>
    </div>
    <div class="row g-4">
      @foreach([
        ['bi-cpu', 'Latest Hardware', 'New-gen processors, GPUs & SSDs from top global brands.'],
        ['bi-patch-check', 'Verified Authentic', 'Every product is sourced through official channels with warranty.'],
        ['bi-headset', 'Expert Support', 'Friendly guidance before and after your purchase.'],
        ['bi-lightning-charge', 'Fast Delivery', 'Quick dispatch to Lahore, Karachi, Islamabad & nationwide.'],
      ] as $item)
      <div class="col-md-6 col-lg-3">
        <div class="home-why-card">
          <div class="home-why-icon"><i class="bi {{ $item[0] }}"></i></div>
          <h3>{{ $item[1] }}</h3>
          <p>{{ $item[2] }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Accessories --}}
<section class="home-section home-reveal">
  <div class="container">
    <div class="home-section-header">
      <span class="home-section-eyebrow">Complete Your Setup</span>
      <h2 class="home-section-title">Accessories Collection</h2>
      <p class="home-section-desc">Keyboards, mice, headphones, monitors, SSDs &amp; more.</p>
      <div class="home-section-line"></div>
    </div>
    <div class="row g-4">
      @foreach($accessories as $product)
        @include('frontend.partials.product-card', ['product' => $product])
      @endforeach
    </div>
  </div>
</section>

{{-- CTA Banner --}}
<section class="home-cta home-reveal">
  <div class="container">
    <div class="home-cta-inner">
      <div class="home-cta-glow"></div>
      <div class="home-cta-content">
        <span class="home-cta-badge"><i class="bi bi-stars me-1"></i> Limited Time Offers</span>
        <h2>Ready to Upgrade Your Setup?</h2>
        <p>Browse {{ $totalProducts }}+ products with official warranty &amp; fast delivery across Pakistan.</p>
      </div>
      <a href="{{ route('shop.index') }}" class="btn btn-accent btn-lg px-5 home-cta-btn">Start Shopping <i class="bi bi-arrow-right ms-2"></i></a>
    </div>
  </div>
</section>

{{-- Brand marquee --}}
<section class="home-marquee" aria-hidden="true">
  <div class="home-marquee-track">
    @foreach($brands->whereNotIn('slug', ['accessories']) as $brand)
    <span>{{ $brand->name }}</span>
    @endforeach
    @foreach($brands->whereNotIn('slug', ['accessories']) as $brand)
    <span>{{ $brand->name }}</span>
    @endforeach
  </div>
</section>

{{-- Brands --}}
<section class="home-section home-section--alt home-reveal">
  <div class="container">
    <div class="home-section-header">
      <span class="home-section-eyebrow">Trusted Worldwide</span>
      <h2 class="home-section-title">Official Brand Partners</h2>
      <div class="home-section-line"></div>
    </div>
    <div class="home-brands-shell">
      <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-7 g-3 justify-content-center">
        @foreach($brands->whereNotIn('slug', ['accessories', 'samsung']) as $brand)
        <div class="col">
          <a href="{{ route('shop.index', ['brand' => $brand->slug]) }}" class="brand-item" title="{{ $brand->name }}">
            <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }}" loading="lazy">
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

{{-- Testimonials --}}
<section class="home-section home-reveal">
  <div class="container">
    <div class="home-section-header">
      <span class="home-section-eyebrow">Customer Love</span>
      <h2 class="home-section-title">What Buyers Say</h2>
      <div class="home-section-line"></div>
    </div>
    <div class="row g-4">
      @foreach([
        ['Ali R.', 'Lahore', 'Got my gaming laptop delivered in 2 days. Genuine product with full warranty. Highly recommend Tech Emporium!'],
        ['Sara K.', 'Karachi', 'Best prices in Pakistan and excellent customer support. The team helped me pick the right business laptop.'],
        ['Usman T.', 'Islamabad', 'Ordered accessories and a monitor — everything arrived well packed. COD was smooth and hassle-free.'],
      ] as $review)
      <div class="col-md-4">
        <div class="home-review-card">
          <div class="home-review-stars">
            @for($i = 0; $i < 5; $i++)<i class="bi bi-star-fill"></i>@endfor
          </div>
          <p class="home-review-text">"{{ $review[2] }}"</p>
          <div class="home-review-author">
            <div class="home-review-avatar">{{ substr($review[0], 0, 1) }}</div>
            <div>
              <strong>{{ $review[0] }}</strong>
              <span>{{ $review[1] }}</span>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const nav = document.querySelector('.glass-nav');
  const navCollapse = document.getElementById('mainNavbar');
  if (nav && document.body.classList.contains('home-page')) {
    const syncNav = () => {
      const menuOpen = navCollapse && navCollapse.classList.contains('show');
      nav.classList.toggle('home-nav-solid', window.scrollY > 60 || menuOpen);
    };
    syncNav();
    window.addEventListener('scroll', syncNav, { passive: true });
    if (navCollapse) {
      navCollapse.addEventListener('shown.bs.collapse', syncNav);
      navCollapse.addEventListener('hidden.bs.collapse', syncNav);
    }
  }

  const reveals = document.querySelectorAll('.home-reveal');
  if ('IntersectionObserver' in window && reveals.length) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    reveals.forEach((el) => observer.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add('is-visible'));
  }
});
</script>
@endpush
