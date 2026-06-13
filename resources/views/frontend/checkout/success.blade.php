@extends('frontend.layouts.app', ['mainMargin' => '100px'])

@section('seo_title', 'Order Confirmed | Tech Emporium')

@section('content')
@if($showSuccessModal ?? false)
<div class="modal fade" id="orderSuccessModal" tabindex="-1" aria-labelledby="orderSuccessModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content order-success-modal border-0">
      <div class="modal-body text-center p-4 p-md-5">
        <div class="order-success-icon mb-3">
          <i class="bi bi-check-circle-fill"></i>
        </div>
        <h4 class="order-success-title mb-2" id="orderSuccessModalLabel">Order Placed Successfully!</h4>
        <p class="order-success-text text-muted mb-4">Your order has been placed successfully.</p>
        <p class="mb-4">
          <span class="text-muted">Order Number:</span> <strong class="text-electric">#{{ $orderModel->order_number }}</strong><br>
          <span class="text-muted small">Total: {{ format_pkr($orderModel->total_amount) }}</span>
        </p>
        <button type="button" class="btn btn-electric px-5 py-2" data-bs-dismiss="modal">Continue</button>
      </div>
    </div>
  </div>
</div>
@endif

<div class="container mb-5">
  <div class="text-center py-5">
    <div class="mb-4">
      <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
    </div>
    <h1 class="text-white mb-3">Thank You for Your Order!</h1>
    <p class="text-muted mb-4">Your order <strong class="text-electric">#{{ $orderModel->order_number }}</strong> has been placed successfully.</p>

    <div class="card glass-card p-4 border border-secondary text-start mx-auto" style="max-width: 600px;">
      <h4 class="text-white mb-3">Order Summary</h4>
      @foreach($orderModel->items as $item)
      <div class="d-flex justify-content-between mb-2 small">
        <span class="text-muted">{{ $item->product->name }} x{{ $item->quantity }}</span>
        <span class="text-white">{{ format_pkr($item->price * $item->quantity) }}</span>
      </div>
      @endforeach
      <div class="d-flex justify-content-between border-top border-secondary pt-3 mt-3 text-white">
        <span>Total</span>
        <strong class="text-orange">{{ format_pkr($orderModel->total_amount) }}</strong>
      </div>
      <p class="text-muted small mt-3 mb-0">
        A confirmation will be sent to <strong class="text-white">{{ $orderModel->customerEmail() }}</strong>.
        @guest
        <a href="{{ route('register') }}" class="text-electric">Create an account</a> to track your orders.
        @endguest
      </p>
    </div>

    <div class="mt-4 d-flex flex-wrap justify-content-center gap-3">
      <a href="{{ route('shop.index') }}" class="btn btn-electric px-4">Continue Shopping</a>
      @auth
      <a href="{{ route('orders.index') }}" class="btn btn-outline-custom px-4">View My Orders</a>
      @endauth
    </div>
  </div>
</div>

@if($showSuccessModal ?? false)
@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modalEl = document.getElementById('orderSuccessModal');
    if (modalEl) {
      bootstrap.Modal.getOrCreateInstance(modalEl).show();
    }
  });
</script>
@endpush
@endif
@endsection
