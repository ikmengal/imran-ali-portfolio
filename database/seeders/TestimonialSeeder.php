<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;
use App\Models\User;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::query()->delete();

        $user = User::whereHas('roles', function ($query) {
            $query->where('name', 'Super Admin');
        })->first() ?? User::first();

        if (!$user) {
            return;
        }

        Testimonial::create([
            'user_id' => $user->id,
            'name' => 'John Doe',
            'designation' => 'Project Manager',
            'company' => 'Technology Company',
            'image' => null,
            'message' => 'Excellent development work with strong attention to backend architecture, performance and business requirements.',
            'rating' => 5,
            'is_visible' => true,
            'sort_order' => 1,
        ]);

        Testimonial::create([
            'user_id' => $user->id,
            'name' => 'Jane Smith',
            'designation' => 'Product Manager',
            'company' => 'Software Company',
            'image' => null,
            'message' => 'Professional, reliable and capable of turning complex business requirements into practical software solutions.',
            'rating' => 5,
            'is_visible' => true,
            'sort_order' => 2,
        ]);
    }
}
