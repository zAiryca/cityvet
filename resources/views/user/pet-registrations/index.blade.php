@extends('layouts.app')

@section('title', '| My Pets')

@section('content')
<div class="min-h-screen bg-gray-50 pt-24">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <div class="bg-white rounded-full p-3 shadow-sm mr-4">
                    <img src="{{ asset('https://i.ibb.co/8DPN5B7m/logo.png') }}" alt="FindFurEver Logo" class="w-12 h-12 object-contain">
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">My Pets</h1>
                    <p class="text-gray-600 mt-1">Manage your pet registrations</p>
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
        <div class="bg-white rounded-2xl shadow-sm p-2 mb-6">
            <div class="flex space-x-1">
                <a href="{{ route('pet-registrations.index') }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ empty($tab) ? 'bg-pastel-blue text-gray-800 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
                    All Pets
                </a>
                <a href="{{ route('pet-registrations.index', ['tab' => 'pending']) }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ ($tab === 'pending') ? 'bg-pastel-yellow text-gray-800 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
                    ⏱ Pre-Registered
                </a>
                <a href="{{ route('pet-registrations.index', ['tab' => 'registered']) }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ ($tab === 'registered') ? 'bg-pastel-green text-gray-800 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
                    ✓ Registered
                </a>
                <a href="{{ route('pet-registrations.index', ['tab' => 'denied']) }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ ($tab === 'denied') ? 'bg-pastel-pink text-gray-800 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
                    × Denied
                </a>
            </div>
        </div>

        <!-- Pre-Registered Pets -->
        @if((empty($tab) || $tab === 'pending') && $pending->count() > 0)
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">⏱ Pre-Registered <span class="text-yellow-600">({{ $pending->count() }})</span></h2>
                <span class="text-sm text-gray-500">Awaiting approval</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($pending as $petRegistration)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <!-- Image Section -->
                    <div class="relative">
                        @if($petRegistration->photo)
                            <img src="{{ asset('storage/' . $petRegistration->photo) }}" alt="{{ $petRegistration->pet_name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-16 h-16 text-gray-400 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z" />
                                    </svg>
                                    <p class="text-gray-500 text-sm mt-2">No Photo</p>
                                </div>
                            </div>
                        @endif

                        <!-- Status Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="px-3 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full shadow-sm">
                                ⏱ Pending
                            </span>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-5">
                        <!-- Pet Info -->
                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $petRegistration->pet_name }}</h3>

                            <div class="flex items-center text-sm text-gray-600 mb-2">
                                <span class="font-medium">{{ $petRegistration->species }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $petRegistration->breed }}</span>
                            </div>

                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <span class="mr-1">♂♀</span>
                                    {{ ucfirst($petRegistration->gender) }}
                                </span>
                                <span class="flex items-center">
                                    <span class="mr-1">📅</span>
                                    {{ $petRegistration->birthday ? $petRegistration->birthday->format('M d, Y') : 'Not set' }}
                                </span>
                            </div>
                        </div>

                        @if($petRegistration->denial_reason)
                        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl">
                            <p class="text-sm text-red-800">{{ $petRegistration->denial_reason }}</p>
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="grid grid-cols-3 gap-2">
                            <a href="{{ route('pet-registrations.show', $petRegistration) }}"
                               class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm font-medium text-center shadow-sm">
                                View
                            </a>
                            <a href="{{ route('pet-registrations.edit', $petRegistration) }}"
                               class="px-3 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors duration-200 text-sm font-medium text-center shadow-sm">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('pet-registrations.destroy', $petRegistration) }}"
                                  onsubmit="return confirm('Are you sure you want to delete this pet registration?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 text-sm font-medium shadow-sm">
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

        <!-- Registered Pets -->
        @if((empty($tab) || $tab === 'registered') && $registered->count() > 0)
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">✓ Registered <span class="text-green-600">({{ $registered->count() }})</span></h2>
                <span class="text-sm text-gray-500">Approved pets</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($registered as $petRegistration)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-green-200">
                    <!-- Image Section -->
                    <div class="relative">
                        @if($petRegistration->photo)
                            <img src="{{ asset('storage/' . $petRegistration->photo) }}" alt="{{ $petRegistration->pet_name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-16 h-16 text-green-600 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-green-600 text-sm mt-2">Registered</p>
                                </div>
                            </div>
                        @endif

                        <!-- Status Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full shadow-sm">
                                ✓ Registered
                            </span>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-5">
                        <!-- Pet Info -->
                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $petRegistration->pet_name }}</h3>

                            <div class="flex items-center text-sm text-gray-600 mb-2">
                                <span class="font-medium">{{ $petRegistration->species }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $petRegistration->breed }}</span>
                            </div>

                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span>{{ ucfirst($petRegistration->gender) }}</span>
                                <span>{{ $petRegistration->birthday ? $petRegistration->birthday->format('M d, Y') : 'Not set' }}</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('pet-registrations.show', $petRegistration) }}"
                               class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm font-medium text-center shadow-sm">
                                View
                            </a>
                            <form method="POST" action="{{ route('pet-registrations.destroy', $petRegistration) }}"
                                  onsubmit="return confirm('Are you sure you want to delete this pet registration?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 text-sm font-medium shadow-sm">
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
                <h2 class="text-xl font-bold text-gray-900">× Denied <span class="text-red-600">({{ $denied->count() }})</span></h2>
                <span class="text-sm text-gray-500">Edit and resubmit</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($denied as $petRegistration)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-red-200">
                    <!-- Image Section -->
                    <div class="relative">
                        @if($petRegistration->photo)
                            <img src="{{ asset('storage/' . $petRegistration->photo) }}" alt="{{ $petRegistration->pet_name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-16 h-16 text-red-600 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-red-600 text-sm mt-2">Needs Update</p>
                                </div>
                            </div>
                        @endif

                        <!-- Status Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="px-3 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded-full shadow-sm">
                                × Denied
                            </span>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-5">
                        <!-- Pet Info -->
                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $petRegistration->pet_name }}</h3>

                            <div class="flex items-center text-sm text-gray-600 mb-2">
                                <span class="font-medium">{{ $petRegistration->species }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $petRegistration->breed }}</span>
                            </div>

                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span>{{ ucfirst($petRegistration->gender) }}</span>
                                <span>{{ $petRegistration->birthday ? $petRegistration->birthday->format('M d, Y') : 'Not set' }}</span>
                            </div>
                        </div>

                        @if($petRegistration->denial_reason)
                        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl">
                            <p class="text-sm text-red-800">{{ $petRegistration->denial_reason }}</p>
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('pet-registrations.show', $petRegistration) }}"
                               class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm font-medium text-center shadow-sm">
                                View
                            </a>
                            <a href="{{ route('pet-registrations.edit', $petRegistration) }}"
                               class="px-3 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors duration-200 text-sm font-medium text-center shadow-sm">
                                Resubmit
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
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
            <div class="max-w-md mx-auto">
                <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z" />
                </svg>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No pets yet</h3>
                <p class="text-gray-600 mb-6">Start by pre-registering your first pet to get them officially registered!</p>
                <a href="{{ route('pet-registrations.create') }}"
                   class="inline-flex items-center px-6 py-3 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
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

