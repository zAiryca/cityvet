@extends('layouts.admin')

@section('title', '| Pet Registration Details')

@section('content')
<div>
    <div class="max-w-6xl px-4 py-4 mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                <div class="p-3 mr-4 bg-white rounded-full shadow-sm">
                    <img src="{{ asset('https://i.ibb.co/8DPN5B7m/logo.png') }}" alt="FindFurEver Logo" class="object-contain w-12 h-12">
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Registration Review</h1>
                    <p class="mt-1 text-gray-600">Manage {{ $pet_registration->pet_name }}'s application</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.pet-registrations.index') }}"
                   class="px-5 py-2.5 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                    ← Back to Registrations
                </a>
            </div>
        </div>

        <!-- Status Banner -->
        <div class="p-6 mb-6 bg-white shadow-lg rounded-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="text-sm">
                        <span class="text-gray-600">Application Status:</span>
                        @if($pet_registration->status === 'pending')
                            <span class="px-4 py-2 ml-2 text-sm font-medium text-yellow-800 bg-yellow-100 border border-yellow-200 rounded-full">
                                <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Pending Review
                            </span>
                        @elseif($pet_registration->status === 'registered')
                            <span class="px-4 py-2 ml-2 text-sm font-medium text-green-800 bg-green-100 border border-green-200 rounded-full">
                                <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Registered
                            </span>
                        @elseif($pet_registration->status === 'denied')
                            <span class="px-4 py-2 ml-2 text-sm font-medium text-red-800 bg-red-100 border border-red-200 rounded-full">
                                <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Denied
                            </span>
                        @endif
                    </div>
                </div>
                <div class="text-sm text-gray-500">
                    Submitted: {{ $pet_registration->created_at->format('M d, Y') }}
                </div>
            </div>

            @if($pet_registration->status === 'denied' && $pet_registration->denial_reason)
                <div class="p-4 mt-4 border border-red-200 bg-red-50 rounded-xl">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                        <h4 class="font-semibold text-red-700">Reason for Denial</h4>
                    </div>
                    <p class="text-red-800">{{ $pet_registration->denial_reason }}</p>
                </div>
            @endif
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Pet Information -->
            <div class="space-y-6 lg:col-span-2">
                <!-- Pet Details Card -->
                <div class="p-6 bg-white shadow-lg rounded-2xl">
                    <h2 class="flex items-center mb-6 text-xl font-bold text-gray-900">
                        <svg class="w-6 h-6 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="#2563eb" d="M234.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5 .3-86.2 32.6-96.8 70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3-14.3-70.1 10.2-84.1 59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5l0 1.6c0 25.8-20.9 46.7-46.7 46.7-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2-25.8 0-46.7-20.9-46.7-46.7l0-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3 29.1 51.7 10.2 84.1-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5 46.9 53.9 32.6 96.8-52.1 69.1-84.4 58.5z"/>
                        </svg>
                        Pet Information
                    </h2>

                    @if($pet_registration->photo)
                        <div class="mb-6 flex justify-center">
                            <img src="{{ asset('storage/' . $pet_registration->photo) }}"
                                 alt="{{ $pet_registration->pet_name }}"
                                 class="object-cover w-64 h-64 transition-all duration-300 shadow-lg cursor-pointer rounded-xl hover:shadow-xl hover:opacity-90"
                                 onclick="openAdminPetRegPhotoModal()"
                                 style="cursor: pointer;">
                        </div>
                    @endif

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm font-semibold tracking-wide text-blue-600 uppercase">Pet Name</label>
                                <div class="p-4 bg-white border-2 border-blue-200 shadow-sm rounded-xl">
                                    <p class="text-xl font-bold text-blue-800">{{ $pet_registration->pet_name }}</p>
                                </div>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-semibold tracking-wide text-green-600 uppercase">Species & Breed</label>
                                <div class="p-4 bg-white border-2 border-green-200 shadow-sm rounded-xl">
                                    <p class="text-xl font-bold text-green-800">{{ $pet_registration->species }} - {{ $pet_registration->breed }}</p>
                                </div>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-semibold tracking-wide text-orange-600 uppercase">Birthday</label>
                                <div class="p-4 bg-white border-2 border-orange-200 shadow-sm rounded-xl">
                                    <p class="text-xl font-bold text-orange-800">{{ $pet_registration->birthday ? $pet_registration->birthday->format('M d, Y') : 'Not specified' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm font-semibold tracking-wide text-purple-600 uppercase">Gender</label>
                                <div class="p-4 bg-white border-2 border-purple-200 shadow-sm rounded-xl">
                                    <p class="text-xl font-bold text-purple-800">{{ ucfirst($pet_registration->gender) }}</p>
                                </div>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-semibold tracking-wide text-orange-600 uppercase">Color Markings</label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(explode(', ', is_array($pet_registration->color_markings) ? implode(', ', $pet_registration->color_markings) : $pet_registration->color_markings) as $color)
                                        <span class="px-4 py-2 text-sm font-semibold text-orange-800 bg-orange-100 border border-orange-200 rounded-full">{{ $color }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block mb-1 text-sm font-semibold text-gray-600">Description</label>
                        <p class="text-gray-700 bg-gray-50 p-4 rounded-lg min-h-[80px]">
                            {{ $pet_registration->description ?: 'No description provided' }}
                        </p>
                    </div>
                </div>

                <!-- Owner Information Card -->
                <div class="p-6 bg-white shadow-lg rounded-2xl">
                    <h2 class="flex items-center mb-6 text-xl font-bold text-gray-900">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Owner Information
                    </h2>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm font-semibold tracking-wide text-purple-600 uppercase">Full Name</label>
                                <div class="p-4 bg-white border-2 border-purple-200 shadow-sm rounded-xl">
                                    <p class="text-xl font-bold text-purple-800">{{ $pet_registration->user->name ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <div>
                                <label class="block mb-1 text-sm font-semibold text-gray-600">Email Address</label>
                                <p class="px-3 py-2 text-gray-900 rounded-lg bg-gray-50">{{ $pet_registration->user->email ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block mb-1 text-sm font-semibold text-gray-600">Contact Number</label>
                                <p class="px-3 py-2 text-gray-900 rounded-lg bg-gray-50">{{ $pet_registration->user->contact_number ?? 'N/A' }}</p>
                            </div>

                            <div>
                                <label class="block mb-1 text-sm font-semibold text-gray-600">Address</label>
                                <p class="p-3 text-sm text-gray-700 rounded-lg bg-gray-50">
                                    {{ ($pet_registration->user->street ?? '') . ', ' . ($pet_registration->user->barangay ?? '') . ', ' . ($pet_registration->user->city_municipality ?? '') }}
                                </p>
                            </div>

                            @if($pet_registration->user->id_photo)
                                <div class="mt-4">
                                    <label class="block mb-3 text-sm font-semibold text-gray-600">ID Photo</label>
                                    <div onclick="document.getElementById('petRegShowIdPhotoModal').classList.remove('hidden')"
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

            <!-- Actions Sidebar -->
            <div class="space-y-6">
                <!-- Admin Actions -->
                <div class="p-6 bg-white shadow-lg rounded-2xl">
                    <h2 class="flex items-center mb-6 text-xl font-bold text-gray-900">
                        <svg class="w-6 h-6 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Admin Actions
                    </h2>

                    <div class="space-y-4">
                        @if($pet_registration->status === 'pending')
                            <form method="POST" action="{{ route('admin.pet-registrations.approve', $pet_registration) }}" class="block">
                                @csrf
                                <button type="submit"
                                        class="flex items-center justify-center w-full px-4 py-3 font-medium text-white transition-all duration-200 bg-green-600 shadow-sm rounded-xl hover:bg-green-700"
                                        onclick="return confirm('Are you sure you want to register this pet?')">
                                    <svg class="inline w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Register Pet
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.pet-registrations.deny', $pet_registration) }}" class="block">
                                @csrf
                                <div class="mb-3">
                                    <label for="denial_reason" class="block mb-2 text-sm font-medium text-gray-700">Reason for denial (optional)</label>
                                    <textarea name="denial_reason" id="denial_reason" rows="3"
                                              class="w-full p-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                              placeholder="Explain why this registration is being denied..."></textarea>
                                </div>
                                <button type="submit"
                                        class="flex items-center justify-center w-full px-4 py-3 font-medium text-white transition-all duration-200 bg-orange-600 shadow-sm rounded-xl hover:bg-orange-700"
                                        onclick="return confirm('Are you sure you want to deny this pet registration?')">
                                    <svg class="inline w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Deny Registration
                                </button>
                            </form>
                        @endif

                        <form method="POST" action="{{ route('admin.pet-registrations.destroy', $pet_registration) }}" class="block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="flex items-center justify-center w-full px-4 py-3 font-medium text-white transition-all duration-200 bg-red-600 shadow-sm rounded-xl hover:bg-red-700"
                                    onclick="return confirm('Are you sure you want to delete this registration?')">
                                <svg class="inline w-5 h-5 mr-2 text-red-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete Registration
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="p-6 bg-white shadow-lg rounded-2xl">
                    <h2 class="flex items-center mb-6 text-xl font-bold text-gray-900">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Timeline
                    </h2>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 rounded-lg bg-blue-50">
                            <span class="text-sm font-medium text-gray-700">Submitted</span>
                            <span class="text-sm text-gray-600">{{ $pet_registration->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg bg-green-50">
                            <span class="text-sm font-medium text-gray-700">Last Updated</span>
                            <span class="text-sm text-gray-600">{{ $pet_registration->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pet Photo Modal -->
@if($pet_registration->photo)
<div id="adminPetRegPhotoModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75 p-4" onclick="closeAdminPetRegPhotoModal(event)">
    <div class="relative w-full max-w-5xl" onclick="event.stopPropagation()">
        <img src="{{ asset('storage/' . $pet_registration->photo) }}" alt="Full Size Pet Photo" class="w-full h-auto rounded-lg max-h-screen object-contain">

        <!-- Close Button -->
        <button onclick="closeAdminPetRegPhotoModal()" class="absolute top-2 right-2 text-white bg-black bg-opacity-50 rounded-full p-2 hover:bg-opacity-75">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
@endif

<!-- ID Photo Modal -->
@if($pet_registration->user->id_photo)
<div id="petRegShowIdPhotoModal"
     class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 transition-opacity duration-300 bg-black bg-opacity-80"
     onclick="if(event.target.id === 'petRegShowIdPhotoModal') this.classList.add('hidden')">
    <div class="relative max-w-3xl overflow-hidden bg-white shadow-2xl rounded-2xl">
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

<script>
function openAdminPetRegPhotoModal() {
    document.getElementById('adminPetRegPhotoModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeAdminPetRegPhotoModal(event) {
    if (event && event.target.id !== 'adminPetRegPhotoModal') return;
    document.getElementById('adminPetRegPhotoModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Enhanced keyboard event listener for backspace key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Backspace' || event.key === 'Escape') {
        // Check admin pet registration photo modal
        const petModal = document.getElementById('adminPetRegPhotoModal');
        if (petModal && !petModal.classList.contains('hidden')) {
            closeAdminPetRegPhotoModal();
            event.preventDefault();
            return;
        }

        // Check ID photo modal
        const idModal = document.getElementById('petRegShowIdPhotoModal');
        if (idModal && !idModal.classList.contains('hidden')) {
            idModal.classList.add('hidden');
            event.preventDefault();
            return;
        }
    }
});

// Close modal when clicking outside the image
if (document.getElementById('adminPetRegPhotoModal')) {
    document.getElementById('adminPetRegPhotoModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeAdminPetRegPhotoModal();
        }
    });
}
</script>

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
