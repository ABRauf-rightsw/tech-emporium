<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    private const HOME_LIMIT = 5;

    public function index()
    {
        return view('frontend.home.index', [
            'totalProducts' => Cache::remember('home.total_products', 3600, fn () => Product::active()->count()),
            'totalCategories' => Cache::remember('home.total_categories', 3600, fn () => Category::active()->count()),
            'brands' => Cache::remember('home.brands', 3600, fn () => Brand::active()->select(['id', 'name', 'slug', 'logo'])->get()),
        ]);
    }

    public function categories()
    {
        $categories = Category::active()
            ->select(['id', 'name', 'slug', 'image'])
            ->orderBy('name')
            ->limit(self::HOME_LIMIT)
            ->get();

        return response()->json([
            'html' => view('frontend.home.partials.categories-grid', compact('categories'))->render(),
            'pills' => view('frontend.home.partials.quick-nav-pills', compact('categories'))->render(),
        ]);
    }

    public function products()
    {
        $featuredProducts = Product::active()
            ->featured()
            ->with(['category:id,name,slug', 'brand:id,name,slug'])
            ->select([
                'id', 'name', 'slug', 'price', 'sale_price', 'image',
                'category_id', 'brand_id', 'is_best_seller', 'status',
            ])
            ->limit(self::HOME_LIMIT)
            ->get();

        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::active()
                ->with(['category:id,name,slug', 'brand:id,name,slug'])
                ->select([
                    'id', 'name', 'slug', 'price', 'sale_price', 'image',
                    'category_id', 'brand_id', 'is_best_seller', 'status',
                ])
                ->latest()
                ->limit(self::HOME_LIMIT)
                ->get();
        }

        $heroProduct = $featuredProducts->first();

        return response()->json([
            'hero' => $heroProduct
                ? view('frontend.home.partials.hero-product', compact('heroProduct'))->render()
                : '',
            'html' => view('frontend.home.partials.products-grid', compact('featuredProducts'))->render(),
        ]);
    }
}
