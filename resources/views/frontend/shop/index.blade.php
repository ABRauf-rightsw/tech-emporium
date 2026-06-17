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
  <div class="shop-container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb shop-breadcrumb mb-2">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Shop</li>
      </ol>
    </nav>
    <div class="shop-header-inner">
      <div class="shop-header-copy">
        <span class="shop-eyebrow"><i class="bi bi-stars me-1"></i> Tech Emporium Store</span>
        <h1 class="shop-title">Shop All Products</h1>
        <p class="shop-subtitle">Laptops, monitors, accessories &amp; more — curated for Pakistan.</p>
      </div>
      <div class="shop-header-meta">
        <div class="shop-count-badge">
          <span class="shop-count-number">{{ $products->total() }}</span>
          <span class="shop-count-label">Items</span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="shop-container shop-content" id="shop-page" data-shop-url="{{ route('shop.index') }}">
  <div id="shop-active-filters-wrap">
    @include('frontend.shop.partials.active-filters')
  </div>

  <div class="shop-layout">
    <aside class="shop-sidebar">
      <button class="btn shop-filter-toggle w-100 d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#shopFiltersCollapse" aria-expanded="false" aria-controls="shopFiltersCollapse">
        <i class="bi bi-sliders me-2"></i> Filters
      </button>
      <div class="collapse shop-filters-collapse" id="shopFiltersCollapse">
        <div class="shop-filter-card">
          <div class="shop-filter-card-header">
            <div>
              <span class="shop-filter-card-title">Refine Results</span>
              <span class="shop-filter-card-sub">Search, category &amp; brand</span>
            </div>
            <i class="bi bi-funnel"></i>
          </div>
          <form class="shop-filter-form" id="shop-filter-form" onsubmit="return false;">
            <div class="shop-filter-section">
              <h6 class="shop-filter-heading">Search</h6>
              <div class="shop-search-wrap">
                <i class="bi bi-search"></i>
                <input type="text" id="shop-search-input" class="form-control shop-search-input" placeholder="Find a product..." value="{{ request('search') }}" autocomplete="off">
              </div>
            </div>

            <div class="shop-filter-section">
              <h6 class="shop-filter-heading">Category</h6>
              <div class="shop-filter-chips">
                <label class="shop-filter-chip-option">
                  <input type="radio" name="category" value="" @checked(!request('category'))>
                  <span>All</span>
                </label>
                @foreach(['gaming' => 'Gaming', 'business' => 'Business', 'student' => 'Student', 'monitors' => 'Monitors', 'accessories' => 'Accessories', 'storage' => 'Storage'] as $val => $label)
                <label class="shop-filter-chip-option">
                  <input type="radio" name="category" value="{{ $val }}" @checked(request('category') === $val)>
                  <span>{{ $label }}</span>
                </label>
                @endforeach
              </div>
            </div>

            <div class="shop-filter-section">
              <h6 class="shop-filter-heading">Brand</h6>
              <div class="shop-filter-chips shop-filter-chips--brands">
                <label class="shop-filter-chip-option">
                  <input type="radio" name="brand" value="" @checked(!request('brand'))>
                  <span>All</span>
                </label>
                @foreach($brands->where('slug', '!=', 'accessories') as $brand)
                <label class="shop-filter-chip-option">
                  <input type="radio" name="brand" value="{{ $brand->slug }}" @checked(request('brand') === $brand->slug)>
                  <span>{{ $brand->name }}</span>
                </label>
                @endforeach
              </div>
            </div>

            <div class="shop-filter-actions">
              <button type="button" class="btn shop-btn-reset w-100 shop-ajax-reset">
                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
              </button>
            </div>
          </form>
        </div>
      </div>
    </aside>

    <div class="shop-main" id="shop-results-wrap">
      @include('frontend.shop.partials.results')
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const shopPage = document.getElementById('shop-page');
  if (!shopPage) return;

  const shopUrl = shopPage.dataset.shopUrl;
  const filterForm = document.getElementById('shop-filter-form');
  const searchInput = document.getElementById('shop-search-input');
  const resultsWrap = document.getElementById('shop-results-wrap');
  const activeFiltersWrap = document.getElementById('shop-active-filters-wrap');
  const countBadge = document.querySelector('.shop-count-number');

  let searchTimer = null;
  let lastSearchValue = searchInput ? searchInput.value.trim() : '';
  let activeController = null;
  let suppressFetch = false;

  const buildParams = (page = 1) => {
    const params = new URLSearchParams();
    const search = searchInput ? searchInput.value.trim() : '';
    const category = filterForm.querySelector('input[name="category"]:checked')?.value || '';
    const brand = filterForm.querySelector('input[name="brand"]:checked')?.value || '';
    const sortSelect = document.getElementById('sort-select');
    const sort = sortSelect ? sortSelect.value : 'default';

    if (search) params.set('search', search);
    if (category) params.set('category', category);
    if (brand) params.set('brand', brand);
    if (sort && sort !== 'default') params.set('sort', sort);
    if (page > 1) params.set('page', String(page));

    return params;
  };

  resultsWrap.addEventListener('change', (event) => {
    if (event.target.id === 'sort-select') {
      fetchResults(1);
    }
  });

  shopPage.addEventListener('click', (event) => {
    const resetBtn = event.target.closest('.shop-ajax-reset');
    if (resetBtn) {
      event.preventDefault();
      resetFilters();
      return;
    }

    const pageLink = event.target.closest('#shop-results-wrap .shop-pagination a.page-link[href]');
    if (pageLink) {
      event.preventDefault();
      const url = new URL(pageLink.href);
      const page = parseInt(url.searchParams.get('page') || '1', 10);
      fetchResults(page);
    }
  });

  const fetchResults = async (page = 1, pushState = true) => {
    const params = buildParams(page);
    const requestUrl = params.toString() ? `${shopUrl}?${params.toString()}` : shopUrl;

    if (activeController) activeController.abort();
    activeController = new AbortController();

    resultsWrap.classList.add('is-loading');

    try {
      const response = await fetch(requestUrl, {
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
        },
        signal: activeController.signal,
      });

      if (!response.ok) throw new Error('Failed to load products');

      const data = await response.json();
      resultsWrap.innerHTML = data.results;
      activeFiltersWrap.innerHTML = data.activeFilters;
      if (countBadge) countBadge.textContent = data.total;

      if (pushState) {
        history.pushState({ shop: true }, '', requestUrl);
      }
    } catch (error) {
      if (error.name !== 'AbortError') {
        window.location.href = requestUrl;
      }
    } finally {
      resultsWrap.classList.remove('is-loading');
    }
  };

  const resetFilters = () => {
    suppressFetch = true;
    if (searchInput) searchInput.value = '';
    lastSearchValue = '';
    const allCategory = filterForm.querySelector('input[name="category"][value=""]');
    const allBrand = filterForm.querySelector('input[name="brand"][value=""]');
    if (allCategory) allCategory.checked = true;
    if (allBrand) allBrand.checked = true;
    const sortSelect = document.getElementById('sort-select');
    if (sortSelect) sortSelect.value = 'default';
    suppressFetch = false;
    fetchResults(1);
  };

  filterForm.querySelectorAll('input[type="radio"]').forEach((radio) => {
    radio.addEventListener('change', () => {
      if (!suppressFetch) fetchResults(1);
    });
  });

  if (searchInput) {
    searchInput.addEventListener('input', function () {
      clearTimeout(searchTimer);
      searchTimer = setTimeout(() => {
        const current = searchInput.value.trim();
        if (current !== lastSearchValue) {
          lastSearchValue = current;
          fetchResults(1);
        }
      }, 400);
    });

    searchInput.addEventListener('keydown', function (event) {
      if (event.key === 'Enter') {
        event.preventDefault();
        clearTimeout(searchTimer);
        lastSearchValue = searchInput.value.trim();
        fetchResults(1);
      }
    });
  }

  window.addEventListener('popstate', () => {
    const url = new URL(window.location.href);
    suppressFetch = true;

    if (searchInput) searchInput.value = url.searchParams.get('search') || '';
    lastSearchValue = searchInput ? searchInput.value.trim() : '';

    const category = url.searchParams.get('category') || '';
    const categoryInput = filterForm.querySelector(`input[name="category"][value="${category}"]`)
      || filterForm.querySelector('input[name="category"][value=""]');
    if (categoryInput) categoryInput.checked = true;

    const brand = url.searchParams.get('brand') || '';
    const brandInput = filterForm.querySelector(`input[name="brand"][value="${brand}"]`)
      || filterForm.querySelector('input[name="brand"][value=""]');
    if (brandInput) brandInput.checked = true;

    const sortSelect = document.getElementById('sort-select');
    if (sortSelect) sortSelect.value = url.searchParams.get('sort') || 'default';

    suppressFetch = false;

    const page = parseInt(url.searchParams.get('page') || '1', 10);
    fetchResults(page, false);
  });

  const toggle = document.querySelector('.shop-filter-toggle');
  const panel = document.getElementById('shopFiltersCollapse');
  if (toggle && panel) {
    const syncLabel = () => {
      const open = panel.classList.contains('show');
      toggle.innerHTML = open
        ? '<i class="bi bi-x-lg me-2"></i> Close'
        : '<i class="bi bi-sliders me-2"></i> Filters';
    };
    panel.addEventListener('shown.bs.collapse', syncLabel);
    panel.addEventListener('hidden.bs.collapse', syncLabel);
  }
});
</script>
@endpush
