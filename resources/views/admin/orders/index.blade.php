@extends('admin.layouts.app')

@section('content')
<h1 class="page-title mb-4">Orders</h1>
<div class="card-custom p-3">
  <table class="table table-hover">
    <thead><tr><th>Order #</th><th>Customer</th><th>Total</th><th>Payment</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach($orders as $order)
      <tr>
        <td>{{ $order->order_number }}</td>
        <td>{{ $order->customerName() }}@if(!$order->user_id) <span class="badge bg-secondary">Guest</span>@endif</td>
        <td>{{ format_pkr($order->total_amount) }}</td>
        <td>{{ strtoupper($order->payment_method) }} / {{ $order->payment_status }}</td>
        <td>
          <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="d-flex gap-1">@csrf @method('PUT')
            <select name="order_status" class="form-select form-select-sm" onchange="this.form.submit()">
              @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
              <option value="{{ $s }}" @selected($order->order_status === $s)>{{ ucfirst($s) }}</option>
              @endforeach
            </select>
          </form>
        </td>
        <td>{{ $order->created_at->format('M d, Y') }}</td>
        <td class="text-nowrap">
          <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-custom-outline">View</a>
          <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete order #{{ $order->order_number }}? This cannot be undone.')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $orders->links() }}
</div>
@endsection
