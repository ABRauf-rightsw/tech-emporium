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
    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" loading="lazy" decoding="async">
    <div class="home-category-overlay">
      <span class="home-category-tag">Category</span>
      <h3>{{ $category->name }}</h3>
      <span class="home-category-link">Shop Now <i class="bi bi-arrow-right"></i></span>
    </div>
  </a>
</div>
@endforeach
