@extends('layouts.admin')

@section('title', '| Admin - Announcements')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <h1 class="mb-6 text-3xl font-bold">Manage Announcements</h1>

    <!-- Filters -->
    <form method="GET" action="{{ route('admin.announcements.index') }}" class="p-4 mb-6 bg-white rounded-lg shadow">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
            <input type="text" name="search" placeholder="Search by title" value="{{ request('search') }}" class="p-2 border rounded">
            <input type="date" name="event_date" value="{{ request('event_date') }}" class="p-2 border rounded">
            <select name="category" class="p-2 border rounded">
                <option value="">All Categories</option>
                <option value="Event" {{ request('category') == 'Event' ? 'selected' : '' }}>Event</option>
                <option value="Trivia" {{ request('category') == 'Trivia' ? 'selected' : '' }}>Trivia</option>
                <option value="Fun Fact" {{ request('category') == 'Fun Fact' ? 'selected' : '' }}>Fun Fact</option>
                <option value="Holiday Notice" {{ request('category') == 'Holiday Notice' ? 'selected' : '' }}>Holiday Notice</option>
            </select>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded">Filter</button>
                <a href="{{ route('admin.announcements.index') }}" class="px-4 py-2 text-gray-500 border rounded">Clear</a>
            </div>
        </div>
    </form>

    <a href="{{ route('admin.announcements.create') }}" class="inline-block px-4 py-2 mb-6 text-white bg-green-600 rounded">Add New Announcement</a>

    @if($announcements->count() > 0)
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Title</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Location</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Category</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($announcements as $announcement)
                        <tr>
                            <td class="px-6 py-4 font-medium whitespace-nowrap">{{ $announcement->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $announcement->date_when ?: 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ Str::limit($announcement->location, 30) ?: 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
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
                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                <a href="{{ route('admin.announcements.show', $announcement) }}" class="mr-4 text-indigo-600 hover:text-indigo-900">View</a>
                                <a href="{{ route('admin.announcements.edit', $announcement) }}" class="mr-4 text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" class="inline ml-4">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Delete this announcement?')">Delete</button>
                                </form>
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
