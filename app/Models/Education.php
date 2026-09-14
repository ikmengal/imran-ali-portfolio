<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'degree',
        'institution',
        'field',
        'start_year',
        'end_year',
        'description',
        'location',
        'is_current',
        'is_visible',
        'sort_order',
    ];

    protected $casts = [
        'is_current' => 'boolean',
        'is_visible' => 'boolean',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
