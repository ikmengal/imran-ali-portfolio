<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Education;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Education::query()->delete();

        Education::create([
            'degree' => 'Bachelor of Science in Computer Science',
            'institution' => 'Your University',
            'field' => 'Computer Science',
            'start_year' => 2016,
            'end_year' => 2020,
            'description' => 'Studied computer science with a focus on software development, databases, programming and web technologies.',
            'location' => 'Pakistan',
            'is_current' => false,
            'is_visible' => true,
            'sort_order' => 1,
        ]);
    }
}
