<header>
  <nav class="navbar navbar-expand-lg navbar-dark glass-nav fixed-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2 text-white" href="{{ route('home') }}">
        <i class="bi bi-cpu text-electric" style="font-size: 1.8rem;"></i>
        <span>TECH <span class="text-electric">EMPORIUM</span></span>
      </a>
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mainNavbar">
        <form class="d-lg-none nav-mobile-search global-search-form" action="{{ route('shop.index') }}" method="GET" role="search">
          <div class="input-group">
            <input class="form-control nav-mobile-search-input" type="search" name="search" placeholder="Search products..." value="{{ request('search') }}" aria-label="Search">
            <button class="btn btn-electric" type="submit"><i class="bi bi-search"></i></button>
          </div>
        </form>
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('shop.*') ? 'active' : '' }}" href="{{ route('shop.index') }}">Shop</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">Categories</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}" href="{{ route('faq') }}">FAQ</a></li>
        </ul>
        <div class="d-flex align-items-center gap-3 nav-mobile-actions">
          <form class="d-none d-lg-flex global-search-form" action="{{ route('shop.index') }}" method="GET" role="search">
            <div class="input-group">
              <input class="form-control bg-dark border-secondary text-white rounded-start-pill px-3" type="search" name="search" placeholder="Search products..." value="{{ request('search') }}" aria-label="Search">
              <button class="btn btn-electric rounded-end-pill px-3" type="submit"><i class="bi bi-search"></i></button>
            </div>
          </form>
          @auth
          <a href="{{ route('wishlist.index') }}" class="nav-icon-btn position-relative" aria-label="View Wishlist">
            <i class="bi bi-heart"></i>
            @if(($wishlistCount ?? 0) > 0)
            <span class="badge-counter wishlist-counter">{{ $wishlistCount }}</span>
            @else
            <span class="badge-counter wishlist-counter" style="display: none;">0</span>
            @endif
          </a>
          <a href="{{ route('cart.index') }}" class="nav-icon-btn position-relative" aria-label="View Cart">
            <i class="bi bi-cart"></i>
            @if(($cartCount ?? 0) > 0)
            <span class="badge-counter cart-counter">{{ $cartCount }}</span>
            @else
            <span class="badge-counter cart-counter" style="display: none;">0</span>
            @endif
          </a>
          <a href="{{ route('account.index') }}" class="nav-icon-btn" aria-label="My Account"><i class="bi bi-person-circle"></i></a>
          @else
          <a href="{{ route('login') }}" class="nav-icon-btn" aria-label="Login"><i class="bi bi-person-circle"></i></a>
          @endauth
        </div>
      </div>
    </div>
  </nav>
</header>
