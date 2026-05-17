    @extends('layouts.admin')

@section('title', '| Admin Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-secondary-900">Dashboard</h1>
        <p class="mt-2 text-lg text-secondary-600">Welcome back, Admin. Here's your system overview.</p>
    </div>

    <!-- Key Statistics Grid -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-5">
        <!-- Total Users Card -->
        <div class="overflow-hidden transition-shadow duration-200 bg-white border shadow-sm rounded-xl border-slate-200 hover:shadow-md">
            <div class="flex items-center justify-between p-6">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total Users</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['total_users'] }}</p>
                    <p class="mt-4 text-xs text-slate-500">{{ $stats['verified_users'] }} verified</p>
                </div>
                <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-blue-50">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Active Pets Card -->
        <div class="overflow-hidden transition-shadow duration-200 bg-white border shadow-sm rounded-xl border-slate-200 hover:shadow-md">
            <div class="flex items-center justify-between p-6">
                <div>
                    <p class="text-sm font-medium text-slate-600">Active Pets</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['active_pets'] }}</p>
                    <a href="{{ route('admin.pets.index') }}" class="inline-flex items-center mt-4 text-sm font-medium transition-colors text-amber-600 hover:text-amber-700">
                        Manage Pets
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>
                </div>
                <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-amber-50">
                    <svg class="w-6 h-6 text-amber-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-hidden="true">
                        <path fill="currentColor" d="M234.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5 .3-86.2 32.6-96.8 70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3-14.3-70.1 10.2-84.1 59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5l0 1.6c0 25.8-20.9 46.7-46.7 46.7-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2-25.8 0-46.7-20.9-46.7-46.7l0-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3 29.1 51.7 10.2 84.1-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5 46.9 53.9 32.6 96.8-52.1 69.1-84.4 58.5z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card -->
        <div class="overflow-hidden transition-shadow duration-200 bg-white border shadow-sm rounded-xl border-slate-200 hover:shadow-md">
            <div class="flex items-center justify-between p-6">
                <div>
                    <p class="text-sm font-medium text-slate-600">Pending Requests</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['pending_requests'] }}</p>
                    <a href="{{ route('admin.requests.index') }}" class="inline-flex items-center mt-4 text-sm font-medium text-orange-600 transition-colors hover:text-orange-700">
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

        <!-- Total Posters Card -->
        <div class="overflow-hidden transition-shadow duration-200 bg-white border shadow-sm rounded-xl border-slate-200 hover:shadow-md">
            <div class="flex items-center justify-between p-6">
                <div>
                    <p class="text-sm font-medium text-slate-600">Lost & Found Reports</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['total_posters'] }}</p>
                    <a href="{{ route('admin.posters.index') }}" class="inline-flex items-center mt-4 text-sm font-medium text-teal-600 transition-colors hover:text-teal-700">
                        Review Posters
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>
                </div>
                <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-teal-50">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Registrations Card -->
        <div class="overflow-hidden transition-shadow duration-200 bg-white border shadow-sm rounded-xl border-slate-200 hover:shadow-md">
            <div class="flex items-center justify-between p-6">
                <div>
                    <p class="text-sm font-medium text-slate-600">Pending Registrations</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $stats['pending_registrations'] }}</p>
                    <a href="{{ route('admin.pet-registrations.index') }}" class="inline-flex items-center mt-4 text-sm font-medium text-indigo-600 transition-colors hover:text-indigo-700">
                        Review Registrations
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </a>
                </div>
                <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-indigo-50">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Table -->
    <div class="bg-white border shadow-sm rounded-xl border-slate-200">
        <div class="px-6 py-4 border-b border-slate-200">
            <h2 class="text-lg font-semibold text-slate-900">Pending Requests</h2>
        </div>
        <div class="overflow-x-auto">
            @if($stats['pending_requests'] > 0)
                <table class="w-full">
                    <thead class="border-b bg-slate-50 border-slate-200">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-left uppercase text-slate-600">Requester</th>
                            <th class="px-6 py-3 text-xs font-medium text-left uppercase text-slate-600">Type</th>
                            <th class="px-6 py-3 text-xs font-medium text-left uppercase text-slate-600">Pet ID</th>
                            <th class="px-6 py-3 text-xs font-medium text-left uppercase text-slate-600">Date</th>
                            <th class="px-6 py-3 text-xs font-medium text-left uppercase text-slate-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse($pendingRequests ?? [] as $request)
                            <tr class="transition-colors duration-150 hover:bg-slate-50">
                                <td class="px-6 py-3 text-sm text-slate-900">
                                    @php
                                        $additionalData = is_string($request->additional_data)
                                            ? json_decode($request->additional_data, true)
                                            : (array) $request->additional_data;
                                    @endphp
                                    {{ ($additionalData['first_name'] ?? '') . ' ' . ($additionalData['last_name'] ?? '') }}
                                </td>
                                <td class="px-6 py-3 text-sm text-slate-900">
                                    <span class="px-2 py-1 text-xs font-medium text-blue-700 rounded bg-blue-50">{{ ucfirst($request->type) }}</span>
                                </td>
                                <td class="px-6 py-3 text-sm text-slate-900">{{ $request->requestable?->display_code ?? 'N/A' }}</td>
                                <td class="px-6 py-3 text-sm text-slate-600">{{ $request->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-3 text-sm font-medium">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.requests.show', $request) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-blue-600 rounded-lg transition-colors duration-200 hover:bg-blue-700">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View
                                        </a>
                                        <form action="{{ route('admin.requests.approve', $request) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-green-600 rounded-lg transition-colors duration-200 hover:bg-green-700">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.requests.deny', $request) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" onclick="return confirm('Are you sure you want to deny this request?');" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-red-600 rounded-lg transition-colors duration-200 hover:bg-red-700">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Deny
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                    <p>No pending requests</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <div class="px-6 py-8 text-center text-slate-500">
                    <p>No pending requests</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions Bar -->
    <div class="bg-white border shadow-sm rounded-xl border-slate-200">
        <div class="px-6 py-4 border-b border-slate-200">
            <h2 class="text-lg font-semibold text-slate-900">Quick Actions</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
                <a href="{{ route('admin.pets.create') }}" class="flex flex-col items-center justify-center px-4 py-3 text-xs font-medium text-white transition-colors duration-200 rounded-lg bg-amber-600 hover:bg-amber-700">
                    <div class="flex items-center mb-1">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Add Impounded/</span>
                    </div>
                    <span>Adoptable Pets</span>
                </a>
                <a href="{{ route('admin.requests.index') }}" class="flex items-center justify-center px-4 py-3 text-sm font-medium text-white transition-colors duration-200 bg-orange-600 rounded-lg hover:bg-orange-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Review Requests
                </a>
                <a href="{{ route('admin.reports.generate') }}" class="flex items-center justify-center px-4 py-3 text-sm font-medium text-white transition-colors duration-200 bg-purple-600 rounded-lg hover:bg-purple-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V7a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Generate Report
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center justify-center px-4 py-3 text-sm font-medium text-white transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Manage Users
                </a>
                <a href="{{ route('admin.posters.index') }}" class="flex items-center justify-center px-4 py-3 text-sm font-medium text-white transition-colors duration-200 bg-teal-600 rounded-lg hover:bg-teal-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Review Posters
                </a>
                <a href="{{ route('admin.pet-registrations.index') }}" class="flex items-center justify-center px-4 py-3 text-sm font-medium text-white transition-colors duration-200 bg-indigo-600 rounded-lg hover:bg-indigo-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Review Registrations
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activity Feed -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Activity Feed -->
        <div class="overflow-hidden bg-white border shadow-sm rounded-xl border-slate-200">
            <div class="px-6 py-4 border-b border-slate-200">
                <h2 class="flex items-center text-lg font-semibold text-slate-900">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Recent Activity
                </h2>
            </div>
            <div class="divide-y divide-slate-200">
                @forelse($activityFeed as $activity)
                    <div class="px-6 py-4 transition-colors duration-150 hover:bg-slate-50">
                        @if($activity instanceof \App\Models\Pet)
                            <!-- Pet Activity -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    @if($activity->photo)
                                        <img src="{{ asset('storage/' . $activity->photo) }}" alt="{{ $activity->display_code }}" class="object-cover w-10 h-10 rounded-lg">
                                    @else
                                        <div class="flex items-center justify-center w-10 h-10 bg-gray-200 rounded-lg">
                                            <span class="text-sm font-bold text-gray-500">{{ substr($activity->display_code, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-medium text-slate-900">New pet added: {{ $activity->display_code }}</p>
                                        <p class="text-sm text-slate-600">
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-slate-100 text-slate-700">{{ $activity->status }}</span>
                                            <span class="ml-2">{{ $activity->created_at->diffForHumans() }}</span>
                                        </p>
                                    </div>
                                </div>
                                <a href="{{ route('admin.pets.show', $activity) }}" class="transition-colors text-amber-600 hover:text-amber-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        @elseif($activity instanceof \App\Models\PetRequest)
                            <!-- Request Activity -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="flex items-center justify-center w-10 h-10 bg-orange-100 rounded-lg">
                                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-slate-900">{{ ucfirst($activity->type) }} request submitted</p>
                                        <p class="text-sm text-slate-600">
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full
                                                @if($activity->status == 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($activity->status == 'approved') bg-green-100 text-green-800
                                                @else bg-red-100 text-red-800
                                                @endif">
                                                {{ $activity->status }}
                                            </span>
                                            <span class="ml-2">{{ $activity->created_at->diffForHumans() }}</span>
                                        </p>
                                    </div>
                                </div>
                                <a href="{{ route('admin.requests.show', $activity) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white transition-colors duration-200 bg-orange-600 rounded-lg hover:bg-orange-700">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    View
                                </a>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-slate-500">
                        <p>No recent activity</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Signups -->
        <div class="overflow-hidden bg-white border shadow-sm rounded-xl border-slate-200">
            <div class="px-6 py-4 border-b border-slate-200">
                <h2 class="flex items-center text-lg font-semibold text-slate-900">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Recent Signups
                </h2>
            </div>
            <div class="divide-y divide-slate-200">
                @forelse($stats['recent_signups'] as $user)
                    <div class="px-6 py-4 transition-colors duration-150 hover:bg-slate-50">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="font-medium text-slate-900">{{ $user->first_name }} {{ $user->last_name }}</p>
                                <p class="mt-1 text-sm text-slate-600">{{ $user->email }}</p>
                                <div class="flex items-center mt-2 space-x-2">
                                    @if($user->email_verified_at)
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 rounded-full bg-green-50">Verified</span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-yellow-700 rounded-full bg-yellow-50">Pending</span>
                                    @endif
                                    <span class="text-xs text-slate-500">{{ $user->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <a href="{{ route('admin.users.show', $user) }}" class="text-blue-600 transition-colors hover:text-blue-700">
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
    </div>

    <!-- System Overview -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <!-- Announcements -->
        <div class="overflow-hidden bg-white border shadow-sm rounded-xl border-slate-200">
            <div class="px-6 py-4 border-b border-slate-200">
                <h2 class="flex items-center text-lg font-semibold text-slate-900">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Latest Announcements
                </h2>
            </div>
            <div class="divide-y divide-slate-200">
                @forelse($upcomingAnnouncements as $announcement)
                    <div class="px-6 py-4 transition-colors duration-150 hover:bg-slate-50">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="font-medium text-slate-900">{{ $announcement->title }}</p>
                                <p class="mt-1 text-sm text-slate-600">{{ $announcement->date_when ?: 'No date specified' }}</p>
                            </div>
                            <a href="{{ route('admin.announcements.show', $announcement) }}" class="text-green-600 transition-colors hover:text-green-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-slate-500">
                        <p>No recent announcements</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Management Links -->
        <div class="overflow-hidden bg-white border shadow-sm rounded-xl border-slate-200">
            <div class="px-6 py-4 border-b border-slate-200">
                <h2 class="text-lg font-semibold text-slate-900">Management</h2>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('admin.pets.index') }}" class="flex items-center justify-between p-3 transition-colors duration-200 rounded-lg hover:bg-slate-50">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v11.494m-9-5.494h18" />
                            </svg>
                        </div>
                        <span class="ml-3 font-medium text-slate-900">Pet Management</span>
                    </div>
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                <a href="{{ route('admin.announcements.index') }}" class="flex items-center justify-between p-3 transition-colors duration-200 rounded-lg hover:bg-slate-50">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-green-50">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="ml-3 font-medium text-slate-900">Announcements</span>
                    </div>
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center justify-between p-3 transition-colors duration-200 rounded-lg hover:bg-slate-50">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <span class="ml-3 font-medium text-slate-900">User Management</span>
                    </div>
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
