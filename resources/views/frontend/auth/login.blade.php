@extends('frontend.layouts.app', ['mainMargin' => '100px'])

@section('seo_title', 'Login | Tech Emporium')

@section('footer')
<footer class="pt-4 pb-3 mt-auto"><div class="container text-center"><p class="small text-muted mb-0">&copy; {{ date('Y') }} Tech Emporium.</p></div></footer>
@endsection

@section('content')
<div class="container flex-grow-1 d-flex align-items-center mb-5">
  <div class="row justify-content-center w-100">
    <div class="col-md-6 col-lg-5">
      <div class="card glass-card p-4 border border-secondary shadow-lg">
        <div class="text-center mb-4">
          <i class="bi bi-cpu text-electric" style="font-size: 3rem;"></i>
          <h2 class="text-white mt-2 mb-1">Welcome Back</h2>
          <p class="text-muted small">Sign in to manage your premium orders</p>
        </div>
        <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label text-muted small">Email Address</label>
            <input type="email" class="form-control custom-input" id="email" name="email" value="{{ old('email') }}" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label text-muted small">Password</label>
            <input type="password" class="form-control custom-input" id="password" name="password" required>
          </div>
          <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="remember" id="remember-me">
            <label class="form-check-label text-white small" for="remember-me">Remember my session</label>
          </div>
          <button type="submit" class="btn btn-electric w-100 py-2 mb-3 text-uppercase fw-bold">Log In</button>
          <a href="{{ route('shop.index') }}" class="btn btn-outline-light w-100 py-2 rounded-pill mb-3">Continue Shopping</a>
        </form>
        <div class="text-center mt-3 border-top border-secondary pt-3">
          <span class="text-muted small">Don't have an account? </span>
          <a href="{{ route('register') }}" class="text-electric small fw-bold">Create Account</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
