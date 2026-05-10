<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

// Public API endpoints
Route::get('/listings', [Api\ListingApiController::class, 'index']);
Route::get('/listings/{listing}', [Api\ListingApiController::class, 'show']);
Route::get('/listings/{listing}/details', [Api\ListingApiController::class, 'showDetails']);
Route::get('/tags', [Api\TagApiController::class, 'index']);
Route::get('/search', [Api\ListingApiController::class, 'search']);

// Authentication endpoints
Route::post('/auth/register', [Api\AuthApiController::class, 'register']);
Route::post('/auth/login', [Api\AuthApiController::class, 'login']);

// Protected API endpoints
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/auth/logout', [Api\AuthApiController::class, 'logout']);
    Route::get('/auth/me', [Api\AuthApiController::class, 'me']);
    Route::put('/auth/me', [Api\AuthApiController::class, 'updateProfile']);
    
    // Listings
    Route::post('/listings', [Api\ListingApiController::class, 'store']);
    Route::put('/listings/{listing}', [Api\ListingApiController::class, 'update']);
    Route::delete('/listings/{listing}', [Api\ListingApiController::class, 'destroy']);
    
    // Applications
    Route::get('/applications', [Api\ApplicationApiController::class, 'index']);
    Route::post('/listings/{listing}/apply', [Api\ApplicationApiController::class, 'store']);
    Route::get('/listings/{listing}/applications', [Api\ApplicationApiController::class, 'listingApplications']);
    
    // Ratings
    Route::post('/listings/{listing}/rate', [Api\RatingApiController::class, 'store']);
    Route::get('/ratings', [Api\RatingApiController::class, 'index']);
    
    // Clicks tracking
    Route::post('/listings/{listing}/click', [Api\ClickApiController::class, 'track']);
});
