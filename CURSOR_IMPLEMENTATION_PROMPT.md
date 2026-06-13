# Tech Emporium — Laravel 10 E-Commerce Full Implementation Prompt

> **How to use in Cursor:** Paste this entire document into a new Agent chat, or reference it with `@CURSOR_IMPLEMENTATION_PROMPT.md`. Attach `@tech-emporium` and `@tech-emporium/admin` for the static HTML/CSS/JS source files.

---

## Mission

Convert the existing **Tech Emporium** static HTML e-commerce UI into a **fully functional Laravel 10 e-commerce system** with database-backed products, authentication, cart, checkout, orders, wishlist, and admin panel — **without redesigning any UI**.

---

## Current Project State (read before coding)

| Item | Status |
|------|--------|
| Laravel root | `C:\laragon\www\tech-emporium` |
| Framework | `composer.json` shows **Laravel 9** (`^9.19`) — upgrade to **Laravel 10** first if not already done |
| Routes | Only default `Route::get('/')` → `welcome` in `routes/web.php` |
| Blade views | Only `resources/views/welcome.blade.php` exists |
| Static frontend HTML | `tech-emporium/*.html` (14 pages) |
| Static admin HTML | `tech-emporium/admin/*.html` (20 pages) |
| Frontend assets | `tech-emporium/assets/` (css, js, images) |
| Admin assets | `tech-emporium/admin/assets/` (css, js) |
| Client-side data | `tech-emporium/assets/js/app.js` — 17 products in `PRODUCT_CATALOG`, cart/wishlist/orders in `localStorage` |
| Database | Default `users` migration only; no e-commerce tables |
| Auth | Not installed (no Breeze/Fortify) |

---

## ABSOLUTE RULES

1. **DO NOT redesign UI** — preserve all HTML structure, CSS classes, Bootstrap layout, glassmorphism theme, and JS animations.
2. **ONLY integrate backend logic** into existing markup.
3. **Extract repeated markup** into Blade layouts/partials — do not change visual output.
4. **All prices in PKR** — format: `Rs. {{ number_format($price) }}`
5. **Move static assets to `public/`** — never serve from `tech-emporium/` folder in production.
6. **Replace `localStorage` cart/wishlist/orders** with database + authenticated sessions.
7. **Keep non-core admin pages** (inventory, sellers, reviews, coupons, banners, reports, settings, profile) as **UI-only stubs** with sidebar links intact — no backend required unless trivial.
8. **Use Laravel conventions** — Form Requests, Eloquent relationships, named routes, `@csrf`, flash messages matching existing alert styles.
9. **Implement in phases** (see Phase Order below) — complete and test each phase before moving on.

---

## Phase 0 — Project Setup

### 0.1 Upgrade to Laravel 10 (if needed)

```bash
composer require laravel/framework:^10.0
# Follow official Laravel 10 upgrade guide for breaking changes
php artisan --version  # must show Laravel 10.x
```

### 0.2 Move Assets to Public

```
public/assets/          ← copy from tech-emporium/assets/
public/admin/assets/    ← copy from tech-emporium/admin/assets/
```

Update all asset references in Blade:

```blade
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<script src="{{ asset('assets/js/app.js') }}"></script>
<img src="{{ asset('assets/images/laptops/dell-xps.svg') }}" alt="...">
```

Admin:

```blade
<link rel="stylesheet" href="{{ asset('admin/assets/css/admin-style.css') }}">
<script src="{{ asset('admin/assets/js/admin.js') }}"></script>
```

### 0.3 Create Blade Directory Structure

Convert static HTML → Blade (preserve markup exactly):

**Frontend** → `resources/views/frontend/`

