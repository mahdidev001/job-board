<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class ListingApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Listing::where('is_active', true)->with('tags')->latest();

        if ($request->has('tag')) {
            $tag = $request->get('tag');
            $query->whereHas('tags', function (Builder $builder) use ($tag) {
                $builder->where('slug', $tag);
            });
        }

        $listings = $query->paginate(20);

        return response()->json($listings);
    }

    public function show(Listing $listing)
    {
        if (!$listing->is_active) {
            return response()->json(['error' => 'Listing not found'], 404);
        }

        $listing->load('tags');
        return response()->json($listing);
    }

    public function showDetails(Listing $listing)
    {
        if (!$listing->is_active) {
            return response()->json(['error' => 'Listing not found'], 404);
        }

        $listing->load(['tags', 'user']);
        return response()->json($listing);
    }

    public function search(Request $request)
    {
        $search = $request->get('q', '');
        
        if (strlen($search) < 2) {
            return response()->json([
                'data' => [],
                'message' => 'Search query must be at least 2 characters'
            ], 400);
        }

        $listings = Listing::where('is_active', true)
            ->where(function ($query) use ($search) {
                $query->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($search) . '%'])
                      ->orWhereRaw('LOWER(company) LIKE ?', ['%' . strtolower($search) . '%'])
                      ->orWhereRaw('LOWER(location) LIKE ?', ['%' . strtolower($search) . '%']);
            })
            ->with('tags')
            ->paginate(20);

        return response()->json($listings);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'url' => 'required|url',
            'description' => 'required|string',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        $listing = auth()->user()->listings()->create([
            'title' => $validated['title'],
            'company' => $validated['company'],
            'location' => $validated['location'],
            'url' => $validated['url'],
            'description' => $validated['description'],
            'is_active' => true,
        ]);

        if (isset($validated['tags'])) {
            $listing->tags()->attach($validated['tags']);
        }

        $listing->load('tags');
        return response()->json($listing, 201);
    }

    public function update(Request $request, Listing $listing)
    {
        if ($listing->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'title' => 'string|max:255',
            'company' => 'string|max:255',
            'location' => 'string|max:255',
            'url' => 'url',
            'description' => 'string',
            'is_active' => 'boolean',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        $listing->update($validated);

        if (isset($validated['tags'])) {
            $listing->tags()->sync($validated['tags']);
        }

        $listing->load('tags');
        return response()->json($listing);
    }

    public function destroy(Listing $listing)
    {
        if ($listing->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $listing->delete();
        return response()->json(['message' => 'Listing deleted successfully']);
    }
}
