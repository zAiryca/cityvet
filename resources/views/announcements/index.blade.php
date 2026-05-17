@extends('layouts.app')

@section('title', '| Announcements')

@section('content')
<div class="px-4 py-6 pt-24 mx-auto max-w-7xl">
    <div class="mb-8">
        <h1 class="mb-2 text-4xl font-bold"><span style="color: #f39c12">Latest</span> Announcements</h1>
        <p class="text-gray-600">Stay updated with our latest news, events, and announcements</p>
    </div>

    <!-- Search and Filter -->
    <div class="mb-8 bg-white rounded-lg shadow p-4">
        <form id="filterForm" method="GET" action="{{ route('announcements.index') }}" class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div class="relative">
                <input type="text" id="searchInput" name="search" placeholder="Search announcements..."
                       value="{{ request('search') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition">
                <div id="searchIndicator" class="absolute right-3 top-3 hidden">
                    <svg class="animate-spin h-5 w-5 text-orange-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <select id="categorySelect" name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition">
                    <option value="">All Categories</option>
                    <option value="Event" {{ request('category') == 'Event' ? 'selected' : '' }}>Event</option>
                    <option value="Trivia" {{ request('category') == 'Trivia' ? 'selected' : '' }}>Trivia</option>
                    <option value="Fun Fact" {{ request('category') == 'Fun Fact' ? 'selected' : '' }}>Fun Fact</option>
                    <option value="Holiday Notice" {{ request('category') == 'Holiday Notice' ? 'selected' : '' }}>Holiday Notice</option>
                </select>
            </div>
            <div class="flex items-center justify-between gap-2">
                <a href="{{ route('announcements.index') }}" class="px-3 py-2 text-sm text-white bg-gray-500 rounded hover:bg-gray-600 transition whitespace-nowrap">
                    Clear
                </a>
                <p class="text-sm text-gray-500">
                    <span id="resultCount">{{ $announcements->total() }}</span> announcement<span id="plural">{{ $announcements->total() != 1 ? 's' : '' }}</span> found
                </p>
            </div>
        </form>
    </div>

    <script>
        let searchTimeout;

        function submitForm() {
            const form = document.getElementById('filterForm');
            const searchInput = document.getElementById('searchInput');
            const searchIndicator = document.getElementById('searchIndicator');

            searchIndicator.classList.remove('hidden');

            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                form.submit();
            }, 500);
        }

        document.getElementById('searchInput').addEventListener('input', submitForm);
        document.getElementById('categorySelect').addEventListener('change', submitForm);

        // Optional: Add keyboard shortcut to clear (Escape key)
        document.getElementById('searchInput').addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && this.value) {
                this.value = '';
                submitForm();
            }
        });
    </script>

    <!-- Announcements Grid -->
    @if($announcements->count() > 0)
        <div class="grid gap-6 md:grid-cols-1 lg:grid-cols-3">
            @foreach($announcements as $announcement)
                <div class="overflow-hidden bg-white rounded-lg shadow-md transition duration-300 hover:shadow-lg hover:scale-105">
                    <div class="p-6">
                        <!-- Category Badge -->
                        @if($announcement->category)
                            <div class="mb-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    @if($announcement->category == 'Event') bg-teal-100 text-teal-800
                                    @elseif($announcement->category == 'Trivia') bg-purple-100 text-purple-800
                                    @elseif($announcement->category == 'Fun Fact') bg-amber-100 text-amber-800
                                    @elseif($announcement->category == 'Holiday Notice') bg-rose-100 text-rose-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ $announcement->category }}
                                </span>
                            </div>
                        @endif

                        <!-- Title -->
                        <h3 class="mb-2 text-xl font-bold text-gray-900 line-clamp-2">{{ $announcement->title }}</h3>

                        <!-- Meta Information -->
                        <div class="mb-4 text-sm text-gray-500">
                            @if($announcement->date_when)
                                <div class="flex items-center mb-1">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $announcement->date_when }}
                                </div>
                            @endif

                            @if($announcement->location)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ Str::limit($announcement->location, 30) }}
                                </div>
                            @endif
                        </div>

                        <!-- Description Preview -->
                        <p class="mb-4 text-gray-600 text-sm line-clamp-3">{{ Str::limit($announcement->description, 150) }}</p>

                        <!-- View Button -->
                        <a href="{{ route('announcements.show', $announcement) }}"
                           class="inline-block px-4 py-2 text-white rounded-lg transition duration-300 hover:opacity-90"
                           style="background-color: #f39c12;">
                            Read More →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $announcements->appends(request()->query())->links() }}
        </div>
    @else
        <div class="py-12 text-center bg-white rounded-lg shadow">
            <svg class="mx-auto w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 118.5 3m-7 8h7m0 0l3-3m-3 3l-3-3" />
            </svg>
            <p class="mt-4 text-lg text-gray-500">No announcements found.</p>
            <p class="mt-2 text-gray-400">Check back later for updates!</p>
        </div>
    @endif
</div>
@endsection
