@extends('layouts.app')

@section('title', '| Claimed or Adopted Pets')

@section('content')
<div class="min-h-screen bg-gray-50 pt-24">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <div class="bg-white rounded-full p-3 shadow-sm mr-4">
                    <svg class="w-12 h-12 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Claimed & Adopted Pets</h1>
                    <p class="text-gray-600 mt-1">Pets you've successfully claimed or adopted</p>
                </div>
            </div>
            <a href="{{ route('pets.adoptable') }}"
               class="px-6 py-3 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                + Browse More Pets
            </a>
        </div>

        @php
            $tab = request('tab');
            $adopted = $pets->where('status', 'adopted');
            $claimed = $pets->where('status', 'claimed');
        @endphp

        <!-- Tabs -->
        <div class="bg-white rounded-2xl shadow-sm p-2 mb-6">
            <div class="flex space-x-1">
                <a href="{{ route('user.adopted-claimed-pets') }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ empty($tab) ? 'bg-blue-50 text-gray-800 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
                    All Pets
                </a>
                <a href="{{ route('user.adopted-claimed-pets', ['tab' => 'adopted']) }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ ($tab === 'adopted') ? 'bg-green-50 text-gray-800 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
                    ✓ Adopted
                </a>
                <a href="{{ route('user.adopted-claimed-pets', ['tab' => 'claimed']) }}"
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ ($tab === 'claimed') ? 'bg-blue-50 text-gray-800 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
                    ✓ Claimed
                </a>
            </div>
        </div>

        <!-- Adopted Pets -->
        @if((empty($tab) || $tab === 'adopted') && $adopted->count() > 0)
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">✓ Adopted <span class="text-green-600">({{ $adopted->count() }})</span></h2>
                <span class="text-sm text-gray-500">Successfully adopted</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($adopted as $pet)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-green-200">
                    <!-- Image Section -->
                    <div class="relative">
                        @if($pet->photo)
                            <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-16 h-16 text-green-600 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-green-600 text-sm mt-2">Adopted</p>
                                </div>
                            </div>
                        @endif

                        <!-- Status Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full shadow-sm">
                                ✓ Adopted
                            </span>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-5">
                        <!-- Pet Info -->
                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $pet->display_code }}</h3>

                            <div class="flex items-center text-sm text-gray-600 mb-2">
                                <span class="font-medium">{{ ucfirst($pet->species) }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $pet->breed ?: 'Unknown' }}</span>
                            </div>

                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <span class="mr-1">⏳</span>
                                    {{ $pet->estimated_age_years ? $pet->estimated_age_years . 'y' : '' }} {{ $pet->estimated_age_months ? $pet->estimated_age_months . 'm' : 'Unknown age' }}
                                </span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('user.adopted-claimed-pets.show', $pet) }}"
                               class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm font-medium text-center shadow-sm">
                                View
                            </a>
                            <form method="POST" action="{{ route('user.adopted-claimed-pets.destroy', $pet) }}"
                                  onsubmit="return confirm('Are you sure you want to delete this record?')">
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

        <!-- Claimed Pets -->
        @if((empty($tab) || $tab === 'claimed') && $claimed->count() > 0)
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">✓ Claimed <span class="text-blue-600">({{ $claimed->count() }})</span></h2>
                <span class="text-sm text-gray-500">Successfully claimed</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($claimed as $pet)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-blue-200">
                    <!-- Image Section -->
                    <div class="relative">
                        @if($pet->photo)
                            <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-16 h-16 text-blue-600 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="text-blue-600 text-sm mt-2">Claimed</p>
                                </div>
                            </div>
                        @endif

                        <!-- Status Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full shadow-sm">
                                ✓ Claimed
                            </span>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-5">
                        <!-- Pet Info -->
                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $pet->display_code }}</h3>

                            <div class="flex items-center text-sm text-gray-600 mb-2">
                                <span class="font-medium">{{ ucfirst($pet->species) }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $pet->breed ?: 'Unknown' }}</span>
                            </div>

                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <span class="mr-1">⏳</span>
                                    {{ $pet->estimated_age_years ? $pet->estimated_age_years . 'y' : '' }} {{ $pet->estimated_age_months ? $pet->estimated_age_months . 'm' : 'Unknown age' }}
                                </span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('user.adopted-claimed-pets.show', $pet) }}"
                               class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 text-sm font-medium text-center shadow-sm">
                                View
                            </a>
                            <form method="POST" action="{{ route('user.adopted-claimed-pets.destroy', $pet) }}"
                                  onsubmit="return confirm('Are you sure you want to delete this record?')">
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

        <!-- Empty State -->
        @if($adopted->count() == 0 && $claimed->count() == 0)
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
            <div class="max-w-md mx-auto">
                <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z" />
                </svg>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No pets claimed or adopted yet</h3>
                <p class="text-gray-600 mb-6">Start by browsing available pets and claiming or adopting one!</p>
                <a href="{{ route('pets.adoptable') }}"
                   class="inline-flex items-center px-6 py-3 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                    + Browse Adoptable Pets
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

