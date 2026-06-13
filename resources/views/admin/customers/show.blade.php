@extends('admin.layouts.app')

@section('content')
<h1 class="page-title mb-4">{{ $customer->name }}</h1>
<div class="card-custom p-4 mb-4">
  <p><strong>Email:</strong> {{ $customer->email }}</p>
  <p><strong>Phone:</strong> {{ $customer->phone }}</p>
</div>
<h5>Order History</h5>
<div class="card-custom p-3">
  <table class="table">
    <thead><tr><th>Order #</th><th>Total</th><th>Status</th><th>Date</th></tr></thead>
    <tbody>
      @forelse($customer->orders as $order)
      <tr>
        <td><a href="{{ route('admin.orders.show', $order) }}">{{ $order->order_number }}</a></td>
        <td>{{ format_pkr($order->total_amount) }}</td>
        <td>{{ $order->order_status }}</td>
        <td>{{ $order->created_at->format('M d, Y') }}</td>
      </tr>
      @empty
      <tr><td colspan="4">No orders.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