| Source HTML | Target Blade | Route Name |
|-------------|--------------|------------|
| `index.html` | `home/index.blade.php` | `home` |
| `products.html` | `shop/index.blade.php` | `shop.index` |
| `product-details.html` | `shop/show.blade.php` | `shop.show` |
| `categories.html` | `categories/index.blade.php` | `categories.index` |
| `cart.html` | `cart/index.blade.php` | `cart.index` |
| `checkout.html` | `checkout/index.blade.php` | `checkout.index` |
| `wishlist.html` | `wishlist/index.blade.php` | `wishlist.index` |
| `login.html` | `auth/login.blade.php` | `login` |
| `register.html` | `auth/register.blade.php` | `register` |
| `my-account.html` | `account/index.blade.php` | `account.index` |
| `orders.html` | `orders/index.blade.php` | `orders.index` |
| `about.html` | `pages/about.blade.php` | `about` |
| `contact.html` | `pages/contact.blade.php` | `contact` |
| `faq.html` | `pages/faq.blade.php` | `faq` |

**Admin** → `resources/views/admin/`

| Source HTML | Target Blade | Route Name |
|-------------|--------------|------------|
| `admin/login.html` | `auth/login.blade.php` | `admin.login` |
| `admin/dashboard.html` | `dashboard/index.blade.php` | `admin.dashboard` |
| `admin/products.html` | `products/index.blade.php` | `admin.products.index` |
| `admin/add-product.html` | `products/create.blade.php` | `admin.products.create` |
| `admin/edit-product.html` | `products/edit.blade.php` | `admin.products.edit` |
| `admin/categories.html` | `categories/index.blade.php` | `admin.categories.index` |
| `admin/add-category.html` | `categories/create.blade.php` | `admin.categories.create` |
| `admin/brands.html` | `brands/index.blade.php` | `admin.brands.index` |
| `admin/orders.html` | `orders/index.blade.php` | `admin.orders.index` |
| `admin/order-details.html` | `orders/show.blade.php` | `admin.orders.show` |
| `admin/customers.html` | `customers/index.blade.php` | `admin.customers.index` |
| `admin/customer-details.html` | `customers/show.blade.php` | `admin.customers.show` |
| Stub pages | Keep as static Blade with `@extends('admin.layouts.app')` | — |

### 0.4 Create Blade Layouts & Partials

**`resources/views/frontend/layouts/app.blade.php`**
- Extract: `<head>`, navbar (lines ~26–95 of `index.html`), footer, back-to-top, Bootstrap CDN, `style.css`, `@yield('content')`, `app.js`

**`resources/views/frontend/partials/navbar.blade.php`**
- Replace all `href="*.html"` with `{{ route('...') }}`
- Dynamic cart/wishlist counters: `{{ $cartCount ?? 0 }}`, `{{ $wishlistCount ?? 0 }}`
- Show auth state: login link vs. account dropdown

**`resources/views/frontend/partials/footer.blade.php`**
- Extract footer from `index.html`

**`resources/views/frontend/partials/product-card.blade.php`**
- Reusable card component used on home, shop, categories

**`resources/views/admin/layouts/app.blade.php`**
- Extract admin sidebar, topbar, loader from `admin/dashboard.html`

**`resources/views/admin/partials/sidebar.blade.php`**
- Replace all `href="*.html"` with named admin routes
- Keep all menu items (including stubs)

### 0.5 Storage Setup

```bash
php artisan storage:link
```

Store uploads in `storage/app/public/products/` and `storage/app/public/categories/`.

Create helper or use `asset('storage/' . $path)` for uploaded images; keep existing SVG paths for seeded demo products.

### 0.6 View Composer (optional but recommended)

Share `$cartCount` and `$wishlistCount` globally for authenticated users via `AppServiceProvider` or dedicated `ViewComposer`.

---

## Phase 1 — Database Migrations

Create migrations in this order:

### 1.1 Extend Users Table

```php
// database/migrations/xxxx_add_role_and_phone_to_users_table.php
$table->string('phone')->nullable()->after('email');
$table->enum('role', ['admin', 'user'])->default('user')->after('phone');
```

### 1.2 Categories

```php
Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->string('image')->nullable();
    $table->enum('status', ['active', 'inactive'])->default('active');
    $table->timestamps();
});
```

### 1.3 Brands

```php
Schema::create('brands', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->string('logo')->nullable();
    $table->enum('status', ['active', 'inactive'])->default('active');
    $table->timestamps();
});
```

### 1.4 Products

