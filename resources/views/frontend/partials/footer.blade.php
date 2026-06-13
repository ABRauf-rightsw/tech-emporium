<section class="newsletter-section py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <h3 class="text-white mb-2"><i class="bi bi-envelope-paper me-2 text-electric"></i>Subscribe to Our Newsletter</h3>
        <p class="text-muted mb-0 small">Get updates on new laptop arrivals, hardware sales, and special tech discounts in Pakistan.</p>
      </div>
      <div class="col-lg-6">
        <form class="newsletter-form" onsubmit="event.preventDefault(); alert('Subscribed successfully!')">
          <div class="input-group">
            <input type="email" required class="form-control" placeholder="Enter your email address" aria-label="Email Address">
            <button class="btn btn-electric" type="submit">Subscribe</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<footer class="pt-5 pb-3">
  <div class="container">
    <div class="row g-4 mb-4">
      <div class="col-lg-4 col-md-6">
        <a class="navbar-brand d-flex align-items-center gap-2 text-white mb-3" href="{{ route('home') }}">
          <i class="bi bi-cpu text-electric" style="font-size: 1.8rem;"></i>
          <span>TECH <span class="text-electric">EMPORIUM</span></span>
        </a>
        <p class="small text-muted mb-4">Tech Emporium is the premium destination for computer hardware, laptops, and custom gaming gear.</p>
      </div>
      <div class="col-lg-2 col-md-6">
        <h5 class="text-white mb-3">Quick Links</h5>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="{{ route('home') }}" class="small">Home</a></li>
          <li class="mb-2"><a href="{{ route('shop.index') }}" class="small">Shop</a></li>
          <li class="mb-2"><a href="{{ route('about') }}" class="small">About Us</a></li>
          <li class="mb-2"><a href="{{ route('contact') }}" class="small">Contact Support</a></li>
        </ul>
      </div>
      <div class="col-lg-3 col-md-6">
        <h5 class="text-white mb-3">Categories</h5>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="{{ route('shop.index', ['category' => 'gaming']) }}" class="small">Gaming Laptops</a></li>
          <li class="mb-2"><a href="{{ route('shop.index', ['category' => 'business']) }}" class="small">Business Laptops</a></li>
          <li class="mb-2"><a href="{{ route('shop.index', ['category' => 'student']) }}" class="small">Student Laptops</a></li>
        </ul>
      </div>
      <div class="col-lg-3 col-md-6">
        <h5 class="text-white mb-3">Contact Information</h5>
        <ul class="list-unstyled small">
          <li class="d-flex align-items-start gap-2 mb-3"><i class="bi bi-geo-alt-fill text-electric mt-1"></i><span>Hafeez Center Lahore, 3rd Floor</span></li>
          <li class="d-flex align-items-center gap-2 mb-3"><i class="bi bi-telephone-fill text-electric"></i><span>+92 (21) 111-832-436</span></li>
          <li class="d-flex align-items-center gap-2"><i class="bi bi-envelope-fill text-electric"></i><span>sales@techemporiumpk.com</span></li>
        </ul>
      </div>
    </div>
    <hr class="border-secondary mb-3">
    <div class="d-flex flex-wrap justify-content-between align-items-center small text-muted">
      <p class="mb-0">Developed by Eng. Abdul Rauf &mdash; &copy; 2026 Tech Emporium. All Rights Reserved.</p>
    </div>
  </div>
</footer>
