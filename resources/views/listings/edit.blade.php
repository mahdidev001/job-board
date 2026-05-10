<x-app-layout>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-gray-800 dark:to-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl font-bold mb-2">Edit Job Listing</h1>
            <p class="text-blue-100 dark:text-gray-300">Update your job posting details</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="max-w-4xl mx-auto px-4 py-12">
        <!-- Error Alert -->
        @if($errors->any())
            <div class="alert alert-error mb-6">
                <div class="flex items-start gap-3">
                    <svg class="w-6 h-6 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4v2m0-16a9 9 0 1 1 0 18 9 9 0 0 1 0-18z"></path>
                    </svg>
                    <div>
                        <h3 class="font-semibold mb-2">Please fix these errors:</h3>
                        <ul class="list-disc list-inside space-y-1 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Success Alert -->
        @if(session('success'))
            <div class="alert alert-success mb-6">
                <div class="flex items-start gap-3">
                    <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <form action="{{ route('listings.update', $listing->slug) }}" method="post" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Basic Job Information -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Basic Information</h2>
                </div>
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label class="form-label">Job Title *</label>
                            <input type="text" name="title" value="{{ old('title', $listing->title) }}" 
                                   class="form-input" required>
                            @error('title')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Company Name *</label>
                            <input type="text" name="company" value="{{ old('company', $listing->company) }}" 
                                   class="form-input" required>
                            @error('company')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label class="form-label">Location *</label>
                            <input type="text" name="location" value="{{ old('location', $listing->location) }}" 
                                   class="form-input" required>
                            @error('location')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Application Link *</label>
                            <input type="url" name="url" value="{{ old('url', $listing->url) }}" 
                                   class="form-input" required>
                            @error('url')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Company Details -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Company Details</h2>
                </div>
                <div class="space-y-4">
                    <!-- Current Logo Preview -->
                    @if($listing->logo)
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Current Logo</p>
                            <img src="/storage/{{ $listing->logo }}" alt="Current logo" 
                                 class="w-32 h-32 object-cover rounded-lg border-2 border-gray-200 dark:border-gray-700">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Upload a new logo to replace</p>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="form-label">Company Logo (Optional)</label>
                        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v4a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32 0L28 20m0 0L20 28m0 0l-12-8"></path>
                            </svg>
                            <input type="file" name="logo" id="logo" class="hidden" accept="image/*">
                            <label for="logo" class="cursor-pointer">
                                <span class="mt-2 block text-sm font-medium text-gray-600 dark:text-gray-300">
                                    Click to upload or drag and drop
                                </span>
                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG up to 5MB</p>
                            </label>
                        </div>
                        @error('logo')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tags (comma separated)</label>
                        <input type="text" name="tags" value="{{ old('tags', $listing->tags->pluck('name')->join(', ')) }}" 
                               class="form-input" placeholder="PHP, Laravel, MySQL, Remote">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Help job seekers find your listing</p>
                        @error('tags')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Job Description -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Job Description *</h2>
                </div>
                <div class="form-group">
                    <textarea name="description" id="description" rows="10"
                              class="form-input">{{ old('description', $listing->description) }}</textarea>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Be clear and detailed to attract the right candidates</p>
                    @error('description')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Salary Information -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Salary Range (Optional)</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label">Minimum Salary</label>
                        <div class="relative">
                            <span class="absolute left-3 top-3 text-gray-500">$</span>
                            <input type="number" name="salary_min" value="{{ old('salary_min', $listing->salary_min) }}" 
                                   class="form-input pl-8">
                        </div>
                        @error('salary_min')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Maximum Salary</label>
                        <div class="relative">
                            <span class="absolute left-3 top-3 text-gray-500">$</span>
                            <input type="number" name="salary_max" value="{{ old('salary_max', $listing->salary_max) }}" 
                                   class="form-input pl-8">
                        </div>
                        @error('salary_max')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <button type="submit" class="btn btn-primary flex-1 text-lg">
                    Update Listing
                </button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary flex-1 text-lg text-center">
                    Cancel
                </a>
            </div>
        </form>
    </section>
</x-app-layout>
