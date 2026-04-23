<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ServiceCategory;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Hash;

class AdminAndCategorySeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin (avoid duplicate)
        User::updateOrCreate(
            ['email' => 'admin@handymanpro.local'],
            [
                'name' => 'Admin',
                'phone' => '03001234567',
                'password' => Hash::make('admin123'),
                'role' => UserRole::Admin,
                'status' => 'active',
            ]
        );

        // Categories
        $categories = [
            ['name' => 'Plumbing', 'slug' => 'plumbing', 'icon' => 'droplet-fill', 'base_price' => 1500],
            ['name' => 'Electrical', 'slug' => 'electrical', 'icon' => 'lightning-charge-fill', 'base_price' => 2000],
            ['name' => 'Cleaning', 'slug' => 'cleaning', 'icon' => 'stars', 'base_price' => 1000],
            ['name' => 'AC Repair', 'slug' => 'ac-repair', 'icon' => 'fan', 'base_price' => 3000],
            ['name' => 'Carpentry', 'slug' => 'carpentry', 'icon' => 'hammer', 'base_price' => 2500],
            ['name' => 'Painting', 'slug' => 'painting', 'icon' => 'palette-fill', 'base_price' => 5000],
        ];

        foreach ($categories as $cat) {
            ServiceCategory::updateOrCreate(
                ['slug' => $cat['slug']], // prevent duplicates
                $cat
            );
        }
    }
}