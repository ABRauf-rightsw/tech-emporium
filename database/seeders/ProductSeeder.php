<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $catMap = [
            'laptops-gaming' => 'gaming-laptops',
            'laptops-business' => 'business-laptops',
            'laptops-student' => 'student-laptops',
            'monitors' => 'monitors',
            'accessories' => 'accessories',
            'storage' => 'storage',
        ];

        $products = [
            ['name' => 'ASUS ROG Strix G16 (2024)', 'category' => 'laptops-gaming', 'brand' => 'asus', 'price' => 419999, 'sale_price' => 389999, 'image' => 'assets/images/laptops/gaming-laptop.svg', 'featured' => true, 'best_seller' => false],
            ['name' => 'Lenovo ThinkPad X1 Carbon Gen 11', 'category' => 'laptops-business', 'brand' => 'lenovo', 'price' => 450000, 'sale_price' => 425000, 'image' => 'assets/images/laptops/business-laptop.svg', 'featured' => true, 'best_seller' => true],
            ['name' => 'HP Pavilion Plus 14 (Ryzen 7)', 'category' => 'laptops-student', 'brand' => 'hp', 'price' => 199999, 'sale_price' => 189999, 'image' => 'assets/images/laptops/student-laptop.svg', 'featured' => true, 'best_seller' => false],
            ['name' => 'Dell XPS 15 9530 Core i7', 'category' => 'laptops-business', 'brand' => 'dell', 'price' => 399999, 'sale_price' => 385000, 'image' => 'assets/images/laptops/dell-xps.svg', 'featured' => true, 'best_seller' => true],
            ['name' => 'HP Spectre x360 14 2-in-1', 'category' => 'laptops-student', 'brand' => 'hp', 'price' => 360000, 'sale_price' => 345000, 'image' => 'assets/images/laptops/hp-spectre.svg', 'featured' => true, 'best_seller' => false],
            ['name' => 'Lenovo ThinkPad T14 Gen 4', 'category' => 'laptops-business', 'brand' => 'lenovo', 'price' => 225000, 'sale_price' => 215000, 'image' => 'assets/images/laptops/lenovo-thinkpad.svg', 'featured' => false, 'best_seller' => false],
            ['name' => 'ASUS ROG Zephyrus G14 Gaming', 'category' => 'laptops-gaming', 'brand' => 'asus', 'price' => 449999, 'sale_price' => 425000, 'image' => 'assets/images/laptops/asus-rog.svg', 'featured' => true, 'best_seller' => false],
            ['name' => 'Acer Predator Helios 16 RTX 4080', 'category' => 'laptops-gaming', 'brand' => 'acer', 'price' => 530000, 'sale_price' => 510000, 'image' => 'assets/images/laptops/acer-predator.svg', 'featured' => true, 'best_seller' => false],
            ['name' => 'MSI Stealth 16 Studio (Slim)', 'category' => 'laptops-gaming', 'brand' => 'msi', 'price' => 485000, 'sale_price' => 465000, 'image' => 'assets/images/laptops/msi-stealth.svg', 'featured' => false, 'best_seller' => false],
            ['name' => 'Apple MacBook Air 13-inch M3', 'category' => 'laptops-student', 'brand' => 'apple', 'price' => 345000, 'sale_price' => 329000, 'image' => 'assets/images/laptops/apple-macbook.svg', 'featured' => true, 'best_seller' => true],
            ['name' => 'Samsung Odyssey G5 27" QHD Gaming Monitor', 'category' => 'monitors', 'brand' => 'samsung', 'price' => 95000, 'sale_price' => 89999, 'image' => 'assets/images/accessories/monitor.svg', 'featured' => false, 'best_seller' => true],
            ['name' => 'Redragon K552 Mechanical RGB Keyboard', 'category' => 'accessories', 'brand' => 'accessories', 'price' => 14999, 'sale_price' => 12499, 'image' => 'assets/images/accessories/keyboard.svg', 'featured' => true, 'best_seller' => false],
            ['name' => 'Logitech G502 Hero Wireless Gaming Mouse', 'category' => 'accessories', 'brand' => 'accessories', 'price' => 9999, 'sale_price' => 7999, 'image' => 'assets/images/accessories/mouse.svg', 'featured' => false, 'best_seller' => false],
            ['name' => 'Samsung 990 Pro 1TB M.2 PCIe 4.0 NVMe SSD', 'category' => 'storage', 'brand' => 'accessories', 'price' => 27999, 'sale_price' => 24999, 'image' => 'assets/images/accessories/ssd.svg', 'featured' => true, 'best_seller' => false],
            ['name' => 'Logitech StreamCam 1080p Web Camera', 'category' => 'accessories', 'brand' => 'accessories', 'price' => 32000, 'sale_price' => 28500, 'image' => 'assets/images/accessories/webcam.svg', 'featured' => false, 'best_seller' => false],
            ['name' => 'Razer BlackShark V2 Pro Gaming Headphones', 'category' => 'accessories', 'brand' => 'accessories', 'price' => 36999, 'sale_price' => 32999, 'image' => 'assets/images/accessories/headphones.svg', 'featured' => false, 'best_seller' => false],
            ['name' => 'Tigernu Sleek Anti-Theft Laptop Backpack', 'category' => 'accessories', 'brand' => 'accessories', 'price' => 9999, 'sale_price' => 8500, 'image' => 'assets/images/accessories/bag.svg', 'featured' => false, 'best_seller' => false],
        ];

        foreach ($products as $p) {
            $category = Category::where('slug', $catMap[$p['category']])->first();
            $brand = Brand::where('slug', $p['brand'])->first();

            Product::create([
                'name' => $p['name'],
                'slug' => Str::slug($p['name']),
                'description' => $p['name'] . ' — Premium hardware available at Tech Emporium Pakistan.',
                'price' => $p['price'],
                'sale_price' => $p['sale_price'],
                'stock' => rand(5, 50),
                'category_id' => $category->id,
                'brand_id' => $brand->id,
                'image' => $p['image'],
                'status' => 'active',
                'is_featured' => $p['featured'],
                'is_best_seller' => $p['best_seller'],
            ]);
        }
    }
}
