<footer class="bg-slate-900 text-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-6">

            <a href="{{ route('listings.index') }}" class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="w-11 h-11 flex-shrink-0">
                    <defs>
                        <linearGradient id="jhGradFooter" x1="0%" x2="100%" y1="0%" y2="100%">
                            <stop offset="0%" stop-color="#06b6d4" />
                            <stop offset="50%" stop-color="#2563eb" />
                            <stop offset="100%" stop-color="#7c3aed" />
                        </linearGradient>
                    </defs>
                    <rect width="64" height="64" rx="12" fill="url(#jhGradFooter)" />
                    <g transform="translate(10,12)">
                        <path d="M8 18h36v10a3 3 0 0 1-3 3H11a3 3 0 0 1-3-3V18z" fill="#fff" opacity="0.08"/>
                        <path d="M20 20h8v6h-8z" fill="#fff"/>
                    </g>
                </svg>
                <div>
                    <span class="text-lg font-bold tracking-wide">JOBHUB</span>
                    <p class="text-sm text-gray-400 mt-1">Find Your Next Role</p>
                </div>
            </a>

            <div class="text-center flex-1">
                <p class="text-xs text-gray-400 mb-1">Built by</p>
                <p class="text-sm font-bold text-white">Mestouri Mohamed & Mahdi Ait Mokhtar</p>
            </div>

            <div class="flex gap-4">
                <a href="https://github.com/allaboutemxhdii" target="_blank" class="p-2 bg-white/5 rounded-full hover:bg-white/10 transition">
                    <svg fill="currentColor" class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577
                        0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729
                        1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605
                        -2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23
                        .96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23 .645 1.653.24 2.873.12 3.176
                        .765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286
                        0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
                    </svg>
                </a>
            </div>

        </div>

        <div class="mt-8 pt-6 border-t border-white/6 text-center text-sm text-gray-400 font-semibold">
            © {{ date('Y') }} JOBHUB. All rights reserved.
        </div>
    </div>
</footer>
