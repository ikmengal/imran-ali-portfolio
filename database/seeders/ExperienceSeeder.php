<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Experience;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Experience::query()->delete();

        Experience::create([
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
