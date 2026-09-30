<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = Permission::where('guard_name', 'web')->get();

        /*
        |--------------------------------------------------------------------------
        | Super Admin
        |--------------------------------------------------------------------------
        */

        $superAdmin = Role::updateOrCreate(
            [
                'name' => 'Super Admin',
                'guard_name' => 'web',
            ]
        );

        $superAdmin->syncPermissions($permissions);

        /*
        |--------------------------------------------------------------------------
        | Admin
        |--------------------------------------------------------------------------
        */

        $admin = Role::updateOrCreate(
            [
                'name' => 'Admin',
                'guard_name' => 'web',
            ]
        );

        $adminPermissions = [
            // Users
            'users-list',
            'users-create',
            'users-edit',
            'users-delete',
            'users-show',

            // Education
            'educations-list',
            'educations-create',
            'educations-edit',
            'educations-delete',
            'educations-show',

            // Experience
            'experiences-list',
            'experiences-create',
            'experiences-edit',
            'experiences-delete',
            'experiences-show',

            // Skills
            'skills-list',
            'skills-create',
            'skills-edit',
            'skills-delete',
            'skills-show',

            // Projects
            'projects-list',
            'projects-create',
            'projects-edit',
            'projects-delete',
            'projects-show',

            // Services
            'services-list',
            'services-create',
            'services-edit',
            'services-delete',
            'services-show',

            // Testimonials
            'testimonials-list',
            'testimonials-create',
            'testimonials-edit',
            'testimonials-delete',
            'testimonials-show',

            // Contact Messages
            'contact_messages-list',
            'contact_messages-show',
            'contact_messages-delete',
        ];

        $admin->syncPermissions(
            Permission::where('guard_name', 'web')
                ->whereIn('name', $adminPermissions)
                ->get()
        );

        /*
        |--------------------------------------------------------------------------
        | User
        |--------------------------------------------------------------------------
        */

        $user = Role::updateOrCreate(
            [
                'name' => 'User',
                'guard_name' => 'web',
            ]
        );

        $userPermissions = [
            'educations-list',
            'educations-show',
            'experiences-list',
            'experiences-show',
            'skills-list',
            'skills-show',
            'projects-list',
            'projects-show',
            'services-list',
            'services-show',
            'testimonials-list',
            'testimonials-show',
        ];

        $user->syncPermissions(
            Permission::where('guard_name', 'web')
                ->whereIn('name', $userPermissions)
                ->get()
        );

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
