<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 py-12">
        <div class="w-full max-w-md px-4">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-md overflow-hidden">
                <div class="p-6 sm:p-8">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-br from-indigo-600 to-blue-500 mb-4">
                            <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2z" fill="currentColor" />
                                <path d="M9.5 15.5L7 13l1.4-1.4L9.5 12.7l6.1-6.1L17 8l-7.5 7.5z" fill="white" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">Welcome back</h2>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Sign in to continue to JobHub</p>
                    </div>

                    @if (session('status'))
                        <div class="mt-4 text-sm text-green-600">{{ session('status') }}</div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
                        @csrf

                        <div>
                            <label for="email" class="sr-only">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="you@example.com"
                                   class="block w-full px-4 py-3 rounded-lg border border-gray-200 bg-gray-50 dark:bg-gray-800 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="password" class="sr-only">Password</label>
                            <input id="password" type="password" name="password" required placeholder="••••••••"
                                   class="block w-full px-4 py-3 rounded-lg border border-gray-200 bg-gray-50 dark:bg-gray-800 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-indigo-600 rounded border-gray-300">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Remember me</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">Forgot?</a>
                            @endif
                        </div>

                        <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow">Sign in</button>
                    </form>

                    <div class="mt-4">
                        <a href="{{ route('auth.google') }}" class="w-full inline-flex items-center justify-center gap-3 py-3 border border-gray-200 rounded-lg hover:shadow-sm bg-white text-gray-700">
                            <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google" class="w-5 h-5">
                            Continue with Google
                        </a>
                    </div>

                    <p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-300">Don't have an account? <a href="{{ route('register') }}" class="text-indigo-600 font-medium hover:underline">Create account</a></p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
