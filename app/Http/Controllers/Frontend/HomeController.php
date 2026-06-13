<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home.index', [
            'totalProducts' => Product::active()->count(),
            'categories' => Category::active()->get(),
            'featuredProducts' => Product::active()->featured()->with(['category', 'brand'])->limit(8)->get(),
            'bestSellers' => Product::active()->bestSeller()->with(['category', 'brand'])->limit(4)->get(),
            'accessories' => Product::active()
                ->whereHas('category', fn ($q) => $q->whereIn('slug', ['accessories', 'storage']))
                ->with(['category', 'brand'])
                ->limit(4)
                ->get(),
            'brands' => Brand::active()->get(),
        ]);
    }
}