```php
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->text('description')->nullable();
    $table->unsignedBigInteger('price');           // PKR, store as integer (no decimals)
    $table->unsignedBigInteger('sale_price')->nullable();
    $table->unsignedInteger('stock')->default(0);
    $table->foreignId('category_id')->constrained()->cascadeOnDelete();
    $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
    $table->string('image')->nullable();
    $table->enum('status', ['active', 'inactive'])->default('active');
    $table->boolean('is_featured')->default(false);
    $table->boolean('is_best_seller')->default(false);
    $table->timestamps();
});
```

### 1.5 Product Images

```php
Schema::create('product_images', function (Blueprint $table) {
    $table->id();
    $table->foreignId('product_id')->constrained()->cascadeOnDelete();
    $table->string('image');
    $table->timestamps();
});
```

### 1.6 Carts

```php
Schema::create('carts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('product_id')->constrained()->cascadeOnDelete();
    $table->unsignedInteger('quantity')->default(1);
    $table->timestamps();
    $table->unique(['user_id', 'product_id']);
});
```

### 1.7 Wishlists

```php
Schema::create('wishlists', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('product_id')->constrained()->cascadeOnDelete();
    $table->timestamps();
    $table->unique(['user_id', 'product_id']);
});
```

### 1.8 Orders

```php
Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->string('order_number')->unique();
    $table->unsignedBigInteger('total_amount');    // PKR
    $table->enum('payment_method', ['cod', 'easypaisa', 'jazzcash', 'bank']);
    $table->enum('payment_status', ['pending', 'paid'])->default('pending');
    $table->enum('order_status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');
    $table->text('address');
    $table->string('city');
    $table->string('phone');
    $table->timestamps();
});
```

### 1.9 Order Items

```php
Schema::create('order_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('order_id')->constrained()->cascadeOnDelete();
    $table->foreignId('product_id')->constrained()->cascadeOnDelete();
    $table->unsignedBigInteger('price');           // snapshot at order time
    $table->unsignedInteger('quantity');
    $table->timestamps();
});
```

Run: `php artisan migrate`

---

## Phase 2 — Models & Relationships

### Models to create/update

| Model | File | Key Relationships |
|-------|------|-------------------|
| `User` | `app/Models/User.php` | `hasMany` Cart, Wishlist, Order |
| `Category` | `app/Models/Category.php` | `hasMany` Product |
| `Brand` | `app/Models/Brand.php` | `hasMany` Product |
| `Product` | `app/Models/Product.php` | `belongsTo` Category, Brand; `hasMany` ProductImage, Cart, Wishlist, OrderItem |
| `ProductImage` | `app/Models/ProductImage.php` | `belongsTo` Product |
| `Cart` | `app/Models/Cart.php` | `belongsTo` User, Product |
| `Wishlist` | `app/Models/Wishlist.php` | `belongsTo` User, Product |
| `Order` | `app/Models/Order.php` | `belongsTo` User; `hasMany` OrderItem |
| `OrderItem` | `app/Models/OrderItem.php` | `belongsTo` Order, Product |

### User model additions

```php
protected $fillable = ['name', 'email', 'password', 'phone', 'role'];

public function isAdmin(): bool
{
    return $this->role === 'admin';
}

public function carts() { return $this->hasMany(Cart::class); }
public function wishlists() { return $this->hasMany(Wishlist::class); }
public function orders() { return $this->hasMany(Order::class); }
```

### Product model helpers

```php
public function getEffectivePriceAttribute(): int
{
    return $this->sale_price ?? $this->price;
}

public function getRouteKeyName(): string
{
    return 'slug';
}

public function scopeActive($query) { return $query->where('status', 'active'); }
public function scopeFeatured($query) { return $query->where('is_featured', true); }
public function scopeBestSeller($query) { return $query->where('is_best_seller', true); }
```

---

## Phase 3 — Authentication & Middleware

### Install Laravel Breeze (Blade stack)

```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run build
php artisan migrate
```

**Customize Breeze views** to match existing `login.html` / `register.html` glassmorphic UI — do not use default Breeze styling.

### Role Middleware

Create `app/Http/Middleware/AdminMiddleware.php`:

```php
public function handle(Request $request, Closure $next)
{
    if (!auth()->check() || !auth()->user()->isAdmin()) {
        abort(403, 'Unauthorized');
    }
    return $next($request);
}
```

