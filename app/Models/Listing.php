<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::deleting(function ($listing) {
            $listing->tags()->detach();
            $listing->clicks()->delete();
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function clicks()
    {
        return $this->hasMany(Click::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // Provide a `description` attribute for views that expect it (maps to `content` column)
    public function getDescriptionAttribute()
    {
        return $this->attributes['content'] ?? null;
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['content'] = $value;
    }
}