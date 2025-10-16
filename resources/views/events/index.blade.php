@extends('layouts.app')

@section('title', '| Events')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Upcoming Events</h1>
    <p class="mb-6">Join us for pet-friendly events. Register your registered pet to participate.</p>

    @if($events->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($events as $event)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-blue-100 p-4">
                        <h3 class="font-bold text-xl">{{ $event->title }}</h3>
                        <p class="text-blue-800">{{ $event->event_date->format('M d, Y h:i A') }}</p>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-700 mb-4">{{ Str::limit($event->description, 100) }}</p>
                        <p class="text-sm text-gray-500 mb-4"><strong>Location:</strong> {{ $event->location }}</p>
                        <a href="{{ route('events.show', $event) }}" class="block w-full bg-blue-600 text-white py-2 rounded text-center hover:bg-blue-700">View Details</a>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $events->links() }}
    @else
        <p class="text-gray-500 text-center py-8">No upcoming events. Check back soon!</p>
    @endif
</div>
@endsection
