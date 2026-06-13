@extends('frontend.layouts.app', ['mainMargin' => '100px'])

@section('seo_title', 'Register | Tech Emporium')

@section('content')
<div class="container mb-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card glass-card p-4 border border-secondary shadow-lg">
        <div class="text-center mb-4">
          <i class="bi bi-cpu text-electric" style="font-size: 3rem;"></i>
          <h2 class="text-white mt-2">Create Account</h2>
        </div>
        <form action="{{ route('register') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label class="form-label text-muted small">Full Name</label>
            <input type="text" name="name" class="form-control custom-input" value="{{ old('name') }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label text-muted small">Email</label>
            <input type="email" name="email" class="form-control custom-input" value="{{ old('email') }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label text-muted small">Phone</label>
            <input type="text" name="phone" class="form-control custom-input" value="{{ old('phone') }}">
          </div>
          <div class="mb-3">
            <label class="form-label text-muted small">Password</label>
            <input type="password" name="password" class="form-control custom-input" required>
          </div>
          <div class="mb-4">
            <label class="form-label text-muted small">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control custom-input" required>
          </div>
          <button type="submit" class="btn btn-electric w-100 py-2">Register</button>
        </form>
        <div class="text-center mt-3">
          <a href="{{ route('login') }}" class="text-electric small">Already have an account? Login</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
