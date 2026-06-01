<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#2563eb">
        <meta name="description" content="JobHub - Find your next opportunity">

        <title>{{ config('app.name', 'JobHub') }} - Find Great Jobs</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-950 dark:to-slate-900">
        <div class="min-h-screen flex flex-col">
            <!-- Navigation -->
            <nav class="navbar border-b border-gray-200 dark:border-gray-700">
                <div class="navbar-container">
                    <div class="flex items-center gap-8">
                        <a href="/" class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="w-10 h-10 flex-shrink-0">
                                <defs>
                                    <linearGradient id="jobhubGrad" x1="0%" x2="100%" y1="0%" y2="100%">
                                        <stop offset="0%" stop-color="#2563eb" />
                                        <stop offset="100%" stop-color="#7c3aed" />
                                    </linearGradient>
                                </defs>
                                <rect width="48" height="48" rx="10" fill="url(#jobhubGrad)" />
                                <path fill="#fff" d="M24 9c-7 6-12 12.5-12 16.5 0 4.5 3.6 6.5 12 6.5s12-2 12-6.5c0-4-5-10.5-12-16.5z" />
                                <circle cx="31" cy="17" r="1.6" fill="#fff" />
                            </svg>
                            <span class="text-xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600">JOBHUB</span>
                        </a>
                        <div class="hidden md:flex gap-6">
                            @auth
                                <a href="/dashboard" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition">Dashboard</a>
                            @endauth
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        @auth
                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-small">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline btn-small">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary btn-small">Sign Up</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-gray-900 dark:bg-black text-white py-12 mt-20">
                <div class="max-w-7xl mx-auto px-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                        <div>
                            <h3 class="text-lg font-bold mb-4">JobHub</h3>
                            <p class="text-gray-400 text-sm">Find your next opportunity with JobHub - the modern job board platform.</p>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-4">For Job Seekers</h4>
                            <ul class="space-y-2 text-sm text-gray-400">
                                <li><a href="/listings" class="hover:text-white transition">Browse Jobs</a></li>
                                <li><a href="/applications" class="hover:text-white transition">My Applications</a></li>
                                <li><a href="/profile" class="hover:text-white transition">Profile</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-4">For Employers</h4>
                            <ul class="space-y-2 text-sm text-gray-400">
                                <li><a href="/listings/create" class="hover:text-white transition">Post Job</a></li>
                                <li><a href="/dashboard" class="hover:text-white transition">Dashboard</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-4">Company</h4>
                            <ul class="space-y-2 text-sm text-gray-400">
                                <li><a href="#" class="hover:text-white transition">About</a></li>
                                <li><a href="#" class="hover:text-white transition">Contact</a></li>
                                <li><a href="#" class="hover:text-white transition">Terms</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="border-t border-gray-800 pt-8">
                        <p class="text-center text-gray-400 text-sm">&copy; {{ date('Y') }} JobHub. All rights reserved. | <a href="#" class="hover:text-white transition">Privacy Policy</a> | <a href="#" class="hover:text-white transition">Terms of Service</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
