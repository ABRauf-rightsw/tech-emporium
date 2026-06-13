@extends('frontend.layouts.app', ['mainMargin' => '100px'])

@section('seo_title', 'My Account | Tech Emporium')

@section('content')
<div class="container mb-5">
  <h1 class="text-white mb-4">My Account</h1>
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card glass-card p-4 border border-secondary">
        <h5 class="text-white">{{ $user->name }}</h5>
        <p class="text-muted small mb-1">{{ $user->email }}</p>
        <p class="text-muted small">{{ $user->phone }}</p>
        <form action="{{ route('logout') }}" method="POST" class="mt-3">
          @csrf
          <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card glass-card p-4 border border-secondary">
        <h5 class="text-white mb-3">Quick Links</h5>
        <a href="{{ route('orders.index') }}" class="btn btn-electric me-2 mb-2">My Orders</a>
        <a href="{{ route('wishlist.index') }}" class="btn btn-outline-light me-2 mb-2">Wishlist</a>
        <a href="{{ route('cart.index') }}" class="btn btn-outline-light mb-2">Shopping Cart</a>
      </div>
    </div>
  </div>
</div>
@endsection
