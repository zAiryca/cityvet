@extends('layouts.app')

@section('title', '| Announcements')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <h1 class="mb-6 text-3xl font-bold">Announcements</h1>
    <p class="mb-6">Stay updated with the latest announcements from CityVet.</p>

    <!-- Filters -->
    <form method="GET" action="{{ route('announcements.index') }}" class="p-4 mb-6 bg-white rounded-lg shadow">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <input type="text" name="search" placeholder="Search by title" value="{{ request('search') }}" class="p-2 border rounded">
            <select name="category" class="p-2 border rounded">
                <option value="">All Categories</option>
                <option value="Event" {{ request('category') == 'Event' ? 'selected' : '' }}>Event</option>
                <option value="Trivia" {{ request('category') == 'Trivia' ? 'selected' : '' }}>Trivia</option>
                <option value="Fun Fact" {{ request('category') == 'Fun Fact' ? 'selected' : '' }}>Fun Fact</option>
                <option value="Holiday Notice" {{ request('category') == 'Holiday Notice' ? 'selected' : '' }}>Holiday Notice</option>
            </select>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded">Filter</button>
                <a href="{{ route('announcements.index') }}" class="px-4 py-2 text-gray-500 border rounded">Clear</a>
            </div>
        </div>
    </form>

    @if($announcements->count() > 0)
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($announcements as $announcement)
                <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-8 {{ $announcement->category == 'Event' ? 'border-teal-600' : ($announcement->category == 'Trivia' ? 'border-purple-600' : ($announcement->category == 'Fun Fact' ? 'border-amber-600' : 'border-rose-600')) }} flex flex-col h-full">
                    <div class="flex flex-col h-full p-4">
                        <div class="flex-grow">
                            <h3 class="mb-2 text-xl font-bold">{{ $announcement->title }}</h3>
                            @if($announcement->category)
                                <span class="inline-flex items-center px-2.5 py-0.5 mb-2 rounded-full text-xs font-medium
                                    @if($announcement->category == 'Event') bg-teal-100 text-teal-800
                                    @elseif($announcement->category == 'Trivia') bg-purple-100 text-purple-800
                                    @elseif($announcement->category == 'Fun Fact') bg-amber-100 text-amber-800
                                    @elseif($announcement->category == 'Holiday Notice') bg-rose-100 text-rose-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ $announcement->category }}
                                </span>
                            @else
                                <span class="inline-block px-2 py-1 mb-2 text-xs text-gray-800 bg-gray-200 rounded-full">N/A</span>
                            @endif
                            <p class="text-gray-700">{{ Str::limit($announcement->description, 100) }}</p>
                        </div>
                        <div class="mt-4">
                            <p class="mb-2 text-sm text-gray-500"><strong>When:</strong> {{ $announcement->date_when ?: 'N/A' }}</p>
                            <p class="mb-4 text-sm text-gray-500"><strong>Location:</strong> {{ $announcement->location ?: 'N/A' }}</p>
                            <a href="{{ route('announcements.show', $announcement) }}" class="block w-full py-2 text-center text-white bg-blue-600 rounded hover:bg-blue-700">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $announcements->links() }}
    @else
        <p class="py-8 text-center text-gray-500">No announcements available. Check back soon!</p>
    @endif
</div>
@endsection
