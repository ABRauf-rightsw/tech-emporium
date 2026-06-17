@extends('admin.layouts.app')

@section('title', 'Products | Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h1 class="page-title mb-0">Products</h1>
  <a href="{{ route('admin.products.create') }}" class="btn btn-custom-primary"><i class="bi bi-plus-lg me-1"></i> Add Product</a>
</div>
<div class="card-custom p-3">
  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead><tr><th>Image</th><th>Name</th><th>Category</th><th>Brand</th><th>Price</th><th>Stock</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach($products as $product)
        <tr>
          <td><img src="{{ $product->image_url }}" width="40" alt=""></td>
          <td>{{ $product->name }}</td>
          <td>{{ $product->category->name }}</td>
          <td>{{ $product->brand->name }}</td>
          <td>{{ format_pkr($product->effective_price) }}</td>
          <td>{{ $product->stock }}</td>
          <td><span class="badge bg-{{ $product->status === 'active' ? 'success' : 'secondary' }}">{{ $product->status }}</span></td>
          <td>
            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-custom-outline">Edit</a>
            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  {{ $products->links() }}
</div>
@endsection
