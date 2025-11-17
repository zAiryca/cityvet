@extends('layouts.admin')
@extends('layouts.admin')

@section('title', '| Admin Dashboard')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">

    <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
    <p class="mt-1 mb-6 text-lg text-gray-600">Welcome back, Admin. Here's what's happening.</p>

    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6">
        <div class="p-6 rounded-lg shadow-md bg-indigo-50">
            <h3 class="text-lg font-semibold text-indigo-800">Total Users</h3>
            <p class="mt-2 text-3xl font-bold text-indigo-900">{{ $stats['total_users'] }}</p>
            <a href="{{ route('admin.users.index') }}" class="inline-block mt-4 text-indigo-600 hover:underline">Manage Users</a>
        </div>
        <div class="p-6 rounded-lg shadow-md bg-blue-50">
            <h3 class="text-lg font-semibold text-blue-800">Total Pets</h3>
            <p class="mt-2 text-3xl font-bold text-blue-900">{{ $stats['total_pets'] }}</p>
            <a href="{{ route('admin.pets.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">Manage Pets</a>
        </div>
        <div class="p-6 rounded-lg shadow-md bg-green-50">
            <h3 class="text-lg font-semibold text-green-800">Impounded</h3>
            <p class="mt-2 text-3xl font-bold text-green-900">{{ $stats['impounded'] }}</p>
            <a href="{{ route('admin.pets.index') }}" class="inline-block mt-4 text-green-600 hover:underline">View Pets</a>
        </div>
        <div class="p-6 rounded-lg shadow-md bg-teal-50">
            <h3 class="text-lg font-semibold text-teal-800">Claimed</h3>
            <p class="mt-2 text-3xl font-bold text-teal-900">{{ $stats['claimed'] }}</p>
            <a href="{{ route('admin.pets.index') }}" class="inline-block mt-4 text-teal-600 hover:underline">View Pets</a>
        </div>
        <div class="p-6 rounded-lg shadow-md bg-red-50">
            <h3 class="text-lg font-semibold text-red-800">Adopted</h3>
            <p class="mt-2 text-3xl font-bold text-red-900">{{ $stats['adopted'] }}</p>
            <a href="{{ route('admin.pets.index') }}" class="inline-block mt-4 text-red-600 hover:underline">View Pets</a>
        </div>
        <div class="p-6 rounded-lg shadow-md bg-purple-50">
            <h3 class="text-lg font-semibold text-purple-800">Adoptable Pets</h3>
            <p class="mt-2 text-3xl font-bold text-purple-900">{{ $stats['adoptable'] }}</p>
            <a href="{{ route('admin.pets.index') }}" class="inline-block mt-4 text-purple-600 hover:underline">View Adoptable Pets</a>
        </div>
        <div class="p-6 rounded-lg shadow-md bg-yellow-50">
            <h3 class="text-lg font-semibold text-yellow-800">Pending Requests</h3>
            <p class="mt-2 text-3xl font-bold text-yellow-900">{{ $stats['pending_requests'] }}</p>
            <a href="{{ route('admin.requests.index') }}" class="inline-block mt-4 text-yellow-600 hover:underline">Review Requests</a>
        </div>
        <div class="p-6 rounded-lg shadow-md bg-orange-50">
            <h3 class="text-lg font-semibold text-orange-800">Pre-Registered Pets</h3>
            <p class="mt-2 text-3xl font-bold text-orange-900">{{ $stats['pre_registered_pets'] }}</p>
            <a href="{{ route('admin.pets.index') }}" class="inline-block mt-4 text-orange-600 hover:underline">Review Registrations</a>
        </div>
    </div>

    <h2 class="mb-4 text-2xl font-semibold text-gray-800">Management Sections</h2>
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">

        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h3 class="mb-3 text-xl font-semibold text-gray-900">Pet Management</h3>
            <p class="mb-4 text-gray-600">Manage pet profiles, statuses, and details.</p>
            <div class="flex space-x-3">
                <a href="{{ route('admin.pets.index') }}" class="px-4 py-2 font-medium text-white transition duration-150 bg-blue-600 rounded-md hover:bg-blue-700">View All Pets</a>
                <a href="{{ route('admin.pets.create') }}" class="px-4 py-2 font-medium text-gray-800 transition duration-150 bg-gray-200 rounded-md hover:bg-gray-300">Add New Pet</a>
            </div>
        </div>

        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h3 class="mb-3 text-xl font-semibold text-gray-900">Announcement Management</h3>
            <p class="mb-4 text-gray-600">Create new announcements.</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.announcements.index') }}" class="px-4 py-2 font-medium text-white transition duration-150 bg-green-600 rounded-md hover:bg-green-700">View All Announcements</a>
                <a href="{{ route('admin.announcements.create') }}" class="px-4 py-2 font-medium text-gray-800 transition duration-150 bg-gray-200 rounded-md hover:bg-gray-300">Add New Announcement</a>
            </div>
        </div>

        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h3 class="mb-3 text-xl font-semibold text-gray-900">Reports</h3>
            <p class="mb-4 text-gray-600">Generate system reports on adoptions, finances, or pets.</p>
            <div class="flex space-x-3">
                <a href="{{ route('admin.reports.generate') }}" class="px-4 py-2 font-medium text-white transition duration-150 bg-gray-700 rounded-md hover:bg-gray-800">Generate Reports</a>
            </div>
        </div>

        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h3 class="mb-3 text-xl font-semibold text-gray-900">Poster Moderation</h3>
            <p class="mb-4 text-gray-600">Moderate user-submitted lost and found posters.</p>
            <div class="flex space-x-3">
                <a href="{{ route('admin.posters.index') }}" class="px-4 py-2 font-medium text-white transition duration-150 bg-red-600 rounded-md hover:bg-red-700">Moderate Posters</a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-xl font-bold">Recent Pets Added</h2>
            <ul class="space-y-3">
                @forelse($recentPets as $pet)
                    <li class="flex items-center justify-between">
                        <div>
                            <span class="font-medium">{{ $pet->name }}</span>
                            <span class="ml-2 text-sm text-gray-500">({{ $pet->status }})</span>
                        </div>
                        <a href="{{ route('admin.pets.show', $pet) }}" class="text-blue-600 hover:underline">View</a>
                    </li>
                @empty
                    <li class="text-gray-500">No recent pets found.</li>
                @endforelse
            </ul>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-xl font-bold">Upcoming Announcements</h2>
            <ul class="space-y-3">
                @forelse($upcomingAnnouncements as $announcement)
                    <li class="flex items-center justify-between">
                        <div>
                            <span class="font-medium">{{ $announcement->title }}</span>
                            <span class="ml-2 text-sm text-gray-500">- {{ $announcement->date_when ?: 'No date specified' }}</span>
                        </div>
                        <a href="{{ route('admin.announcements.show', $announcement) }}" class="text-green-600 hover:underline">Edit</a>
                    </li>
                @empty
                    <li class="text-gray-500">No upcoming announcements.</li>
                @endforelse
            </ul>
        </div>
    </div>

</div>
@endsection
