@extends('frontend.layouts.app', ['mainMargin' => '100px'])

@section('seo_title', 'Laptop & Accessory Categories | Tech Emporium')
@section('meta_description', 'Explore Tech Emporium categories: gaming laptops, business laptops, student laptops, monitors, accessories, and storage. Shop by category with official warranty.')

@push('json_ld')
  @include('frontend.partials.schema.breadcrumb', ['items' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Categories', 'url' => route('categories.index')],
  ]])
@endpush

@section('content')
<div class="container mb-5">
  <h1 class="text-white mb-4">Shop by Category</h1>
  <div class="row">
    @foreach($categories as $category)
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="category-card hover-zoom">
        <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-100 h-100 object-fit-cover" onerror="this.onerror=null;this.src='{{ asset(placeholder_image_path('category')) }}';">
        <div class="category-overlay">
          <h4 class="text-white">{{ $category->name }}</h4>
          <p class="text-muted small">{{ $category->products_count }} products</p>
          <a href="{{ route('shop.index', ['category' => str_replace(['gaming-laptops','business-laptops','student-laptops'], ['gaming','business','student'], $category->slug)]) }}" class="btn btn-sm btn-electric">Shop Now</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
