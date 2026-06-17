@extends('admin.layouts.app')

@section('content')
<h1 class="page-title mb-4">Order #{{ $order->order_number }}</h1>
<div class="row g-4">
  <div class="col-lg-8">
    <div class="card-custom p-4">
      <h5>Order Items</h5>
      <table class="table"><thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th></tr></thead>
      <tbody>
        @foreach($order->items as $item)
        <tr>
          <td>{{ $item->product->name }}</td>
          <td>{{ format_pkr($item->price) }}</td>
          <td>{{ $item->quantity }}</td>
          <td>{{ format_pkr($item->price * $item->quantity) }}</td>
        </tr>
        @endforeach
      </tbody></table>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card-custom p-4">
      <p><strong>Customer:</strong> {{ $order->customerName() }}@if(!$order->user_id) <span class="badge bg-secondary">Guest</span>@endif</p>
      <p><strong>Email:</strong> {{ $order->customerEmail() }}</p>
      <p><strong>Phone:</strong> {{ $order->phone }}</p>
      <p><strong>City:</strong> {{ $order->city }}</p>
      <p><strong>Address:</strong> {{ $order->address }}</p>
      <p><strong>Total:</strong> {{ format_pkr($order->total_amount) }}</p>
      <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="mt-3">@csrf @method('PUT')
        <label>Order Status</label>
        <select name="order_status" class="form-select mb-2">@foreach(['pending','processing','shipped','delivered','cancelled'] as $s)<option value="{{ $s }}" @selected($order->order_status===$s)>{{ ucfirst($s) }}</option>@endforeach</select>
        <label>Payment Status</label>
        <select name="payment_status" class="form-select mb-2"><option value="pending" @selected($order->payment_status==='pending')>Pending</option><option value="paid" @selected($order->payment_status==='paid')>Paid</option></select>
        <button type="submit" class="btn btn-custom-primary w-100">Update Order</button>
      </form>
      <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="mt-3" onsubmit="return confirm('Delete this order permanently?')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-outline-danger w-100">
          <i class="bi bi-trash me-1"></i> Delete Order
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
