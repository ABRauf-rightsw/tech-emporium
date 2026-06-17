<div class="shop-toolbar">
  <p class="shop-results-text mb-0">
    Showing <strong>{{ $products->count() }}</strong> of <strong>{{ $products->total() }}</strong> results
  </p>
  <div class="shop-sort-wrap">
    <label for="sort-select" class="shop-sort-label">Sort by</label>
    <select id="sort-select" class="form-select shop-sort-select">
      <option value="default" @selected(request('sort') === 'default' || !request('sort'))>Default</option>
      <option value="price-low" @selected(request('sort') === 'price-low')>Price: Low to High</option>
      <option value="price-high" @selected(request('sort') === 'price-high')>Price: High to Low</option>
      <option value="name" @selected(request('sort') === 'name')>Name A–Z</option>
    </select>
  </div>
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
        <a href="{{ route('shop.index') }}" class="btn btn-electric shop-ajax-reset">View All Products</a>
      </div>
    </div>
    @endforelse
  </div>
</div>

@if($products->hasPages())
<div class="shop-pagination mt-4">{{ $products->links('vendor.pagination.shop') }}</div>
@endif
