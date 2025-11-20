@extends('layouts.admin')

@section('title', '| Admin - View Pet')

@section('content')
<div class="min-h-screen py-8 bg-gray-50">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 overflow-hidden bg-white rounded-lg shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        @if($pet->photo)
                            <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="object-cover w-16 h-16 border border-gray-200 rounded-lg">
                        @else
                            <div class="flex items-center justify-center w-16 h-16 bg-gray-200 rounded-lg">
                                <span class="text-sm text-gray-500">{{ substr($pet->display_code, 0, 1) }}</span>
                            </div>
                        @endif
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $pet->display_code }}</h1>
                            <p class="text-sm text-gray-600">{{ $pet->species }} • {{ $pet->breed }} • {{ $pet->estimated_age }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            @if($pet->status === 'impounded') bg-red-100 text-red-800
                            @elseif($pet->status === 'adoptable') bg-green-100 text-green-800
                            @elseif($pet->status === 'claimed') bg-blue-100 text-blue-800
                            @elseif($pet->status === 'adopted') bg-purple-100 text-purple-800
                            @elseif($pet->status === 'unclaimed' || $pet->status === 'unadopted') bg-gray-100 text-gray-800
                            @else bg-gray-100 text-gray-800 @endif">
                            @if($pet->status === 'unclaimed' || $pet->status === 'unadopted')
                                Unclaimed/Unadopted
                            @else
                                {{ ucfirst($pet->status) }}
                            @endif
                        </span>
                        <a href="{{ route('admin.pets.edit', $pet) }}"
                           class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Pet
                        </a>
                        <a href="{{ route('admin.pets.index') }}"
                           class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <!-- Main Information -->
            <div class="space-y-8 lg:col-span-2">
                <!-- Pet Details -->
                <div class="overflow-hidden bg-white rounded-lg shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Pet Information</h2>
                    </div>
                    <div class="px-6 py-6">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Pet ID</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $pet->display_code }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Species & Breed</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $pet->species }} • {{ $pet->breed }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Estimated Age</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $pet->estimated_age }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Gender</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($pet->gender ?? 'Unknown') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Color Markings</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $pet->color_markings ?: 'Not specified' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($pet->status === 'impounded') bg-red-100 text-red-800
                                        @elseif($pet->status === 'adoptable') bg-green-100 text-green-800
                                        @elseif($pet->status === 'claimed') bg-blue-100 text-blue-800
                                        @elseif($pet->status === 'adopted') bg-purple-100 text-purple-800
                                        @elseif($pet->status === 'unclaimed' || $pet->status === 'unadopted') bg-gray-100 text-gray-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        @if($pet->status === 'unclaimed' || $pet->status === 'unadopted')
                                            Unclaimed/Unadopted
                                        @else
                                            {{ ucfirst($pet->status) }}
                                        @endif
                                    </span>
                                    @if($pet->remaining_days !== null && $pet->remaining_days <= 3)
                                        <div class="mt-1 text-xs text-orange-600">{{ $pet->remaining_days }} days remaining</div>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Description -->
                <div class="overflow-hidden bg-white rounded-lg shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Description</h2>
                    </div>
                    <div class="px-6 py-6">
                        <p class="text-sm leading-relaxed text-gray-700">{{ $pet->description ?: 'No description provided.' }}</p>
                    </div>
                </div>

                <!-- Status-Specific Information -->
                @if($pet->status === 'impounded' || $pet->status === 'adoptable')
                <div class="overflow-hidden bg-white rounded-lg shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Status Information</h2>
                    </div>
                    <div class="px-6 py-6">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            @if($pet->status === 'impounded')
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Impounded Date</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $pet->impounded_date ? $pet->impounded_date->format('M d, Y') : 'Not set' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Caught Location</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $pet->caught_location ?: 'Not specified' }}</dd>
                                </div>
                            @elseif($pet->status === 'adoptable')
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Adoptable Date</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $pet->decision_date ? $pet->decision_date->format('M d, Y') : 'Not set' }}</dd>
                                </div>
                                @if($pet->adoption_reason)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Adoption Reason</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $pet->adoption_reason }}</dd>
                                </div>
                                @endif
                                @if($pet->adoption_notes)
                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Adoption Notes</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $pet->adoption_notes }}</dd>
                                </div>
                                @endif
                            @endif
                        </dl>

                        <!-- Status Notes -->
                        <div class="mt-6 rounded-md p-4
                            @if($pet->status === 'impounded') bg-blue-50 border border-blue-200
                            @elseif($pet->status === 'adoptable') bg-green-50 border border-green-200
                            @endif">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    @if($pet->status === 'impounded')
                                        <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                    @elseif($pet->status === 'adoptable')
                                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium
                                        @if($pet->status === 'impounded') text-blue-800
                                        @elseif($pet->status === 'adoptable') text-green-800
                                        @endif">
                                        @if($pet->status === 'impounded')
                                            Important Notice
                                        @elseif($pet->status === 'adoptable')
                                            Adoption Process
                                        @endif
                                    </h3>
                                    <div class="mt-2 text-sm
                                        @if($pet->status === 'impounded') text-blue-700
                                        @elseif($pet->status === 'adoptable') text-green-700
                                        @endif">
                                        @if($pet->status === 'impounded')
                                            <p>If unclaimed after 3 days, this pet will be moved to the adoptable section.</p>
                                        @elseif($pet->status === 'adoptable')
                                            <p>This pet requires submission of an adoption form through the system. Direct pickup is not available.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                <!-- Photo -->
                <div class="overflow-hidden bg-white rounded-lg shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Photo</h2>
                    </div>
                    <div class="p-6">
                        @if($pet->photo)
                            <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="object-cover w-full rounded-lg shadow-sm">
                        @else
                            <div class="flex items-center justify-center w-full bg-gray-100 rounded-lg aspect-square">
                                <div class="text-center">
                                    <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">No photo available</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="overflow-hidden bg-white rounded-lg shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Quick Actions</h2>
                    </div>
                    <div class="p-6 space-y-3">
                        @if($pet->status === 'impounded')
                            <form action="{{ route('admin.pets.mark-claimed', $pet) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                        onclick="return confirm('Mark this pet as claimed?')">
                                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Mark as Claimed
                                </button>
                            </form>
                        @elseif($pet->status === 'adoptable')
                            <form action="{{ route('admin.pets.mark-adopted', $pet) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                        onclick="return confirm('Mark this pet as adopted?')">
                                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Mark as Adopted
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('admin.pets.edit', $pet) }}"
                           class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Pet
                        </a>

                        <form action="{{ route('admin.pets.destroy', $pet) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                    onclick="return confirm('Delete this pet?')">
                                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete Pet
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Pet Statistics -->
                <div class="overflow-hidden bg-white rounded-lg shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Pet Statistics</h2>
                    </div>
                    <div class="px-6 py-6">
                        <dl class="space-y-4">
                            <div class="flex items-center justify-between">
                                <dt class="text-sm font-medium text-gray-500">Created</dt>
                                <dd class="text-sm text-gray-900">{{ $pet->created_at->format('M d, Y') }}</dd>
                            </div>
                            <div class="flex items-center justify-between">
                                <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                                <dd class="text-sm text-gray-900">{{ $pet->updated_at->format('M d, Y') }}</dd>
                            </div>
                            @if($pet->impounded_date)
                            <div class="flex items-center justify-between">
                                <dt class="text-sm font-medium text-gray-500">Days Impounded</dt>
                                <dd class="text-sm text-gray-900">{{ $pet->impounded_date->diffInDays(now()) }} days</dd>
                            </div>
                            @endif
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
