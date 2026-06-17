@php $product = $product ?? null; @endphp
<div class="row g-3">
  <div class="col-md-6"><label class="form-label">Name</label><input type="text" name="name" class="form-control" value="{{ old('name', $product?->name) }}" required></div>
  <div class="col-md-6"><label class="form-label">Slug</label><input type="text" name="slug" class="form-control" value="{{ old('slug', $product?->slug) }}"></div>
  <div class="col-12">
    <label class="form-label">Description</label>
    <textarea name="description" id="product-description" class="form-control" rows="6">{!! old('description', $product?->description ?? '') !!}</textarea>
    <small class="text-muted">Use lists, bold text, and headings — formatting will appear the same on the product page.</small>
  </div>
  <div class="col-md-4"><label class="form-label">Price (PKR)</label><input type="number" name="price" class="form-control" value="{{ old('price', $product?->price) }}" required></div>
  <div class="col-md-4"><label class="form-label">Sale Price (PKR)</label><input type="number" name="sale_price" class="form-control" value="{{ old('sale_price', $product?->sale_price) }}"></div>
  <div class="col-md-4"><label class="form-label">Stock</label><input type="number" name="stock" class="form-control" value="{{ old('stock', $product?->stock ?? 0) }}" required></div>
  <div class="col-md-6"><label class="form-label">Category</label><select name="category_id" class="form-select" required>@foreach($categories as $cat)<option value="{{ $cat->id }}" @selected(old('category_id', $product?->category_id) == $cat->id)>{{ $cat->name }}</option>@endforeach</select></div>
  <div class="col-md-6"><label class="form-label">Brand</label><select name="brand_id" class="form-select" required>@foreach($brands as $brand)<option value="{{ $brand->id }}" @selected(old('brand_id', $product?->brand_id) == $brand->id)>{{ $brand->name }}</option>@endforeach</select></div>
  <div class="col-md-6"><label class="form-label">Image</label><input type="file" name="image" class="form-control">@if($product?->image)<img src="{{ $product->image_url }}" width="60" class="mt-2" alt="">@endif</div>
  <div class="col-md-6">
    <label class="form-label">Gallery Images</label>
    <input type="file" name="gallery[]" class="form-control" multiple>
    @if($product?->images?->count())
    <div class="d-flex flex-wrap gap-2 mt-2">
      @foreach($product->images as $galleryImage)
      <div class="position-relative border rounded p-1">
        <img src="{{ $galleryImage->image_url }}" width="60" alt="">
        <form action="{{ route('admin.products.images.destroy', $galleryImage) }}" method="POST" class="mt-1">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-sm btn-outline-danger w-100" onclick="return confirm('Remove this image?')">Remove</button>
        </form>
      </div>
      @endforeach
    </div>
    @endif
  </div>
  <div class="col-md-4"><label class="form-label">Status</label><select name="status" class="form-select"><option value="active" @selected(old('status', $product?->status ?? 'active') === 'active')>Active</option><option value="inactive" @selected(old('status', $product?->status) === 'inactive')>Inactive</option></select></div>
  <div class="col-md-4"><div class="form-check mt-4"><input type="checkbox" name="is_featured" value="1" class="form-check-input" id="featured" @checked(old('is_featured', $product?->is_featured))><label class="form-check-label" for="featured">Featured</label></div></div>
  <div class="col-md-4"><div class="form-check mt-4"><input type="checkbox" name="is_best_seller" value="1" class="form-check-input" id="bestseller" @checked(old('is_best_seller', $product?->is_best_seller))><label class="form-check-label" for="bestseller">Best Seller</label></div></div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css">
<style>
  .note-editor.note-frame {
    border-color: rgba(0, 102, 255, 0.15);
    border-radius: 8px;
    overflow: hidden;
  }
  .note-toolbar {
    background: #f8fafc;
    border-bottom-color: rgba(0, 102, 255, 0.1);
  }
  .note-editable {
    min-height: 180px;
    font-size: 0.95rem;
    line-height: 1.6;
  }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  $('#product-description').summernote({
    height: 220,
    placeholder: 'Write product description with bullet points, numbering, bold text...',
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'italic', 'underline', 'clear']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['insert', ['link']],
      ['view', ['fullscreen', 'codeview', 'help']]
    ],
    styleTags: ['p', 'h3', 'h4', 'h5'],
  });
});
</script>
@endpush
