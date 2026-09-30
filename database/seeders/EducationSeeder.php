<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\User;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Education::query()->delete();

        $user = User::whereHas('roles', function ($query) {
            $query->where('name', 'Super Admin');
        })->first() ?? User::first();

        if (! $user) {
            return;
        }

        Education::create([
            'user_id' => $user->id,
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
