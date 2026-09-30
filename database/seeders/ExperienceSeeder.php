<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\User;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Experience::query()->delete();

        $user = User::whereHas('roles', function ($query) {
            $query->where('name', 'Super Admin');
        })->first() ?? User::first();

        if (! $user) {
            return;
        }

        Experience::create([
            'user_id' => $user->id,
            'job_title' => 'Laravel Backend Developer',
            'company' => 'Your Company',
            'employment_type' => 'Full Time',
            'location' => 'Pakistan',
            'start_date' => '2022-01-01',
            'end_date' => null,
            'is_current' => true,
            'description' => 'Developing scalable Laravel applications, REST APIs, admin panels, database architecture and business workflows.',
            'is_visible' => true,
            'sort_order' => 1,
        ]);

        Experience::create([
            'user_id' => $user->id,
            'job_title' => 'PHP Laravel Developer',
            'company' => 'Previous Company',
            'employment_type' => 'Full Time',
            'location' => 'Pakistan',
            'start_date' => '2020-01-01',
            'end_date' => '2021-12-31',
            'is_current' => false,
            'description' => 'Worked on PHP and Laravel based web applications and database-driven systems.',
            'is_visible' => true,
            'sort_order' => 2,
        ]);
    }
}
