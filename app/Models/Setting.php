<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'white_name',
        'logo',
        'white_logo',
        'favicon',
        'footer_text',
        'email',
        'phone',
        'address',
        'social_links',
        'meta_data',
    ];

    protected $casts = [
        'social_links' => 'array',
        'meta_data' => 'array',
    ];

    public static function getSettings(): ?self
    {
        return static::first();
    }

    public function getLogoUrl(): string
    {
        if ($this->logo) {
            return asset('admin/assets/settings/' . $this->logo);
        }
        return asset('admin/assets/logo/vertical-w-logo.png');
    }

    public function getWhiteLogoUrl(): string
    {
        if ($this->white_logo) {
            return asset('admin/assets/settings/' . $this->white_logo);
        }
        return asset('admin/assets/logo/vertical-b-logo.png');
    }

    public function getFaviconUrl(): string
    {
        if ($this->favicon) {
            return asset('admin/assets/settings/' . $this->favicon);
        }
        return asset('admin/assets/logo/favicon.png');
    }
}