@extends('layouts.app')

@section('title', '| My Pets')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">My Pets</h1>
    <p class="mb-6">Manage your pet registrations and pre-registrations.</p>

    <div class="mb-6">
        <a href="{{ route('pet-registrations.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Pre-Register New Pet</a>
        <a href="{{ route('pet-registrations.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 ml-4">Refresh</a>
    </div>

    <!-- Pre-Registered Pets Section -->
    @php
        $pending = $petRegistrations->where('status', 'pending');
        $registered = $petRegistrations->where('status', 'registered');
    @endphp

    @if($pending->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Pre-Registered Pets</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($pending as $petRegistration)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if($petRegistration->photo)
                            <img src="{{ asset('storage/' . $petRegistration->photo) }}" alt="{{ $petRegistration->pet_name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">No Photo</span>
                            </div>
                        @endif

                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $petRegistration->pet_name }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $petRegistration->species }} - {{ $petRegistration->breed }}</p>
                            <p class="text-sm text-gray-500 mb-3">{{ $petRegistration->birthday ? $petRegistration->birthday->format('M d, Y') : 'No birthday' }}</p>

                            <div class="flex justify-between items-center mb-3">
                                <span class="text-xs text-gray-500">{{ ucfirst($petRegistration->gender) }}</span>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pre-Registered</span>
                            </div>

                            <div class="flex space-x-2">
                                <a href="{{ route('pet-registrations.show', $petRegistration) }}" class="flex-1 bg-purple-600 text-white py-2 rounded text-center hover:bg-purple-700 transition duration-200 text-sm">
                                    View
                                </a>
                                <a href="{{ route('pet-registrations.edit', $petRegistration) }}" class="flex-1 bg-blue-600 text-white py-2 rounded text-center hover:bg-blue-700 transition duration-200 text-sm">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('pet-registrations.destroy', $petRegistration) }}" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this pet registration?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-600 text-white py-2 rounded text-center hover:bg-red-700 transition duration-200 text-sm">
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

    @if($registered->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Registered Pets</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($registered as $petRegistration)
                    <div class="bg-green-50 border border-green-200 rounded-lg shadow-md overflow-hidden">
                        @if($petRegistration->photo)
                            <img src="{{ asset('storage/' . $petRegistration->photo) }}" alt="{{ $petRegistration->pet_name }}" class="w-full h-48 object-cover opacity-75">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">No Photo</span>
                            </div>
                        @endif

                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <h3 class="text-lg font-semibold text-gray-900 mr-2">{{ $petRegistration->pet_name }}</h3>
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Registered</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">{{ $petRegistration->species }} - {{ $petRegistration->breed }}</p>
                            <p class="text-sm text-gray-500 mb-3">{{ $petRegistration->birthday ? $petRegistration->birthday->format('M d, Y') : 'No birthday' }}</p>

                            <div class="flex space-x-2">
                                <a href="{{ route('pet-registrations.show', $petRegistration) }}" class="flex-1 bg-purple-600 text-white py-2 rounded text-center hover:bg-purple-700 transition duration-200 text-sm">
                                    View
                                </a>
                                <form method="POST" action="{{ route('pet-registrations.destroy', $petRegistration) }}" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this pet registration?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-600 text-white py-2 rounded text-center hover:bg-red-700 transition duration-200 text-sm">
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

    @if($pending->count() == 0 && $registered->count() == 0)
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <p class="text-gray-500 mb-4">You haven't registered any pets yet.</p>
            <a href="{{ route('pet-registrations.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Pre-Register Your First Pet</a>
        </div>
    @endif
</div>
@endsection
