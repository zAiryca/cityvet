@extends('layouts.admin')

@section('title', '| Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
    <p class="text-lg text-gray-600 mt-1 mb-6">Welcome back, Admin. Here's what's happening.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <div class="bg-blue-50 p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-blue-800">Total Pets</h3>
            <p class="text-3xl font-bold text-blue-900 mt-2">{{ $stats['total_pets'] }}</p>
            <a href="{{ route('admin.pets.index') }}" class="text-blue-600 hover:underline mt-4 inline-block">Manage Pets</a>
        </div>
        <div class="bg-green-50 p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-green-800">Impounded</h3>
            <p class="text-3xl font-bold text-green-900 mt-2">{{ $stats['impounded'] }}</p>
            <a href="{{ route('admin.pets.index') }}" class="text-green-600 hover:underline mt-4 inline-block">View Pets</a>
        </div>
        <div class="bg-purple-50 p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-purple-800">Adoptable Pets</h3>
            <p class="text-3xl font-bold text-purple-900 mt-2">{{ $stats['adoptable'] }}</p>
            <a href="{{ route('admin.pets.index') }}" class="text-purple-600 hover:underline mt-4 inline-block">View Adoptable Pets</a>
        </div>
        <div class="bg-yellow-50 p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-yellow-800">Pending Requests</h3>
            <p class="text-3xl font-bold text-yellow-900 mt-2">{{ $stats['pending_requests'] }}</p>
            <a href="{{ route('admin.requests.index') }}" class="text-yellow-600 hover:underline mt-4 inline-block">Review Requests</a>
        </div>
        <div class="bg-orange-50 p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-orange-800">Pre-Registered Pets</h3>
            <p class="text-3xl font-bold text-orange-900 mt-2">{{ $stats['pre_registered_pets'] }}</p>
            <a href="{{ route('admin.pets.index') }}" class="text-orange-600 hover:underline mt-4 inline-block">Review Registrations</a>
        </div>
    </div>

    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Management Sections</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold mb-3 text-gray-900">Pet Management</h3>
            <p class="text-gray-600 mb-4">Manage pet profiles, statuses, and details.</p>
            <div class="flex space-x-3">
                <a href="{{ route('admin.pets.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md font-medium hover:bg-blue-700 transition duration-150">View All Pets</a>
                <a href="{{ route('admin.pets.create') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md font-medium hover:bg-gray-300 transition duration-150">Add New Pet</a>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold mb-3 text-gray-900">Event Management</h3>
            <p class="text-gray-600 mb-4">Create new events or announcements.</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.events.index') }}" class="bg-green-600 text-white px-4 py-2 rounded-md font-medium hover:bg-green-700 transition duration-150">View All Events</a>
                <a href="{{ route('admin.events.create') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md font-medium hover:bg-gray-300 transition duration-150">Add New Event</a>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold mb-3 text-gray-900">Reports</h3>
            <p class="text-gray-600 mb-4">Generate system reports on adoptions, finances, or pets.</p>
            <div class="flex space-x-3">
                <a href="{{ route('admin.reports.generate') }}" class="bg-gray-700 text-white px-4 py-2 rounded-md font-medium hover:bg-gray-800 transition duration-150">Generate Reports</a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Recent Pets Added</h2>
            <ul class="space-y-3">
                @forelse($recentPets as $pet)
                    <li class="flex items-center justify-between">
                        <div>
                            <span class="font-medium">{{ $pet->name }}</span>
                            <span class="text-sm text-gray-500 ml-2">({{ $pet->status }})</span>
                        </div>
                        <a href="{{ route('admin.pets.show', $pet) }}" class="text-blue-600 hover:underline">View</a>
                    </li>
                @empty
                    <li class="text-gray-500">No recent pets found.</li>
                @endforelse
            </ul>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Upcoming Events</h2>
            <ul class="space-y-3">
                @forelse($upcomingEvents as $event)
                    <li class="flex items-center justify-between">
                        <div>
                            <span class="font-medium">{{ $event->title }}</span>
                            <span class="text-sm text-gray-500 ml-2">- {{ $event->event_date->format('M d, Y') }}</span>
                        </div>
                        <a href="{{ route('admin.events.show', $event) }}" class="text-green-600 hover:underline">Edit</a>
                    </li>
                @empty
                    <li class="text-gray-500">No upcoming events.</li>
                @endforelse
            </ul>
        </div>
    </div>

</div>
@endsection
