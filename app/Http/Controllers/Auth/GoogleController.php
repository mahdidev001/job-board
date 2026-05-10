<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            \Log::error('Google OAuth callback error: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['google' => 'Unable to login using Google. Please try again. (check server logs)']);
        }

        $user = User::where('google_id', $googleUser->getId())
            ->orWhere('email', $googleUser->getEmail())
            ->first();

        if (! $user) {
            // Redirect new Google users to the register page with prefilled data
            return redirect()->route('register', [
                'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? '',
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
            ]);
        }

        if (! $user->google_id) {
            $user->google_id = $googleUser->getId();
            $user->save();
        }

        Auth::login($user, true);

        if (empty($user->role)) {
            return redirect()->route('auth.google.choose-role');
        }

        return redirect()->route('listings.index');
    }

    public function showChooseRole()
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        return view('auth.choose-role');
    }

    public function saveChooseRole(Request $request)
    {
        $request->validate([
            'role' => 'required|in:user,employer',
        ]);

        $user = auth()->user();
        if (! $user) {
            return redirect()->route('login');
        }

        $user->role = $request->role;
        $user->save();

        return redirect()->route('dashboard');
    }
}
