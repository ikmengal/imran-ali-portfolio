<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'banner_image',
        'banner_alt',
        'banner_overlay',
        'content',
        'meta_title',
        'meta_description',
        'is_visible',
        'show_in_footer',
        'sort_order',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'show_in_footer' => 'boolean',
        'banner_overlay' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Page $page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeInFooter($query)
    {
        return $query->where('show_in_footer', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
