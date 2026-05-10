<section class="relative bg-gradient-to-br from-red-50 via-white to-red-100 border-b border-red-200">
    <div class="container mx-auto px-5 py-24 flex flex-col items-center text-center">
        
        <!-- Badge -->
        <span class="mb-4 inline-block px-4 py-1 text-sm font-semibold text-red-700 bg-red-100 rounded-full">
            🚀 Find Your Next Opportunity
        </span>

        <!-- Title -->
        <h1 class="title-font sm:text-5xl text-4xl mb-6 font-extrabold text-gray-900 tracking-tight">
            Top Jobs in the Industry
        </h1>

        <!-- Subtitle -->
        <p class="mb-10 max-w-2xl text-lg text-gray-600 leading-relaxed">
            Whether you're planning your next career move or just exploring new opportunities, 
            browse a curated list of high-quality job openings from trusted companies worldwide.
        </p>

        <!-- Search Box -->
        <form action="{{ route('listings.index') }}" method="get"
              class="w-full max-w-2xl flex items-center bg-white rounded-2xl shadow-lg p-2 transition hover:shadow-xl">

            <input
                type="text"
                id="s"
                name="s"
                value="{{ request()->get('s') }}"
                placeholder="Search job title, company, or keyword..."
                class="flex-grow px-4 py-3 text-gray-700 bg-transparent focus:outline-none text-base"
            />

            <button
                class="ml-2 inline-flex items-center justify-center bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-xl transition duration-200">
                Search
            </button>
        </form>

    </div>
</section>
