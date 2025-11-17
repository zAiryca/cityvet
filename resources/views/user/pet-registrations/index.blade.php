@extends('layouts.app')

@section('title', '| My Pets')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">My Pets</h1>
    <p class="mb-6">Manage your pet registrations and pre-registrations.</p>

    <div class="mb-6">
        <a href="{{ route('pet-registrations.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">New Pet</a>
    </div>

    <!-- Pre-Registered Pets Section -->
    @php
        $preRegistered = $pets->where('registration_status', 'pre-registered');
        $registered = $pets->where('registration_status', 'approved');
    @endphp

    @if($preRegistered->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Pre-Registered Pets</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($preRegistered as $pet)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if($pet->photo)
                            <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->name ?: 'Pet' }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">No Photo</span>
                            </div>
                        @endif

                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $pet->name }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $pet->species }} - {{ $pet->breed }}</p>
                            <p class="text-sm text-gray-500 mb-3">{{ $pet->birthday ? $pet->birthday->format('M d, Y') : 'No birthday' }}</p>

                            <div class="flex justify-between items-center mb-3">
                                <span class="text-xs text-gray-500">{{ $pet->gender }}</span>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pre-Registered</span>
                            </div>

                            <div class="flex space-x-2">
                                <a href="{{ route('pet-registrations.show', $pet) }}" class="flex-1 bg-purple-600 text-white py-2 rounded text-center hover:bg-purple-700 transition duration-200 text-sm">
                                    View
                                </a>
                                <a href="{{ route('pet-registrations.edit', $pet) }}" class="flex-1 bg-blue-600 text-white py-2 rounded text-center hover:bg-blue-700 transition duration-200 text-sm">
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if($registered->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Registered Pets</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($registered as $pet)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if($pet->photo)
                            <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->name ?: 'Pet' }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">No Photo</span>
                            </div>
                        @endif

                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $pet->name }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $pet->species }} - {{ $pet->breed }}</p>
                            <p class="text-sm text-gray-500 mb-3">{{ $pet->birthday ? $pet->birthday->format('M d, Y') : 'No birthday' }}</p>

                            <div class="flex justify-between items-center mb-3">
                                <span class="text-xs text-gray-500">{{ $pet->gender }}</span>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Registered</span>
                            </div>

                            <div class="flex space-x-2">
                                <a href="{{ route('pet-registrations.show', $pet) }}" class="flex-1 bg-purple-600 text-white py-2 rounded text-center hover:bg-purple-700 transition duration-200 text-sm">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if($preRegistered->count() == 0 && $registered->count() == 0)
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <p class="text-gray-500 mb-4">You haven't registered any pets yet.</p>
            <a href="{{ route('pet-registrations.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Register Your First Pet</a>
        </div>
    @endif
</div>
@endsection
