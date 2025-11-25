@extends('layouts.admin')

@section('title', '| Pet Registration Details')

@section('content')
<div>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <div class="bg-white rounded-full p-3 shadow-sm mr-4">
                    <img src="{{ asset('https://i.ibb.co/8DPN5B7m/logo.png') }}" alt="FindFurEver Logo" class="w-12 h-12 object-contain">
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Registration Review</h1>
                    <p class="text-gray-600 mt-1">Manage {{ $pet_registration->pet_name }}'s application</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.pet-registrations.index') }}"
                   class="px-5 py-2.5 bg-pastel-blue text-gray-800 rounded-xl hover:bg-pastel-blue-dark transition-all duration-200 font-medium shadow-sm">
                    ← Back to List
                </a>
            </div>
        </div>

        <!-- Status Banner -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="text-sm">
                        <span class="text-gray-600">Application Status:</span>
                        @if($pet_registration->status === 'pending')
                            <span class="ml-2 px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium border border-yellow-200">
                                ⏳ Pending Review
                            </span>
                        @elseif($pet_registration->status === 'registered')
                            <span class="ml-2 px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium border border-green-200">
                                ✅ Registered
                            </span>
                        @elseif($pet_registration->status === 'denied')
                            <span class="ml-2 px-4 py-2 bg-red-100 text-red-800 rounded-full text-sm font-medium border border-red-200">
                                ❌ Denied
                            </span>
                        @endif
                    </div>
                </div>
                <div class="text-sm text-gray-500">
                    Submitted: {{ $pet_registration->created_at->format('M d, Y') }}
                </div>
            </div>

            @if($pet_registration->status === 'denied' && $pet_registration->denial_reason)
                <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <div class="flex items-center mb-2">
                        <span class="text-lg mr-2">⚠️</span>
                        <h4 class="font-semibold text-red-700">Reason for Denial</h4>
                    </div>
                    <p class="text-red-800">{{ $pet_registration->denial_reason }}</p>
                </div>
            @endif
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Pet Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Pet Details Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="text-2xl mr-2">🐕</span>
                        Pet Information
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Pet Name</label>
                                <p class="text-lg font-bold text-gray-900 bg-pastel-blue px-3 py-2 rounded-lg">{{ $pet_registration->pet_name }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Species & Breed</label>
                                <p class="text-gray-900 bg-pastel-green px-3 py-2 rounded-lg">
                                    {{ $pet_registration->species }} - {{ $pet_registration->breed }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Birthday</label>
                                <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">
                                    {{ $pet_registration->birthday ? $pet_registration->birthday->format('M d, Y') : 'Not specified' }}
                                </p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Gender</label>
                                <p class="text-gray-900 bg-pastel-purple px-3 py-2 rounded-lg">{{ ucfirst($pet_registration->gender) }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Color Markings</label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(explode(', ', is_array($pet_registration->color_markings) ? implode(', ', $pet_registration->color_markings) : $pet_registration->color_markings) as $color)
                                        <span class="px-3 py-1 bg-pastel-yellow text-gray-800 rounded-full text-sm">{{ $color }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Description</label>
                        <p class="text-gray-700 bg-gray-50 p-4 rounded-lg min-h-[80px]">
                            {{ $pet_registration->description ?: 'No description provided 🐾' }}
                        </p>
                    </div>

                    @if($pet_registration->photo)
                        <div class="mt-6">
                            <label class="block text-sm font-semibold text-gray-600 mb-3">Pet Photo</label>
                            <img src="{{ asset('storage/' . $pet_registration->photo) }}"
                                 alt="{{ $pet_registration->pet_name }}"
                                 class="w-full max-w-md h-64 object-cover rounded-xl shadow-md">
                        </div>
                    @endif
                </div>

                <!-- Owner Information Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="text-2xl mr-2">👤</span>
                        Owner Information
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Full Name</label>
                                <p class="text-lg text-gray-900 bg-pastel-purple px-3 py-2 rounded-lg">{{ $pet_registration->user->name ?? 'N/A' }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Email Address</label>
                                <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $pet_registration->user->email ?? 'N/A' }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Birthday</label>
                                <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">
                                    {{ $pet_registration->user->birthday ? $pet_registration->user->birthday->format('M d, Y') : 'N/A' }}
                                </p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Contact Number</label>
                                <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-lg">{{ $pet_registration->user->contact_number ?? 'N/A' }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Address</label>
                                <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded-lg">
                                    {{ ($pet_registration->user->street ?? '') . ', ' . ($pet_registration->user->barangay ?? '') . ', ' . ($pet_registration->user->city_municipality ?? '') }}
                                </p>
                            </div>

                            @if($pet_registration->user->id_photo)
                                <div>
                                    <label class="block text-sm font-semibold text-gray-600 mb-1">ID Verification</label>
                                    <div onclick="document.getElementById('petRegShowIdPhotoModal').classList.remove('hidden')"
                                         class="inline-flex items-center p-3 bg-pastel-mint rounded-lg cursor-pointer hover:bg-pastel-mint-dark transition-colors duration-200">
                                        <span class="text-xl mr-2">🪪</span>
                                        <span class="font-medium">View ID Photo</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions Sidebar -->
            <div class="space-y-6">
                <!-- Admin Actions -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="text-2xl mr-2">⚡</span>
                        Admin Actions
                    </h2>

                    <div class="space-y-4">
                        @if($pet_registration->status === 'pending')
                            <form method="POST" action="{{ route('admin.pet-registrations.approve', $pet_registration) }}" class="block">
                                @csrf
                                <button type="submit"
                                        class="w-full px-4 py-3 bg-pastel-green text-gray-800 rounded-xl hover:bg-pastel-green-dark transition-all duration-200 font-medium shadow-sm flex items-center justify-center"
                                        onclick="return confirm('Are you sure you want to register this pet?')">
                                    <span class="text-xl mr-2">✅</span>
                                    Register Pet
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.pet-registrations.deny', $pet_registration) }}" class="block">
                                @csrf
                                <div class="mb-3">
                                    <label for="denial_reason" class="block text-sm font-medium text-gray-700 mb-2">Reason for denial (optional)</label>
                                    <textarea name="denial_reason" id="denial_reason" rows="3"
                                              class="w-full p-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                              placeholder="Explain why this registration is being denied..."></textarea>
                                </div>
                                <button type="submit"
                                        class="w-full px-4 py-3 bg-pastel-orange text-gray-800 rounded-xl hover:bg-pastel-orange-dark transition-all duration-200 font-medium shadow-sm flex items-center justify-center"
                                        onclick="return confirm('Are you sure you want to deny this pet registration?')">
                                    <span class="text-xl mr-2">❌</span>
                                    Deny Registration
                                </button>
                            </form>
                        @endif

                        <form method="POST" action="{{ route('admin.pet-registrations.destroy', $pet_registration) }}" class="block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full px-4 py-3 bg-pastel-pink text-gray-800 rounded-xl hover:bg-pastel-pink-dark transition-all duration-200 font-medium shadow-sm flex items-center justify-center"
                                    onclick="return confirm('Are you sure you want to delete this registration?')">
                                <span class="text-xl mr-2">🗑️</span>
                                Delete Registration
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="text-2xl mr-2">📅</span>
                        Timeline
                    </h2>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-700">Submitted</span>
                            <span class="text-sm text-gray-600">{{ $pet_registration->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                            <span class="text-sm font-medium text-gray-700">Last Updated</span>
                            <span class="text-sm text-gray-600">{{ $pet_registration->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ID Photo Modal -->
@if($pet_registration->user->id_photo)
<div id="petRegShowIdPhotoModal"
     class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 transition-opacity duration-300 bg-black bg-opacity-80"
     onclick="if(event.target.id === 'petRegShowIdPhotoModal') this.classList.add('hidden')">
    <div class="relative max-w-3xl overflow-hidden bg-white rounded-2xl shadow-2xl">
        <div class="sticky top-0 z-10 flex items-center justify-between p-4 bg-white border-b border-gray-200">
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

.bg-pastel-orange { background-color: #fed7aa; }
.hover\:bg-pastel-orange-dark:hover { background-color: #fdba74; }
</style>
@endsection
