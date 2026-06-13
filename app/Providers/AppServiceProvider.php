<?php

namespace App\Providers;

use App\Models\Wishlist;
use App\Services\CartService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('frontend.*', function ($view) {
            $cartService = app(CartService::class);
            $view->with('cartCount', $cartService->getCount());
            $view->with('wishlistCount', Auth::check()
                ? Wishlist::where('user_id', Auth::id())->count()
                : 0);
        });
    }
}
