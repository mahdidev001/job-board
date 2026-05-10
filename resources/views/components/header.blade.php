<header class="bg-transparent border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="{{ route('listings.index') }}" class="flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="w-12 h-12 flex-shrink-0">
                <defs>
                    <linearGradient id="jhGradHeader" x1="0%" x2="100%" y1="0%" y2="100%">
                        <stop offset="0%" stop-color="#06b6d4" />
                        <stop offset="50%" stop-color="#2563eb" />
                        <stop offset="100%" stop-color="#7c3aed" />
                    </linearGradient>
                </defs>
                <rect width="64" height="64" rx="12" fill="url(#jhGradHeader)" />
                <g transform="translate(8,8)">
                    <rect x="6" y="18" width="40" height="22" rx="3" fill="#fff" opacity="0.06" />
                    <path d="M10 18h28v-6a4 4 0 0 0-4-4H14a4 4 0 0 0-4 4v6z" fill="#fff" opacity="0.12" />
                    <path d="M18 26h8v8h-8z" fill="#fff" />
                    <path d="M34 26h6v8h-6z" fill="#fff" />
                </g>
            </svg>
            <div class="leading-tight">
                <div class="text-2xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-sky-600 via-blue-600 to-purple-600">JOBHUB</div>
                <div class="text-xs text-gray-500">Find Your Next Role</div>
            </div>
        </a>

        <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
            @auth
                @if(auth()->check() && auth()->user()->role && auth()->user()->role === 'employer')
                    <a href="{{ route('dashboard') }}" class="mr-5 text-red-700 hover:text-red-900 font-semibold">
                        My Listings
                    </a>
                @endif
                <span class="mr-5 text-gray-700">Welcome, {{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="post" class="mr-5">
                    @csrf
                    <button type="submit" class="text-red-700 hover:text-red-900 font-semibold">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mr-5 hover:text-red-900">
                    login
                </a>
                <a href="{{ route('register') }}" class="mr-5 hover:text-red-900">
                    register
                </a>
            @endauth
        </nav>

        <!-- Post Job Button - Only for Employers -->
        @auth
            @if(auth()->user()->role === 'employer')
                <a href="{{ route('listings.create') }}"
                   class="inline-flex items-center bg-red-600 text-white border-0 py-1 px-3 focus:outline-none hover:bg-red-700 rounded text-base mt-4 md:mt-0">
                    Post Job
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                         stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            @endif
        @else
            <a href="{{ route('listings.create') }}"
               class="inline-flex items-center bg-red-600 text-white border-0 py-1 px-3 focus:outline-none hover:bg-red-700 rounded text-base mt-4 md:mt-0">
                Post Job
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                     stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
            </a>
        @endauth

    </div>
</header>
