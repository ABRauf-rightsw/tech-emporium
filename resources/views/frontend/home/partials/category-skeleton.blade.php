@for($i = 0; $i < 5; $i++)
@php
  $bentoClass = match($i) {
    0 => 'col-12 col-lg-8',
    1 => 'col-12 col-md-6 col-lg-4',
    default => 'col-md-6 col-lg-4',
  };
  $cardClass = $i === 0 ? 'home-skeleton-card home-skeleton-card--wide' : ($i === 1 ? 'home-skeleton-card home-skeleton-card--tall' : 'home-skeleton-card');
@endphp
<div class="{{ $bentoClass }}">
  <div class="{{ $cardClass }} home-skeleton-shimmer" aria-hidden="true">
    <div class="home-skeleton-line home-skeleton-line--title"></div>
    <div class="home-skeleton-line home-skeleton-line--short"></div>
  </div>
</div>
@endfor
