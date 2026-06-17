<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct(private ImageUploadService $images)
    {
    }

    public function index()
    {
        $products = Product::with(['category', 'brand'])->latest()->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create', [
            'categories' => Category::active()->get(),
            'brands' => Brand::active()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:products',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'sale_price' => 'nullable|integer|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'image' => 'nullable|image|max:5120',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'boolean',
            'is_best_seller' => 'boolean',
            'gallery.*' => 'nullable|image|max:5120',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_best_seller'] = $request->boolean('is_best_seller');
        $data['description'] = clean_rich_text($data['description'] ?? null);

        $product = Product::create($data);

        if ($request->hasFile('image')) {
            $stored = $this->images->compressAndStore($request->file('image'), 'products', $product);
            $product->update(['image' => $stored->path]);
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $stored = $this->images->compressAndStore($file, 'products', $product);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $stored->path,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        $product->load('images');

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::active()->get(),
            'brands' => Brand::active()->get(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:products,slug,' . $product->id,
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'sale_price' => 'nullable|integer|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'image' => 'nullable|image|max:5120',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'boolean',
            'is_best_seller' => 'boolean',
            'gallery.*' => 'nullable|image|max:5120',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_best_seller'] = $request->boolean('is_best_seller');
        $data['description'] = clean_rich_text($data['description'] ?? null);

        if ($request->hasFile('image')) {
            $data['image'] = $this->images->replace($request->file('image'), 'products', $product->image, $product);
        }

        $product->update($data);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $stored = $this->images->compressAndStore($file, 'products', $product);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $stored->path,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $this->images->deleteByPath($product->image);

        foreach ($product->images as $galleryImage) {
            $this->images->deleteByPath($galleryImage->image);
            $galleryImage->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }

    public function destroyImage(ProductImage $productImage)
    {
        $this->images->deleteByPath($productImage->image);
        $productImage->delete();

        return back()->with('success', 'Image removed.');
    }
}
