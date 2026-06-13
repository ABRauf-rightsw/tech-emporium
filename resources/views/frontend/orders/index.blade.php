@extends('frontend.layouts.app', ['mainMargin' => '100px'])

@section('seo_title', 'My Orders | Tech Emporium')

@section('content')
<div class="container mb-5">
  <h1 class="text-white mb-4">My Orders</h1>
  @if($orders->isEmpty())
  <div class="text-center py-5 border border-secondary rounded glass-card">
    <p class="text-muted">You have not placed any orders yet.</p>
    <a href="{{ route('shop.index') }}" class="btn btn-electric">Start Shopping</a>
  </div>
  @else
  @foreach($orders as $order)
  <div class="card glass-card p-4 border border-secondary mb-3">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
      <div>
        <h5 class="text-white mb-1">Order #{{ $order->order_number }}</h5>
        <small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small>
      </div>
      <div class="text-end">
        <span class="badge bg-electric">{{ ucfirst($order->order_status) }}</span>
        <div class="text-orange fw-bold mt-1">{{ format_pkr($order->total_amount) }}</div>
      </div>
    </div>
    <ul class="list-unstyled small text-muted mb-0">
      @foreach($order->items as $item)
      <li>{{ $item->product->name }} x{{ $item->quantity }} — {{ format_pkr($item->price * $item->quantity) }}</li>
      @endforeach
    </ul>
  </div>
  @endforeach
  @endif
</div>
@endsection
