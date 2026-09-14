<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Skill::query()->delete();

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
                ...$skill,
                'is_visible' => true,
                'sort_order' => $index + 1,
            ]);
        }
    }
}
