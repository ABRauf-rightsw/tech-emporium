@extends('frontend.layouts.app', ['mainMargin' => '100px'])

@section('seo_title', 'FAQ | Shipping, Payments & Warranty | Tech Emporium')
@section('meta_description', 'Find answers about Tech Emporium delivery times, payment methods (COD, Easypaisa, JazzCash), official warranty, and 7-day return policy in Pakistan.')

@push('json_ld')
  @include('frontend.partials.schema.faq')
  @include('frontend.partials.schema.breadcrumb', ['items' => [
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'FAQ', 'url' => route('faq')],
  ]])
@endpush

@section('content')
<div class="container mb-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb small">
      <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-electric">Home</a></li>
      <li class="breadcrumb-item active text-white">Help FAQ</li>
    </ol>
  </nav>
  <div class="row mb-5 text-center">
    <div class="col-md-8 mx-auto">
      <h1 class="text-white mb-2">Help &amp; Support FAQ</h1>
      <p class="text-muted">Common questions regarding shipment, payments, warranties, and returns.</p>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
          <h2 class="accordion-header"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"><i class="bi bi-truck me-2 text-electric"></i>How long does delivery take?</button></h2>
          <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
            <div class="accordion-body">Flat-rate delivery of Rs. 250 across Pakistan. FREE shipping for orders above Rs. 10,000. Karachi: 24-48 hours. Lahore/Islamabad: 2-3 business days.</div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"><i class="bi bi-credit-card me-2 text-electric"></i>What payment options do you support?</button></h2>
          <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body">Cash On Delivery, Bank Transfer, Easypaisa, and JazzCash.</div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree"><i class="bi bi-shield-check me-2 text-electric"></i>How does warranty work?</button></h2>
          <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body">All products come with official manufacturer warranty cards. Claim at authorized service centers nationwide.</div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour"><i class="bi bi-arrow-left-right me-2 text-electric"></i>Return policy?</button></h2>
          <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
            <div class="accordion-body">7-Day Replacement Policy for manufacturing defects or shipping damages. Original packaging required.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
