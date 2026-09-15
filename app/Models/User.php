<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password', 'profile_image', 'bio'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function education()
    {
        return $this->hasMany(Education::class)->ordered();
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class)->ordered();
    }

    public function skills()
    {
        return $this->hasMany(Skill::class)->ordered();
    }

    public function projects()
    {
        return $this->hasMany(Project::class)->ordered();
    }

    public function projectTechnologies()
    {
        return $this->hasMany(ProjectTechnology::class)->ordered();
    }

    public function services()
    {
        return $this->hasMany(Service::class)->ordered();
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class)->ordered();
    }

    public function contactMessages()
    {
        return $this->hasMany(ContactMessage::class);
    }
}
