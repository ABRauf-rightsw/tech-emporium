@extends('frontend.layouts.app', ['mainMargin' => '100px'])

@section('seo_title', 'About Tech Emporium | Trusted Computer Store in Lahore')
@section('meta_description', 'Learn about Tech Emporium — Pakistan\'s premium destination for laptops, gaming hardware, and accessories since 2020. Located at Hafeez Center Lahore, 3rd Floor.')

@push('json_ld')
  @include('frontend.partials.schema.breadcrumb', ['items' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'About Us', 'url' => route('about')],
  ]])
@endpush

@section('content')
<div class="container mb-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb small">
      <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-electric">Home</a></li>
      <li class="breadcrumb-item active text-white">About Us</li>
    </ol>
  </nav>
  <section class="py-4">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="text-uppercase text-electric fw-bold small" style="letter-spacing: 2px;">ESTABLISHED IN 2020</span>
        <h1 class="text-white display-5 mb-4">Our Journey: Powering Computing in Pakistan</h1>
        <p class="text-muted fs-6">Tech Emporium was founded on a simple vision: to eliminate the gap in premium, verified, and authentic computer components available in Pakistan.</p>
        <p class="text-muted fs-6">We specialize in offering high-end laptops, custom computing assemblies, storage upgrades, and specialized peripherals.</p>
      </div>
      <div class="col-lg-6">
        <div class="p-4 border border-secondary rounded glass-card text-center" style="background:#0d1b2a;">
          <i class="bi bi-cpu text-electric" style="font-size: 8rem; opacity:0.8;"></i>
          <h3 class="text-white mt-3">Tech Emporium HQ</h3>
          <p class="text-muted mb-0 small">Hafeez Center Lahore, 3rd Floor</p>
        </div>
      </div>
    </div>
  </section>
  <section class="py-5 mt-4">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card glass-card h-100 p-4 border border-secondary">
          <h4 class="text-white"><i class="bi bi-rocket-takeoff text-orange me-2"></i>Our Core Mission</h4>
          <p class="text-muted mb-0">To simplify hardware procurement for developers, creators, gamers, and businesses with accessible PKR pricing and nationwide delivery.</p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card glass-card h-100 p-4 border border-secondary">
          <h4 class="text-white"><i class="bi bi-eye text-electric me-2"></i>Our Vision</h4>
          <p class="text-muted mb-0">To establish a standard in customer satisfaction and technical transparency across Pakistan's tech retail market.</p>
        </div>
      </div>
    </div>
  </section>
  <section class="py-5 mt-4">
    <div class="row g-4 justify-content-center">
      @foreach([['member1.svg','Haroon','Founder & CEO'],['member2.svg','Zabiullah','Chief Technology Officer'],['member3.svg','Zabiullah','Head of Customer Operations']] as $m)
      <div class="col-md-6 col-lg-4">
        <div class="card glass-card border border-secondary text-center p-4">
          <img src="{{ asset('assets/images/team/'.$m[0]) }}" alt="{{ $m[1] }}" class="mx-auto rounded-circle mb-3 border border-secondary" style="width:100px;height:100px;">
          <h5 class="text-white mb-1">{{ $m[1] }}</h5>
          <p class="text-electric small mb-0">{{ $m[2] }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </section>
</div>
@endsection
