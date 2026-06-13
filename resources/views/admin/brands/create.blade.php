@extends('admin.layouts.app')

@section('content')
<h1 class="page-title mb-4">Add Brand</h1>
<div class="card-custom p-4">
  <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">@csrf
    <div class="mb-3"><label class="form-label">Name</label><input type="text" name="name" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">Slug</label><input type="text" name="slug" class="form-control"></div>
    <div class="mb-3"><label class="form-label">Logo</label><input type="file" name="logo" class="form-control"></div>
    <div class="mb-3"><label class="form-label">Status</label><select name="status" class="form-select"><option value="active">Active</option><option value="inactive">Inactive</option></select></div>
    <button type="submit" class="btn btn-custom-primary">Save</button>
  </form>
</div>
@endsection
