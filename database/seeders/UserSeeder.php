<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | Super Admin
        |--------------------------------------------------------------------------
        */

        $superAdmin = User::updateOrCreate(
            [
                'email' => 'admin@example.com',
            ],
            [
                'name' => 'Super Admin',
                'bio' => 'Full-stack Laravel developer building robust applications with modern practices.',
                'password' => Hash::make('password'),
            ]
        );

        $superAdmin->syncRoles([
            Role::findByName('Super Admin', 'web'),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Admin
        |--------------------------------------------------------------------------
        */

        $admin = User::updateOrCreate(
            [
                'email' => 'user@example.com',
            ],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );

        $admin->syncRoles([
            Role::findByName('Admin', 'web'),
        ]);
    }
}
