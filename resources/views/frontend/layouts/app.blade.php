<!DOCTYPE html>
<html lang="en-PK">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ seo_title() }}</title>
  @include('frontend.partials.seo-meta')
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset_version('assets/css/style.css') }}">
  @stack('styles')
</head>
<body data-laravel="true" @yield('body-class')>

  @include('frontend.partials.navbar')

  @include('frontend.partials.alerts')

  <main style="margin-top: {{ $mainMargin ?? '76px' }};" @yield('main-class')>
    @yield('content')
  </main>

  @hasSection('footer')
    @yield('footer')
  @else
    @include('frontend.partials.footer')
  @endif

  <button id="btn-back-to-top" class="back-to-top" aria-label="Back to Top">
    <i class="bi bi-arrow-up"></i>
  </button>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset_version('assets/js/app.js') }}"></script>
  @stack('scripts')
</body>
</html>
