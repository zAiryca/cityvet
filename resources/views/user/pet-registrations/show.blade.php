@extends('layouts.app')

@section('title', '| Pet Pre-Registration Details')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold">{{ $petRegistration->pet_name }}</h3>
                    <div class="flex space-x-2">
                        @if($petRegistration->status === 'pending')
                            <a href="{{ route('pet-registrations.edit', $petRegistration) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('pet-registrations.destroy', $petRegistration) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this registration?')">
                                    Delete
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('pet-registrations.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to List
                        </a>
                    </div>
                </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Pet Information -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-teal-600 px-8 py-6">
                        <h2 class="text-2xl font-bold text-white">🐾 Pet Information</h2>
                    </div>

                    <div class="px-8 py-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600">Pet Name</label>
                                    <p class="text-lg font-medium text-gray-900">{{ $petRegistration->pet_name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600">Species</label>
                                    <p class="text-lg font-medium text-gray-900">{{ $petRegistration->species }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600">Breed</label>
                                    <p class="text-lg font-medium text-gray-900">{{ $petRegistration->breed }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600">Birth Date</label>
                                    <p class="text-lg font-medium text-gray-900">{{ $petRegistration->birthday ? $petRegistration->birthday->format('M d, Y') : 'Not specified' }}</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600">Gender</label>
                                    <p class="text-lg font-medium text-gray-900">{{ ucfirst($petRegistration->gender) }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600">Color Markings</label>
                                    <p class="text-lg font-medium text-gray-900">{{ is_array($petRegistration->color_markings) ? implode(', ', $petRegistration->color_markings) : $petRegistration->color_markings }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-600">Description</label>
                                    <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">{{ $petRegistration->description ?: 'No description provided' }}</p>
                                </div>
                            </div>
                        </div>

                        @if($petRegistration->photo)
                            <div class="mt-6">
                                <label class="block text-sm font-semibold text-gray-600 mb-3">Pet Photo</label>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <img src="{{ asset('storage/' . $petRegistration->photo) }}" alt="{{ $petRegistration->pet_name }}" class="max-w-full h-auto rounded-lg shadow-md">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Owner Information -->
            <div>
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-8 py-6">
                        <h2 class="text-2xl font-bold text-white">👤 Owner Information</h2>
                    </div>

                    <div class="px-8 py-6 space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-600">Full Name</label>
                            <p class="text-lg font-medium text-gray-900">{{ $petRegistration->user->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600">Email Address</label>
                            <p class="text-lg font-medium text-gray-900">{{ $petRegistration->user->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600">Contact Number</label>
                            <p class="text-lg font-medium text-gray-900">{{ $petRegistration->user->contact_number ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600">Complete Address</label>
                            <p class="text-gray-700 bg-gray-50 p-3 rounded-lg text-sm">
                                {{ ($petRegistration->user->street ?? '') . ', ' . ($petRegistration->user->barangay ?? '') . ', ' . ($petRegistration->user->city_municipality ?? '') }}
                            </p>
                        </div>
                        <div class="border-t pt-4">
                            <label class="block text-sm font-semibold text-gray-600">Registration Timeline</label>
                            <div class="space-y-2 text-sm">
                                <p><span class="font-medium">Submitted:</span> {{ $petRegistration->created_at->format('M d, Y H:i') }}</p>
                                <p><span class="font-medium">Last Updated:</span> {{ $petRegistration->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
