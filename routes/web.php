<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\SitemapController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\Frontend\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/about', fn () => view('frontend.pages.about'))->name('about');
Route::get('/contact', fn () => view('frontend.pages.contact'))->name('contact');
Route::get('/faq', fn () => view('frontend.pages.faq'))->name('faq');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home/categories', [HomeController::class, 'categories'])->name('home.categories');
Route::get('/home/products', [HomeController::class, 'products'])->name('home.products');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', function () {
    $lines = [
        'User-agent: *',
        'Allow: /',
        'Disallow: /admin/',
        'Disallow: /cart',
        'Disallow: /checkout',
        'Disallow: /login',
        'Disallow: /register',
        'Disallow: /my-account',
        'Disallow: /orders',
        'Disallow: /wishlist',
        '',
        'Sitemap: ' . url('/sitemap.xml'),
    ];

    return response(implode("\n", $lines), 200)->header('Content-Type', 'text/plain');
})->name('robots');

Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::get('/product/{product:slug}', [ShopController::class, 'show'])->name('show');
});

Route::get('/categories', [ShopController::class, 'categories'])->name('categories.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/buy-now', [CartController::class, 'buyNow'])->name('cart.buy-now');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/wishlist/move-to-cart', [WishlistController::class, 'moveToCart'])->name('wishlist.move');

    Route::get('/my-account', fn () => view('frontend.account.index', ['user' => auth()->user()]))->name('account.index');
    Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('orders.show');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login']);
    });

    Route::post('/logout', [AdminAuthController::class, 'logout'])->middleware('auth')->name('logout');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('products', ProductController::class);
        Route::delete('products/images/{productImage}', [ProductController::class, 'destroyImage'])->name('products.images.destroy');
        Route::resource('categories', CategoryController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update']);
        Route::resource('customers', CustomerController::class)->only(['index', 'show']);

        Route::view('/inventory', 'admin.stubs.inventory')->name('inventory');
        Route::view('/sellers', 'admin.stubs.sellers')->name('sellers');
        Route::view('/reviews', 'admin.stubs.reviews')->name('reviews');
        Route::view('/coupons', 'admin.stubs.coupons')->name('coupons');
        Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
        Route::post('/banners/hero', [BannerController::class, 'updateHero'])->name('banners.hero.update');
        Route::delete('/banners/hero', [BannerController::class, 'removeHero'])->name('banners.hero.remove');
        Route::view('/reports', 'admin.stubs.reports')->name('reports');
        Route::view('/settings', 'admin.stubs.settings')->name('settings');
        Route::view('/profile', 'admin.stubs.profile')->name('profile');
    });
});
