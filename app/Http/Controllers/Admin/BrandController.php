<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function __construct(private ImageUploadService $images)
    {
    }

    public function index()
    {
        $brands = Brand::withCount('products')->latest()->paginate(15);

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:brands',
            'logo' => 'nullable|image|max:5120',
            'status' => 'required|in:active,inactive',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        $brand = Brand::create($data);

        if ($request->hasFile('logo')) {
            $stored = $this->images->compressAndStore($request->file('logo'), 'brands', $brand);
            $brand->update(['logo' => $stored->path]);
        }

        return redirect()->route('admin.brands.index')->with('success', 'Brand created.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:brands,slug,' . $brand->id,
            'logo' => 'nullable|image|max:5120',
            'status' => 'required|in:active,inactive',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        if ($request->hasFile('logo')) {
            $data['logo'] = $this->images->replace($request->file('logo'), 'brands', $brand->logo, $brand);
        }

        $brand->update($data);

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated.');
    }

    public function destroy(Brand $brand)
    {
        $this->images->deleteByPath($brand->logo);
        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted.');
    }
}
