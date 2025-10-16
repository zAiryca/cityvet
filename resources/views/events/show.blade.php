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
            @auth
                @if($event->registrations->where('user_id', auth()->id())->count() === 0)
                    <form action="{{ route('events.register', $event) }}" method="POST" class="mb-6">
                        @csrf
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Your Registered Pet</label>
                        <select name="pet_id" required class="border p-2 rounded mb-4 w-full">
                            <option value="">Choose a pet</option>
                            @foreach(auth()->user()->pets()->where('status', 'registered')->get() as $pet)
                                <option value="{{ $pet->id }}">{{ $pet->name }} ({{ $pet->species }})</option>
                            @endforeach
                        </select>
                        @error('pet_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Register for Event</button>
                    </form>
                @else
                    <p class="text-green-600 mb-6">You are already registered for this event!</p>
                @endif
            @else
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Login to Register</a>
            @endauth
            <a href="{{ route('events.index') }}" class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700 ml-4">Back to Events</a>
        </div>
    </div>
</div>
@endsection
