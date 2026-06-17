@extends('admin.layouts.app')

@section('content')
<h1 class="page-title mb-4">Edit Category</h1>
<div class="card-custom p-4">
  <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
    <div class="mb-3"><label class="form-label">Name</label><input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required></div>
    <div class="mb-3"><label class="form-label">Slug</label><input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}"></div>
    <div class="mb-3"><label class="form-label">Image</label><input type="file" name="image" class="form-control">@if($category->image)<img src="{{ $category->image_url }}" width="60" class="mt-2" alt="">@endif</div>
    <div class="mb-3"><label class="form-label">Status</label><select name="status" class="form-select"><option value="active" @selected($category->status==='active')>Active</option><option value="inactive" @selected($category->status==='inactive')>Inactive</option></select></div>
    <button type="submit" class="btn btn-custom-primary">Update</button>
  </form>
</div>
@endsection