Register in `app/Http/Kernel.php`:

```php
'admin' => \App\Http\Middleware\AdminMiddleware::class,
```

### Auth Redirect Logic

In `app/Providers/RouteServiceProvider.php` or Breeze's `AuthenticatedSessionController`:

- Admin (`role === 'admin'`) → `route('admin.dashboard')`
- User → `route('home')`

### Separate Admin Login (optional)

Use existing `admin/login.html` design at `/admin/login` with a dedicated controller that validates credentials and checks `role === 'admin'`.

---

## Phase 4 — Seeders

Create `DatabaseSeeder` calling:

### 4.1 AdminUserSeeder

```php
User::create([
    'name' => 'Admin',
    'email' => 'admin@techemporium.pk',
    'password' => Hash::make('password'),
    'phone' => '0300-0000000',
    'role' => 'admin',
]);
```

### 4.2 Demo User

```php
User::create([
    'name' => 'Muhammad Ali',
    'email' => 'ali.tech@gmail.com',
    'password' => Hash::make('password'),
    'phone' => '0300-1234567',
    'role' => 'user',
]);
```

### 4.3 CategorySeeder

Map from `app.js` catalog categories:

| Name | Slug | Image |
|------|------|-------|
| Gaming Laptops | `gaming-laptops` | `assets/images/laptops/gaming-laptop.svg` |
| Business Laptops | `business-laptops` | `assets/images/laptops/business-laptop.svg` |
| Student Laptops | `student-laptops` | `assets/images/laptops/student-laptop.svg` |
| Monitors | `monitors` | `assets/images/accessories/monitor.svg` |
| Accessories | `accessories` | `assets/images/accessories/keyboard.svg` |
| Storage | `storage` | `assets/images/accessories/ssd.svg` |

### 4.4 BrandSeeder

| Name | Slug | Logo |
|------|------|------|
| Dell | `dell` | `assets/images/brands/dell.svg` |
| HP | `hp` | `assets/images/brands/hp.svg` |
| Lenovo | `lenovo` | `assets/images/brands/lenovo.svg` |
| Asus | `asus` | `assets/images/brands/asus.svg` |
| Acer | `acer` | `assets/images/brands/acer.svg` |
| MSI | `msi` | `assets/images/brands/msi.svg` |
| Apple | `apple` | `assets/images/brands/apple.svg` |

### 4.5 ProductSeeder

**Import all 17 products from `tech-emporium/assets/js/app.js` → `PRODUCT_CATALOG` array.**

For each product:
- `name`, `price`, `sale_price` (from `oldPrice` if badge is "Sale"), `slug` (Str::slug)
- `category_id` / `brand_id` from slug mapping
- `image` from catalog `image` field
- `is_featured` = true for homepage featured section products
- `is_best_seller` = true where `badge === "Best Seller"`
- `stock` = random 5–50
- `description` = combine `specs` + `features` from JS object as HTML or plain text
- `status` = `active`

Run: `php artisan db:seed`

---

## Phase 5 — Controllers

### Directory Structure

```
app/Http/Controllers/
├── Admin/
│   ├── AdminDashboardController.php
│   ├── ProductController.php
│   ├── CategoryController.php
│   ├── BrandController.php
│   ├── OrderController.php
│   └── CustomerController.php
└── Frontend/
    ├── HomeController.php
    ├── ShopController.php
    ├── CartController.php
    ├── CheckoutController.php
    ├── WishlistController.php
    └── UserOrderController.php
```

### Admin Controllers

**AdminDashboardController@index**
- Stats: `Product::count()`, `Order::count()`, `Order::sum('total_amount')`, `User::where('role','user')->count()`
- `Order::where('order_status','pending')->count()`, `Order::where('order_status','delivered')->count()`
- Recent orders (latest 10), recent products (latest 5)
- Pass chart data (monthly revenue last 6 months) to existing Chart.js in dashboard Blade

**ProductController** (resource)
- `index`: paginated table matching `admin/products.html` structure
- `create`/`store`: form from `add-product.html` — handle image upload + gallery images
- `edit`/`update`: form from `edit-product.html`
- `destroy`: soft confirmation, redirect with flash

