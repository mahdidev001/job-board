<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Click;
use App\Models\Listing;
use Illuminate\Http\Request;

class ClickApiController extends Controller
{
    public function track(Request $request, Listing $listing)
    {
        Click::create([
            'listing_id' => $listing->id,
            'user_id' => auth()->id(),
        ]);

        return response()->json(['message' => 'Click tracked successfully']);
    }
}
