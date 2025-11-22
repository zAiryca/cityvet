@extends('layouts.admin')

@section('title', '| Admin Dashboard')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">

    <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
    <p class="mt-1 mb-6 text-lg text-gray-600">Welcome back, Admin. Here's what's happening.</p>

    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-8">
        <div class="p-6 rounded-lg shadow-md bg-indigo-50">
            <h3 class="text-lg font-semibold text-indigo-800">Total Users</h3>
            <p class="mt-2 text-3xl font-bold text-indigo-900">{{ $stats['total_users'] }}</p>
            <a href="{{ route('admin.users.index') }}" class="inline-block mt-4 text-indigo-600 hover:underline">Manage Users</a>
        </div>
        <div class="p-6 rounded-lg shadow-md bg-green-50">
            <h3 class="text-lg font-semibold text-green-800">Verified Users</h3>
            <p class="mt-2 text-3xl font-bold text-green-900">{{ $stats['verified_users'] }}</p>
            <p class="mt-2 text-sm text-green-600">Email verified</p>
        </div>
        <div class="p-6 rounded-lg shadow-md bg-yellow-50">
            <h3 class="text-lg font-semibold text-yellow-800">Unverified Users</h3>
            <p class="mt-2 text-3xl font-bold text-yellow-900">{{ $stats['unverified_users'] }}</p>
            <p class="mt-2 text-sm text-yellow-600">Pending verification</p>
        </div>
        <div class="p-6 rounded-lg shadow-md bg-red-50">
            <h3 class="text-lg font-semibold text-red-800">Admin Users</h3>
            <p class="mt-2 text-3xl font-bold text-red-900">{{ $stats['admin_users'] }}</p>
            <p class="mt-2 text-sm text-red-600">Admin role</p>
        </div>
        <div class="p-6 rounded-lg shadow-md bg-blue-50">
            <h3 class="text-lg font-semibold text-blue-800">Total Pets</h3>
            <p class="mt-2 text-3xl font-bold text-blue-900">{{ $stats['total_pets'] }}</p>
            <a href="{{ route('admin.pets.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">Manage Pets</a>
        </div>
        <div class="p-6 rounded-lg shadow-md bg-cyan-50">
            <h3 class="text-lg font-semibold text-cyan-800">Impounded</h3>
            <p class="mt-2 text-3xl font-bold text-cyan-900">{{ $stats['impounded'] }}</p>
            <a href="{{ route('admin.pets.index') }}" class="inline-block mt-4 text-cyan-600 hover:underline">View Pets</a>
        </div>
        <div class="p-6 rounded-lg shadow-md bg-teal-50">
            <h3 class="text-lg font-semibold text-teal-800">Claimed</h3>
            <p class="mt-2 text-3xl font-bold text-teal-900">{{ $stats['claimed'] }}</p>
            <a href="{{ route('admin.pets.index') }}" class="inline-block mt-4 text-teal-600 hover:underline">View Pets</a>
        </div>
        <div class="p-6 rounded-lg shadow-md bg-rose-50">
            <h3 class="text-lg font-semibold text-rose-800">Adopted</h3>
            <p class="mt-2 text-3xl font-bold text-rose-900">{{ $stats['adopted'] }}</p>
            <a href="{{ route('admin.pets.index') }}" class="inline-block mt-4 text-rose-600 hover:underline">View Pets</a>
        </div>
        <div class="p-6 rounded-lg shadow-md bg-purple-50">
            <h3 class="text-lg font-semibold text-purple-800">Adoptable Pets</h3>
            <p class="mt-2 text-3xl font-bold text-purple-900">{{ $stats['adoptable'] }}</p>
            <a href="{{ route('admin.pets.index') }}" class="inline-block mt-4 text-purple-600 hover:underline">View Adoptable Pets</a>
        </div>
        <div class="p-6 rounded-lg shadow-md bg-orange-50">
            <h3 class="text-lg font-semibold text-orange-800">Pending Requests</h3>
            <p class="mt-2 text-3xl font-bold text-orange-900">{{ $stats['pending_requests'] }}</p>
            <a href="{{ route('admin.requests.index') }}" class="inline-block mt-4 text-orange-600 hover:underline">Review Requests</a>
        </div>
        <div class="p-6 rounded-lg shadow-md bg-amber-50">
            <h3 class="text-lg font-semibold text-amber-800">Pre-Registered Pets</h3>
            <p class="mt-2 text-3xl font-bold text-amber-900">{{ $stats['pre_registered_pets'] }}</p>
            <a href="{{ route('admin.pets.index') }}" class="inline-block mt-4 text-amber-600 hover:underline">Review Registrations</a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 mb-8 lg:grid-cols-3">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-xl font-bold flex items-center">
                <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0H9m6 0H9m3 6h-3v2a6 6 0 01-6-6v-2a6 6 0 0112 0v2z"></path>
                </svg>
                Recent User Signups
            </h2>
            <ul class="space-y-3">
                @forelse($stats['recent_signups'] as $user)
                    <li class="flex items-center justify-between p-3 border-l-4 border-indigo-600 bg-indigo-50">
                        <div>
                            <span class="font-medium text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</span>
                            <span class="ml-2 text-sm text-gray-500">{{ $user->email }}</span>
                            <div class="mt-1 text-xs text-gray-500">
                                @if($user->email_verified_at)
                                    <span class="inline-block px-2 py-1 text-green-700 bg-green-100 rounded">Verified</span>
                                @else
                                    <span class="inline-block px-2 py-1 text-yellow-700 bg-yellow-100 rounded">Pending</span>
                                @endif
                                <span class="ml-2">{{ $user->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <a href="{{ route('admin.users.show', $user) }}" class="text-indigo-600 hover:underline text-sm">View</a>
                    </li>
                @empty
                    <li class="text-gray-500">No recent signups.</li>
                @endforelse
            </ul>
        </div>

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

</div>
@endsection
