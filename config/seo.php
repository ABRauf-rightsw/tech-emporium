<?php

return [

    'site_name' => 'Tech Emporium',

    'default_title' => 'Tech Emporium | Premium Laptops & Accessories in Pakistan',

    'title_separator' => ' | ',

    'default_description' => 'Shop authentic laptops, gaming PCs, monitors, SSDs, and computer accessories at Tech Emporium Pakistan. Official warranty, competitive PKR prices, and nationwide delivery from Hafeez Center Lahore.',

    'default_keywords' => 'laptops Pakistan, gaming laptops, business laptops, computer accessories, Tech Emporium, Hafeez Center Lahore, Dell HP Lenovo Asus, buy laptop online Pakistan',

    'og_image' => 'assets/images/banners/hero-bg.svg',

    'twitter_handle' => '@TechEmporiumPK',

    'locale' => 'en_PK',

    'business' => [
        'name' => 'Tech Emporium',
        'legal_name' => 'Tech Emporium',
        'url' => env('APP_URL', 'https://techemporiumpk.com'),
        'email' => 'sales@techemporiumpk.com',
        'phone' => '+92-21-111-832-436',
        'address' => [
            'street' => 'Hafeez Center, 3rd Floor',
            'city' => 'Lahore',
            'region' => 'Punjab',
            'postal_code' => '54000',
            'country' => 'PK',
        ],
    ],

    'social' => [
        'facebook' => null,
        'instagram' => null,
        'twitter' => null,
    ],

    'noindex_routes' => [
        'cart.index',
        'checkout.index',
        'checkout.place',
        'checkout.success',
        'login',
        'register',
        'logout',
        'account.index',
        'orders.index',
        'orders.show',
        'wishlist.index',
        'wishlist.add',
        'wishlist.remove',
        'wishlist.move',
        'admin.*',
    ],

];
