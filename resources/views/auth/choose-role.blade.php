<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 py-12">
        <div class="w-full max-w-md px-4">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-md overflow-hidden p-6">
                <div class="text-center mb-4">
                    <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">Choose your role</h2>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Please select whether you're a job seeker or an employer.</p>
                </div>

                <form method="POST" action="{{ route('auth.google.choose-role.post') }}" class="space-y-4">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">I am a...</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="flex items-center p-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:border-blue-400 transition">
                                <input type="radio" name="role" value="user" class="w-4 h-4 text-blue-600" required>
                                <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Job Seeker</span>
                            </label>
                            <label class="flex items-center p-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:border-blue-400 transition">
                                <input type="radio" name="role" value="employer" class="w-4 h-4 text-blue-600" required>
                                <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Employer</span>
                            </label>
                        </div>
                        @error('role')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-full">Continue</button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
