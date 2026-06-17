<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private array $categoryMap = [
        'gaming' => 'gaming-laptops',
        'business' => 'business-laptops',
        'student' => 'student-laptops',
        'monitors' => 'monitors',
        'accessories' => 'accessories',
        'storage' => 'storage',
    ];

    public function index(Request $request)
    {
        $products = $this->filteredProducts($request);

        if ($request->ajax()) {
            return response()->json([
                'results' => view('frontend.shop.partials.results', compact('products'))->render(),
                'activeFilters' => view('frontend.shop.partials.active-filters')->render(),
                'total' => $products->total(),
            ]);
        }

        return view('frontend.shop.index', [
            'products' => $products,
            'categories' => Category::active()->get(),
            'brands' => Brand::active()->get(),
        ]);
    }

    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'images']);

        $related = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('frontend.shop.show', compact('product', 'related'));
    }

    public function categories()
    {
        return view('frontend.categories.index', [
            'categories' => Category::active()->withCount('products')->get(),
        ]);
    }

    private function filteredProducts(Request $request): LengthAwarePaginator
    {
        $query = Product::active()->with(['category', 'brand']);

        if ($search = trim((string) $request->get('search', ''))) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($category = $request->get('category')) {
            $slug = $this->categoryMap[$category] ?? $category;
            $query->whereHas('category', fn ($q) => $q->where('slug', $slug));
        }

        if ($brand = $request->get('brand')) {
            $query->whereHas('brand', fn ($q) => $q->where('slug', $brand));
        }

        if ($maxPrice = $request->get('max_price')) {
            $query->where('price', '<=', (int) $maxPrice);
        }

        $sort = $request->get('sort', 'default');
        match ($sort) {
            'price-low' => $query->orderByRaw('COALESCE(sale_price, price) ASC'),
            'price-high' => $query->orderByRaw('COALESCE(sale_price, price) DESC'),
            'name' => $query->orderBy('name'),
            default => $query->latest(),
        };

        return $query->paginate(12)->withQueryString();
    }
}
