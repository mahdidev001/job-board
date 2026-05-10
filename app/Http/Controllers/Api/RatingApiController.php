<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingApiController extends Controller
{
    public function store(Request $request, Listing $listing)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $rating = Rating::updateOrCreate(
            [
                'listing_id' => $listing->id,
                'user_id' => auth()->id(),
            ],
            [
                'rating' => $validated['rating'],
                'comment' => $validated['comment'] ?? null,
            ]
        );

        return response()->json($rating, 201);
    }

    public function index(Request $request)
    {
        $ratings = auth()->user()->ratings()->with('listing')->paginate(20);
        return response()->json($ratings);
    }
}
