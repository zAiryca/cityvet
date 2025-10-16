@extends('layouts.app')

@section('title', '| Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>
    <p class="mb-6">Manage pets, events, posters, and requests.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-blue-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-blue-800">Total Pets</h3>
            <p class="text-3xl font-bold">{{ $totalPets ?? Pet::count() }}</p>
            <a href="{{ route('admin.pets.index') }}" class="text-blue-600 hover:underline">Manage</a>
        </div>
        <div class="bg-green-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-green-800">Impounded</h3>
            <p class="text-3xl font-bold">{{ $impoundedCount ?? Pet::where('status', 'impounded')->count() }}</p>
            <a href="{{ route('admin.pets.index') }}" class="text-green-600 hover:underline">View</a>
        </div>
        <div class="bg-purple-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-purple-800">Pending Posters</h3>
            <p class="text-3xl font-bold">{{ $pendingPosters ?? Poster::where('approved', false)->count() }}</p>
            <a href="{{ route('admin.posters.index') }}" class="text-purple-600 hover:underline">Approve</a>
        </div>
        <div class="bg-yellow-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-yellow-800">Pending Requests</h3>
            <p class="text-3xl font-bold">{{ $pendingRequests ?? PetRequest::where('status', 'pending')->count() }}</p>
            <a href="{{ route('admin.requests.index') }}" class="text-yellow-600 hover:underline">Review</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Recent Pets</h2>
            <ul class="space-y-2">
                @foreach(Pet::latest()->take(5)->get() as $pet)
                    <li class="flex justify-between">
                        <span>{{ $pet->name }} ({{ $pet->status }})</span>
                        <a href="{{ route('admin.pets.show', $pet) }}" class="text-blue-600">View</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Upcoming Events</h2>
            <ul class="space-y-2">
                @foreach(Event::upcoming()->take(5)->get() as $event)
                    <li class="flex justify-between">
                        <span>{{ $event->title }} - {{ $event->event_date->format('M d') }}</span>
                        <a href="{{ route('admin.events.show', $event) }}" class="text-green-600">Edit</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('admin.reports.generate') }}" class="bg-gray-600 text-white px-6 py-3 rounded hover:bg-gray-700">Generate Reports</a>
    </div>
</div>
@endsection
