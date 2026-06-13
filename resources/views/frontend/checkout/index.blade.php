@extends('frontend.layouts.app', ['mainMargin' => '100px'])

@section('seo_title', 'Checkout | Tech Emporium')

@section('content')
<div class="container mb-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb small">
      <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-electric">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('cart.index') }}" class="text-electric">Cart</a></li>
      <li class="breadcrumb-item active text-white">Checkout</li>
    </ol>
  </nav>
  <h1 class="text-white mb-4">Secure Checkout</h1>

  <form action="{{ route('checkout.place') }}" method="POST" id="checkout-form">
    @csrf
    <div class="row g-4">
      <div class="col-lg-7">
        <div class="card glass-card p-4 border border-secondary mb-4">
          <h4 class="text-white mb-3"><i class="bi bi-person-lines-fill text-electric me-2"></i>Billing Information</h4>
          <div class="row g-3">
            <div class="col-md-12">
              <label for="billing-name" class="form-label text-muted small">Full Name</label>
              <input type="text" class="form-control custom-input" id="billing-name" name="billing-name" value="{{ old('billing-name', auth()->user()?->name) }}" required>
            </div>
            <div class="col-md-6">
              <label for="billing-email" class="form-label text-muted small">Email Address</label>
              <input type="email" class="form-control custom-input" id="billing-email" name="billing-email" value="{{ old('billing-email', auth()->user()?->email) }}" required>
            </div>
            <div class="col-md-6">
              <label for="billing-phone" class="form-label text-muted small">Phone Number</label>
              <input type="text" class="form-control custom-input" id="billing-phone" name="billing-phone" value="{{ old('billing-phone', auth()->user()?->phone) }}" required>
            </div>
            <div class="col-md-6">
              <label for="billing-city" class="form-label text-muted small">City</label>
              <select class="form-select custom-select" id="billing-city" name="billing-city" required>
                @foreach(['Karachi','Lahore','Islamabad','Rawalpindi','Faisalabad','Multan','Peshawar'] as $city)
                <option value="{{ $city }}" @selected(old('billing-city', 'Lahore') === $city)>{{ $city }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-12">
              <label for="billing-address" class="form-label text-muted small">Street Address</label>
              <textarea class="form-control custom-input" id="billing-address" name="billing-address" rows="3" required>{{ old('billing-address') }}</textarea>
            </div>
          </div>
        </div>
        <div class="card glass-card p-4 border border-secondary">
          <h4 class="text-white mb-3"><i class="bi bi-wallet2 text-electric me-2"></i>Payment Methods</h4>
          <div class="row g-3">
            @foreach(['cod' => 'Cash On Delivery (COD)', 'bank' => 'Bank Transfer', 'easypaisa' => 'Easypaisa Mobile Wallet', 'jazzcash' => 'JazzCash Mobile Wallet'] as $val => $label)
            <div class="col-md-6">
              <div class="payment-box">
                <input class="form-check-input me-2" type="radio" name="paymentMethod" id="pay-{{ $val }}" value="{{ $val }}" @checked(old('paymentMethod', 'cod') === $val)>
                <label class="form-check-label text-white" for="pay-{{ $val }}"><strong>{{ $label }}</strong></label>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="card glass-card p-4 border border-secondary sticky-lg-top" style="top: 100px;">
          <h4 class="text-white mb-4 border-bottom border-secondary pb-2">Order Summary</h4>
          @foreach($cartItems as $item)
          <div class="d-flex justify-content-between mb-2 small">
            <span class="text-muted">{{ $item->product->name }} x{{ $item->quantity }}</span>
            <span class="text-white">{{ format_pkr($item->product->effective_price * $item->quantity) }}</span>
          </div>
          @endforeach
          <div class="d-flex justify-content-between mb-2 text-muted small mt-3"><span>Subtotal:</span><span class="text-white">{{ format_pkr($subtotal) }}</span></div>
          <div class="d-flex justify-content-between mb-2 text-muted small"><span>Shipping:</span><span class="text-white">{{ format_pkr($shipping) }}</span></div>
          <div class="d-flex justify-content-between mb-4 border-top border-secondary pt-3 fs-5 text-white"><span>Order Total:</span><strong class="text-orange">{{ format_pkr($total) }}</strong></div>
          <button type="submit" class="btn btn-electric w-100 py-3" id="place-order-btn">Place Order</button>
        </div>
      </div>
    </div>
  </form>
</div>

@push('scripts')
<script>
  document.getElementById('checkout-form')?.addEventListener('submit', function () {
    const btn = document.getElementById('place-order-btn');
    if (btn) {
      btn.disabled = true;
      btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Placing Order...';
    }
  });
</script>
@endpush
@endsection
