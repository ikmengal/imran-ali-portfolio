<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::firstOrCreate([], [
            'name' => 'Admin Panel',
            'white_name' => 'Admin Panel',
            'footer_text' => 'All rights reserved.',
            'email' => 'admin@example.com',
            'phone' => '+92 300 1234567',
            'address' => 'Your Address Here',
            'social_links' => [
                'facebook' => 'https://facebook.com',
                'twitter' => 'https://twitter.com',
                'linkedin' => 'https://linkedin.com',
                'instagram' => 'https://instagram.com',
            ],
            'meta_data' => [
                'meta_title' => 'Admin Panel',
                'meta_description' => 'Admin panel for managing portfolio',
                'meta_keywords' => 'admin, panel, portfolio, dashboard',
            ],
        ]);
    }
}