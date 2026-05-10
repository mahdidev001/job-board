<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagApiController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::orderBy('name')->get();
        return response()->json($tags);
    }
}
