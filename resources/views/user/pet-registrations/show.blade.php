@extends('layouts.app')

@section('title', '| Pet Pre-Registration Details')

@section('content')
<div class="min-h-screen bg-gray-50 pt-24">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <div class="bg-white rounded-full p-3 shadow-sm mr-4">
                    <img src="{{ asset('https://i.ibb.co/8DPN5B7m/logo.png') }}" alt="FindFurEver Logo" class="w-12 h-12 object-contain">
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Pet Registration Details</h1>
                    <p class="text-gray-600 mt-1">Meet {{ $petRegistration->pet_name }}</p>
                </div>
            </div>
            <div class="flex space-x-3">
                @if(in_array($petRegistration->status, ['pending', 'registered', 'denied']))
                    @if(in_array($petRegistration->status, ['pending', 'denied']))
                        <a href="{{ route('pet-registrations.edit', $petRegistration) }}"
                           class="px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                            Edit
                        </a>
                    @endif
                    <form method="POST" action="{{ route('pet-registrations.destroy', $petRegistration) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-5 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md"
                                onclick="return confirm('Are you sure you want to delete this registration?')">
                            Delete
                        </button>
                    </form>
                @endif
                <a href="{{ route('pet-registrations.index') }}"
                   class="px-5 py-2.5 bg-gray-700 text-white rounded-xl hover:bg-gray-800 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                    ← Back
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Pet Photo & Quick Info -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    @if($petRegistration->photo)
                        <img src="{{ asset('storage/' . $petRegistration->photo) }}"
                             alt="{{ $petRegistration->pet_name }}"
                             class="w-full h-64 object-cover rounded-xl mb-4 shadow-md">
                    @else
                        <div class="w-full h-64 bg-gradient-to-br from-pink-100 to-purple-100 rounded-xl flex items-center justify-center mb-4">
                            <div class="text-center">
                                <svg class="w-20 h-20 text-gray-400 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z" />
                                </svg>
                                <p class="text-gray-500 mt-2">No photo</p>
                            </div>
                        </div>
                    @endif

                    <!-- Status Badge -->
                    <div class="flex justify-center mb-4">
                        @if($petRegistration->status === 'pending')
                            <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                                ⏱ Pending Review
                            </span>
                        @elseif($petRegistration->status === 'registered')
                            <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                ✓ Registered
                            </span>
                        @elseif($petRegistration->status === 'denied')
                            <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full text-sm font-medium">
                                × Denied
                            </span>
                        @endif
                    </div>

                    <!-- Quick Info -->
                    <div class="space-y-3">
                        <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                            <svg class="w-8 h-8 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-600">Species</p>
                                <p class="font-semibold text-gray-900">{{ $petRegistration->species }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 bg-green-50 rounded-lg">
                            <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-600">Birthday</p>
                                <p class="font-semibold text-gray-900">{{ $petRegistration->birthday ? $petRegistration->birthday->format('M d, Y') : 'Not specified' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 bg-purple-50 rounded-lg">
                            <span class="text-2xl text-purple-600 mr-3">♂♀</span>
                            <div>
                                <p class="text-sm text-gray-600">Gender</p>
                                <p class="font-semibold text-gray-900">{{ ucfirst($petRegistration->gender) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pet Details -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Pet Details
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Pet Name</label>
                                <p class="text-lg font-bold text-gray-900 bg-pastel-blue px-3 py-2 rounded-lg">{{ $petRegistration->pet_name }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Breed</label>
                                <p class="text-lg text-gray-900 bg-pastel-green px-3 py-2 rounded-lg">{{ $petRegistration->breed }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Color Markings</label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(explode(', ', is_array($petRegistration->color_markings) ? implode(', ', $petRegistration->color_markings) : $petRegistration->color_markings) as $color)
                                        <span class="px-3 py-1 bg-pastel-yellow text-gray-800 rounded-full text-sm">{{ $color }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Description</label>
                                <p class="text-gray-700 bg-gray-50 p-4 rounded-lg min-h-[100px]">
                                    {{ $petRegistration->description ?: 'No description provided' }}
                                </p>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600 mb-1">Submitted</label>
                                    <p class="text-sm text-gray-700">{{ $petRegistration->created_at->format('M d, Y') }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600 mb-1">Last Updated</label>
                                    <p class="text-sm text-gray-700">{{ $petRegistration->updated_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($petRegistration->status === 'denied' && $petRegistration->denial_reason)
                        <div class="mt-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                            <div class="flex items-center mb-2">
                                <svg class="w-6 h-6 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <h4 class="font-semibold text-red-700">Reason for Denial</h4>
                            </div>
                            <p class="text-red-800">{{ $petRegistration->denial_reason }}</p>
                        </div>
                    @endif
                </div>

                <!-- Owner Information -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mt-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Owner Information
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Full Name</label>
                                <p class="text-lg text-gray-900 bg-pastel-purple px-3 py-2 rounded-lg">{{ $petRegistration->user->name ?? 'N/A' }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Email Address</label>
                                <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $petRegistration->user->email ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Contact Number</label>
                                <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $petRegistration->user->contact_number ?? 'N/A' }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Address</label>
                                <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded-lg">
                                    {{ ($petRegistration->user->street ?? '') . ', ' . ($petRegistration->user->barangay ?? '') . ', ' . ($petRegistration->user->city_municipality ?? '') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    @if($petRegistration->user->id_photo)
                        <div class="mt-6">
                            <label class="block text-sm font-semibold text-gray-600 mb-3">ID Photo</label>
                            <div onclick="document.getElementById('petShowIdPhotoModal').classList.remove('hidden')"
                                 class="inline-flex items-center p-3 bg-pastel-mint rounded-lg cursor-pointer hover:bg-pastel-mint-dark transition-colors duration-200">
                                <svg class="w-6 h-6 text-teal-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                </svg>
                                <span class="font-medium">View ID Photo</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ID Photo Modal -->
@if($petRegistration->user->id_photo)
<div id="petShowIdPhotoModal"
     class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 transition-opacity duration-300 bg-black bg-opacity-80"
     onclick="if(event.target.id === 'petShowIdPhotoModal') this.classList.add('hidden')">
    <div class="relative max-w-3xl overflow-hidden bg-white rounded-2xl shadow-2xl">
        <div class="sticky top-0 z-10 flex items-center justify-between p-4 bg-white border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-800">Owner ID Photo</h3>
            <button onclick="document.getElementById('petShowIdPhotoModal').classList.add('hidden')"
                    class="p-2 text-gray-500 transition duration-150 rounded-full hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6 max-h-[80vh] overflow-y-auto">
            <img src="{{ asset('storage/' . $petRegistration->user->id_photo) }}"
                 alt="Full Size ID Photo"
                 class="w-full h-auto rounded-lg shadow-md">
        </div>
    </div>
</div>
@endif

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

.bg-pastel-mint { background-color: #ccfbf1; }
.hover\:bg-pastel-mint-dark:hover { background-color: #99f6e4; }
</style>
@endsection

