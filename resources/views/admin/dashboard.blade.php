@extends('layouts.admin')

@section('title', '| Admin Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-900">Dashboard</h1>
        <p class="mt-2 text-lg text-slate-600">Welcome back, Admin. Here's your system overview.</p>
    </div>

    <!-- Key Statistics Grid -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
        <!-- Total Users Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow duration-200 overflow-hidden">
            <div class="flex items-center justify-between p-6">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total Users</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['total_users'] }}</p>
                    <a href="{{ route('admin.users.index') }}" class="mt-4 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">
                        Manage Users
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>
                </div>
                <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-blue-50">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M7.707 9.172A4 4 0 1016.9 8.172M15.75 12.75H8.25m6 2.25a2 2 0 110-4 2 2 0 010 4z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Verified Users Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow duration-200 overflow-hidden">
            <div class="flex items-center justify-between p-6">
                <div>
                    <p class="text-sm font-medium text-slate-600">Verified Users</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['verified_users'] }}</p>
                    <p class="mt-4 text-xs text-slate-500">Email verified</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-green-50">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Pets Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow duration-200 overflow-hidden">
            <div class="flex items-center justify-between p-6">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total Pets</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['total_pets'] }}</p>
                    <a href="{{ route('admin.pets.index') }}" class="mt-4 inline-flex items-center text-sm font-medium text-amber-600 hover:text-amber-700 transition-colors">
                        Manage Pets
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>
                </div>
                <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-amber-50">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v11.494m-9-5.494h18" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow duration-200 overflow-hidden">
            <div class="flex items-center justify-between p-6">
                <div>
                    <p class="text-sm font-medium text-slate-600">Pending Requests</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['pending_requests'] }}</p>
                    <a href="{{ route('admin.requests.index') }}" class="mt-4 inline-flex items-center text-sm font-medium text-orange-600 hover:text-orange-700 transition-colors">
                        Review Requests
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>
                </div>
                <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-orange-50">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Stats Row -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
        <!-- Impounded Pets -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-slate-900">Impounded</h3>
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50">
                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4v2M6.228 4.228a9 9 0 1012.544 0M4.5 4.5l14 14" />
                    </svg>
                </span>
            </div>
            <p class="text-3xl font-bold text-slate-900">{{ $stats['impounded'] }}</p>
            <a href="{{ route('admin.pets.index') }}" class="mt-4 inline-flex items-center text-sm font-medium text-red-600 hover:text-red-700 transition-colors">
                View Pets
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </a>
        </div>

        <!-- Claimed Pets -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-slate-900">Claimed</h3>
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-cyan-50">
                    <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </span>
            </div>
            <p class="text-3xl font-bold text-slate-900">{{ $stats['claimed'] }}</p>
            <a href="{{ route('admin.pets.index') }}" class="mt-4 inline-flex items-center text-sm font-medium text-cyan-600 hover:text-cyan-700 transition-colors">
                View Pets
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </a>
        </div>

        <!-- Adopted Pets -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-slate-900">Adopted</h3>
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-rose-50">
                    <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                </span>
            </div>
            <p class="text-3xl font-bold text-slate-900">{{ $stats['adopted'] }}</p>
            <a href="{{ route('admin.pets.index') }}" class="mt-4 inline-flex items-center text-sm font-medium text-rose-600 hover:text-rose-700 transition-colors">
                View Pets
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </a>
        </div>
    </div>

    <!-- Activity Sections -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Recent User Signups -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="border-b border-slate-200 px-6 py-4">
                <h2 class="text-lg font-semibold text-slate-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Recent Signups
                </h2>
            </div>
            <div class="divide-y divide-slate-200">
                @forelse($stats['recent_signups'] as $user)
                    <div class="px-6 py-4 hover:bg-slate-50 transition-colors duration-150">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="font-medium text-slate-900">{{ $user->first_name }} {{ $user->last_name }}</p>
                                <p class="mt-1 text-sm text-slate-600">{{ $user->email }}</p>
                                <div class="mt-2 flex items-center space-x-2">
                                    @if($user->email_verified_at)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700">Verified</span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700">Pending</span>
                                    @endif
                                    <span class="text-xs text-slate-500">{{ $user->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <a href="{{ route('admin.users.show', $user) }}" class="text-blue-600 hover:text-blue-700 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-slate-500">
                        <p>No recent signups</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Pets Added -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="border-b border-slate-200 px-6 py-4">
                <h2 class="text-lg font-semibold text-slate-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v11.494m-9-5.494h18" />
                    </svg>
                    Recent Pets
                </h2>
            </div>
            <div class="divide-y divide-slate-200">
                @forelse($recentPets as $pet)
                    <div class="px-6 py-4 hover:bg-slate-50 transition-colors duration-150">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-slate-900">{{ $pet->name }}</p>
                                <p class="mt-1 text-sm text-slate-600">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700">{{ $pet->status }}</span>
                                </p>
                            </div>
                            <a href="{{ route('admin.pets.show', $pet) }}" class="text-amber-600 hover:text-amber-700 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-slate-500">
                        <p>No recent pets</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Upcoming Announcements -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="border-b border-slate-200 px-6 py-4">
                <h2 class="text-lg font-semibold text-slate-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Announcements
                </h2>
            </div>
            <div class="divide-y divide-slate-200">
                @forelse($upcomingAnnouncements as $announcement)
                    <div class="px-6 py-4 hover:bg-slate-50 transition-colors duration-150">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="font-medium text-slate-900">{{ $announcement->title }}</p>
                                <p class="mt-1 text-sm text-slate-600">{{ $announcement->date_when ?: 'No date specified' }}</p>
                            </div>
                            <a href="{{ route('admin.announcements.show', $announcement) }}" class="text-green-600 hover:text-green-700 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-slate-500">
                        <p>No upcoming announcements</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Management Sections -->
    <div>
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Management</h2>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <!-- Pet Management -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-all duration-200 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-amber-50 mb-4">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v11.494m-9-5.494h18" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-900">Pet Management</h3>
                    <p class="mt-2 text-sm text-slate-600">Manage pet profiles, statuses, and details.</p>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('admin.pets.index') }}" class="flex-1 inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 rounded-lg transition-colors duration-200">
                            View All
                        </a>
                        <a href="{{ route('admin.pets.create') }}" class="flex-1 inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-amber-600 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors duration-200">
                            Add New
                        </a>
                    </div>
                </div>
            </div>

            <!-- Announcements -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-all duration-200 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-green-50 mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-900">Announcements</h3>
                    <p class="mt-2 text-sm text-slate-600">Create and manage system announcements.</p>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('admin.announcements.index') }}" class="flex-1 inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg transition-colors duration-200">
                            View All
                        </a>
                        <a href="{{ route('admin.announcements.create') }}" class="flex-1 inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-green-600 bg-green-50 hover:bg-green-100 rounded-lg transition-colors duration-200">
                            Add New
                        </a>
                    </div>
                </div>
            </div>

            <!-- Requests -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-all duration-200 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-orange-50 mb-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-900">Requests</h3>
                    <p class="mt-2 text-sm text-slate-600">Review and manage adoption and claim requests.</p>
                    <div class="mt-4">
                        <a href="{{ route('admin.requests.index') }}" class="w-full inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 rounded-lg transition-colors duration-200">
                            Review Requests
                        </a>
                    </div>
                </div>
            </div>

            <!-- Reports -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-all duration-200 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-purple-50 mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V7a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-900">Reports</h3>
                    <p class="mt-2 text-sm text-slate-600">Generate system reports and analytics.</p>
                    <div class="mt-4">
                        <a href="{{ route('admin.reports.generate') }}" class="w-full inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 rounded-lg transition-colors duration-200">
                            Generate Reports
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
