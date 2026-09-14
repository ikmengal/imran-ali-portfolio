<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::query()->delete();

        Testimonial::create([
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
