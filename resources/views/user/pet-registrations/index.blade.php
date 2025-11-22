@extends('layouts.app')

@section('title', '| My Pets')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                <h1 class="text-3xl font-bold text-white">🐾 My Pets</h1>
                <p class="text-blue-100 mt-2">Manage your pet registrations and pre-registrations</p>
            </div>

            <div class="px-8 py-6 bg-gray-50">
                <div class="flex justify-between items-center">
                    <div class="flex space-x-3">
                        <a href="{{ route('pet-registrations.create') }}" class="bg-purple-600 text-white px-6 py-3 rounded-xl hover:bg-purple-700 transition duration-200 font-semibold shadow-lg hover:shadow-xl">
                            🚀 Pre-Register New Pet
                        </a>
                        <a href="{{ route('pet-registrations.index') }}" class="bg-gray-600 text-white px-6 py-3 rounded-xl hover:bg-gray-700 transition duration-200 font-semibold shadow-lg hover:shadow-xl">
                            🔄 Refresh
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pre-Registered Pets Section -->
        @php
            $pending = $petRegistrations->where('status', 'pending');
            $registered = $petRegistrations->where('status', 'registered');
            $denied = $petRegistrations->where('status', 'denied');
        @endphp

        @if($pending->count() > 0)
            <div class="mb-8">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-8 py-6">
                        <h2 class="text-2xl font-bold text-white">⏳ Pre-Registered Pets</h2>
                        <p class="text-yellow-100 mt-1">Pets awaiting official registration approval</p>
                    </div>

                    <div class="px-8 py-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($pending as $petRegistration)
                                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-yellow-200 hover:shadow-xl transition duration-300">
                                    @if($petRegistration->photo)
                                        <img src="{{ asset('storage/' . $petRegistration->photo) }}" alt="{{ $petRegistration->pet_name }}" class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                            <div class="text-center">
                                                <span class="text-4xl">🐾</span>
                                                <p class="text-gray-500 text-sm mt-2">No Photo</p>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="p-6">
                                        <div class="flex justify-between items-start mb-3">
                                            <h3 class="text-xl font-bold text-gray-900">{{ $petRegistration->pet_name }}</h3>
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">Pre-Registered</span>
                                        </div>

                                        <div class="space-y-2 mb-4">
                                            <p class="text-sm text-gray-600"><span class="font-medium">Species:</span> {{ $petRegistration->species }}</p>
                                            <p class="text-sm text-gray-600"><span class="font-medium">Breed:</span> {{ $petRegistration->breed }}</p>
                                            <p class="text-sm text-gray-600"><span class="font-medium">Gender:</span> {{ ucfirst($petRegistration->gender) }}</p>
                                            <p class="text-sm text-gray-600"><span class="font-medium">Birthday:</span> {{ $petRegistration->birthday ? $petRegistration->birthday->format('M d, Y') : 'Not specified' }}</p>
                                        </div>

                                        <div class="flex space-x-2">
                                            <a href="{{ route('pet-registrations.show', $petRegistration) }}" class="flex-1 bg-purple-600 text-white py-3 rounded-lg text-center hover:bg-purple-700 transition duration-200 font-semibold text-sm shadow-md hover:shadow-lg">
                                                👁️ View
                                            </a>
                                            <a href="{{ route('pet-registrations.edit', $petRegistration) }}" class="flex-1 bg-blue-600 text-white py-3 rounded-lg text-center hover:bg-blue-700 transition duration-200 font-semibold text-sm shadow-md hover:shadow-lg">
                                                ✏️ Edit
                                            </a>
                                            <form method="POST" action="{{ route('pet-registrations.destroy', $petRegistration) }}" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this pet registration?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg text-center hover:bg-red-700 transition duration-200 font-semibold text-sm shadow-md hover:shadow-lg">
                                                    🗑️ Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Denied Registrations --}}
        @if($denied->count() > 0)
            <div class="mb-8">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-red-600 to-pink-500 px-8 py-6">
                        <h2 class="text-2xl font-bold text-white">⛔ Denied Registrations</h2>
                        <p class="text-red-100 mt-1">Registrations that were denied by the admin. You can edit and resubmit.</p>
                    </div>

                    <div class="px-8 py-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($denied as $petRegistration)
                                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-red-200 hover:shadow-xl transition duration-300">
                                    @if($petRegistration->photo)
                                        <img src="{{ asset('storage/' . $petRegistration->photo) }}" alt="{{ $petRegistration->pet_name }}" class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                            <div class="text-center">
                                                <span class="text-4xl">🐾</span>
                                                <p class="text-gray-500 text-sm mt-2">No Photo</p>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="p-6">
                                        <div class="flex justify-between items-start mb-3">
                                            <h3 class="text-xl font-bold text-gray-900">{{ $petRegistration->pet_name }}</h3>
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 border border-red-200">Denied</span>
                                        </div>

                                        <div class="space-y-2 mb-4">
                                            <p class="text-sm text-gray-600"><span class="font-medium">Species:</span> {{ $petRegistration->species }}</p>
                                            <p class="text-sm text-gray-600"><span class="font-medium">Breed:</span> {{ $petRegistration->breed }}</p>
                                            <p class="text-sm text-gray-600"><span class="font-medium">Gender:</span> {{ ucfirst($petRegistration->gender) }}</p>
                                            <p class="text-sm text-gray-600"><span class="font-medium">Birthday:</span> {{ $petRegistration->birthday ? $petRegistration->birthday->format('M d, Y') : 'Not specified' }}</p>
                                        </div>

                                        <div class="flex space-x-2">
                                            <a href="{{ route('pet-registrations.show', $petRegistration) }}" class="flex-1 bg-purple-600 text-white py-3 rounded-lg text-center hover:bg-purple-700 transition duration-200 font-semibold text-sm shadow-md hover:shadow-lg">
                                                👁️ View
                                            </a>
                                            <a href="{{ route('pet-registrations.edit', $petRegistration) }}" class="flex-1 bg-blue-600 text-white py-3 rounded-lg text-center hover:bg-blue-700 transition duration-200 font-semibold text-sm shadow-md hover:shadow-lg">
                                                ✏️ Edit & Resubmit
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
