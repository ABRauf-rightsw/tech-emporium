@if ($paginator->hasPages())
<nav class="shop-pagination-nav" aria-label="Product pages">
  <p class="shop-pagination-info">
    Showing <strong>{{ $paginator->firstItem() }}</strong> to <strong>{{ $paginator->lastItem() }}</strong> of <strong>{{ $paginator->total() }}</strong> results
  </p>
  <ul class="pagination shop-pagination-list mb-0">
    @if ($paginator->onFirstPage())
    <li class="page-item disabled">
      <span class="page-link shop-page-arrow" aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
    </li>
    @else
    <li class="page-item">
      <a class="page-link shop-page-arrow" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous page"><i class="bi bi-chevron-left"></i></a>
    </li>
    @endif

    @foreach ($elements as $element)
      @if (is_string($element))
      <li class="page-item disabled"><span class="page-link shop-page-dots">{{ $element }}</span></li>
      @endif
      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
          <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
          @else
          <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
          @endif
        @endforeach
      @endif
    @endforeach

    @if ($paginator->hasMorePages())
    <li class="page-item">
      <a class="page-link shop-page-arrow" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next page"><i class="bi bi-chevron-right"></i></a>
    </li>
    @else
    <li class="page-item disabled">
      <span class="page-link shop-page-arrow" aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
    </li>
    @endif
  </ul>
</nav>
@endif
