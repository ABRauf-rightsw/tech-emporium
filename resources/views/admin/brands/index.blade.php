@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-4">
  <h1 class="page-title mb-0">Brands</h1>
  <a href="{{ route('admin.brands.create') }}" class="btn btn-custom-primary">Add Brand</a>
</div>
<div class="card-custom p-3">
  <table class="table table-hover">
    <thead><tr><th>Logo</th><th>Name</th><th>Slug</th><th>Products</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach($brands as $brand)
      <tr>
        <td><img src="{{ asset($brand->logo) }}" width="40" alt=""></td>
        <td>{{ $brand->name }}</td>
        <td>{{ $brand->slug }}</td>
        <td>{{ $brand->products_count }}</td>
        <td>
          <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-sm btn-custom-outline">Edit</a>
          <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Delete</button></form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $brands->links() }}
</div>
@endsection
