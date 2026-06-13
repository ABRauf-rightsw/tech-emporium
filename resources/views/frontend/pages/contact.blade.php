@extends('frontend.layouts.app', ['mainMargin' => '100px'])

@section('seo_title', 'Contact Tech Emporium | Hafeez Center Lahore')
@section('meta_description', 'Contact Tech Emporium for laptop and accessory inquiries. Visit Hafeez Center Lahore, 3rd Floor, or call +92 (21) 111-832-436. Email: sales@techemporiumpk.com')

@push('json_ld')
  @include('frontend.partials.schema.breadcrumb', ['items' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Contact', 'url' => route('contact')],
  ]])
@endpush

@section('content')
<div class="container mb-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb small">
      <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-electric">Home</a></li>
      <li class="breadcrumb-item active text-white">Contact Us</li>
    </ol>
  </nav>
  <h1 class="text-white mb-4">Contact Support</h1>
  <div class="row g-5">
    <section class="col-lg-7">
      <div class="card glass-card p-4 border border-secondary">
        <h4 class="text-white mb-3"><i class="bi bi-envelope-check text-electric me-2"></i>Send an Inquiry</h4>
        <form id="contact-inquiry-form" onsubmit="event.preventDefault(); alert('Message sent! We will reply shortly.');">
          <div class="row g-3">
            <div class="col-md-6"><label class="form-label text-muted small">Your Name</label><input type="text" class="form-control custom-input" required></div>
            <div class="col-md-6"><label class="form-label text-muted small">Email</label><input type="email" class="form-control custom-input" required></div>
            <div class="col-md-12"><label class="form-label text-muted small">Subject</label><input type="text" class="form-control custom-input" required></div>
            <div class="col-md-12"><label class="form-label text-muted small">Message</label><textarea class="form-control custom-input" rows="5" required></textarea></div>
          </div>
          <button type="submit" class="btn btn-electric w-100 py-3 mt-4">Send Message<i class="bi bi-send-fill ms-2"></i></button>
        </form>
      </div>
    </section>
    <section class="col-lg-5">
      <div class="card glass-card p-4 border border-secondary">
        <h4 class="text-white mb-3">Contact Coordinates</h4>
        <ul class="list-unstyled mb-0">
          <li class="d-flex gap-3 mb-4"><i class="bi bi-geo-alt-fill text-electric fs-3"></i><div><h6 class="text-white">Store Location</h6><p class="text-muted small mb-0">Hafeez Center Lahore, 3rd Floor</p></div></li>
          <li class="d-flex gap-3 mb-4"><i class="bi bi-telephone-fill text-electric fs-3"></i><div><h6 class="text-white">Helpline</h6><p class="text-muted small mb-0">+92 (21) 111-832-436</p></div></li>
          <li class="d-flex gap-3"><i class="bi bi-envelope-fill text-electric fs-3"></i><div><h6 class="text-white">Email</h6><p class="text-muted small mb-0"><a href="mailto:sales@techemporiumpk.com" class="text-muted">sales@techemporiumpk.com</a></p></div></li>
        </ul>
      </div>
    </section>
  </div>
</div>
@endsection
