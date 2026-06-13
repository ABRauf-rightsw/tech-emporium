@extends('admin.layouts.app')

@section('content')
<h1 class="page-title mb-4">Edit Brand</h1>
<div class="card-custom p-4">
  <form action="{{ route('admin.brands.update', $brand) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
    <div class="mb-3"><label class="form-label">Name</label><input type="text" name="name" class="form-control" value="{{ old('name', $brand->name) }}" required></div>
    <div class="mb-3"><label class="form-label">Slug</label><input type="text" name="slug" class="form-control" value="{{ old('slug', $brand->slug) }}"></div>
    <div class="mb-3"><label class="form-label">Logo</label><input type="file" name="logo" class="form-control">@if($brand->logo)<img src="{{ asset($brand->logo) }}" width="60" class="mt-2">@endif</div>
    <div class="mb-3"><label class="form-label">Status</label><select name="status" class="form-select"><option value="active" @selected($brand->status==='active')>Active</option><option value="inactive" @selected($brand->status==='inactive')>Inactive</option></select></div>
    <button type="submit" class="btn btn-custom-primary">Update</button>
  </form>
</div>
@endsection
