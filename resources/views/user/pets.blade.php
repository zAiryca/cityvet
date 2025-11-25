@extends('layouts.app')

@section('title', '| My Pets')

@section('content')
@if(session('refresh'))
<script>
    window.onload = function() {
        location.reload();
    };
</script>
@endif
<div class="max-w-7xl mx-auto py-6 px-4 pt-24">
    <h1 class="text-3xl font-bold mb-6">My Pets</h1>
    <p class="mb-6">Manage your pet registrations and pre-registrations.</p>

    <div class="mb-6">
        <a href="{{ route('pet-registrations.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Pre-Register New Pet</a>
        <a href="{{ route('user.pets') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 ml-4">Refresh</a>
    </div>

    <!-- Pre-Registered Pets Section -->
    @if($preRegisteredPets->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Pre-Registered Pets</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($preRegisteredPets as $pet)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if($pet->photo)
                            <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">No Photo</span>
                            </div>
                        @endif

                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $pet->name }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $pet->species }} - {{ $pet->breed }}</p>
                            <p class="text-sm text-gray-600 mb-2">Gender: {{ ucfirst($pet->gender) }}</p>
                            <p class="text-sm text-gray-500 mb-3">
                                Age:
                                @if($pet->age_years || $pet->age_months)
                                    @if($pet->age_years) {{ $pet->age_years }} year{{ $pet->age_years !== 1 ? 's' : '' }} @endif
                                    @if($pet->age_years && $pet->age_months) and @endif
                                    @if($pet->age_months) {{ $pet->age_months }} month{{ $pet->age_months !== 1 ? 's' : '' }} @endif
                                @else
                                    N/A
                                @endif
                            </p>
                            <p class="text-sm text-gray-500 mb-3">Pre-registered on {{ $pet->created_at->format('M d, Y') }}</p>

                            <div class="flex items-center mb-3">
                                <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Pending Approval</span>
                            </div>

                            <div class="flex space-x-2 mb-2">
                                <a href="{{ route('pet-registrations.show', $pet) }}" class="flex-1 bg-purple-600 text-white py-2 rounded text-center hover:bg-purple-700 transition duration-200 text-sm">
                                    View
                                </a>
                                <a href="{{ route('pet-registrations.edit', $pet) }}" class="flex-1 bg-blue-600 text-white py-2 rounded text-center hover:bg-blue-700 transition duration-200 text-sm">
                                    Edit
                                </a>
                            </div>

                            <div class="flex space-x-2">
                                <form method="POST" action="{{ route('pet-registrations.destroy', $pet) }}" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this pre-registration?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700 transition duration-200 text-sm">
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

    <!-- Registered Pets Section -->
    @if($registeredPets->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Registered Pets</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($registeredPets as $pet)
                    <div class="bg-green-50 border border-green-200 rounded-lg shadow-md overflow-hidden">
                        @if($pet->photo)
                            <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->name }}" class="w-full h-48 object-cover opacity-75">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">No Photo</span>
                            </div>
                        @endif

                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <h3 class="text-lg font-semibold text-gray-900 mr-2">{{ $pet->name }}</h3>
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Registered</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">{{ $pet->species }} - {{ $pet->breed }}</p>
                            <p class="text-sm text-gray-600 mb-2">Gender: {{ ucfirst($pet->gender) }}</p>
                            <p class="text-sm text-gray-500 mb-3">
                                Age:
                                @if($pet->age_years || $pet->age_months)
                                    @if($pet->age_years) {{ $pet->age_years }} year{{ $pet->age_years !== 1 ? 's' : '' }} @endif
                                    @if($pet->age_years && $pet->age_months) and @endif
                                    @if($pet->age_months) {{ $pet->age_months }} month{{ $pet->age_months !== 1 ? 's' : '' }} @endif
                                @else
                                    N/A
                                @endif
                            </p>
                            <p class="text-sm text-gray-500 mb-3">Registered on {{ $pet->updated_at->format('M d, Y') }}</p>

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

    @if($preRegisteredPets->count() == 0 && $registeredPets->count() == 0)
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <p class="text-gray-500 mb-4">You haven't registered any pets yet.</p>
            <a href="{{ route('pet-registrations.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Pre-Register Your First Pet</a>
        </div>
    @endif
</div>
@endsection

