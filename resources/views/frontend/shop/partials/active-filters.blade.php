@php
  $activeFilters = collect([
    'search' => request('search'),
    'category' => request('category'),
    'brand' => request('brand'),
  ])->filter(fn ($value) => filled($value));
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
  <a href="{{ route('shop.index') }}" class="shop-filter-clear shop-ajax-reset">Clear all</a>
</div>
@endif
