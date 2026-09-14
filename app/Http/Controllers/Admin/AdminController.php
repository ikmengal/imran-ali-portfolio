<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'projects' => \App\Models\Project::count(),
            'experiences' => \App\Models\Experience::count(),
            'education' => \App\Models\Education::count(),
            'skills' => \App\Models\Skill::count(),
            'services' => \App\Models\Service::count(),
            'testimonials' => \App\Models\Testimonial::count(),
            'messages' => \App\Models\ContactMessage::count(),
            'unread_messages' => \App\Models\ContactMessage::unread()->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}