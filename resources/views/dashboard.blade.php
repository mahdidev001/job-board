<x-app-layout>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-gray-800 dark:to-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-2">
                        @if(auth()->user()->role === 'employer')
                            Dashboard
                        @else
                            My Applications
                        @endif
                    </h1>
                    <p class="text-blue-100 dark:text-gray-300">Manage your job listings and applications</p>
                </div>
                @if(auth()->user()->role === 'employer')
                    <a href="{{ route('listings.create') }}" class="btn btn-primary mt-4 md:mt-0">
                        Post New Job
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="max-w-7xl mx-auto px-4 py-12">
        @if(auth()->user()->role === 'employer')
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="card">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Active Listings</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $listings->count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Clicks</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $listings->sum(fn($l) => $l->clicks()->count()) }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Posted This Month</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $listings->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Listings Section -->
        <div>
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    @if(auth()->user()->role === 'employer')
                        Your Job Listings
                    @else
                        Your Applications
                    @endif
                </h2>
                <p class="text-gray-500 dark:text-gray-400 mt-1">
                    @if(auth()->user()->role === 'employer')
                        Manage and track your posted jobs
                    @else
                        View your submitted applications
                    @endif
                </p>
            </div>

            @if($listings->count() > 0)
                <div class="space-y-4">
                    @foreach($listings as $listing)
                        <div class="card hover:shadow-xl transition-all duration-300 {{ $listing->is_highlighted ? 'border-l-4 border-yellow-400' : '' }}">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6">
                                <!-- Logo & Basic Info (logo hidden) -->
                                <div class="flex gap-4 flex-1">
                                    <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center flex-shrink-0">
                                        <span class="text-white text-2xl font-bold">{{ substr($listing->company, 0, 1) }}</span>
                                    </div>
                                    
                                    <div class="flex-1">
                                        <a href="{{ route('listings.show', $listing->slug) }}" class="text-lg font-bold text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition">
                                            {{ $listing->title }}
                                        </a>
                                        <p class="text-gray-600 dark:text-gray-400 flex items-center gap-2 mt-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5.581m0 0H9m0 0h5.581m0 0a2.121 2.121 0 01-3.75 1.5"></path>
                                            </svg>
                                            {{ $listing->company }}
                                        </p>
                                        <p class="text-gray-500 dark:text-gray-500 text-sm mt-1">
                                            {{ $listing->location }} • Posted {{ $listing->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Stats & Actions -->
                                <div class="flex flex-col items-start md:items-end gap-4">
                                    <!-- Highlight Badge -->
                                    @if($listing->is_highlighted)
                                        <span class="badge badge-warning">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            Highlighted
                        </span>
                                    @endif

                                    @if(auth()->user()->role === 'employer')
                                        <!-- Stats -->
                                        <div class="text-right">
                                            <p class="text-gray-500 dark:text-gray-400 text-sm">
                                                <span class="font-bold text-gray-900 dark:text-white">{{ $listing->clicks()->count() }}</span> clicks
                                            </p>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="flex gap-2 flex-wrap justify-end">
                                            <a href="{{ route('listings.applications', $listing->slug) }}" class="btn btn-small btn-primary">
                                                Applications
                                            </a>
                                            <a href="{{ route('listings.edit', $listing->slug) }}" class="btn btn-small btn-secondary">
                                                Edit
                                            </a>
                                            <form action="{{ route('listings.destroy', $listing->slug) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-small btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Tags -->
                            @if($listing->tags->count() > 0)
                                <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                    @foreach($listing->tags as $tag)
                                        <span class="badge badge-secondary">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="empty-state">
                    <h3 class="empty-state-title">
                        @if(auth()->user()->role === 'employer')
                            No job listings yet
                        @else
                            No applications yet
                        @endif
                    </h3>
                    <p class="empty-state-text">
                        @if(auth()->user()->role === 'employer')
                            Create your first job listing to get started
                        @else
                            Apply to jobs to see them here
                        @endif
                    </p>
                    @if(auth()->user()->role === 'employer')
                        <a href="{{ route('listings.create') }}" class="btn btn-primary">
                            Post a Job
                        </a>
                    @else
                        <a href="{{ route('listings.index') }}" class="btn btn-primary">
                            Browse Jobs
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
