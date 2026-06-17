@foreach($featuredProducts as $product)
  @include('frontend.partials.product-card', ['product' => $product])
@endforeach
