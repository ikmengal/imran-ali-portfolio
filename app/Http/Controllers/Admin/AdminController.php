<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Traits\Filterable;
use App\Models\ContactMessage;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdminController extends Controller
{
    use AuthorizesRequests, Filterable;

    protected function scopeRecords(Builder $query): Builder
    {
        $user = auth()->user();

        if ($user->hasRole('Super Admin')) {
            return $query;
        }

        $model = $query->getModel();
        $table = $model->getTable();

        $userOwnedTables = ['educations', 'experiences', 'projects', 'skills', 'services', 'testimonials'];

        if (in_array($table, $userOwnedTables)) {
            return $query->where('user_id', $user->id);
        }

        return $query;
    }

    protected function getFilters(string $modelClass): array
    {
        return match ($modelClass) {
            Project::class => [
                ['name' => 'search', 'type' => 'search', 'column' => 'title', 'label' => 'Search Title'],
                ['name' => 'category', 'type' => 'select', 'column' => 'category', 'label' => 'Category', 'options' => $this->getFilterOptions(Project::class, 'category')],
                ['name' => 'is_visible', 'type' => 'boolean', 'column' => 'is_visible', 'label' => 'Visibility', 'options' => [1 => 'Visible', 0 => 'Hidden']],
                ['name' => 'is_featured', 'type' => 'boolean', 'column' => 'is_featured', 'label' => 'Featured', 'options' => [1 => 'Featured', 0 => 'Not Featured']],
            ],
            Experience::class => [
                ['name' => 'search', 'type' => 'search', 'column' => 'job_title', 'label' => 'Search Job Title'],
                ['name' => 'company', 'type' => 'search', 'column' => 'company', 'label' => 'Search Company'],
                ['name' => 'employment_type', 'type' => 'select', 'column' => 'employment_type', 'label' => 'Employment Type', 'options' => $this->getFilterOptions(Experience::class, 'employment_type')],
                ['name' => 'is_visible', 'type' => 'boolean', 'column' => 'is_visible', 'label' => 'Visibility', 'options' => [1 => 'Visible', 0 => 'Hidden']],
                ['name' => 'is_current', 'type' => 'boolean', 'column' => 'is_current', 'label' => 'Current', 'options' => [1 => 'Current', 0 => 'Past']],
            ],
            Education::class => [
                ['name' => 'search', 'type' => 'search', 'column' => 'degree', 'label' => 'Search Degree'],
                ['name' => 'institution', 'type' => 'search', 'column' => 'institution', 'label' => 'Search Institution'],
                ['name' => 'is_visible', 'type' => 'boolean', 'column' => 'is_visible', 'label' => 'Visibility', 'options' => [1 => 'Visible', 0 => 'Hidden']],
                ['name' => 'is_current', 'type' => 'boolean', 'column' => 'is_current', 'label' => 'Current', 'options' => [1 => 'Current', 0 => 'Completed']],
            ],
            Skill::class => [
                ['name' => 'search', 'type' => 'search', 'column' => 'name', 'label' => 'Search Skill'],
                ['name' => 'category', 'type' => 'select', 'column' => 'category', 'label' => 'Category', 'options' => $this->getFilterOptions(Skill::class, 'category')],
                ['name' => 'is_visible', 'type' => 'boolean', 'column' => 'is_visible', 'label' => 'Visibility', 'options' => [1 => 'Visible', 0 => 'Hidden']],
                ['name' => 'is_featured', 'type' => 'boolean', 'column' => 'is_featured', 'label' => 'Featured', 'options' => [1 => 'Featured', 0 => 'Not Featured']],
            ],
            Service::class => [
                ['name' => 'search', 'type' => 'search', 'column' => 'title', 'label' => 'Search Title'],
                ['name' => 'is_visible', 'type' => 'boolean', 'column' => 'is_visible', 'label' => 'Visibility', 'options' => [1 => 'Visible', 0 => 'Hidden']],
                ['name' => 'is_featured', 'type' => 'boolean', 'column' => 'is_featured', 'label' => 'Featured', 'options' => [1 => 'Featured', 0 => 'Not Featured']],
            ],
            Testimonial::class => [
                ['name' => 'search', 'type' => 'search', 'column' => 'name', 'label' => 'Search Name'],
                ['name' => 'company', 'type' => 'search', 'column' => 'company', 'label' => 'Search Company'],
                ['name' => 'rating', 'type' => 'select', 'column' => 'rating', 'label' => 'Rating', 'options' => [5 => '5 Stars', 4 => '4 Stars', 3 => '3 Stars', 2 => '2 Stars', 1 => '1 Star']],
                ['name' => 'is_visible', 'type' => 'boolean', 'column' => 'is_visible', 'label' => 'Visibility', 'options' => [1 => 'Visible', 0 => 'Hidden']],
            ],
            ContactMessage::class => [
                ['name' => 'search', 'type' => 'search', 'column' => 'name', 'label' => 'Search Name'],
                ['name' => 'email', 'type' => 'search', 'column' => 'email', 'label' => 'Search Email'],
                ['name' => 'is_read', 'type' => 'boolean', 'column' => 'is_read', 'label' => 'Status', 'options' => [1 => 'Read', 0 => 'Unread']],
            ],
            User::class => [
                ['name' => 'search', 'type' => 'search', 'column' => 'name', 'label' => 'Search Name'],
                ['name' => 'email', 'type' => 'search', 'column' => 'email', 'label' => 'Search Email'],
                ['name' => 'role', 'type' => 'custom', 'label' => 'Role', 'options' => ['Super Admin' => 'Super Admin', 'Admin' => 'Admin', 'User' => 'User'], 'callback' => function ($query, $value) {
                    $query->whereHas('roles', function ($q) use ($value) {
                        $q->where('name', $value);
                    });
                }],
                ['name' => 'status', 'type' => 'custom', 'label' => 'Status', 'options' => ['active' => 'Active', 'trashed' => 'Trashed'], 'callback' => function ($query, $value) {
                    if ($value === 'trashed') {
                        $query->onlyTrashed();
                    }
                }],
                ['name' => 'email_verified', 'type' => 'custom', 'label' => 'Email Verified', 'options' => [1 => 'Verified', 0 => 'Unverified'], 'callback' => function ($query, $value) {
                    if ($value == 1) {
                        $query->whereNotNull('email_verified_at');
                    } elseif ($value == 0) {
                        $query->whereNull('email_verified_at');
                    }
                }],
            ],
            default => [],
        };
    }

    protected function authorizeRecord($record): void
    {
        $user = auth()->user();

        if ($user->hasRole('Super Admin')) {
            return;
        }

        $model = $record;
        $table = $model->getTable();

        $userOwnedTables = ['educations', 'experiences', 'projects', 'skills', 'services', 'testimonials'];

        if (in_array($table, $userOwnedTables)) {
            if ($record->user_id !== $user->id) {
                abort(403, 'Unauthorized. You can only access your own records.');
            }
        }
    }

    public function dashboard()
    {
        $user = auth()->user();
        $isSuperAdmin = $user->hasRole('Super Admin');

        $baseQuery = $isSuperAdmin ? fn ($model) => $model::query() : fn ($model) => $model::where('user_id', $user->id);

        $stats = [
            'projects' => $baseQuery(Project::class)->count(),
            'featured_projects' => $baseQuery(Project::class)->where('is_featured', true)->count(),
            'github_projects' => $baseQuery(Project::class)->whereNotNull('github_url')->where('github_url', '!=', '')->count(),
            'experiences' => $baseQuery(Experience::class)->count(),
            'education' => $baseQuery(Education::class)->count(),
            'skills' => $baseQuery(Skill::class)->count(),
            'services' => $baseQuery(Service::class)->count(),
            'testimonials' => $baseQuery(Testimonial::class)->count(),
            'messages' => ContactMessage::count(),
            'unread_messages' => ContactMessage::unread()->count(),
            'certifications' => 0, // Placeholder - requires separate certifications table
        ];

        // Additional analytical data
        $analytics = [
            'visible_projects' => $baseQuery(Project::class)->where('is_visible', true)->count(),
            'featured_projects' => $baseQuery(Project::class)->where('is_featured', true)->count(),
            'github_projects' => $baseQuery(Project::class)->whereNotNull('github_url')->where('github_url', '!=', '')->count(),
            'visible_experiences' => $baseQuery(Experience::class)->where('is_visible', true)->count(),
            'current_experiences' => $baseQuery(Experience::class)->where('is_current', true)->count(),
            'visible_education' => $baseQuery(Education::class)->where('is_visible', true)->count(),
            'current_education' => $baseQuery(Education::class)->where('is_current', true)->count(),
            'visible_skills' => $baseQuery(Skill::class)->where('is_visible', true)->count(),
            'featured_skills' => $baseQuery(Skill::class)->where('is_featured', true)->count(),
            'visible_services' => $baseQuery(Service::class)->where('is_visible', true)->count(),
            'featured_services' => $baseQuery(Service::class)->where('is_featured', true)->count(),
            'visible_testimonials' => $baseQuery(Testimonial::class)->where('is_visible', true)->count(),
            'recent_messages' => ContactMessage::latest()->take(5)->get(),
            'recent_projects' => $baseQuery(Project::class)->with('technologies')->latest()->take(5)->get(),
            'messages_this_month' => ContactMessage::whereMonth('created_at', now()->month)->count(),
            'messages_last_month' => ContactMessage::whereMonth('created_at', now()->subMonth()->month)->count(),
            'projects_this_month' => $baseQuery(Project::class)->whereMonth('created_at', now()->month)->count(),
            'projects_last_month' => $baseQuery(Project::class)->whereMonth('created_at', now()->subMonth()->month)->count(),
            'skills_this_month' => $baseQuery(Skill::class)->whereMonth('created_at', now()->month)->count(),
            'skills_last_month' => $baseQuery(Skill::class)->whereMonth('created_at', now()->subMonth()->month)->count(),
        ];

        // Growth percentages
        $analytics['messages_growth'] = $this->calculateGrowth($analytics['messages_this_month'], $analytics['messages_last_month']);
        $analytics['projects_growth'] = $this->calculateGrowth($analytics['projects_this_month'], $analytics['projects_last_month']);
        $analytics['skills_growth'] = $this->calculateGrowth($analytics['skills_this_month'], $analytics['skills_last_month']);

        // Skills breakdown by category
        $skillsByCategory = $baseQuery(Skill::class)->where('is_visible', true)
            ->selectRaw('category, count(*) as count, avg(percentage) as avg_percentage')
            ->groupBy('category')
            ->orderByDesc('count')
            ->get();

        // Projects by category
        $projectsByCategory = $baseQuery(Project::class)->where('is_visible', true)
            ->selectRaw('category, count(*) as count')
            ->groupBy('category')
            ->orderByDesc('count')
            ->get();

        // Monthly trends for charts (last 6 months)
        $monthlyProjects = $this->getMonthlyTrends($baseQuery, Project::class, 6);
        $monthlyMessages = $this->getMonthlyTrends(fn ($m) => ContactMessage::query(), ContactMessage::class, 6);
        $monthlySkills = $this->getMonthlyTrends($baseQuery, Skill::class, 6);

        // Skills proficiency distribution
        $skillsProficiency = $baseQuery(Skill::class)->where('is_visible', true)
            ->selectRaw('
                CASE
                    WHEN percentage >= 80 THEN "Expert (80-100%)"
                    WHEN percentage >= 60 THEN "Advanced (60-79%)"
                    WHEN percentage >= 40 THEN "Intermediate (40-59%)"
                    WHEN percentage >= 20 THEN "Beginner (20-39%)"
                    ELSE "Learning (0-19%)"
                END as level,
                count(*) as count
            ')
            ->groupBy('level')
            ->orderByRaw('MIN(percentage) DESC')
            ->get();

        // Recent activity (simulated from recent model changes)
        $recentActivity = $this->getRecentActivity($baseQuery, $isSuperAdmin, $user->id);

        return view('admin.dashboard', compact(
            'stats',
            'analytics',
            'skillsByCategory',
            'projectsByCategory',
            'monthlyProjects',
            'monthlyMessages',
            'monthlySkills',
            'skillsProficiency',
            'recentActivity'
        ));
    }

    protected function calculateGrowth(int $current, int $previous): float
    {
        if ($previous > 0) {
            return round((($current - $previous) / $previous) * 100, 1);
        }

        return $current > 0 ? 100 : 0;
    }

    protected function getMonthlyTrends(callable $baseQuery, string $model, int $months = 6): array
    {
        $labels = [];
        $data = [];

        for ($i = $months - 1; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $labels[] = $date->format('M Y');
            $data[] = $baseQuery($model)->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return ['labels' => $labels, 'data' => $data];
    }

    protected function getRecentActivity(callable $baseQuery, bool $isSuperAdmin, int $userId, int $limit = 10): array
    {
        $activities = [];

        // Recent projects
        $recentProjects = $baseQuery(Project::class)->latest('created_at')->take($limit)->get();
        foreach ($recentProjects as $project) {
            $activities[] = [
                'type' => 'project_created',
                'icon' => 'ph-folder-simple-plus',
                'color' => 'primary',
                'description' => "Created project <strong>{$project->title}</strong>",
                'time' => $project->created_at->diffForHumans(),
                'url' => route('admin.projects.show', $project),
            ];
        }

        // Recent experiences
        $recentExperiences = $baseQuery(Experience::class)->latest('created_at')->take($limit)->get();
        foreach ($recentExperiences as $exp) {
            $activities[] = [
                'type' => 'experience_created',
                'icon' => 'ph-briefcase',
                'color' => 'info',
                'description' => "Added experience <strong>{$exp->job_title}</strong> at <strong>{$exp->company}</strong>",
                'time' => $exp->created_at->diffForHumans(),
                'url' => route('admin.experiences.show', $exp),
            ];
        }

        // Recent skills
        $recentSkills = $baseQuery(Skill::class)->latest('created_at')->take($limit)->get();
        foreach ($recentSkills as $skill) {
            $activities[] = [
                'type' => 'skill_created',
                'icon' => 'ph-code',
                'color' => 'secondary',
                'description' => "Added skill <strong>{$skill->name}</strong>",
                'time' => $skill->created_at->diffForHumans(),
                'url' => route('admin.skills.show', $skill),
            ];
        }

        // Recent messages
        $recentMessages = ContactMessage::latest('created_at')->take($limit)->get();
        foreach ($recentMessages as $msg) {
            $activities[] = [
                'type' => 'message_received',
                'icon' => 'ph-envelope',
                'color' => 'danger',
                'description' => "New message from <strong>{$msg->name}</strong> ({$msg->email})",
                'time' => $msg->created_at->diffForHumans(),
                'url' => route('admin.messages.show', $msg),
            ];
        }

        // Sort by time and limit
        usort($activities, fn ($a, $b) => strtotime($b['time']) - strtotime($a['time']));

        return array_slice($activities, 0, $limit);
    }
}