**CategoryController** (resource)
- CRUD matching `categories.html` / `add-category.html`

**BrandController** (resource)
- CRUD matching `brands.html`

**OrderController**
- `index`: filterable orders table from `orders.html`
- `show`: order details from `order-details.html`
- `update`: PATCH order_status and payment_status

**CustomerController**
- `index`: users where `role = user`
- `show`: customer profile + order history from `customer-details.html`

### Frontend Controllers

**HomeController@index**
- Featured products: `Product::active()->featured()->limit(8)->get()`
- Best sellers: `Product::active()->bestSeller()->limit(8)->get()`
- Categories: `Category::active()->limit(6)->get()`
- Replace JS-rendered product grids with `@foreach` Blade loops

**ShopController**
- `index`: products with filters (category, brand, price range, search, sort)
  - Query params: `?category=gaming-laptops&brand=asus&sort=price-low&search=rog`
  - Preserve existing sidebar filter UI — wire checkboxes to query string or form GET
- `show`: single product by slug, related products same category

**CartController**
- `index`: load `auth()->user()->carts()->with('product')->get()`
- `add`: POST `{ product_id, quantity }` — merge if exists
- `update`: POST `{ cart_id, quantity }`
- `remove`: POST `{ cart_id }`
- Calculate totals server-side; pass to Blade

**CheckoutController**
- `index`: cart items + summary (shipping Rs. 250, free if subtotal > 10000 — match `app.js` logic)
- `placeOrder`: validate billing fields from `checkout.html` form IDs:
  - `billing-name`, `billing-email`, `billing-phone`, `billing-city`, `billing-address`
  - `paymentMethod`: cod | bank | easypaisa | jazzcash
  - Generate order number: `TE-` + 6 digits
  - DB transaction: create Order + OrderItems, decrement stock, clear cart
  - Redirect to `orders.index` with success flash

**WishlistController**
- `index`: user's wishlist with products
- `add`/`remove` via POST (can use AJAX to preserve heart-toggle UX)
- `moveToCart`: add product to cart, remove from wishlist

**UserOrderController**
- `index`: authenticated user's orders for `orders.html`
- `show`: single order detail with status timeline

---

## Phase 6 — Routes

Replace `routes/web.php` content:

```php
<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;
use Illuminate\Support\Facades\Route;

// Static pages
Route::get('/about', fn () => view('frontend.pages.about'))->name('about');
Route::get('/contact', fn () => view('frontend.pages.contact'))->name('contact');
Route::get('/faq', fn () => view('frontend.pages.faq'))->name('faq');

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Shop
Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::get('/product/{product:slug}', [ShopController::class, 'show'])->name('show');
});

// Categories page
Route::get('/categories', [ShopController::class, 'categories'])->name('categories.index');

// Auth required
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place');

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/wishlist/move-to-cart', [WishlistController::class, 'moveToCart'])->name('wishlist.move');

    Route::get('/my-account', fn () => view('frontend.account.index'))->name('account.index');
    Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('orders.show');
});

// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin login (guest)
    Route::middleware('guest')->group(function () {
        Route::get('/login', fn () => view('admin.auth.login'))->name('login');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('orders', OrderController::class)->only(['index', 'show', 'update']);
        Route::resource('customers', CustomerController::class)->only(['index', 'show']);

        // Stub routes — render existing UI, no backend
        Route::view('/inventory', 'admin.stubs.inventory')->name('inventory');
        Route::view('/sellers', 'admin.stubs.sellers')->name('sellers');
        Route::view('/reviews', 'admin.stubs.reviews')->name('reviews');
        Route::view('/coupons', 'admin.stubs.coupons')->name('coupons');
        Route::view('/banners', 'admin.stubs.banners')->name('banners');
        Route::view('/reports', 'admin.stubs.reports')->name('reports');
        Route::view('/settings', 'admin.stubs.settings')->name('settings');
        Route::view('/profile', 'admin.stubs.profile')->name('profile');
    });
});

require __DIR__.'/auth.php';  // Breeze routes
```

---

