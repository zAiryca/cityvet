@extends('layouts.admin')

@section('title', '| Pet Registration Details')

@section('content')
<div class="min-h-screen px-4 py-12 bg-gradient-to-br from-blue-50 to-indigo-100 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-6 overflow-hidden bg-white shadow-xl rounded-2xl">
            <div class="px-8 py-6 bg-gradient-to-r from-blue-600 to-indigo-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white">Pet Registration Details</h1>
                        <p class="mt-1 text-blue-100">Review and manage pet registration application</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.pet-registrations.index') }}" class="px-4 py-2 font-semibold text-white transition duration-200 rounded-lg bg-white/20 hover:bg-white/30">
                            ← Back to List
                        </a>
                    </div>
                </div>
            </div>

            <!-- Status Badge -->
            <div class="px-8 py-4 border-b bg-gray-50">
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

            @if($pet_registration->status === 'denied' && $pet_registration->denial_reason)
                <div class="px-8 py-4 border-t border-red-100 bg-red-50">
                    <h4 class="text-sm font-semibold text-red-700">Denial reason</h4>
                    <p class="mt-2 text-sm text-red-800">{{ $pet_registration->denial_reason }}</p>
                </div>
            @endif
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Pet Information -->
            <div class="lg:col-span-2">
                <div class="overflow-hidden bg-white shadow-xl rounded-2xl">
                    <div class="px-8 py-6 bg-gradient-to-r from-green-600 to-teal-600">
                        <h2 class="text-2xl font-bold text-white">Pet Information</h2>
                    </div>

                    <div class="px-8 py-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
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
                                    <p class="p-3 text-gray-700 rounded-lg bg-gray-50">{{ $pet_registration->description ?: 'No description provided' }}</p>
                                </div>
                            </div>
                        </div>

                        @if($pet_registration->photo)
                            <div class="mt-6">
                                <label class="block mb-3 text-sm font-semibold text-gray-600">Pet Photo</label>
                                <div class="p-4 rounded-lg bg-gray-50">
                                    <img src="{{ asset('storage/' . $pet_registration->photo) }}" alt="{{ $pet_registration->pet_name }}" class="h-auto max-w-full rounded-lg shadow-md">
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
                            <label class="block text-sm font-semibold text-gray-600">Birthday</label>
                            <p class="text-lg font-medium text-gray-900">{{ $pet_registration->user->birthday ? $pet_registration->user->birthday->format('M d, Y') : 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-600">Complete Address</label>
                            <p class="p-3 text-sm text-gray-700 rounded-lg bg-gray-50">
                                {{ ($pet_registration->user->street ?? '') . ', ' . ($pet_registration->user->barangay ?? '') . ', ' . ($pet_registration->user->city_municipality ?? '') }}
                            </p>
                        </div>
                        @if($pet_registration->user->id_photo)
                            <div class="pt-4 border-t">
                                <label class="block mb-2 text-sm font-semibold text-gray-600">ID Photo</label>
                                <div onclick="document.getElementById('petRegShowIdPhotoModal').classList.remove('hidden')"
                                     class="flex flex-col items-center justify-center w-24 h-16 transition duration-150 ease-in-out bg-black border-2 border-gray-400 rounded cursor-pointer hover:bg-gray-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.75 4h2.5a2 2 0 011.664.89l.812 1.22a2 2 0 001.664.89H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>

                                <!-- Modal for Full Size ID Photo -->
                                <div id="petRegShowIdPhotoModal"
                                     class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 transition-opacity duration-300 bg-black bg-opacity-80"
                                     onclick="if(event.target.id === 'petRegShowIdPhotoModal') this.classList.add('hidden')">
                                    <div class="relative max-w-3xl overflow-hidden bg-white rounded-lg shadow-2xl">
                                        <div class="sticky top-0 z-10 flex items-center justify-between p-3 bg-white border-b border-gray-200">
                                            <h3 class="text-xl font-semibold text-gray-800">Owner ID Photo</h3>
                                            <button onclick="document.getElementById('petRegShowIdPhotoModal').classList.add('hidden')"
                                                    class="p-2 text-gray-500 transition duration-150 rounded-full hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="p-6 max-h-[80vh] overflow-y-auto">
                                            <img src="{{ asset('storage/' . $pet_registration->user->id_photo) }}"
                                                 alt="Full Size ID Photo"
                                                 class="w-full h-auto rounded-lg shadow-md">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="pt-4 border-t">
                            <label class="block text-sm font-semibold text-gray-600">Registration Timeline</label>
                            <div class="space-y-2 text-sm">
                                <p><span class="font-medium">Submitted:</span> {{ $pet_registration->created_at->format('M d, Y H:i') }}</p>
                                <p><span class="font-medium">Last Updated:</span> {{ $pet_registration->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-6 overflow-hidden bg-white shadow-xl rounded-2xl">
                    <div class="px-8 py-6 bg-gradient-to-r from-gray-600 to-gray-700">
                        <h2 class="text-xl font-bold text-white">Actions</h2>
                    </div>

                    <div class="px-8 py-6 space-y-3">
                        @if($pet_registration->status === 'pending')
                            <form method="POST" action="{{ route('admin.pet-registrations.approve', $pet_registration) }}" class="block">
                                @csrf
                                <button type="submit" class="w-full px-4 py-3 font-semibold text-white transition duration-200 bg-green-600 rounded-lg hover:bg-green-700"
                                        onclick="return confirm('Are you sure you want to register this pet?')">
                                    ✅ Register Pet
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.pet-registrations.deny', $pet_registration) }}" class="block">
                                @csrf
                                <label for="denial_reason" class="block mb-2 text-sm font-medium text-white">Reason for denial (optional)</label>
                                <textarea name="denial_reason" id="denial_reason" rows="3" class="w-full p-3 mb-3 text-sm rounded-lg" placeholder="Explain why this registration is denied (optional)"></textarea>
                                <button type="submit" class="w-full px-4 py-3 font-semibold text-white transition duration-200 bg-orange-600 rounded-lg hover:bg-orange-700"
                                        onclick="return confirm('Are you sure you want to deny this pet registration?')">
                                    ❌ Deny Registration
                                </button>
                            </form>
                        @endif

                        <form method="POST" action="{{ route('admin.pet-registrations.destroy', $pet_registration) }}" class="block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-4 py-3 font-semibold text-white transition duration-200 bg-red-600 rounded-lg hover:bg-red-700"
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
