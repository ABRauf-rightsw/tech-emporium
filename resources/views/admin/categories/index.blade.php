@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-4">
  <h1 class="page-title mb-0">Categories</h1>
  <a href="{{ route('admin.categories.create') }}" class="btn btn-custom-primary">Add Category</a>
</div>
<div class="card-custom p-3">
  <table class="table table-hover">
    <thead><tr><th>Name</th><th>Slug</th><th>Products</th><th>Status</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach($categories as $category)
      <tr>
        <td>{{ $category->name }}</td>
        <td>{{ $category->slug }}</td>
        <td>{{ $category->products_count }}</td>
        <td>{{ $category->status }}</td>
        <td>
          <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-custom-outline">Edit</a>
          <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Delete</button></form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $categories->links() }}
</div>
@endsection
