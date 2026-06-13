@php
  /** @var \App\Models\Product $product */
  $availability = $product->stock > 0
      ? 'https://schema.org/InStock'
      : 'https://schema.org/OutOfStock';
@endphp
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Product',
    'name' => $product->name,
    'description' => strip_tags($product->description ?? ''),
    'image' => [seo_absolute_url($product->image)],
    'sku' => 'TE-' . $product->id,
    'brand' => [
        '@type' => 'Brand',
        'name' => $product->brand->name,
    ],
    'category' => $product->category->name,
    'offers' => [
        '@type' => 'Offer',
        'url' => route('shop.show', $product),
        'priceCurrency' => 'PKR',
        'price' => $product->effective_price,
        'availability' => $availability,
        'itemCondition' => 'https://schema.org/NewCondition',
        'seller' => [
            '@type' => 'Organization',
            'name' => config('seo.site_name'),
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
