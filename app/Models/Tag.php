<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function listings()
    {
        return $this->belongsToMany(
            Listing::class,   // Related model
            'listing_tag',    // Pivot table name
            'tag_id',         // Foreign key on pivot table for this model
            'listing_id'      // Foreign key on pivot table for the related model
        );
    }
}
