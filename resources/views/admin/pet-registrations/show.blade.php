@extends('layouts.admin')

@section('title', '| Pet Registration Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-white">Pet Registration Details</h1>
                        <p class="text-blue-100 mt-1">Review and manage pet registration application</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.pet-registrations.index') }}" class="bg-white/20 hover:bg-white/30 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                            ← Back to List
                        </a>
                    </div>
                </div>
            </div>

            <!-- Status Badge -->
            <div class="px-8 py-4 bg-gray-50 border-b">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <span class="text-sm font-medium text-gray-600">Status:</span>
                        <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full
                            @if($pet_registration->status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                            @elseif($pet_registration->status === 'registered') bg-green-100 text-green-800 border border-green-200
                            @elseif($pet_registration->status === 'denied') bg-red-100 text-red-800 border border-red-200
                            @else bg-gray-100 text-gray-800 border border-gray-200 @endif">
                            {{ ucfirst($pet_registration->status) }}
                        </span>
                    </div>

                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Pet Information -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-teal-600 px-8 py-6">
                        <h2 class="text-2xl font-bold text-white">Pet Information</h2>
                    </div>

                    <div class="px-8 py-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600">Pet Name</label>
                                    <p class="text-lg font-medium text-gray-900">{{ $pet_registration->pet_name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600">Species</label>
                                    <p class="text-lg font-medium text-gray-900">{{ $pet_registration->species }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600">Breed</label>
                                    <p class="text-lg font-medium text-gray-900">{{ $pet_registration->breed }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600">Birth Date</label>
                                    <p class="text-lg font-medium text-gray-900">{{ $pet_registration->birthday ? $pet_registration->birthday->format('M d, Y') : 'Not specified' }}</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600">Gender</label>
                                    <p class="text-lg font-medium text-gray-900">{{ ucfirst($pet_registration->gender) }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600">Color Markings</label>
                                    <p class="text-lg font-medium text-gray-900">{{ is_array($pet_registration->color_markings) ? implode(', ', $pet_registration->color_markings) : $pet_registration->color_markings }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-600">Description</label>
                                    <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">{{ $pet_registration->description ?: 'No description provided' }}</p>
                                </div>
                            </div>
                        </div>

                        @if($pet_registration->photo)
                            <div class="mt-6">
                                <label class="block text-sm font-semibold text-gray-600 mb-3">Pet Photo</label>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <img src="{{ asset('storage/' . $pet_registration->photo) }}" alt="{{ $pet_registration->pet_name }}" class="max-w-full h-auto rounded-lg shadow-md">
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
                        <h2 class="text-2xl font-bold text-white">Owner Information</h2>
                    </div>

                    <div class="px-8 py-6 space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-600">Full Name</label>
                            <p class="text-lg font-medium text-gray-900">{{ $pet_registration->user->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600">Email Address</label>
                            <p class="text-lg font-medium text-gray-900">{{ $pet_registration->user->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600">Contact Number</label>
                            <p class="text-lg font-medium text-gray-900">{{ $pet_registration->user->contact_number ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600">Complete Address</label>
                            <p class="text-gray-700 bg-gray-50 p-3 rounded-lg text-sm">
                                {{ ($pet_registration->user->street ?? '') . ', ' . ($pet_registration->user->barangay ?? '') . ', ' . ($pet_registration->user->city_municipality ?? '') }}
                            </p>
                        </div>
                        <div class="border-t pt-4">
                            <label class="block text-sm font-semibold text-gray-600">Registration Timeline</label>
                            <div class="space-y-2 text-sm">
                                <p><span class="font-medium">Submitted:</span> {{ $pet_registration->created_at->format('M d, Y H:i') }}</p>
                                <p><span class="font-medium">Last Updated:</span> {{ $pet_registration->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden mt-6">
                    <div class="bg-gradient-to-r from-gray-600 to-gray-700 px-8 py-6">
                        <h2 class="text-xl font-bold text-white">Actions</h2>
                    </div>

                    <div class="px-8 py-6 space-y-3">
                        <form method="POST" action="{{ route('admin.pet-registrations.destroy', $pet_registration) }}" class="block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200"
                                    onclick="return confirm('Are you sure you want to delete this registration?')">
                                🗑️ Delete Registration
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
