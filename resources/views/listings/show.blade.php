<x-app-layout>
    <!-- Job Header Section -->
    <section class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-900 py-12 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <!-- Left Content -->
                <div class="flex-1">
                    <div class="flex items-start gap-4 mb-6">
                        @if($listing->logo)
                            <img src="/storage/{{ $listing->logo }}" 
                                 alt="{{ $listing->company }}"
                                 class="w-20 h-20 rounded-lg object-cover ring-2 ring-gray-200 dark:ring-gray-700">
                        @else
                            <div class="w-20 h-20 rounded-lg bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                <span class="text-white text-2xl font-bold">{{ substr($listing->company, 0, 1) }}</span>
                            </div>
                        @endif
                        
                        <div>
                            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">
                                {{ $listing->title }}
                            </h1>
                            <p class="text-xl text-gray-700 dark:text-gray-300 font-semibold">{{ $listing->company }}</p>
                            <p class="text-gray-600 dark:text-gray-400 flex items-center gap-2 mt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $listing->location }}
                            </p>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2">
                        @foreach($listing->tags as $tag)
                            <span class="badge badge-primary">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>

                <!-- Right Side - CTA -->
                <div class="flex-shrink-0">
                    @auth
                        @if(auth()->user()->role === 'employer')
                            <div class="alert alert-warning">
                                <p class="font-semibold">Employers cannot apply</p>
                            </div>
                        @else
                            <button onclick="document.getElementById('applyModal').showModal()" class="btn btn-primary w-full">
                                Apply Now
                            </button>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 text-center">Posted {{ $listing->created_at->diffForHumans() }}</p>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary w-full">
                            Login to Apply
                        </a>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 text-center">Posted {{ $listing->created_at->diffForHumans() }}</p>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Job Description -->
            <div class="lg:col-span-2">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Job Description</h2>
                    </div>
                    <div class="prose dark:prose-invert prose-sm max-w-none text-gray-700 dark:text-gray-300">
                        {!! $listing->description !!}
                    </div>
                </div>

                <!-- Job Details Card -->
                <div class="card mt-6">
                    <div class="card-header">
                        <h2 class="card-title">Job Details</h2>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Company</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ $listing->company }}</p>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Location</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ $listing->location }}</p>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Posted</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ $listing->created_at->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Apply Link</h3>
                            <a href="{{ $listing->url }}" target="_blank" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 break-all">
                                View on Company Website
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="lg:col-span-1">
                <!-- Apply Card -->
                @auth
                    @if(auth()->user()->role !== 'employer')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Ready to Apply?</h3>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                Submit your application and let the employer know why you're interested in this position.
                            </p>
                            <button onclick="document.getElementById('applyModal').showModal()" class="btn btn-primary w-full">
                                Apply Now
                            </button>
                        </div>
                    @endif
                @else
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Want to Apply?</h3>
                        </div>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            Log in or create an account to apply for this position.
                        </p>
                        <a href="{{ route('login') }}" class="btn btn-primary w-full">
                            Login to Apply
                        </a>
                        <p class="text-sm text-center text-gray-600 dark:text-gray-400 mt-3">
                            Don't have an account? <a href="{{ route('register') }}" class="link-hover">Sign up</a>
                        </p>
                    </div>
                @endauth

                <!-- Share Card (single button with dropdown menu) -->
                <div class="card mt-6">
                    <div class="card-header">
                        <h3 class="card-title">Share This Job</h3>
                    </div>
                    @php
                        $shareUrl = url('/listings/' . $listing->slug);
                        $shareTitle = $listing->title . ' at ' . $listing->company;
                    @endphp
                    <div class="p-3 relative">
                        <button id="shareToggle" onclick="toggleShareMenu(event)" aria-expanded="false" class="btn btn-secondary w-full flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12v.01M12 12v.01M20 12v.01"/></svg>
                            Share
                        </button>

                        <div id="shareMenu" class="hidden mt-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded shadow-sm overflow-hidden absolute right-0 w-56 z-40">
                            <ul>
                                <li>
                                    <a class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center gap-2" href="#" onclick="openShare('https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}'); return false;">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 10-11.5 9.9v-7h-2.2v-2.9h2.2V9.5c0-2.2 1.3-3.4 3.3-3.4.96 0 1.96.17 1.96.17v2.1h-1.07c-1.05 0-1.38.66-1.38 1.34v1.6h2.35l-.37 2.9h-1.98v7A10 10 0 0022 12z"/></svg>
                                        Share on Facebook
                                    </a>
                                </li>
                                <li>
                                    <a class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center gap-2" href="#" onclick="openShare('https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}&text={{ urlencode($shareTitle) }}'); return false;">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M22.46 6c-.77.35-1.6.59-2.46.69a4.3 4.3 0 001.88-2.38 8.59 8.59 0 01-2.72 1.04 4.28 4.28 0 00-7.3 3.9A12.13 12.13 0 013 4.79a4.28 4.28 0 001.33 5.72 4.24 4.24 0 01-1.94-.54v.05a4.28 4.28 0 003.43 4.2 4.3 4.3 0 01-1.93.07 4.29 4.29 0 004 2.98A8.6 8.6 0 012 19.54a12.15 12.15 0 006.58 1.93c7.9 0 12.23-6.54 12.23-12.22 0-.19 0-.38-.01-.57A8.7 8.7 0 0022.46 6z"/></svg>
                                        Share on Twitter
                                    </a>
                                </li>
                                <li>
                                    <a class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center gap-2" href="#" onclick="openShare('https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($shareUrl) }}'); return false;">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M19 3A2 2 0 0121 5v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h14zM8.34 17.34V10.2H5.67v7.14h2.67zM7 9.09a1.56 1.56 0 110-3.12 1.56 1.56 0 010 3.12zM18.33 17.34v-3.9c0-2.09-1.12-3.06-2.61-3.06-1.2 0-1.73.67-2.03 1.14v-0.97H11.1c.03.64 0 7.14 0 7.14h2.67v-3.99c0-.21.02-.42.08-.57.17-.42.55-.86 1.2-.86.85 0 1.19.65 1.19 1.6v3.82h2.62z"/></svg>
                                        Share on LinkedIn
                                    </a>
                                </li>
                                <li>
                                    <a class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center gap-2" href="#" onclick="openShare('https://api.whatsapp.com/send?text={{ urlencode($shareTitle . ' ' . $shareUrl) }}'); return false;">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M20.52 3.48A11.94 11.94 0 0012 0C5.37 0 .01 5.37.01 12a11.9 11.9 0 001.64 6.12L0 24l5.1-1.33A11.93 11.93 0 0012 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.18-3.48-8.52zM12 21.5c-1.66 0-3.29-.45-4.68-1.3l-.33-.19-3.03.79.81-2.95-.21-.31A8.45 8.45 0 013.5 12c0-4.69 3.81-8.5 8.5-8.5 4.69 0 8.5 3.81 8.5 8.5S16.69 21.5 12 21.5zM17.1 14.3c-.24-.12-1.44-.71-1.66-.79-.22-.08-.38-.12-.54.12-.16.24-.62.79-.76.95-.14.16-.28.18-.52.06-.24-.12-1.01-.37-1.92-1.18-.71-.63-1.19-1.41-1.33-1.65-.14-.24-.01-.37.11-.49.11-.11.24-.28.36-.42.12-.14.16-.24.24-.4.08-.16.04-.3-.02-.42-.06-.12-.54-1.31-.74-1.8-.2-.47-.4-.41-.55-.42-.14-.01-.3-.01-.46-.01s-.42.06-.64.3c-.22.24-.86.84-.86 2.05s.88 2.37 1.01 2.54c.12.16 1.75 2.66 4.24 3.73 2.49 1.06 2.49.71 2.94.66.45-.05 1.44-.56 1.64-1.1.2-.54.2-1 .14-1.1-.06-.1-.22-.16-.46-.28z"/></svg>
                                        Share on WhatsApp
                                    </a>
                                </li>
                                <li>
                                    <a class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center gap-2" href="#" onclick="openShare('https://t.me/share/url?url={{ urlencode($shareUrl) }}&text={{ urlencode($shareTitle) }}'); return false;">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.373 0 0 5.373 0 12c0 6.627 5.373 12 12 12s12-5.373 12-12C24 5.373 18.627 0 12 0zM17.92 7.2l-1.46 6.84c-.11.47-.4.6-.8.38l-2.22-1.64-1.07 1.03c-.12.12-.22.22-.45.22l.16-2.26 4.11-3.72c.18-.16-.04-.25-.28-.09L8.9 12.9 6.86 11.9c-.5-.2-.51-.5.1-.76l10.96-4.84c.5-.2.94.12.6.9z"/></svg>
                                        Share on Telegram
                                    </a>
                                </li>
                                <li>
                                    <a class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 flex items-center gap-2" href="#" onclick="copyShareLink('{{ $shareUrl }}'); return false;">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 13.065L.99 6.44V18a2 2 0 002 2h18a2 2 0 002-2V6.44L12 13.065zM12 11L23.01 4H.99L12 11z"/></svg>
                                        Copy Link
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Salary Info (if available) -->
                @if($listing->salary_min || $listing->salary_max)
                    <div class="card mt-6 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900 dark:to-indigo-900">
                        <h3 class="font-bold text-gray-900 dark:text-white mb-2">Salary Range</h3>
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                            @if($listing->salary_min && $listing->salary_max)
                                ${{ number_format($listing->salary_min) }} - ${{ number_format($listing->salary_max) }}
                            @elseif($listing->salary_min)
                                From ${{ number_format($listing->salary_min) }}
                            @else
                                Up to ${{ number_format($listing->salary_max) }}
                            @endif
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Apply Modal -->
    @auth
        @if(auth()->user()->role !== 'employer')
            <dialog id="applyModal" class="modal">
                <div class="modal-box max-w-md">
                    <h3 class="font-bold text-lg mb-4">Apply for {{ $listing->title }}</h3>
                    
                    <form action="{{ route('listings.apply', $listing->slug) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Your Message *</label>
                            <textarea name="message" rows="6"
                                      class="form-input"
                                      placeholder="Tell the employer why you're interested in this position..."
                                      required></textarea>
                            @error('message')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-3 mt-6">
                            <button type="submit" class="btn btn-primary flex-1">Submit Application</button>
                            <button type="button" onclick="document.getElementById('applyModal').close()" class="btn btn-secondary flex-1">Cancel</button>
                        </div>
                    </form>
                </div>
                <form method="dialog" class="modal-backdrop">
                    <button>close</button>
                </form>
            </dialog>
        @endif
    @endauth

    <script>
        function shareJob(title, url) {
            if (navigator.share) {
                navigator.share({ title: title, url: url });
            } else {
                navigator.clipboard.writeText(url).then(() => {
                    alert('Job link copied to clipboard!');
                });
            }
        }

        function toggleShareMenu(event) {
            const btn = event.currentTarget;
            const menu = document.getElementById('shareMenu');
            const expanded = btn.getAttribute('aria-expanded') === 'true';
            btn.setAttribute('aria-expanded', String(!expanded));
            menu.classList.toggle('hidden');
        }

        function openShare(url) {
            // Open in new window/tab
            window.open(url, '_blank', 'noopener');
        }

        function copyShareLink(url) {
            navigator.clipboard.writeText(url).then(() => {
                alert('Job link copied to clipboard!');
                const menu = document.getElementById('shareMenu');
                if (menu) menu.classList.add('hidden');
                const btn = document.getElementById('shareToggle');
                if (btn) btn.setAttribute('aria-expanded', 'false');
            }).catch(() => {
                prompt('Copy this link', url);
            });
        }

        // Close share menu when clicking outside
        document.addEventListener('click', function(e) {
            const menu = document.getElementById('shareMenu');
            const btn = document.getElementById('shareToggle');
            if (!menu || !btn) return;
            if (menu.classList.contains('hidden')) return;
            if (!menu.contains(e.target) && !btn.contains(e.target)) {
                menu.classList.add('hidden');
                btn.setAttribute('aria-expanded', 'false');
            }
        });
    </script>

    <!-- Ratings Section -->
    <section class="bg-white py-12">
        <div class="container mx-auto px-5">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Job Ratings</h2>

            <!-- Average Rating -->
            @if($listing->ratings->count() > 0)
                @php
                    $avgRating = $listing->ratings->avg('rating');
                    $totalRatings = $listing->ratings->count();
                @endphp
                <div class="mb-8 p-6 bg-gray-50 rounded-lg">
                    <div class="flex items-center gap-4">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-4xl font-bold text-gray-900">{{ number_format($avgRating, 1) }}</span>
                                <div class="flex gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $avgRating)
                                            <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                        @else
                                            <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <p class="text-gray-600">Based on {{ $totalRatings }} {{ $totalRatings === 1 ? 'rating' : 'ratings' }}</p>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-gray-600 mb-8">No ratings yet. Be the first to rate this job!</p>
            @endif

            <!-- Add Rating Form -->
            @auth
                @if(auth()->user()->role !== 'employer')
                    @php
                        $userRating = $listing->ratings->where('user_id', auth()->id())->first();
                    @endphp
                    <div class="bg-gray-50 p-6 rounded-lg mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            {{ $userRating ? 'Update Your Rating' : 'Rate This Job' }}
                        </h3>
                        
                        <form action="{{ route('listings.rate', $listing->slug) }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 font-semibold mb-2">Rating</label>
                                <div class="flex gap-2" id="ratingStars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <label class="cursor-pointer star-label" data-rating="{{ $i }}">
                                            <input type="radio" name="rating" value="{{ $i }}" 
                                                   {{ $userRating && $userRating->rating == $i ? 'checked' : '' }}
                                                   class="hidden">
                                            <svg class="w-8 h-8 transition text-gray-300 fill-current star-icon" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                        </label>
                                    @endfor
                                </div>
                                @error('rating')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="review" class="block text-gray-700 font-semibold mb-2">Review (Optional)</label>
                                <textarea name="review" id="review" rows="4" 
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                                          placeholder="Share your experience with this job listing...">{{ $userRating?->review }}</textarea>
                                @error('review')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="px-6 py-2 bg-indigo-500 text-white font-semibold rounded-lg hover:bg-indigo-600 transition">
                                {{ $userRating ? 'Update Rating' : 'Submit Rating' }}
                            </button>
                        </form>
                    </div>
                @endif
            @endauth

            <!-- Display Ratings -->
            @if($listing->ratings->count() > 0)
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">All Ratings</h3>
                    @foreach($listing->ratings->sortByDesc('created_at') as $rating)
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $rating->user->name }}</p>
                                    <div class="flex gap-1 mt-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $rating->rating)
                                                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                            @else
                                                <svg class="w-4 h-4 text-gray-300 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500">{{ $rating->created_at->diffForHumans() }}</p>
                            </div>
                            @if($rating->review)
                                <p class="text-gray-700 mt-2">{{ $rating->review }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ratingStars = document.getElementById('ratingStars');
            if (!ratingStars) return;

            const starLabels = ratingStars.querySelectorAll('.star-label');
            const starIcons = ratingStars.querySelectorAll('.star-icon');

            starLabels.forEach((label, index) => {
                // Hover effect
                label.addEventListener('mouseenter', function() {
                    starIcons.forEach((icon, i) => {
                        if (i <= index) {
                            icon.classList.add('text-yellow-400');
                            icon.classList.remove('text-gray-300');
                        } else {
                            icon.classList.remove('text-yellow-400');
                            icon.classList.add('text-gray-300');
                        }
                    });
                });

                // Click effect
                label.addEventListener('click', function() {
                    const input = label.querySelector('input[type="radio"]');
                    input.checked = true;
                    updateStarDisplay(index);
                });
            });

            // Mouse leave effect
            ratingStars.addEventListener('mouseleave', function() {
                updateStarDisplay(getCheckedRating());
            });

            function getCheckedRating() {
                const checked = ratingStars.querySelector('input[type="radio"]:checked');
                return checked ? parseInt(checked.value) - 1 : -1;
            }

            function updateStarDisplay(index) {
                starIcons.forEach((icon, i) => {
                    if (i <= index) {
                        icon.classList.add('text-yellow-400');
                        icon.classList.remove('text-gray-300');
                    } else {
                        icon.classList.remove('text-yellow-400');
                        icon.classList.add('text-gray-300');
                    }
                });
            }

            // Initialize display for existing rating
            updateStarDisplay(getCheckedRating());
        });
    </script>
</x-app-layout>
