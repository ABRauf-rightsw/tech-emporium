@foreach($categories as $category)
<a href="{{ route('shop.index', ['category' => str_replace(['gaming-laptops','business-laptops','student-laptops'], ['gaming','business','student'], $category->slug)]) }}" class="home-quick-pill">{{ $category->name }}</a>
@endforeach
<a href="{{ route('shop.index') }}" class="home-quick-pill home-quick-pill--accent">All Products</a>
