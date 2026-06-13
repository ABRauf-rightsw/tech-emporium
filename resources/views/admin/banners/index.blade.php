@extends('admin.layouts.app')

@section('title', 'Banners | Admin')

@section('content')
<h1 class="page-title mb-4">Banners</h1>

<div class="card-custom p-4">
  <h5 class="mb-3">Homepage Hero Background</h5>
  <p class="text-muted small mb-4">Upload a new background image for the homepage hero section. Images are automatically compressed before saving.</p>

  <div class="mb-4 border rounded p-3 bg-light">
    <p class="small text-muted mb-2">Current preview</p>
    <img src="{{ asset($heroBackground) }}" alt="Hero background" class="img-fluid rounded border" style="max-height: 220px; object-fit: cover; width: 100%;">
  </div>

  <form action="{{ route('admin.banners.hero.update') }}" method="POST" enctype="multipart/form-data" class="mb-3">
    @csrf
    <div class="mb-3">
      <label class="form-label">Upload new hero background</label>
      <input type="file" name="hero_background" class="form-control" accept="image/*" required>
      <div class="form-text">Recommended: wide landscape image (1920×600 or larger). Max 8MB.</div>
    </div>
    <button type="submit" class="btn btn-custom-primary">Save Hero Background</button>
  </form>

  @if($heroBackground !== \App\Models\SiteSetting::DEFAULT_HERO_BACKGROUND)
  <form action="{{ route('admin.banners.hero.remove') }}" method="POST" onsubmit="return confirm('Reset to default hero background?')">
    @csrf @method('DELETE')
    <button type="submit" class="btn btn-custom-outline text-danger">Reset to Default</button>
  </form>
  @endif
</div>
@endsection
