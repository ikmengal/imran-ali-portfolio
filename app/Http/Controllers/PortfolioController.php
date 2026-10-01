<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request, $slug = null)
    {
        if ($slug) {
            $user = User::where('portfolio_slug', $slug)->firstOrFail();
        } elseif (auth()->check()) {
            $user = auth()->user();
        } else {
            $user = User::whereHas('roles', function ($q) {
                $q->where('name', 'Super Admin');
            })->first();

            if (! $user) {
                $user = User::first();
            }
        }

        $skills = $user->skills()->visible()->ordered()->get()->groupBy('category');
        $experiences = $user->experiences()->visible()->ordered()->get();
        $education = $user->education()->visible()->ordered()->get();
        $projects = $user->projects()->visible()->ordered()->with('technologies')->get();
        $featuredProjects = $user->projects()->visible()->featured()->ordered()->with('technologies')->get();
        $services = $user->services()->visible()->ordered()->get();
        $testimonials = $user->testimonials()->visible()->ordered()->get();

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