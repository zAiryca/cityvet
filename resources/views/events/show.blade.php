@extends('layouts.app')

@section('title', '| Announcement Details')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <div class="bg-white rounded-lg shadow overflow-hidden max-w-4xl mx-auto border-l-8 {{ $announcement->category == 'Event' ? 'border-teal-600' : ($announcement->category == 'Trivia' ? 'border-purple-600' : ($announcement->category == 'Fun Fact' ? 'border-amber-600' : 'border-rose-600')) }}">
        <div class="p-8">
            <h1 class="mb-4 text-3xl font-bold">{{ $announcement->title }}</h1>
            <span class="inline-block px-3 py-1 mb-4 text-sm text-gray-800 bg-gray-200 rounded-full">{{ $announcement->category }}</span>
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                <p><strong>When:</strong> {{ $announcement->date_when ?: 'N/A' }}</p>
                <p><strong>Location:</strong> {{ $announcement->location ?: 'N/A' }}</p>
            </div>
            <p class="mb-6 text-gray-700">{{ $announcement->description }}</p>
            <a href="{{ route('announcements.index') }}" class="px-6 py-2 text-white bg-gray-600 rounded hover:bg-gray-700">Back to Announcements</a>
        </div>
    </div>
</div>
@endsection
