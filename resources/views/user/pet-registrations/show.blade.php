@extends('layouts.app')

@section('title', '| Pet Pre-Registration Details')

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200 lg:p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold">{{ $petRegistration->pet_name }}</h3>
                    <div class="flex space-x-2">
                        @if(in_array($petRegistration->status, ['pending', 'registered', 'denied']))
                            @if(in_array($petRegistration->status, ['pending', 'denied']))
                                <a href="{{ route('pet-registrations.edit', $petRegistration) }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                    Edit
                                </a>
                            @endif
                            <form method="POST" action="{{ route('pet-registrations.destroy', $petRegistration) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700" onclick="return confirm('Are you sure you want to delete this registration?')">
                                    Delete
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('pet-registrations.index') }}" class="px-4 py-2 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">
                            Back to List
                        </a>
                    </div>
                </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Pet Information -->
            <div class="lg:col-span-2">
                <div class="overflow-hidden bg-white shadow-xl rounded-2xl">
                    <div class="px-8 py-6 bg-gradient-to-r from-green-600 to-teal-600">
                        <h2 class="text-2xl font-bold text-white">🐾 Pet Information</h2>
                    </div>

                    <div class="px-8 py-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
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
                                    <p class="p-3 text-gray-700 rounded-lg bg-gray-50">{{ $petRegistration->description ?: 'No description provided' }}</p>
                                </div>
                            </div>
                        </div>

                        @if($petRegistration->photo)
                            <div class="mt-6">
                                <label class="block mb-3 text-sm font-semibold text-gray-600">Pet Photo</label>
                                <div class="p-4 rounded-lg bg-gray-50">
                                    <img src="{{ asset('storage/' . $petRegistration->photo) }}" alt="{{ $petRegistration->pet_name }}" class="h-auto max-w-full rounded-lg shadow-md">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Owner Information -->
            <div>
                <div class="overflow-hidden bg-white shadow-xl rounded-2xl">
                    <div class="px-8 py-6 bg-gradient-to-r from-purple-600 to-pink-600">
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
                            <p class="p-3 text-sm text-gray-700 rounded-lg bg-gray-50">
                                {{ ($petRegistration->user->street ?? '') . ', ' . ($petRegistration->user->barangay ?? '') . ', ' . ($petRegistration->user->city_municipality ?? '') }}
                            </p>
                        </div>
                        @if($petRegistration->user->id_photo)
                            <div>
                                <label class="block text-sm font-semibold text-gray-600">ID Photo</label>
                                <div class="flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . $petRegistration->user->id_photo) }}" alt="Owner ID Photo" class="object-cover w-24 h-16 border border-gray-300 rounded">
                                    <span class="text-sm text-gray-600">Uploaded ID photo for verification.</span>
                                </div>
                            </div>
                        @endif
                        <div class="pt-4 border-t">
                            <label class="block text-sm font-semibold text-gray-600">Registration Timeline</label>
                            <div class="space-y-2 text-sm">
                                <p><span class="font-medium">Submitted:</span> {{ $petRegistration->created_at->format('M d, Y H:i') }}</p>
                                <p><span class="font-medium">Last Updated:</span> {{ $petRegistration->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                        @if($petRegistration->status === 'denied' && $petRegistration->denial_reason)
                            <div class="mt-4 p-4 border border-red-100 bg-red-50 rounded">
                                <h4 class="text-sm font-semibold text-red-700">Reason for denial</h4>
                                <p class="text-sm text-red-800 mt-2">{{ $petRegistration->denial_reason }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
