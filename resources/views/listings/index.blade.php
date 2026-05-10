<x-app-layout>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 dark:from-blue-800 dark:to-blue-900 text-white py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center">
                <h1 class="text-5xl font-bold mb-4">Find Your Next Opportunity</h1>
                <p class="text-xl text-blue-100 mb-8">Discover thousands of job opportunities in your field</p>
                
                <!-- Search Bar -->
                <div class="max-w-2xl mx-auto">
                    <form action="{{ route('listings.index') }}" method="GET" class="flex gap-2">
                        <input type="text" name="s" placeholder="Search jobs, companies, skills..." 
                               value="{{ request('s') }}"
                               class="flex-1 px-6 py-4 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="max-w-7xl mx-auto px-4 py-16">
        <!-- Alerts -->
        @if (session('error'))
            <div class="alert alert-error mb-6">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filters Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Filter by Category</h2>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('listings.index') }}"
                   class="badge {{ !request('tag') ? 'badge-primary' : 'badge-secondary' }} cursor-pointer">
                    All Jobs ({{ $listings->count() }})
                </a>
                @foreach($tags as $tag)
                    <a href="{{ route('listings.index', ['tag' => $tag->slug]) }}"
                       class="badge {{ $tag->slug === request('tag') ? 'badge-primary' : 'badge-secondary' }} cursor-pointer hover:opacity-80 transition">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Jobs Grid -->
        <div class="space-y-4">
            @forelse($listings as $listing)
                     <a href="{{ route('listings.show', $listing->slug) }}"
                   class="card group block hover:shadow-xl transition-all duration-300">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                        <!-- Left Side -->
                        <div class="flex-1">
                            <div class="flex items-start gap-4">
                                <!-- Company Logo -->
                                @if($listing->logo)
                                    <img src="/storage/{{ $listing->logo }}"
                                         alt="{{ $listing->company }}"
                                         class="w-14 h-14 rounded-lg object-cover ring-2 ring-gray-200 dark:ring-gray-700 flex-shrink-0">
                                @else
                                    <div class="w-14 h-14 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center flex-shrink-0">
                                        <span class="text-white font-bold">{{ substr($listing->company, 0, 1) }}</span>
                                    </div>
                                @endif

                                <!-- Job Info -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition truncate">
                                        {{ $listing->title }}
                                    </h3>
                                    <p class="text-gray-700 dark:text-gray-300 font-medium">{{ $listing->company }}</p>
                                    <div class="flex items-center gap-2 mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $listing->location }}
                                    </div>
                                    @if($listing->salary_min || $listing->salary_max)
                                        <p class="text-sm text-gray-700 dark:text-gray-300 mt-2 font-semibold">
                                            @if($listing->salary_min && $listing->salary_max)
                                                ${{ number_format($listing->salary_min) }} - ${{ number_format($listing->salary_max) }}
                                            @elseif($listing->salary_min)
                                                From ${{ number_format($listing->salary_min) }}
                                            @else
                                                Up to ${{ number_format($listing->salary_max) }}
                                            @endif
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <!-- Description Preview -->
                            <p class="text-gray-600 dark:text-gray-400 mt-4 line-clamp-2">
                                {{ substr(strip_tags($listing->description), 0, 150) }}...
                            </p>
                        </div>

                        <!-- Right Side -->
                        <div class="flex flex-col items-end gap-4">
                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 justify-end">
                                @foreach($listing->tags->take(3) as $tag)
                                    <span class="badge badge-secondary text-xs">{{ $tag->name }}</span>
                                @endforeach
                                @if($listing->tags->count() > 3)
                                    <span class="badge badge-secondary text-xs">+{{ $listing->tags->count() - 3 }}</span>
                                @endif
                            </div>

                            <!-- Posted Date -->
                            <div class="text-right">
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Posted {{ $listing->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="card text-center py-16">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">No jobs found</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Try adjusting your filters or search terms</p>
                    <a href="{{ route('listings.index') }}" class="btn btn-primary btn-small">Clear Filters</a>
                </div>
            @endforelse
        </div>
    </section>
</x-app-layout>
