@extends('admin.layouts.app')

@section('content')
<h1 class="page-title mb-4">Customers</h1>
<div class="card-custom p-3">
  <table class="table table-hover">
    <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Orders</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach($customers as $customer)
      <tr>
        <td>{{ $customer->name }}</td>
        <td>{{ $customer->email }}</td>
        <td>{{ $customer->phone }}</td>
        <td>{{ $customer->orders_count }}</td>
        <td><a href="{{ route('admin.customers.show', $customer) }}" class="btn btn-sm btn-custom-outline">View</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $customers->links() }}
</div>
@endsection
