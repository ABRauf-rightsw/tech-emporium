<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | Tech Emporium</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('admin/assets/css/admin-style.css') }}">
</head>
<body>
  <div class="login-bg">
    <div class="login-glass-card text-center text-white">
      <div class="mb-4">
        <i class="bi bi-cpu text-primary" style="font-size: 3rem;"></i>
        <h4 class="mt-2 fw-bold text-uppercase">Tech <span class="text-primary">Emporium</span></h4>
        <p class="text-white-50 small">Admin Management Portal</p>
      </div>
      @if($errors->any())
      <div class="alert alert-danger text-start small">{{ $errors->first() }}</div>
      @endif
      <form action="{{ route('admin.login') }}" method="POST" class="text-start">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label small text-white-50">Email Address</label>
          <input type="email" id="email" name="email" class="form-control border-secondary-subtle text-white" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label small text-white-50">Password</label>
          <input type="password" id="password" name="password" class="form-control border-secondary-subtle text-white" required>
        </div>
        <div class="mb-4 form-check">
          <input type="checkbox" class="form-check-input" name="remember" id="rememberMe">
          <label class="form-check-label small text-white-50" for="rememberMe">Remember me</label>
        </div>
        <button type="submit" class="btn btn-custom-primary w-100 py-2"><i class="bi bi-box-arrow-in-right me-2"></i>Sign In to Dashboard</button>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('admin/assets/js/admin.js') }}"></script>
</body>
</html>
