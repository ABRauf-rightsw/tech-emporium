@extends('admin.layouts.app')

@section('title', 'Dashboard | Tech Emporium Admin')

@section('content')
<div class="page-title-box d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
  <div>
    <h1 class="page-title">Dashboard Overview</h1>
    <p class="text-muted small mb-0">Real-time statistics for Tech Emporium.</p>
  </div>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-4">
  <div class="col"><div class="card-custom stat-card"><div class="stat-info"><p>Total Revenue</p><h3>{{ format_pkr($totalRevenue) }}</h3></div><div class="stat-icon bg-success-light text-success"><i class="bi bi-cash-stack"></i></div></div></div>
  <div class="col"><div class="card-custom stat-card"><div class="stat-info"><p>Total Orders</p><h3>{{ $totalOrders }}</h3></div><div class="stat-icon bg-primary-light text-primary"><i class="bi bi-cart-check"></i></div></div></div>
  <div class="col"><div class="card-custom stat-card"><div class="stat-info"><p>Total Customers</p><h3>{{ $totalCustomers }}</h3></div><div class="stat-icon bg-info-light text-info"><i class="bi bi-people"></i></div></div></div>
  <div class="col"><div class="card-custom stat-card"><div class="stat-info"><p>Total Products</p><h3>{{ $totalProducts }}</h3></div><div class="stat-icon bg-warning-light text-warning"><i class="bi bi-box-seam"></i></div></div></div>
  <div class="col"><div class="card-custom stat-card"><div class="stat-info"><p>Pending Orders</p><h3>{{ $pendingOrders }}</h3></div><div class="stat-icon bg-warning-light text-warning"><i class="bi bi-hourglass-split"></i></div></div></div>
  <div class="col"><div class="card-custom stat-card"><div class="stat-info"><p>Completed Orders</p><h3>{{ $completedOrders }}</h3></div><div class="stat-icon bg-success-light text-success"><i class="bi bi-truck"></i></div></div></div>
  <div class="col"><div class="card-custom stat-card"><div class="stat-info"><p>Low Stock Items</p><h3>{{ $lowStock }}</h3></div><div class="stat-icon bg-danger-light text-danger"><i class="bi bi-graph-down"></i></div></div></div>
</div>

<div class="row g-4">
  <div class="col-lg-8">
    <div class="card-custom p-4">
      <h5 class="mb-3">Recent Orders</h5>
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead><tr><th>Order #</th><th>Customer</th><th>Amount</th><th>Status</th></tr></thead>
          <tbody>
            @forelse($recentOrders as $order)
            <tr>
              <td><a href="{{ route('admin.orders.show', $order) }}">{{ $order->order_number }}</a></td>
              <td>{{ $order->customerName() }}</td>
              <td>{{ format_pkr($order->total_amount) }}</td>
              <td><span class="badge bg-secondary">{{ ucfirst($order->order_status) }}</span></td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-muted">No orders yet.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card-custom p-4">
      <h5 class="mb-3">Recent Products</h5>
      @foreach($recentProducts as $product)
      <div class="d-flex align-items-center gap-2 mb-3">
        <img src="{{ $product->image_url }}" width="40" alt="">
        <div><div class="small fw-bold">{{ Str::limit($product->name, 30) }}</div><div class="text-muted small">{{ format_pkr($product->effective_price) }}</div></div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
