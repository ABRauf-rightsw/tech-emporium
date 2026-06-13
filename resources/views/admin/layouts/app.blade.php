<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin | Tech Emporium')</title>
  <meta name="robots" content="noindex, nofollow">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('admin/assets/css/admin-style.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  @stack('styles')
</head>
<body>
  <div id="admin-wrapper">
    @include('admin.partials.sidebar')
    <div class="sidebar-overlay"></div>
    <div id="admin-content">
      <header id="admin-header">
        <div class="d-flex align-items-center gap-3">
          <button class="header-toggle" id="sidebarToggle" aria-label="Toggle Sidebar"><i class="bi bi-justify"></i></button>
        </div>
        <div class="header-actions">
          <div class="dropdown profile-dropdown">
            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">
              <div class="profile-info d-none d-lg-block">
                <span class="profile-name">{{ auth()->user()->name }}</span>
                <span class="profile-role">Admin</span>
              </div>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <form action="{{ route('admin.logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right"></i> Logout</button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </header>
      <main class="content-body">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @yield('content')
      </main>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('admin/assets/js/admin.js') }}"></script>
  @stack('scripts')
</body>
</html>
