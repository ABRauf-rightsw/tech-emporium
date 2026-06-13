@php
  $business = config('seo.business');
  $address = $business['address'];
@endphp
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'ComputerStore',
    '@id' => seo_absolute_url('/') . '#organization',
    'name' => $business['name'],
    'url' => $business['url'],
    'email' => $business['email'],
    'telephone' => $business['phone'],
    'image' => seo_og_image(),
    'priceRange' => 'Rs.',
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => $address['street'],
        'addressLocality' => $address['city'],
        'addressRegion' => $address['region'],
        'postalCode' => $address['postal_code'],
        'addressCountry' => $address['country'],
    ],
    'areaServed' => [
        '@type' => 'Country',
        'name' => 'Pakistan',
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
