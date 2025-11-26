@extends('layouts.admin')

@section('title', '| Admin - Announcement Details')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <h1 class="mb-6 text-3xl font-bold">Announcement Details: {{ $announcement->title }}</h1>
    <div class="max-w-4xl overflow-hidden bg-white rounded-lg shadow">
        <div class="p-8">
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                <p><strong>Date/When:</strong> {{ $announcement->date_when ?: 'N/A' }}</p>
                <p><strong>Location:</strong> {{ $announcement->location ?: 'N/A' }}</p>
                <p><strong>Category:</strong> {{ $announcement->category ?: 'N/A' }}</p>
            </div>
            <p class="mb-6 text-gray-700"><strong>Description:</strong> {{ $announcement->description }}</p>
            <div class="flex space-x-4">
                <a href="{{ route('admin.announcements.edit', $announcement) }}" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Edit</a>
                <a href="{{ route('admin.announcements.index') }}" class="px-4 py-2 text-white bg-gray-600 rounded hover:bg-gray-700">Back to List</a>
            </div>
        </div>
    </div>

    <!-- No registrations section na ta pang announce nlng to -->
</div>
@endsection
