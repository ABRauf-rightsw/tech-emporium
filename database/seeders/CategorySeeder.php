<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Gaming Laptops', 'slug' => 'gaming-laptops', 'image' => 'assets/images/laptops/gaming-laptop.svg'],
            ['name' => 'Business Laptops', 'slug' => 'business-laptops', 'image' => 'assets/images/laptops/business-laptop.svg'],
            ['name' => 'Student Laptops', 'slug' => 'student-laptops', 'image' => 'assets/images/laptops/student-laptop.svg'],
            ['name' => 'Monitors', 'slug' => 'monitors', 'image' => 'assets/images/accessories/monitor.svg'],
            ['name' => 'Accessories', 'slug' => 'accessories', 'image' => 'assets/images/accessories/keyboard.svg'],
            ['name' => 'Storage', 'slug' => 'storage', 'image' => 'assets/images/accessories/ssd.svg'],
        ];

        foreach ($categories as $cat) {
            Category::create(array_merge($cat, ['status' => 'active']));
        }
    }
}
