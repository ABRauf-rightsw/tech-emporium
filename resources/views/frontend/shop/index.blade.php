@extends('frontend.layouts.app', ['mainMargin' => '100px'])

@php
  $shopMetaTitle = 'Shop Laptops & Accessories';
  $shopMetaDesc = 'Shop premium laptops, gaming gear, monitors, and computer accessories at Tech Emporium Pakistan. Filter by brand, category, and price. Fast delivery across Pakistan.';
  if ($search = request('search')) {
      $shopMetaTitle = 'Search: ' . $search;
      $shopMetaDesc = 'Search results for "' . $search . '" at Tech Emporium. Find laptops and accessories with official warranty and competitive PKR prices.';
  } elseif ($cat = request('category')) {
      $shopMetaTitle = ucfirst($cat) . ' Products';
      $shopMetaDesc = 'Browse ' . str_replace('-', ' ', $cat) . ' at Tech Emporium Pakistan. Authentic products, official warranty, and nationwide delivery.';
  } elseif ($brand = request('brand')) {
      $shopMetaTitle = ucfirst($brand) . ' Products';
      $shopMetaDesc = 'Shop ' . ucfirst($brand) . ' laptops and hardware at Tech Emporium. Genuine products with warranty in Pakistan.';
  }
@endphp

@section('seo_title', $shopMetaTitle . ' | Tech Emporium')
@section('meta_description', $shopMetaDesc)

@push('json_ld')
  @include('frontend.partials.schema.breadcrumb', ['items' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Shop', 'url' => route('shop.index')],
  ]])
@endpush

@section('body-class')
class="shop-page"
@endsection

@section('content')
<div class="shop-header">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb shop-breadcrumb mb-3">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Shop</li>
      </ol>
    </nav>
    <div class="shop-header-inner">
      <div>
        <span class="shop-eyebrow"><i class="bi bi-grid-3x3-gap me-1"></i> Browse Collection</span>
        <h1 class="shop-title">Shop</h1>
        <p class="shop-subtitle">Premium laptops, gaming gear, monitors &amp; accessories — all in one place.</p>
      </div>
      <div class="shop-count-badge">
        <span class="shop-count-number">{{ $products->total() }}</span>
        <span class="shop-count-label">Products</span>
      </div>
    </div>
  </div>
</div>

<div class="container shop-content pb-5">
  @php
    $activeFilters = collect([
      'search' => request('search'),
      'category' => request('category'),
      'brand' => request('brand'),
    ])->filter();
  @endphp

  @if($activeFilters->isNotEmpty())
  <div class="shop-active-filters">
    <span class="shop-active-label"><i class="bi bi-funnel me-1"></i> Active filters:</span>
    @if(request('search'))
    <span class="shop-filter-chip">"{{ request('search') }}"</span>
    @endif
    @if(request('category'))
    <span class="shop-filter-chip">{{ ucfirst(request('category')) }}</span>
    @endif
    @if(request('brand'))
    <span class="shop-filter-chip">{{ ucfirst(request('brand')) }}</span>
    @endif
    <a href="{{ route('shop.index') }}" class="shop-filter-clear">Clear all</a>
  </div>
  @endif

  <div class="row g-4">
    <aside class="col-lg-3">
      <button class="btn btn-electric w-100 d-lg-none shop-filter-toggle mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#shopFiltersCollapse" aria-expanded="false" aria-controls="shopFiltersCollapse">
        <i class="bi bi-sliders me-2"></i> Show Filters
      </button>
      <div class="collapse shop-filters-collapse" id="shopFiltersCollapse">
      <div class="shop-filter-card">
        <div class="shop-filter-card-header">
          <i class="bi bi-sliders"></i>
          <span>Filters</span>
        </div>
        <form method="GET" action="{{ route('shop.index') }}" class="shop-filter-form">
          <div class="shop-filter-section">
            <h6 class="shop-filter-heading">Search</h6>
            <div class="shop-search-wrap">
              <i class="bi bi-search"></i>
              <input type="text" name="search" class="form-control shop-search-input" placeholder="Search products..." value="{{ request('search') }}">
            </div>
          </div>

          <div class="shop-filter-section">
            <h6 class="shop-filter-heading">Categories</h6>
            <div class="shop-filter-options">
              @foreach(['gaming' => 'Gaming Laptops', 'business' => 'Business Laptops', 'student' => 'Student Laptops', 'monitors' => 'Monitors', 'accessories' => 'Accessories', 'storage' => 'Storage'] as $val => $label)
              <label class="shop-filter-option">
                <input type="radio" name="category" value="{{ $val }}" @checked(request('category') === $val)>
                <span>{{ $label }}</span>
              </label>
              @endforeach
            </div>
          </div>

          <div class="shop-filter-section">
            <h6 class="shop-filter-heading">Brands</h6>
            <div class="shop-filter-options">
              @foreach($brands->where('slug', '!=', 'accessories') as $brand)
              <label class="shop-filter-option">
                <input type="radio" name="brand" value="{{ $brand->slug }}" @checked(request('brand') === $brand->slug)>
                <span>{{ $brand->name }}</span>
              </label>
              @endforeach
            </div>
          </div>

          <div class="shop-filter-actions">
            <button type="submit" class="btn btn-electric w-100">Apply Filters</button>
            <a href="{{ route('shop.index') }}" class="btn shop-btn-reset w-100">Reset</a>
          </div>
        </form>
      </div>
      </div>
    </aside>

    <div class="col-lg-9">
      <div class="shop-toolbar">
        <p class="shop-results-text mb-0">
          Showing <strong>{{ $products->count() }}</strong> of <strong>{{ $products->total() }}</strong> results
        </p>
        <form method="GET" action="{{ route('shop.index') }}" class="shop-sort-form">
          @foreach(request()->except('sort', 'page') as $key => $val)
            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
          @endforeach
          <label for="sort-select" class="shop-sort-label">Sort by</label>
          <select id="sort-select" name="sort" class="form-select shop-sort-select" onchange="this.form.submit()">
            <option value="default" @selected(request('sort') === 'default' || !request('sort'))>Default</option>
            <option value="price-low" @selected(request('sort') === 'price-low')>Price: Low to High</option>
            <option value="price-high" @selected(request('sort') === 'price-high')>Price: High to Low</option>
            <option value="name" @selected(request('sort') === 'name')>Name A–Z</option>
          </select>
        </form>
      </div>

      <div class="shop-product-grid">
        <div class="row g-4">
          @forelse($products as $product)
            @include('frontend.partials.product-card', ['product' => $product])
          @empty
          <div class="col-12">
            <div class="shop-empty-state">
              <i class="bi bi-search"></i>
              <h3>No products found</h3>
              <p>Try adjusting your filters or search term.</p>
              <a href="{{ route('shop.index') }}" class="btn btn-electric">View All Products</a>
            </div>
          </div>
          @endforelse
        </div>
      </div>

      @if($products->hasPages())
      <div class="shop-pagination mt-4">{{ $products->links('vendor.pagination.shop') }}</div>
      @endif
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const toggle = document.querySelector('.shop-filter-toggle');
  const panel = document.getElementById('shopFiltersCollapse');
  if (!toggle || !panel) return;
  const syncLabel = () => {
    const open = panel.classList.contains('show');
    toggle.innerHTML = open
      ? '<i class="bi bi-x-lg me-2"></i> Hide Filters'
      : '<i class="bi bi-sliders me-2"></i> Show Filters';
  };
  panel.addEventListener('shown.bs.collapse', syncLabel);
  panel.addEventListener('hidden.bs.collapse', syncLabel);
});
</script>
@endpush
