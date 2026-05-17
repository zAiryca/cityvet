@extends('layouts.app')

@section('title', '| Claimed or Adopted Pets')

@section('content')
<div class="min-h-screen pt-24 bg-gray-50">
    <div class="px-4 py-8 mx-auto max-w-7xl">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8"style="margin-top: -5rem" >
            <div class="flex items-center">
                <div class="p-3 mr-4 bg-white rounded-full shadow-sm">
                    <svg class="w-12 h-12 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900" >Claimed & Adopted Pets</h1>
                    <p class="mt-1 text-gray-600">Pets you've successfully claimed or adopted</p>
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
        <div class="p-2 mb-6 bg-white shadow-sm rounded-2xl">
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

            <div class="grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($adopted as $pet)
                <div class="overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl hover:scale-105">
                    <!-- Photo Section -->
                    <div class="relative">
                        @if($pet->photo)
                            <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="object-cover w-full h-48">
                        @else
                            <div class="flex items-center justify-center w-full h-48 bg-gray-100">
                                <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif

                        <!-- Status Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold text-green-800 bg-green-100 rounded-full shadow-sm">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <polyline points="20,6 9,17 4,12"></polyline>
                                </svg>
                                Adopted
                            </span>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-3">
                        <!-- Pet Info -->
                        <div class="mb-4">
                            <h3 class="mb-2 text-lg font-bold text-gray-900">{{ $pet->display_code }}</h3>

                            <div class="flex items-center mb-2 text-sm text-gray-600">
                                <span class="font-medium">{{ ucfirst($pet->species) }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $pet->breed ?: 'Unknown' }}</span>
                            </div>

                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <span class="mr-1">Estimated Age:</span>
                                    {{ $pet->estimated_age_years ? $pet->estimated_age_years . 'y' : '' }} {{ $pet->estimated_age_months ? $pet->estimated_age_months . 'm' : 'Unknown age' }}
                                </span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('user.adopted-claimed-pets.show', $pet) }}"
                               class="px-3 py-2 text-sm font-medium text-center text-white transition-colors duration-200 bg-blue-600 rounded-lg shadow-sm hover:bg-blue-700">
                                View
                            </a>
                            <form method="POST" action="{{ route('user.adopted-claimed-pets.destroy', $pet) }}"
                                  onsubmit="return confirm('Are you sure you want to delete this record?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full px-3 py-2 text-sm font-medium text-white transition-colors duration-200 bg-red-600 rounded-lg shadow-sm hover:bg-red-700">
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

            <div class="grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($claimed as $pet)
                <div class="overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl hover:scale-105">
                    <!-- Image Section -->
                    <div class="relative">
                        @if($pet->photo)
                            <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="object-cover w-full h-48">
                        @else
                            <div class="flex items-center justify-center w-full h-48 bg-gray-100">
                                <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif

                        <!-- Status Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold text-blue-800 bg-blue-100 rounded-full shadow-sm">
                                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <polyline points="20,6 9,17 4,12"></polyline>
                                </svg>
                                Claimed
                            </span>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-3">
                        <!-- Pet Info -->
                        <div class="mb-4">
                            <h3 class="mb-2 text-lg font-bold text-gray-900">{{ $pet->display_code }}</h3>

                            <div class="flex items-center mb-2 text-sm text-gray-600">
                                <span class="font-medium">{{ ucfirst($pet->species) }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $pet->breed ?: 'Unknown' }}</span>
                            </div>

                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center">
                                    <span class="mr-1">Estimated Age:</span>
                                    {{ $pet->estimated_age_years ? $pet->estimated_age_years . 'y' : '' }} {{ $pet->estimated_age_months ? $pet->estimated_age_months . 'm' : 'Unknown age' }}
                                </span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('user.adopted-claimed-pets.show', $pet) }}"
                               class="px-3 py-2 text-sm font-medium text-center text-white transition-colors duration-200 bg-blue-600 rounded-lg shadow-sm hover:bg-blue-700">
                                View
                            </a>
                            <form method="POST" action="{{ route('user.adopted-claimed-pets.destroy', $pet) }}"
                                  onsubmit="return confirm('Are you sure you want to delete this record?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full px-3 py-2 text-sm font-medium text-white transition-colors duration-200 bg-red-600 rounded-lg shadow-sm hover:bg-red-700">
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
        <div class="p-12 text-center bg-white shadow-lg rounded-2xl">
            <div class="max-w-md mx-auto">
                <svg class="w-24 h-24 mx-auto mb-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z" />
                </svg>
                <h3 class="mb-2 text-xl font-bold text-gray-900">No pets claimed or adopted yet</h3>
                <p class="mb-6 text-gray-600">Start by browsing available pets and claiming or adopting one!</p>
                <a href="{{ route('pets.adoptable') }}"
                   class="inline-flex items-center px-6 py-3 font-medium text-white transition-all duration-200 bg-teal-600 shadow-sm rounded-xl hover:bg-teal-700 hover:shadow-md">
                    + Browse Adoptable Pets
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
