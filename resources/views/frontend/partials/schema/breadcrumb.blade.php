@php
  $items = $items ?? [];
  $list = [];
  foreach ($items as $index => $item) {
      $list[] = [
          '@type' => 'ListItem',
          'position' => $index + 1,
          'name' => $item['name'],
          'item' => $item['url'] ?? null,
      ];
  }
@endphp
@if(count($list))
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => $list,
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endif
