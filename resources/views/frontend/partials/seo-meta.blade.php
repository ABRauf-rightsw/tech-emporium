@php
  $seoTitle = seo_title();
  $seoDescription = seo_description();
  $seoKeywords = seo_keywords();
  $seoCanonical = trim((string) $__env->yieldContent('canonical')) ?: seo_canonical_url();
  $seoRobots = seo_robots();
  $seoOgType = seo_og_type();
  $seoOgImage = seo_og_image();
  $siteName = config('seo.site_name');
@endphp
<meta name="description" content="{{ $seoDescription }}">
<meta name="keywords" content="{{ $seoKeywords }}">
<meta name="author" content="{{ $siteName }}">
<meta name="theme-color" content="#0066ff">
<meta name="robots" content="{{ $seoRobots }}">
<meta name="googlebot" content="{{ $seoRobots }}">
<link rel="canonical" href="{{ $seoCanonical }}">

<meta property="og:locale" content="{{ config('seo.locale') }}">
<meta property="og:type" content="{{ $seoOgType }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="{{ $seoTitle }}">
<meta property="og:description" content="{{ $seoDescription }}">
<meta property="og:url" content="{{ $seoCanonical }}">
<meta property="og:image" content="{{ $seoOgImage }}">
<meta property="og:image:alt" content="{{ $siteName }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoTitle }}">
<meta name="twitter:description" content="{{ $seoDescription }}">
<meta name="twitter:image" content="{{ $seoOgImage }}">
@if(config('seo.twitter_handle'))
<meta name="twitter:site" content="{{ config('seo.twitter_handle') }}">
@endif

<meta name="geo.region" content="PK-PB">
<meta name="geo.placename" content="Lahore">
<meta name="geo.position" content="31.5204;74.3587">
<meta name="ICBM" content="31.5204, 74.3587">

<link rel="alternate" hreflang="en-pk" href="{{ $seoCanonical }}">
<link rel="alternate" hreflang="x-default" href="{{ $seoCanonical }}">

@include('frontend.partials.schema.organization')

@stack('json_ld')
