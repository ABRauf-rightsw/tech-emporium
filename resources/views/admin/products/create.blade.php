@extends('admin.layouts.app')

@section('title', 'Add Product | Admin')

@section('content')
<h1 class="page-title mb-4">Add Product</h1>
<div class="card-custom p-4">
  <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.products._form')
    <button type="submit" class="btn btn-custom-primary">Save Product</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-custom-outline">Cancel</a>
  </form>
</div>
@endsection
