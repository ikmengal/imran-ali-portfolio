<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::query()->delete();

        $project = Project::create([
            'title' => 'Travel Management System',
            'slug' => 'travel-management-system',
            'short_description' => 'A complete digital travel management and approval platform.',
            'description' => 'A Laravel based travel management system designed to digitize employee travel requests, approvals, finance workflows and travel records.',
            'image' => null,
            'github_url' => 'https://github.com/yourusername/travel-management-system',
            'live_url' => null,
            'category' => 'Web Application',
            'is_featured' => true,
            'is_visible' => true,
            'sort_order' => 1,
        ]);

        $technologies = [
            'Laravel',
            'PHP',
            'MySQL',
            'Bootstrap',
            'JavaScript',
            'Yajra DataTables',
            'Spatie Permission',
        ];

        foreach ($technologies as $index => $technology) {
            $project->technologies()->create([
                'name' => $technology,
                'sort_order' => $index + 1,
            ]);
        }

        $project = Project::create([
            'title' => 'Learning Management System',
            'slug' => 'learning-management-system',
            'short_description' => 'A modern LMS for courses, students, instructors and learning management.',
            'description' => 'A Laravel based learning management platform with course management, students, instructors, progress tracking and assessment features.',
            'image' => null,
            'github_url' => 'https://github.com/yourusername/lms-portal',
            'live_url' => null,
            'category' => 'LMS',
            'is_featured' => true,
            'is_visible' => true,
            'sort_order' => 2,
        ]);

        foreach (
            [
                'Laravel',
                'PHP',
                'MySQL',
                'Bootstrap',
                'JavaScript',
                'REST API',
            ] as $index => $technology
        ) {
            $project->technologies()->create([
                'name' => $technology,
                'sort_order' => $index + 1,
            ]);
        }
    }
}
