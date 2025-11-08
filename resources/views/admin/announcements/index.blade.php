@extends('layouts.admin')

@section('title', '| Admin - Announcements')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Manage Announcements</h1>

    <!-- Filters -->
    <form method="GET" action="{{ route('admin.announcements.index') }}" class="bg-white p-4 rounded-lg shadow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="text" name="search" placeholder="Search by title" value="{{ request('search') }}" class="border p-2 rounded">
            <input type="date" name="event_date" value="{{ request('event_date') }}" class="border p-2 rounded">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
            <a href="{{ route('admin.announcements.index') }}" class="ml-2 text-gray-500">Clear</a>
        </div>
    </form>

    <a href="{{ route('admin.announcements.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-6 inline-block">Add New Announcement</a>

    @if($announcements->count() > 0)
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Registrations</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($announcements as $announcement)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $announcement->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $announcement->event_date->format('M d, Y h:i A') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ Str::limit($announcement->location, 30) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $announcement->registrations->count() }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.announcements.show', $announcement) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">View</a>
                                <a href="{{ route('admin.announcements.registrations', $announcement) }}" class="text-green-600 hover:text-green-900 mr-4">Registrations</a>
                                <a href="{{ route('admin.announcements.edit', $announcement) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
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
        <p class="text-gray-500 text-center py-8">No announcements found. <a href="{{ route('admin.announcements.create') }}" class="text-blue-600">Add the first one</a>.</p>
    @endif
</div>
@endsection
