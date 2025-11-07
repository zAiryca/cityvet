@extends('layouts.app')

@section('title', '| Event Details')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <div class="bg-white rounded-lg shadow overflow-hidden max-w-4xl mx-auto">
        <div class="p-8">
            <h1 class="text-3xl font-bold mb-4">{{ $event->title }}</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <p><strong>Date & Time:</strong> {{ $event->event_date->format('M d, Y h:i A') }}</p>
                <p><strong>Location:</strong> {{ $event->location }}</p>
            </div>
            <p class="text-gray-700 mb-6">{{ $event->description }}</p>
            <a href="{{ route('events.index') }}" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700">Back to Announcements</a>
        </div>
    </div>
</div>
@endsection
