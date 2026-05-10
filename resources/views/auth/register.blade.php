<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            <!-- Logo/Branding -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-blue-600 mb-4">JobHub</h1>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Create Account</h2>
                <p class="text-gray-600 dark:text-gray-400">Join thousands of job seekers and employers</p>
            </div>

            <!-- Register Card -->
            <div class="card">
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name', request('name')) }}" 
                               class="form-input" placeholder="John Doe" required autofocus>
                        @error('name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email', request('email')) }}" 
                               class="form-input" placeholder="you@example.com" required>
                        @error('email')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role Selection -->
                    <div class="form-group">
                        <label class="form-label">I am a...</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="flex items-center p-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:border-blue-400 transition">
                                <input type="radio" name="role" value="user" {{ old('role', 'user') === 'user' ? 'checked' : '' }}
                                       class="w-4 h-4 text-blue-600">
                                <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Job Seeker</span>
                            </label>
                            <label class="flex items-center p-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:border-blue-400 transition">
                                <input type="radio" name="role" value="employer" {{ old('role') === 'employer' ? 'checked' : '' }}
                                       class="w-4 h-4 text-blue-600">
                                <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Employer</span>
                            </label>
                        </div>
                        @error('role')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    @if(!request('google_id'))
                        <!-- Password -->
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input id="password" type="password" name="password" 
                                   class="form-input" placeholder="••••••••" required>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">At least 8 characters</p>
                            @error('password')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label class="form-label">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" 
                                   class="form-input" placeholder="••••••••" required>
                            @error('password_confirmation')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    @else
                        <input type="hidden" name="google_id" value="{{ request('google_id') }}">
                    @endif

                    <!-- Terms -->
                    <div class="flex items-start gap-2">
                        <input id="terms" type="checkbox" name="terms" 
                               class="w-4 h-4 mt-0.5 text-blue-600 rounded border-gray-300">
                        <label for="terms" class="text-xs text-gray-700 dark:text-gray-300">
                            I agree to the
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold">Terms of Service</a>
                            and
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Register Button -->
                    <button type="submit" class="btn btn-primary w-full">
                        Create Account
                    </button>
                    
                    <div class="mt-4">
                        <a href="{{ route('auth.google') }}" class="w-full inline-flex items-center justify-center gap-3 py-3 border border-gray-200 rounded-lg hover:shadow-sm bg-white text-gray-700">
                            <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google" class="w-5 h-5">
                            Continue with Google
                        </a>
                    </div>
                </form>
            </div>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-gray-700 dark:text-gray-300">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-800">
                        Sign in here
                    </a>
                </p>
            </div>

            <!-- Features -->
            <div class="mt-8 space-y-3">
                <div class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                    </svg>
                    <p class="text-sm text-gray-700 dark:text-gray-300"><span class="font-semibold">Free to use</span> - No hidden fees</p>
                </div>
                <div class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                    </svg>
                    <p class="text-sm text-gray-700 dark:text-gray-300"><span class="font-semibold">Verified listings</span> - Quality jobs only</p>
                </div>
                <div class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                    </svg>
                    <p class="text-sm text-gray-700 dark:text-gray-300"><span class="font-semibold">24/7 Support</span> - We're here to help</p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
