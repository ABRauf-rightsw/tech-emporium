<aside id="admin-sidebar">
  <div class="sidebar-brand">
    <a class="d-flex align-items-center gap-2 text-white" href="{{ route('admin.dashboard') }}">
      <i class="bi bi-cpu text-primary fs-4"></i>
      <span>TECH <span class="text-primary">EMPORIUM</span></span>
    </a>
  </div>
  <div class="sidebar-menu">
    <div class="menu-label">Main Menu</div>
    <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i><span>Dashboard</span></a>
    <div class="menu-label mt-4">Catalog</div>
    <a href="{{ route('admin.products.index') }}" class="menu-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"><i class="bi bi-box-seam"></i><span>Products</span></a>
    <a href="{{ route('admin.categories.index') }}" class="menu-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"><i class="bi bi-grid"></i><span>Categories</span></a>
    <a href="{{ route('admin.brands.index') }}" class="menu-item {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}"><i class="bi bi-award"></i><span>Brands</span></a>
    <a href="{{ route('admin.inventory') }}" class="menu-item"><i class="bi bi-journal-text"></i><span>Inventory</span></a>
    <div class="menu-label mt-4">Sales &amp; Customers</div>
    <a href="{{ route('admin.orders.index') }}" class="menu-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}"><i class="bi bi-cart3"></i><span>Orders</span></a>
    <a href="{{ route('admin.customers.index') }}" class="menu-item {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}"><i class="bi bi-people"></i><span>Customers</span></a>
    <a href="{{ route('admin.sellers') }}" class="menu-item"><i class="bi bi-shop"></i><span>Sellers</span></a>
    <div class="menu-label mt-4">Marketing</div>
    <a href="{{ route('admin.reviews') }}" class="menu-item"><i class="bi bi-star"></i><span>Reviews</span></a>
    <a href="{{ route('admin.coupons') }}" class="menu-item"><i class="bi bi-percent"></i><span>Coupons</span></a>
    <a href="{{ route('admin.banners.index') }}" class="menu-item {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}"><i class="bi bi-image"></i><span>Banners</span></a>
    <div class="menu-label mt-4">Management</div>
    <a href="{{ route('admin.reports') }}" class="menu-item"><i class="bi bi-bar-chart"></i><span>Reports</span></a>
    <a href="{{ route('admin.settings') }}" class="menu-item"><i class="bi bi-gear"></i><span>Settings</span></a>
    <a href="{{ route('admin.profile') }}" class="menu-item"><i class="bi bi-person"></i><span>Profile</span></a>
  </div>
  <div class="sidebar-footer">
    <form action="{{ route('admin.logout') }}" method="POST">
      @csrf
      <button type="submit" class="menu-item text-danger w-100 border-0 bg-transparent"><i class="bi bi-box-arrow-right text-danger"></i><span>Logout</span></button>
    </form>
  </div>
</aside>
