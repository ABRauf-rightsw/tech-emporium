<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@techemporiumpk.com',
            'password' => Hash::make('zabiullahtechemporium'),
            'phone' => '0300-0000000',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Muhammad Ali',
            'email' => 'ali.tech@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '0300-1234567',
            'role' => 'user',
        ]);
    }
}
