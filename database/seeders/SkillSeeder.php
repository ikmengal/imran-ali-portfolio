<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Skill::query()->delete();

        $user = User::whereHas('roles', function ($query) {
            $query->where('name', 'Super Admin');
        })->first() ?? User::first();

        if (! $user) {
            return;
        }

        $skills = [
            [
                'name' => 'Laravel',
                'category' => 'Backend',
                'percentage' => 95,
                'icon' => 'fab fa-laravel',
                'is_featured' => true,
            ],
            [
                'name' => 'PHP',
                'category' => 'Backend',
                'percentage' => 95,
                'icon' => 'fab fa-php',
                'is_featured' => true,
            ],
            [
                'name' => 'MySQL',
                'category' => 'Database',
                'percentage' => 90,
                'icon' => 'fas fa-database',
                'is_featured' => true,
            ],
            [
                'name' => 'JavaScript',
                'category' => 'Frontend',
                'percentage' => 80,
                'icon' => 'fab fa-js',
                'is_featured' => true,
            ],
            [
                'name' => 'Bootstrap',
                'category' => 'Frontend',
                'percentage' => 90,
                'icon' => 'fab fa-bootstrap',
                'is_featured' => false,
            ],
            [
                'name' => 'Git',
                'category' => 'Tools',
                'percentage' => 85,
                'icon' => 'fab fa-git-alt',
                'is_featured' => false,
            ],
            [
                'name' => 'REST API',
                'category' => 'Backend',
                'percentage' => 90,
                'icon' => 'fas fa-code',
                'is_featured' => true,
            ],
        ];

        foreach ($skills as $index => $skill) {
            Skill::create([
                'user_id' => $user->id,
                ...$skill,
                'is_visible' => true,
                'sort_order' => $index + 1,
            ]);
        }
    }
}
