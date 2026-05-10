<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\Request;

class ApplicationApiController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $applications = $user->applications()->with('listing')->paginate(20);
        return response()->json($applications);
    }

    public function store(Request $request, Listing $listing)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $user = $request->user();

        // Check if user already applied
        if ($user->applications()->where('listing_id', $listing->id)->exists()) {
            return response()->json(['error' => 'You have already applied to this listing'], 409);
        }

        $application = $user->applications()->create([
            'listing_id' => $listing->id,
            'message' => $validated['message'],
        ]);

        return response()->json($application, 201);
    }

    public function listingApplications(Request $request, Listing $listing)
    {
        if ($listing->user_id !== $request->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $applications = $listing->applications()->with('user')->paginate(20);
        return response()->json($applications);
    }
}
