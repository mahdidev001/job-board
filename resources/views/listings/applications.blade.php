<x-app-layout>
    <section class="text-gray-700 body-font overflow-hidden bg-gray-50">
        <div class="container px-5 py-12 mx-auto">

            <!-- Header -->
            <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold mb-4 inline-block">
                        ← Back to Dashboard
                    </a>
                    <h2 class="text-3xl font-extrabold text-gray-900">
                        Applications for "{{ $listing->title }}"
                    </h2>
                    <p class="text-gray-600 mt-2">{{ $listing->company }} — {{ $listing->location }}</p>
                </div>
            </div>

            <!-- Applications List -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                @if($clicks->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-100 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Date</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">IP Address</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">User Agent</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($clicks as $click)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $click->created_at->format('M d, Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            <span class="font-mono bg-gray-100 px-2 py-1 rounded">{{ $click->ip }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            <span class="text-xs">{{ substr($click->user_agent, 0, 50) }}{{ strlen($click->user_agent) > 50 ? '...' : '' }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Summary -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        <p class="text-sm text-gray-700">
                            <strong>Total Applications:</strong> {{ $clicks->count() }}
                        </p>
                    </div>
                @else
                    <div class="px-6 py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-gray-600 text-lg">No applications yet.</p>
                        <p class="text-gray-500 text-sm">When someone clicks "Apply", their information will appear here.</p>
                    </div>
                @endif
            </div>

        </div>
    </section>
</x-app-layout>
