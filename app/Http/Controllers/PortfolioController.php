<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\User;

class PortfolioController extends Controller
{
    public function index()
    {
        $user = User::whereHas('roles', function ($query) {
            $query->where('name', 'Super Admin');
        })->first();

        if (! $user) {
            $user = User::first();
        }

        $skills = Skill::visible()->ordered()->get()->groupBy('category');
        $experiences = Experience::visible()->ordered()->get();
        $education = Education::visible()->ordered()->get();
        $projects = Project::visible()->ordered()->with('technologies')->get();
        $featuredProjects = Project::visible()->featured()->ordered()->with('technologies')->get();
        $services = Service::visible()->ordered()->get();
        $testimonials = Testimonial::visible()->ordered()->get();

        return view('portfolio.index', compact(
            'user',
            'skills',
            'experiences',
            'education',
            'projects',
            'featuredProjects',
            'services',
            'testimonials'
        ));
    }
}
