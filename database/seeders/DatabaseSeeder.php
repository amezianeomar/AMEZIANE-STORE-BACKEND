<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Restore Users (Admin & Angel)
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@ameziane.store',
            'password' => Hash::make('password'),
            'role' => 'ADMIN',
        ]);

        User::create([
            'name' => 'Angel User',
            'email' => 'angel@ameziane.store',
            'password' => Hash::make('password'),
            'role' => 'USER',
        ]);

        // 2. Restore Products from JSON
        $jsonPath = base_path('products-pictures.json');
        if (File::exists($jsonPath)) {
            $data = json_decode(File::get($jsonPath), true);
            
            foreach ($data as $category => $products) {
                foreach ($products as $item) {
                    Product::create([
                        'nom' => $item['name'],
                        'prix' => rand(50, 2000), // Random price as JSON lacks it
                        'image' => $item['img'],
                        'desc' => 'High-performance gear for elite gamers.',
                        'categorie' => $category
                    ]);
                }
            }
        }
    }
}
