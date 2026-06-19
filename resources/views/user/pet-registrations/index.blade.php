@extends('layouts.app')

@section('title', '| My Pets')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="px-4 py-8 mx-auto max-w-7xl">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <div class="p-0 mr-4 bg-white rounded-full shadow-sm overflow-hidden w-12 h-12">
                    <img src="{{ asset('image/logo.png') }}" alt="FindFurEver Logo" class="w-full h-full object-cover">
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">My Pets</h1>
                    <p class="mt-1 text-gray-600">Manage your pet registrations</p>
                </div>
            </div>
            <a href="{{ route('pet-registrations.create') }}"
               class="px-6 py-3 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                + Pre-Register New Pet
            </a>
        </div>

        @php
            $tab = request('tab');
            $pending = $petRegistrations->where('status', 'pending');
            $registered = $petRegistrations->where('status', 'registered');
            $denied = $petRegistrations->where('status', 'denied');
        @endphp

        <!-- Tabs -->
        <div class="p-2 mb-6 bg-white shadow-sm rounded-2xl">
            <div class="flex space-x-1">
                <a href="{{ route('pet-registrations.index') }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ empty($tab) ? 'bg-gray-100 text-gray-800 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
                    All Pets
                </a>
                <a href="{{ route('pet-registrations.index', ['tab' => 'pending']) }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ ($tab === 'pending') ? 'bg-yellow-100 text-yellow-800 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
                    <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12,6 12,12 16,14"></polyline>
                    </svg>
                    Pre-registered
                </a>
                <a href="{{ route('pet-registrations.index', ['tab' => 'registered']) }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ ($tab === 'registered') ? 'bg-green-100 text-green-800 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
                    <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <polyline points="20,6 9,17 4,12"></polyline>
                    </svg>
                    Registered
                </a>
                <a href="{{ route('pet-registrations.index', ['tab' => 'denied']) }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ ($tab === 'denied') ? 'bg-red-100 text-red-800 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
                    <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                    Denied
                </a>
            </div>
        </div>

        <!-- Pre-Registered Pets -->
        @if((empty($tab) || $tab === 'pending') && $pending->count() > 0)
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="flex items-center text-xl font-bold text-gray-900">
                    <svg class="w-5 h-5 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12,6 12,12 16,14"></polyline>
                    </svg>
                    Pre-registered <span class="text-yellow-600">({{ $pending->count() }})</span>
                </h2>
                <span class="text-sm text-gray-500">Awaiting approval</span>
            </div>

            <div class="grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($pending as $petRegistration)
                <div class="overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl hover:scale-105">
                    <!-- Photo Section with Status Badge -->
                    <div class="relative h-48 overflow-hidden bg-gray-100">
                        @if($petRegistration->photo)
                            <img src="{{ asset('storage/' . $petRegistration->photo) }}" alt="{{ $petRegistration->pet_name }}" class="object-cover w-full h-full">
                        @else
                            <div class="flex items-center justify-center w-full h-full">
                                <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold text-yellow-800 bg-yellow-100 rounded-full">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12,6 12,12 16,14"></polyline>
                                </svg>
                                Pending
                            </span>
                        </div>
                    </div>

                    <div class="p-3">
                        <!-- Pet Info -->
                        <div class="mb-2">
                            <h3 class="text-base font-bold text-gray-900">{{ $petRegistration->pet_name }}</h3>
                            <p class="text-sm text-gray-600">{{ ucfirst($petRegistration->species) }} • {{ ucfirst($petRegistration->breed) }}</p>
                        </div>

                        <!-- Quick Info -->
                        <div class="grid grid-cols-2 gap-2 mb-3">
                            <div class="text-xs">
                                <p class="font-semibold text-gray-500 uppercase">Gender</p>
                                <p class="font-semibold text-gray-900">{{ ucfirst($petRegistration->gender) }}</p>
                            </div>
                            <div class="text-xs">
                                <p class="font-semibold text-gray-500 uppercase">Birthday</p>
                                <p class="font-semibold text-gray-900">{{ $petRegistration->birthday ? $petRegistration->birthday->format('M d, Y') : 'N/A' }}</p>
                            </div>
                        </div>

                        @if($petRegistration->denial_reason)
                        <div class="px-2 py-1 mb-3 text-xs font-medium text-white bg-red-600 rounded">
                            {{ $petRegistration->denial_reason }}
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('pet-registrations.show', $petRegistration) }}"
                               class="flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-white transition-colors bg-blue-600 rounded-lg shadow-sm hover:bg-blue-700">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View
                            </a>
                            <a href="{{ route('pet-registrations.edit', $petRegistration) }}"
                               class="flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-white transition-colors bg-gray-600 rounded-lg shadow-sm hover:bg-gray-700">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Registered Pets -->
        @if((empty($tab) || $tab === 'registered') && $registered->count() > 0)
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="flex items-center text-xl font-bold text-gray-900">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <polyline points="20,6 9,17 4,12"></polyline>
                    </svg>
                    Registered <span class="text-green-600">({{ $registered->count() }})</span>
                </h2>
                <span class="text-sm text-gray-500">Approved pets</span>
            </div>

            <div class="grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($registered as $petRegistration)
                <div class="overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl hover:scale-105">
                    <!-- Photo Section with Status Badge -->
                    <div class="relative h-48 overflow-hidden bg-gray-100">
                        @if($petRegistration->photo)
                            <img src="{{ asset('storage/' . $petRegistration->photo) }}" alt="{{ $petRegistration->pet_name }}" class="object-cover w-full h-full">
                        @else
                            <div class="flex items-center justify-center w-full h-full">
                                <svg class="w-16 h-16 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold text-green-800 bg-green-100 rounded-full">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <polyline points="20,6 9,17 4,12"></polyline>
                                </svg>
                                Registered
                            </span>
                        </div>
                    </div>

                    <div class="p-3">
                        <!-- Pet Info -->
                        <div class="mb-2">
                            <h3 class="text-base font-bold text-gray-900">{{ $petRegistration->pet_name }}</h3>
                            <p class="text-sm text-gray-600">{{ ucfirst($petRegistration->species) }} • {{ ucfirst($petRegistration->breed) }}</p>
                        </div>

                        <!-- Quick Info -->
                        <div class="grid grid-cols-2 gap-2 mb-3">
                            <div class="text-xs">
                                <p class="font-semibold text-gray-500 uppercase">Gender</p>
                                <p class="font-semibold text-gray-900">{{ ucfirst($petRegistration->gender) }}</p>
                            </div>
                            <div class="text-xs">
                                <p class="font-semibold text-gray-500 uppercase">Birthday</p>
                                <p class="font-semibold text-gray-900">{{ $petRegistration->birthday ? $petRegistration->birthday->format('M d, Y') : 'N/A' }}</p>
                            </div>
                        </div>

                        <!-- Success Message -->
                        <div class="mb-3">
                            <p class="text-xs font-semibold text-green-700">
                                ✓ Successfully registered
                            </p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('pet-registrations.show', $petRegistration) }}"
                               class="flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-white transition-colors bg-blue-600 rounded-lg shadow-sm hover:bg-blue-700">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View
                            </a>
                            <form method="POST" action="{{ route('pet-registrations.destroy', $petRegistration) }}"
                                  onsubmit="return confirm('Are you sure you want to delete this pet registration?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-white transition-colors bg-red-600 rounded-lg shadow-sm hover:bg-red-600">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Denied Pets -->
        @if((empty($tab) || $tab === 'denied') && $denied->count() > 0)
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="flex items-center text-xl font-bold text-gray-900">
                    <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                    Denied <span class="text-red-600">({{ $denied->count() }})</span>
                </h2>
                <span class="text-sm text-gray-500">Edit and resubmit</span>
            </div>

            <div class="grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($denied as $petRegistration)
                <div class="overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl hover:scale-105">
                    <!-- Photo Section with Status Badge -->
                    <div class="relative h-48 overflow-hidden bg-gray-100">
                        @if($petRegistration->photo)
                            <img src="{{ asset('storage/' . $petRegistration->photo) }}" alt="{{ $petRegistration->pet_name }}" class="object-cover w-full h-full">
                        @else
                            <div class="flex items-center justify-center w-full h-full">
                                <svg class="w-16 h-16 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold text-red-800 bg-red-100 rounded-full">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                                Denied
                            </span>
                        </div>
                    </div>

                    <div class="p-3">
                        <!-- Pet Info -->
                        <div class="mb-2">
                            <h3 class="text-base font-bold text-gray-900">{{ $petRegistration->pet_name }}</h3>
                            <p class="text-sm text-gray-600">{{ ucfirst($petRegistration->species) }} • {{ ucfirst($petRegistration->breed) }}</p>
                        </div>

                        <!-- Quick Info -->
                        <div class="grid grid-cols-2 gap-2 mb-3">
                            <div class="text-xs">
                                <p class="font-semibold text-gray-500 uppercase">Gender</p>
                                <p class="font-semibold text-gray-900">{{ ucfirst($petRegistration->gender) }}</p>
                            </div>
                            <div class="text-xs">
                                <p class="font-semibold text-gray-500 uppercase">Birthday</p>
                                <p class="font-semibold text-gray-900">{{ $petRegistration->birthday ? $petRegistration->birthday->format('M d, Y') : 'N/A' }}</p>
                            </div>
                        </div>

                        @if($petRegistration->denial_reason)
                        <div class="px-2 py-1 mb-3 text-xs font-medium text-white bg-red-600 rounded">
                            {{ $petRegistration->denial_reason }}
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('pet-registrations.show', $petRegistration) }}"
                               class="flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-white transition-colors bg-blue-600 rounded-lg shadow-sm hover:bg-blue-700">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View
                            </a>
                            <a href="{{ route('pet-registrations.edit', $petRegistration) }}"
                               class="flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-white transition-colors bg-gray-600 rounded-lg shadow-sm hover:bg-gray-700">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Empty State -->
        @if((empty($tab) || $tab === 'pending') && $pending->count() == 0 && (empty($tab) || $tab === 'registered') && $registered->count() == 0 && (empty($tab) || $tab === 'denied') && $denied->count() == 0)
        <div class="p-12 text-center bg-white shadow-lg rounded-2xl">
            <div class="max-w-md mx-auto">
                <h3 class="mb-2 text-xl font-bold text-gray-900">No pets yet</h3>
                <p class="mb-6 text-gray-600">Start by pre-registering your first pet to get them officially registered!</p>
                <a href="{{ route('pet-registrations.create') }}"
                   class="inline-flex items-center px-6 py-3 font-medium text-white transition-all duration-200 bg-teal-600 shadow-sm rounded-xl hover:bg-teal-700 hover:shadow-md">
                    + Pre-Register Your First Pet
                </a>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
.bg-pastel-blue { background-color: #dbeafe; }
.hover\:bg-pastel-blue-dark:hover { background-color: #bfdbfe; }

.bg-pastel-green { background-color: #dcfce7; }
.hover\:bg-pastel-green-dark:hover { background-color: #bbf7d0; }

.bg-pastel-yellow { background-color: #fef9c3; }
.hover\:bg-pastel-yellow-dark:hover { background-color: #fef08a; }

.bg-pastel-pink { background-color: #fce7f3; }
.hover\:bg-pastel-pink-dark:hover { background-color: #fbcfe8; }

.bg-pastel-purple { background-color: #e9d5ff; }
.hover\:bg-pastel-purple-dark:hover { background-color: #d8b4fe; }

.bg-pastel-orange { background-color: #fed7aa; }
.hover\:bg-pastel-orange-dark:hover { background-color: #fdba74; }
</style>
@endsection
