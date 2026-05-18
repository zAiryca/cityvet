@extends('layouts.app')

@section('title', '| Pet Pre-Registration Details')

@section('content')
<div class="min-h-screen pt-16 bg-gray-50">
    <div class="max-w-6xl px-4 py-6 mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <div class="p-3 mr-4 bg-white rounded-full shadow-sm">
                    <img src="{{ asset('https://i.ibb.co/8DPN5B7m/logo.png') }}" alt="FindFurEver Logo" class="object-contain w-12 h-12">
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Pet Registration Details</h1>
                    <p class="mt-1 text-gray-600">Meet {{ $petRegistration->pet_name }}</p>
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
                <a href="javascript:void(0)" onclick="history.back()"
                   class="bg-gray-600 text-white hover:bg-gray-800 px-4 py-2 rounded">
                    Back
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Pet Photo & Quick Info -->
            <div class="lg:col-span-1">
                <div class="p-4 bg-white shadow-lg rounded-2xl">
                    <!-- Status Badge -->
                    <div class="flex justify-center mb-4">
                        @if($petRegistration->status === 'pending')
                            <span class="inline-flex items-center px-4 py-2 text-sm font-bold text-yellow-800 bg-yellow-100 rounded-full">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12,6 12,12 16,14"></polyline>
                                </svg>
                                Pending Review
                            </span>
                        @elseif($petRegistration->status === 'registered')
                            <span class="inline-flex items-center px-4 py-2 text-sm font-bold text-green-800 bg-green-100 rounded-full">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <polyline points="20,6 9,17 4,12"></polyline>
                                </svg>
                                Registered
                            </span>
                        @elseif($petRegistration->status === 'denied')
                            <span class="inline-flex items-center px-4 py-2 text-sm font-bold text-red-800 bg-red-100 rounded-full">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                                Denied
                            </span>
                        @endif
                    </div>

                    <!-- Pet Photo -->
                    <div class="mb-6">
                        @if($petRegistration->photo)
                            <img src="{{ asset('storage/' . $petRegistration->photo) }}"
                                 alt="{{ $petRegistration->pet_name }}"
                                 class="object-cover w-full h-64 mx-auto transition-all duration-300 shadow-lg cursor-pointer rounded-xl hover:shadow-xl hover:opacity-90"
                                 onclick="openPetRegistrationPhotoModal()"
                                 style="cursor: pointer;">
                        @else
                            <div class="flex items-center justify-center w-full h-64 bg-gradient-to-br from-pink-100 to-purple-100 rounded-xl">
                                <div class="text-center">
                                    <svg class="w-16 h-16 mx-auto text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z" />
                                    </svg>
                                    <p class="text-sm text-gray-500">No photo</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Quick Info -->
                    <div class="space-y-3">
                        <div class="flex items-center p-4 bg-white border-2 border-blue-200 shadow-sm rounded-xl">
                            <div class="flex items-center justify-center w-10 h-10 mr-3 bg-blue-100 rounded-full">
                                <svg class="w-5 h-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="#3B82F6" d="M234.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5 .3-86.2 32.6-96.8 70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3-14.3-70.1 10.2-84.1 59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5l0 1.6c0 25.8-20.9 46.7-46.7 46.7-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2-25.8 0-46.7-20.9-46.7-46.7l0-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3 29.1 51.7 10.2 84.1-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5 46.9 53.9 32.6 96.8-52.1 69.1-84.4 58.5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold tracking-wide text-blue-600 uppercase">Species</p>
                                <p class="text-lg font-bold text-blue-800">{{ $petRegistration->species }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-4 bg-white border-2 border-green-200 shadow-sm rounded-xl">
                            <div class="flex items-center justify-center w-10 h-10 mr-3 bg-green-100 rounded-full">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold tracking-wide text-green-600 uppercase">Birthday</p>
                                <p class="text-lg font-bold text-green-800">{{ $petRegistration->birthday ? $petRegistration->birthday->format('M d, Y') : 'Not specified' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-4 bg-white border-2 border-purple-200 shadow-sm rounded-xl">
                            <div class="flex items-center justify-center w-10 h-10 mr-3 bg-purple-100 rounded-full">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold tracking-wide text-purple-600 uppercase">Gender</p>
                                <p class="text-lg font-bold text-purple-800">{{ ucfirst($petRegistration->gender) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pet Details -->
            <div class="lg:col-span-2">
                <div class="p-4 bg-white shadow-lg rounded-2xl">
                    <h2 class="flex items-center mb-4 text-lg font-bold text-gray-900">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Pet Details
                    </h2>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm font-semibold tracking-wide text-blue-600 uppercase">Pet Name</label>
                                <div class="p-4 bg-white border-2 border-blue-200 shadow-sm rounded-xl">
                                    <p class="text-xl font-bold text-blue-800">{{ $petRegistration->pet_name }}</p>
                                </div>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-semibold tracking-wide text-green-600 uppercase">Breed</label>
                                <div class="p-4 bg-white border-2 border-green-200 shadow-sm rounded-xl">
                                    <p class="text-xl font-bold text-green-800">{{ $petRegistration->breed }}</p>
                                </div>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-semibold tracking-wide text-orange-600 uppercase">Color Markings</label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(explode(', ', is_array($petRegistration->color_markings) ? implode(', ', $petRegistration->color_markings) : $petRegistration->color_markings) as $color)
                                        <span class="px-4 py-2 text-sm font-semibold text-orange-800 bg-orange-100 border border-orange-200 rounded-full">{{ $color }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block mb-1 text-sm font-semibold text-gray-600">Description</label>
                                <p class="text-gray-700 bg-gray-50 p-4 rounded-lg min-h-[100px]">
                                    {{ $petRegistration->description ?: 'No description provided' }}
                                </p>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block mb-1 text-sm font-semibold text-gray-600">Submitted</label>
                                    <p class="text-sm text-gray-700">{{ $petRegistration->created_at->format('M d, Y') }}</p>
                                </div>
                                <div>
                                    <label class="block mb-1 text-sm font-semibold text-gray-600">Last Updated</label>
                                    <p class="text-sm text-gray-700">{{ $petRegistration->updated_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($petRegistration->status === 'denied' && $petRegistration->denial_reason)
                        <div class="p-4 mt-6 border border-red-200 bg-red-50 rounded-xl">
                            <div class="flex items-center mb-2">
                                <svg class="w-6 h-6 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <h4 class="font-semibold text-red-700">Reason for Denial</h4>
                            </div>
                            <p class="text-red-800">{{ $petRegistration->denial_reason }}</p>
                        </div>
                    @endif
                </div>

                <!-- Owner Information -->
                <div class="p-4 mt-4 bg-white shadow-lg rounded-2xl">
                    <h2 class="flex items-center mb-4 text-lg font-bold text-gray-900">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Owner Information
                    </h2>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm font-semibold tracking-wide text-purple-600 uppercase">Full Name</label>
                                <div class="p-4 bg-white border-2 border-purple-200 shadow-sm rounded-xl">
                                    <p class="text-xl font-bold text-purple-800">{{ $petRegistration->user->name ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <div>
                                <label class="block mb-1 text-sm font-semibold text-gray-600">Email Address</label>
                                <p class="px-3 py-2 text-gray-900 rounded-lg bg-gray-50">{{ $petRegistration->user->email ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block mb-1 text-sm font-semibold text-gray-600">Contact Number</label>
                                <p class="px-3 py-2 text-gray-900 rounded-lg bg-gray-50">{{ $petRegistration->user->contact_number ?? 'N/A' }}</p>
                            </div>

                            <div>
                                <label class="block mb-1 text-sm font-semibold text-gray-600">Address</label>
                                <p class="p-3 text-sm text-gray-700 rounded-lg bg-gray-50">
                                    {{ ($petRegistration->user->street ?? '') . ', ' . ($petRegistration->user->barangay ?? '') . ', ' . ($petRegistration->user->city_municipality ?? '') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    @if($petRegistration->user->id_photo)
                        <div class="mt-6">
                            <label class="block mb-3 text-sm font-semibold text-gray-600">ID Photo</label>
                            <div onclick="document.getElementById('petShowIdPhotoModal').classList.remove('hidden')"
                                 class="inline-flex items-center p-3 transition-colors duration-200 bg-teal-100 rounded-lg cursor-pointer hover:bg-teal-200">
                                <svg class="w-6 h-6 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

<!-- Pet Photo Modal -->
@if($petRegistration->photo)
<div id="petRegistrationPhotoModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75 p-4" onclick="closePetRegistrationPhotoModal(event)">
    <div class="relative w-full max-w-5xl" onclick="event.stopPropagation()">
        <img src="{{ asset('storage/' . $petRegistration->photo) }}" alt="Full Size Pet Photo" class="w-full h-auto rounded-lg max-h-screen object-contain">

        <!-- Close Button -->
        <button onclick="closePetRegistrationPhotoModal()" class="absolute top-2 right-2 text-white bg-black bg-opacity-50 rounded-full p-2 hover:bg-opacity-75">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
@endif

<!-- ID Photo Modal -->
@if($petRegistration->user->id_photo)
<div id="petShowIdPhotoModal"
     class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 transition-opacity duration-300 bg-black bg-opacity-80"
     onclick="if(event.target.id === 'petShowIdPhotoModal') this.classList.add('hidden')">
    <div class="relative max-w-3xl overflow-hidden bg-white shadow-2xl rounded-2xl">
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

<script>
function openPetRegistrationPhotoModal() {
    document.getElementById('petRegistrationPhotoModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closePetRegistrationPhotoModal(event) {
    if (event && event.target.id !== 'petRegistrationPhotoModal') return;
    document.getElementById('petRegistrationPhotoModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Enhanced keyboard event listener for backspace key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Backspace' || event.key === 'Escape') {
        // Check pet registration photo modal
        const petModal = document.getElementById('petRegistrationPhotoModal');
        if (petModal && !petModal.classList.contains('hidden')) {
            closePetRegistrationPhotoModal();
            event.preventDefault();
            return;
        }

        // Check ID photo modal
        const idModal = document.getElementById('petShowIdPhotoModal');
        if (idModal && !idModal.classList.contains('hidden')) {
            idModal.classList.add('hidden');
            event.preventDefault();
            return;
        }
    }
});

// Close modal when clicking outside the image
if (document.getElementById('petRegistrationPhotoModal')) {
    document.getElementById('petRegistrationPhotoModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closePetRegistrationPhotoModal();
        }
    });
}
</script>

@endsection
