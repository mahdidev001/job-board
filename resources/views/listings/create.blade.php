<x-app-layout>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-gray-800 dark:to-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl font-bold mb-2">Post a New Job</h1>
            <p class="text-blue-100 dark:text-gray-300">Fill out the form below to list your job opening</p>
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

        <form action="{{ route('listings.store') }}" id="payment_form" method="post" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Account Info (for guests) -->
            @guest
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Account Information</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label class="form-label">Email Address *</label>
                            <input type="email" name="email" value="{{ old('email') }}" 
                                   class="form-input" placeholder="your@email.com" required>
                            @error('email')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="name" value="{{ old('name') }}" 
                                   class="form-input" placeholder="John Doe" required>
                            @error('name')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password *</label>
                            <input type="password" name="password" 
                                   class="form-input" placeholder="••••••••" required>
                            @error('password')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirm Password *</label>
                            <input type="password" name="password_confirmation" 
                                   class="form-input" placeholder="••••••••" required>
                            @error('password_confirmation')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            @endguest

            <!-- Basic Job Information -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Basic Information</h2>
                </div>
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label class="form-label">Job Title *</label>
                            <input type="text" name="title" value="{{ old('title') }}" 
                                   class="form-input" placeholder="e.g. Senior Laravel Developer" required>
                            @error('title')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Company Name *</label>
                            <input type="text" name="company" value="{{ old('company') }}" 
                                   class="form-input" placeholder="Your Company" required>
                            @error('company')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label class="form-label">Location *</label>
                            <input type="text" name="location" value="{{ old('location') }}" 
                                   class="form-input" placeholder="e.g. New York, NY" required>
                            @error('location')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Application Link *</label>
                            <input type="url" name="url" value="{{ old('url') }}" 
                                   class="form-input" placeholder="https://yoursite.com/apply" required>
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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group md:col-span-2">
                        <label class="form-label">Company Logo</label>
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

                    <div class="form-group md:col-span-2">
                        <label class="form-label">Tags (comma separated)</label>
                        <input type="text" name="tags" value="{{ old('tags') }}" 
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
                              class="form-input" 
                              placeholder="Describe the job position, responsibilities, requirements, and benefits...">{{ old('description') }}</textarea>
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
                            <input type="number" name="salary_min" value="{{ old('salary_min') }}" 
                                   class="form-input pl-8" placeholder="0">
                        </div>
                        @error('salary_min')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Maximum Salary</label>
                        <div class="relative">
                            <span class="absolute left-3 top-3 text-gray-500">$</span>
                            <input type="number" name="salary_max" value="{{ old('salary_max') }}" 
                                   class="form-input pl-8" placeholder="0">
                        </div>
                        @error('salary_max')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Listing Features</h2>
                </div>
                <div class="space-y-4">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_highlighted" value="1" 
                               {{ old('is_highlighted') ? 'checked' : '' }}
                               class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-2 focus:ring-blue-500">
                        <span class="text-gray-700 dark:text-gray-300">
                            <span class="font-semibold">Highlight this posting</span>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Appears at the top of listings (+$5)</p>
                        </span>
                    </label>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Payment Information</h2>
                </div>
                
                <!-- Pricing Summary -->
                <div class="bg-blue-50 dark:bg-blue-900 rounded-lg p-4 mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-gray-700 dark:text-gray-300">Standard Listing</span>
                        <span class="font-semibold text-gray-900 dark:text-white">$0</span>
                    </div>
                    <div id="highlightCost" class="flex justify-between items-center mb-4" style="display: none;">
                        <span class="text-gray-700 dark:text-gray-300">Highlight Premium</span>
                        <span class="font-semibold text-gray-900 dark:text-white">$5.00</span>
                    </div>
                    <div class="border-t border-blue-200 dark:border-blue-700 pt-2 flex justify-between items-center">
                        <span class="font-semibold text-gray-900 dark:text-white">Total</span>
                        <span class="text-2xl font-bold text-blue-600 dark:text-blue-400" id="totalAmount">$0</span>
                    </div>
                </div>

                <!-- Card Element -->
                <div class="form-group">
                    <label class="form-label">Card Information</label>
                    <div id="card-element" class="form-input p-4 bg-white"></div>
                    @error('payment_method_id')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Hidden Input for Payment Method -->
            <input type="hidden" id="payment_method_id" name="payment_method_id" value="">

            <!-- Submit Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <button type="submit" id="form_submit" class="btn btn-primary flex-1 text-lg">
                    <span id="submitText">Post Job Listing</span>
                </button>
                <a href="{{ route('listings.index') }}" class="btn btn-secondary flex-1 text-lg text-center">
                    Cancel
                </a>
            </div>
        </form>
    </section>

    <!-- Stripe JS -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Initialize Stripe
        const stripeKey = "{{ config('services.stripe.public') }}";
        if (!stripeKey || stripeKey.length === 0) {
            console.error('Stripe public key is empty!');
        }
        
        const stripe = Stripe(stripeKey);
        const elements = stripe.elements();
        const cardElement = elements.create('card', {
            classes: {
                base: 'form-input',
                focus: 'ring-2 ring-blue-500 border-blue-500',
                invalid: 'border-red-500'
            }
        });
        cardElement.mount('#card-element');

        // Update total price based on highlighted checkbox
        const highlightCheckbox = document.querySelector('input[name="is_highlighted"]');
        const highlightCost = document.getElementById('highlightCost');
        const totalAmount = document.getElementById('totalAmount');

        function updateTotal() {
            const isHighlighted = highlightCheckbox.checked ? 5 : 0;
            totalAmount.textContent = '$' + isHighlighted.toFixed(2);
            if (isHighlighted > 0) {
                highlightCost.style.display = 'flex';
            } else {
                highlightCost.style.display = 'none';
            }
        }

        highlightCheckbox.addEventListener('change', updateTotal);
        updateTotal();

        // Handle form submission
        document.getElementById('form_submit').addEventListener('click', async (e) => {
            e.preventDefault();
            
            const submitBtn = document.getElementById('form_submit');
            submitBtn.disabled = true;
            document.getElementById('submitText').textContent = 'Processing...';

            const isHighlighted = highlightCheckbox.checked;
            const amount = isHighlighted ? 500 : 0; // Stripe expects cents

            if (amount > 0) {
                const { paymentMethod, error } = await stripe.createPaymentMethod('card', cardElement);
                if (error) {
                    alert('Payment Error: ' + error.message);
                    submitBtn.disabled = false;
                    document.getElementById('submitText').textContent = 'Post Job Listing';
                } else {
                    document.getElementById('payment_method_id').value = paymentMethod.id;
                    document.getElementById('payment_form').submit();
                }
            } else {
                document.getElementById('payment_form').submit();
            }
        });
    </script>
</x-app-layout>