## Phase 7 — Blade Integration Details

### Link Replacement Pattern

```blade
{{-- Before --}}
<a href="products.html">Shop Catalog</a>

{{-- After --}}
<a href="{{ route('shop.index') }}">Shop Catalog</a>
```

### Product Card Loop (preserve existing card HTML)

```blade
@foreach($products as $product)
  <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
    {{-- copy exact card markup from index.html / products.html --}}
    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
    <h5>{{ $product->name }}</h5>
    <span class="text-orange">Rs. {{ number_format($product->effective_price) }}</span>
    @if($product->sale_price)
      <del class="text-muted">Rs. {{ number_format($product->price) }}</del>
    @endif
    <form action="{{ route('cart.add') }}" method="POST">
      @csrf
      <input type="hidden" name="product_id" value="{{ $product->id }}">
      <button type="submit" class="btn btn-electric btn-sm">Add to Cart</button>
    </form>
  </div>
@endforeach
```

### Cart Page Integration

Replace `#cart-table-body` JS rendering with server-side `@forelse`:

```blade
@forelse($cartItems as $item)
  <tr>
    <td>
      <img src="{{ asset($item->product->image) }}" width="60">
      {{ $item->product->name }}
    </td>
    <td>Rs. {{ number_format($item->product->effective_price) }}</td>
    <td>
      <form action="{{ route('cart.update') }}" method="POST">
        @csrf
        <input type="hidden" name="cart_id" value="{{ $item->id }}">
        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}">
        <button type="submit">Update</button>
      </form>
    </td>
    <td>Rs. {{ number_format($item->product->effective_price * $item->quantity) }}</td>
    <td>
      <form action="{{ route('cart.remove') }}" method="POST">
        @csrf
        <input type="hidden" name="cart_id" value="{{ $item->id }}">
        <button type="submit"><i class="bi bi-trash"></i></button>
      </form>
    </td>
  </tr>
@empty
  {{-- show #empty-cart-message --}}
@endforelse
```

### Checkout Form

```blade
<form action="{{ route('checkout.place') }}" method="POST" id="checkout-form">
  @csrf
  {{-- keep all existing input fields and payment radio buttons --}}
  <button type="submit" class="btn btn-electric w-100">Place Order</button>
</form>
```

### Admin Dashboard Stats Cards

Wire existing stat card elements to Blade variables:

```blade
<h3>{{ $totalProducts }}</h3>
<h3>Rs. {{ number_format($totalRevenue) }}</h3>
<h3>{{ $totalOrders }}</h3>
<h3>{{ $totalCustomers }}</h3>
```

### Admin Orders Table

```blade
@foreach($orders as $order)
  <tr>
    <td>#{{ $order->order_number }}</td>
    <td>{{ $order->user->name }}</td>
    <td>Rs. {{ number_format($order->total_amount) }}</td>
    <td>
      <form action="{{ route('admin.orders.update', $order) }}" method="POST">
        @csrf @method('PUT')
        <select name="order_status" onchange="this.form.submit()">
          @foreach(['pending','processing','shipped','delivered','cancelled'] as $status)
            <option value="{{ $status }}" @selected($order->order_status === $status)>{{ ucfirst($status) }}</option>
          @endforeach
        </select>
      </form>
    </td>
  </tr>
@endforeach
```

### Flash Messages

Use existing Bootstrap alert styles:

```blade
@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif
```

---

## Phase 8 — JavaScript Migration

### Keep in `app.js` (UI-only)

- Page loader fade-out
- Back-to-top button
- Price range slider UI (submit via GET form on change)
- Navbar scroll effects
- Product image gallery tabs on detail page
- Admin sidebar toggle (`admin.js`)

### Remove or disable in `app.js`

- `PRODUCT_CATALOG` constant (data now from DB)
- `CartManager` localStorage logic
- `WishlistManager` localStorage logic
- `OrderManager` localStorage logic
- Dynamic product rendering functions (`renderProductGrid`, etc.)

### Optional AJAX enhancements (preserve UX)

For add-to-cart / wishlist heart toggle without full page reload:

```javascript
// POST to route('cart.add') with CSRF token from meta tag
// Update .cart-counter badge text from JSON response
```

