@extends('admin.layouts.app')

@section('title', 'Edit Product | Admin')

@section('content')
<h1 class="page-title mb-4">Edit Product</h1>
<div class="card-custom p-4">
  <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('admin.products._form', ['product' => $product])
    <button type="submit" class="btn btn-custom-primary">Update Product</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-custom-outline">Cancel</a>
  </form>

  @foreach($product->images as $galleryImage)
  <form id="delete-gallery-{{ $galleryImage->id }}" action="{{ route('admin.products.images.destroy', $galleryImage) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
  </form>
  @endforeach
</div>
@endsection
