<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\Auth\GoogleController;



// Primary listings index route
Route::get('/listings', [Controllers\ListingController::class, 'index'])
    ->name('listings.index');

// Keep root path simple and redirect to listings
Route::get('/', function () {
    return redirect()->route('listings.index');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/new', [Controllers\ListingController::class, 'create'])
        ->name('listings.create');

    Route::post('/new', [Controllers\ListingController::class, 'store'])
        ->name('listings.store');

    Route::delete('/listings/{listing}', [Controllers\ListingController::class, 'destroy'])
        ->name('listings.destroy');

    Route::get('/listings/{listing}/edit', [Controllers\ListingController::class, 'edit'])
        ->name('listings.edit');

    Route::put('/listings/{listing}', [Controllers\ListingController::class, 'update'])
        ->name('listings.update');

    Route::get('/listings/{listing}/applications', [Controllers\ListingController::class, 'applications'])
        ->name('listings.applications');

    Route::post('/listings/{listing}/rate', [Controllers\ListingController::class, 'rate'])
        ->name('listings.rate');
});

Route::get('/dashboard', function (\Illuminate\Http\Request $request) {
    // Redirect non-employers to home page
    if ($request->user()->role !== 'employer') {
        return redirect()->route('listings.index');
    }
    
    return view('dashboard', [
        'listings' => $request->user()->listings
    ]);
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/listings/{listing}', [Controllers\ListingController::class, 'show'])
    ->name('listings.show');

Route::get('/listings/{listing}/apply', [Controllers\ListingController::class, 'apply'])
    ->middleware(['auth','verified'])
    ->name('listings.apply');

// Google OAuth
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::middleware('auth')->group(function () {
    Route::get('auth/google/choose-role', [GoogleController::class, 'showChooseRole'])->name('auth.google.choose-role');
    Route::post('auth/google/choose-role', [GoogleController::class, 'saveChooseRole'])->name('auth.google.choose-role.post');
});
    