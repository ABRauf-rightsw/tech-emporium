<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Dell', 'slug' => 'dell', 'logo' => 'assets/images/brands/dell.svg'],
            ['name' => 'HP', 'slug' => 'hp', 'logo' => 'assets/images/brands/hp.svg'],
            ['name' => 'Lenovo', 'slug' => 'lenovo', 'logo' => 'assets/images/brands/lenovo.svg'],
            ['name' => 'Asus', 'slug' => 'asus', 'logo' => 'assets/images/brands/asus.svg'],
            ['name' => 'Acer', 'slug' => 'acer', 'logo' => 'assets/images/brands/acer.svg'],
            ['name' => 'MSI', 'slug' => 'msi', 'logo' => 'assets/images/brands/msi.svg'],
            ['name' => 'Apple', 'slug' => 'apple', 'logo' => 'assets/images/brands/apple.svg'],
            ['name' => 'Samsung', 'slug' => 'samsung', 'logo' => 'assets/images/brands/samsung.svg'],
            ['name' => 'Tech Emporium', 'slug' => 'accessories', 'logo' => 'assets/images/brands/hp.svg'],
        ];

        foreach ($brands as $brand) {
            Brand::create(array_merge($brand, ['status' => 'active']));
        }
    }
}
