<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::query()->delete();

        $services = [
            [
                'title' => 'Laravel Development',
                'icon' => 'fab fa-laravel',
                'description' => 'Building scalable and maintainable Laravel web applications with clean architecture and modern development practices.',
            ],
            [
                'title' => 'Backend Development',
                'icon' => 'fas fa-server',
                'description' => 'Developing secure and scalable backend systems, APIs, authentication and business logic.',
            ],
            [
                'title' => 'REST API Development',
                'icon' => 'fas fa-code',
                'description' => 'Designing and developing reliable REST APIs for web and mobile applications.',
            ],
            [
                'title' => 'Database Design',
                'icon' => 'fas fa-database',
                'description' => 'Designing optimized relational databases, relationships, migrations and efficient queries.',
            ],
            [
                'title' => 'Admin Panel Development',
                'icon' => 'fas fa-layer-group',
                'description' => 'Creating powerful and user-friendly administration panels for business applications.',
            ],
        ];

        foreach ($services as $index => $service) {
            Service::create([
                ...$service,
                'is_featured' => true,
                'is_visible' => true,
                'sort_order' => $index + 1,
            ]);
        }
    }
}
