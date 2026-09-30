<?php

namespace App\Providers;

use App\Models\ContactMessage;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\User;
use App\Policies\ContactMessagePolicy;
use App\Policies\EducationPolicy;
use App\Policies\ExperiencePolicy;
use App\Policies\ProjectPolicy;
use App\Policies\ServicePolicy;
use App\Policies\SkillPolicy;
use App\Policies\TestimonialPolicy;
use App\Policies\UserPolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Project::class => ProjectPolicy::class,
        Skill::class => SkillPolicy::class,
        Service::class => ServicePolicy::class,
        Experience::class => ExperiencePolicy::class,
        Education::class => EducationPolicy::class,
        Testimonial::class => TestimonialPolicy::class,
        ContactMessage::class => ContactMessagePolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        foreach ($this->policies as $model => $policy) {
            Gate::policy($model, $policy);
        }
    }
}