Add to layout `<head>`:

```blade
<meta name="csrf-token" content="{{ csrf_token() }}">
```

---

## Phase 9 — Form Requests & Validation

Create Form Request classes:

| Request | Rules |
|---------|-------|
| `StoreProductRequest` | name, slug, price, stock, category_id, brand_id, image (image\|mimes:jpeg,png,jpg,webp\|max:2048) |
| `StoreCategoryRequest` | name, slug, image, status |
| `StoreBrandRequest` | name, logo, status |
| `PlaceOrderRequest` | billing-name, billing-email, billing-phone, billing-city, billing-address, paymentMethod |
| `CartAddRequest` | product_id (exists), quantity (min:1) |

---

## Phase 10 — Business Logic Rules

Match existing `app.js` behavior:

| Rule | Implementation |
|------|----------------|
| Shipping cost | Rs. 250 flat; **free if subtotal > Rs. 10,000** |
| Order number format | `TE-` + 6 random digits, unique in DB |
| Payment status on COD | `pending` |
| Payment status on bank/easypaisa/jazzcash | `pending` (admin marks `paid` manually) |
| Order status on place | `processing` |
| Stock check | Reject cart add/update if quantity > stock |
| Price at checkout | Use `effective_price` (sale_price ?? price), snapshot in `order_items.price` |
| Clear cart | After successful order placement |

---

## Phase 11 — File Upload Handling

In `ProductController@store` and `@update`:

```php
if ($request->hasFile('image')) {
    $path = $request->file('image')->store('products', 'public');
    $data['image'] = 'storage/' . $path;
}
```

For gallery images, loop `product_images[]` and create `ProductImage` records.

---

## Implementation Order (strict)

1. Phase 0 — Assets + Blade conversion + layouts
2. Phase 1 — Migrations
3. Phase 2 — Models
4. Phase 3 — Auth + middleware
5. Phase 4 — Seeders
6. Phase 5 + 6 — Controllers + Routes
7. Phase 7 — Wire Blade data (home → shop → cart → checkout → orders)
8. Phase 8 — Trim app.js
9. Phase 9 + 10 — Validation + business rules
10. Phase 11 — File uploads in admin

**Test after each phase.** Do not proceed if migrations fail or views break.

---

## Acceptance Criteria

- [ ] `php artisan migrate --seed` runs without errors
- [ ] Admin login: `admin@techemporium.pk` / `password` → `/admin/dashboard`
- [ ] User login: `ali.tech@gmail.com` / `password` → `/`
- [ ] Homepage shows DB products (featured + best sellers)
- [ ] Shop page filters by category, brand, search, sort
- [ ] Product detail page loads by slug
- [ ] Cart CRUD works for authenticated users
- [ ] Checkout creates order + order items, clears cart
- [ ] User can view order history at `/orders`
- [ ] Wishlist add/remove/move-to-cart works
- [ ] Admin can CRUD products, categories, brands
- [ ] Admin can view/update order status
- [ ] Admin dashboard shows live stats + Chart.js data
- [ ] All prices display as `Rs. X,XXX` (PKR)
- [ ] **Zero visual redesign** — UI matches original static HTML
- [ ] No `localStorage` dependency for cart/wishlist/orders

---

## Default Credentials (after seeding)

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@techemporium.pk | password |
| User | ali.tech@gmail.com | password |

---

## Commands to Run After Full Implementation

```bash
composer install
cp .env.example .env   # configure DB
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
# Visit http://127.0.0.1:8000
```

---

## DO NOT

- Redesign navbar, cards, admin sidebar, or color scheme
- Replace Bootstrap 5 with Tailwind (unless Breeze default — override to match existing CSS)
- Delete original `tech-emporium/` folder until implementation is verified
- Use API/SPA architecture — this is server-rendered Blade
- Skip CSRF tokens on any POST form
- Store prices as decimals — use unsigned integers for PKR whole amounts

---

## GOAL

Deliver a **production-ready Laravel 10 e-commerce system** for **Tech Emporium** with full admin + user panels, database integration, PKR currency, and the existing premium dark glassmorphism UI fully preserved.
