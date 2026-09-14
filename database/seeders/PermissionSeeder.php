<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            // Permissions
            [
                'label' => 'permissions',
                'name' => 'permissions-list',
            ],
            [
                'label' => 'permissions',
                'name' => 'permissions-create',
            ],
            [
                'label' => 'permissions',
                'name' => 'permissions-edit',
            ],
            [
                'label' => 'permissions',
                'name' => 'permissions-delete',
            ],
            [
                'label' => 'permissions',
                'name' => 'permissions-show',
            ],

            // Roles
            [
                'label' => 'roles',
                'name' => 'roles-list',
            ],
            [
                'label' => 'roles',
                'name' => 'roles-create',
            ],
            [
                'label' => 'roles',
                'name' => 'roles-edit',
            ],
            [
                'label' => 'roles',
                'name' => 'roles-delete',
            ],
            [
                'label' => 'roles',
                'name' => 'roles-show',
            ],

            // Users
            [
                'label' => 'users',
                'name' => 'users-list',
            ],
            [
                'label' => 'users',
                'name' => 'users-create',
            ],
            [
                'label' => 'users',
                'name' => 'users-edit',
            ],
            [
                'label' => 'users',
                'name' => 'users-delete',
            ],
            [
                'label' => 'users',
                'name' => 'users-show',
            ],

            // Education
            [
                'label' => 'educations',
                'name' => 'educations-list',
            ],
            [
                'label' => 'educations',
                'name' => 'educations-create',
            ],
            [
                'label' => 'educations',
                'name' => 'educations-edit',
            ],
            [
                'label' => 'educations',
                'name' => 'educations-delete',
            ],
            [
                'label' => 'educations',
                'name' => 'educations-show',
            ],

            // Experience
            [
                'label' => 'experiences',
                'name' => 'experiences-list',
            ],
            [
                'label' => 'experiences',
                'name' => 'experiences-create',
            ],
            [
                'label' => 'experiences',
                'name' => 'experiences-edit',
            ],
            [
                'label' => 'experiences',
                'name' => 'experiences-delete',
            ],
            [
                'label' => 'experiences',
                'name' => 'experiences-show',
            ],

            // Skills
            [
                'label' => 'skills',
                'name' => 'skills-list',
            ],
            [
                'label' => 'skills',
                'name' => 'skills-create',
            ],
            [
                'label' => 'skills',
                'name' => 'skills-edit',
            ],
            [
                'label' => 'skills',
                'name' => 'skills-delete',
            ],
            [
                'label' => 'skills',
                'name' => 'skills-show',
            ],

            // Projects
            [
                'label' => 'projects',
                'name' => 'projects-list',
            ],
            [
                'label' => 'projects',
                'name' => 'projects-create',
            ],
            [
                'label' => 'projects',
                'name' => 'projects-edit',
            ],
            [
                'label' => 'projects',
                'name' => 'projects-delete',
            ],
            [
                'label' => 'projects',
                'name' => 'projects-show',
            ],

            // Services
            [
                'label' => 'projects',
                'name' => 'services-list',
            ],
            [
                'label' => 'projects',
                'name' => 'services-create',
            ],
            [
                'label' => 'projects',
                'name' => 'services-edit',
            ],
            [
                'label' => 'projects',
                'name' => 'services-delete',
            ],
            [
                'label' => 'projects',
                'name' => 'services-show',
            ],

            // Testimonials
            [
                'label' => 'testimonials',
                'name' => 'testimonials-list',
            ],
            [
                'label' => 'testimonials',
                'name' => 'testimonials-create',
            ],
            [
                'label' => 'testimonials',
                'name' => 'testimonials-edit',
            ],
            [
                'label' => 'testimonials',
                'name' => 'testimonials-delete',
            ],
            [
                'label' => 'testimonials',
                'name' => 'testimonials-show',
            ],

            // Contact Messages
            [
                'label' => 'contact_messages',
                'name' => 'contact_messages-list',
            ],
            [
                'label' => 'contact_messages',
                'name' => 'contact_messages-show',
            ],
            [
                'label' => 'contact_messages',
                'name' => 'contact_messages-delete',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                [
                    'name' => $permission['name'],
                    'guard_name' => 'web',
                ],
                [
                    'label' => $permission['label'],
                ]
            );
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
