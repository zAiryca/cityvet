@extends('layouts.admin')

@section('title', '| Admin - Announcements')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <h1 class="mb-6 text-3xl font-bold">Manage Announcements</h1>

    <!-- Search and Filter -->
    <div class="mb-6 bg-white rounded-lg shadow p-4">
        <form id="filterForm" method="GET" action="{{ route('admin.announcements.index') }}" class="grid grid-cols-1 gap-4 md:grid-cols-3">
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
                <a href="{{ route('admin.announcements.index') }}" class="px-3 py-2 text-sm text-white bg-gray-500 rounded hover:bg-gray-600 transition whitespace-nowrap">
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

    <a href="{{ route('admin.announcements.create') }}" class="inline-block px-4 py-2 mb-6 text-white bg-green-600 rounded">Add New Announcement</a>

    @if($announcements->count() > 0)
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Title</th>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Location</th>
                        <th class="px-3 py-3 text-xs font-medium text-left text-gray-500 uppercase">Category</th>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($announcements as $announcement)
                        <tr>
                            <td class="px-4 py-4 font-medium whitespace-nowrap">{{ $announcement->title }}</td>
                            <td class="px-4 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $announcement->date_when ?: 'N/A' }}</td>
                            <td class="px-4 py-4 text-sm text-gray-900 whitespace-nowrap">{{ Str::limit($announcement->location, 30) ?: 'N/A' }}</td>
                            <td class="px-3 py-4 text-sm text-gray-900 whitespace-nowrap">
                                @if($announcement->category)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($announcement->category == 'Event') bg-teal-100 text-teal-800
                                        @elseif($announcement->category == 'Trivia') bg-purple-100 text-purple-800
                                        @elseif($announcement->category == 'Fun Fact') bg-amber-100 text-amber-800
                                        @elseif($announcement->category == 'Holiday Notice') bg-rose-100 text-rose-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ $announcement->category }}
                                    </span>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <button onclick="window.location.href='{{ route('admin.announcements.show', $announcement) }}'"
                                            class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-white bg-indigo-600 border border-indigo-600 rounded-md hover:bg-indigo-700 hover:border-indigo-700 transition-colors"
                                            title="View Announcement Details">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        View
                                    </button>
                                    <button onclick="window.location.href='{{ route('admin.announcements.edit', $announcement) }}'"
                                            class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-white bg-blue-600 border border-blue-600 rounded-md hover:bg-blue-700 hover:border-blue-700 transition-colors"
                                            title="Edit Announcement">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-white bg-red-600 border border-red-600 rounded-md hover:bg-red-700 hover:border-red-700 transition-colors"
                                                title="Delete Announcement"
                                                onclick="return confirm('Are you sure you want to delete this announcement? This action cannot be undone.')">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $announcements->appends(request()->query())->links() }}
    @else
        <p class="py-8 text-center text-gray-500">No announcements found. <a href="{{ route('admin.announcements.create') }}" class="text-blue-600">Add the first one</a>.</p>
    @endif
</div>
@endsection
