@extends('layouts.app')

@section('title', '| Request Details')

@section('content')
<div class="py-10 pt-24 mx-auto max-w-7xl sm:px-6 lg:px-8">

    <div class="flex items-center justify-between pb-4 mb-8 border-b border-gray-200">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">
            {{ ucfirst($request->type) }} Request Details
        </h1>
        <a href="{{ route('user.requests') }}" class="bg-gray-600 text-white hover:bg-gray-800 px-4 py-2 rounded">
            Back
        </a>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

        <div class="space-y-6 lg:col-span-1">

            <div class="overflow-hidden bg-white border border-gray-100 shadow-lg rounded-xl">
                <div class="p-6">
                    <h2 class="flex items-center mb-4 text-xl font-semibold text-gray-900">
                        <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.001 12.001 0 0012 21a12.001 12.001 0 008.618-3.04z"></path></svg>
                        Request Status
                    </h2>

                    <dl class="space-y-3">
                        @php
                            $petId = $request->requestable && isset($request->requestable->display_code) ? $request->requestable->display_code : 'N/A';
                        @endphp
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Pet ID</dt>
                            <dd class="mt-1 text-gray-900">{{ $petId }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Type</dt>
                            <dd class="mt-1 text-gray-900">{{ ucfirst($request->type) }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1">
                                <span class="px-3 py-1 text-sm font-bold rounded-full @if($request->status === 'pending') bg-yellow-100 text-yellow-800 @elseif($request->status === 'approved') bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">{{ ucfirst($request->status) }}</span>
                            </dd>
                        </div>
                        @if($request->status === 'denied' && $request->denial_reason)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Denial Reason</dt>
                            <dd class="mt-1 text-sm italic text-gray-700">{{ $request->denial_reason }}</dd>
                        </div>
                        @endif
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Date</dt>
                            <dd class="mt-1 text-gray-900">{{ $request->created_at->format('M d, Y h:i A') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            @if($request->status === 'pending')
            <div class="p-6 border border-red-200 shadow-md bg-red-50 rounded-xl">
                <h3 class="mb-3 text-lg font-semibold text-red-800">Manage Request</h3>
                <form action="{{ route('user.requests.destroy', $request) }}" method="POST" onsubmit="return confirm('WARNING: Are you sure you want to cancel this request? This action cannot be reversed.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Cancel Request
                    </button>
                </form>
            </div>
            @endif

            @if($request->admin_notes)
            <div class="p-6 border-l-4 border-indigo-500 shadow-lg bg-indigo-50 rounded-xl">
                <h3 class="flex items-center mb-2 text-lg font-semibold text-indigo-800">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10m-9 4h6m-9-4L7 4m0 0h6m-6 0h6"></path></svg>
                    Shelter/Admin Feedback
                </h3>
                <p class="text-sm italic text-indigo-700 whitespace-pre-wrap">{{ $request->admin_notes }}</p>
            </div>
            @endif

        </div>

        <div class="space-y-8 lg:col-span-2">

            @if($request->requestable)
                @php
                    $item = $request->requestable;
                    $item_type = $request->requestable_type;
                @endphp
                @php
                    // Use the model-provided display code (now PET####)
                    $displayCode = $item->display_code ?? null;
                @endphp
                <div class="{{ $request->type === 'claim' ? 'p-8 sm:p-10' : 'p-6 sm:p-8' }} overflow-hidden bg-white border border-gray-100 shadow-lg rounded-xl">
                    <h2 class="pb-3 mb-6 text-2xl font-bold text-gray-900 border-b">
                        @if($item_type === 'App\\Models\\Pet')
                            Associated Pet
                        @elseif($item_type === 'App\\Models\\Event')
                            Associated Event
                        @endif
                    </h2>

                    @if($item_type === 'App\\Models\\Pet')
                        <div class="flex flex-col space-y-6">
                            <div class="flex items-start space-x-6">
                                <div class="flex-shrink-0">
                                    @if(isset($item->photo) && $item->photo)
                                        <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $displayCode ?? $item->name }}" class="object-cover w-64 h-64 rounded-lg shadow-md cursor-pointer hover:opacity-90" onclick="openPetPhotoModal()">
                                    @else
                                        <div class="flex items-center justify-center w-64 h-64 text-gray-500 bg-gray-100 rounded-lg">No Photo</div>
                                    @endif
                                </div>
                                <div class="grid flex-1 min-w-0 grid-cols-2 text-sm text-gray-700 gap-x-6 gap-y-3">
                                    <p><strong class="block text-gray-500">ID Code:</strong> {{ $displayCode ?? 'N/A' }}</p>
                                    <p><strong class="block text-gray-500">Species:</strong> {{ ($item->species ?? '-') }} </p>
                                    <p><strong class="block text-gray-500">Breed:</strong> {{ ($item->breed ?? '-') }}</p>
                                    <p><strong class="block text-gray-500">Estimated Age:</strong> {{ ($item->age ?? 'N/A') }}</p>
                                    <p><strong class="block text-gray-500">Color:</strong> {{ ($item->color ?? 'N/A') }}</p>
                                    <p><strong class="block text-gray-500">Status:</strong> {{ ucfirst($item->status ?? 'N/A') }}</p>

                                    @if($item->description)
                                        <div class="col-span-2 w-full p-4 rounded-lg bg-gray-50">
                                            <p class="text-sm font-medium text-gray-600">Description</p>
                                            <p class="mt-2 text-gray-900">{{ $item->description }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if($item->medical_notes)
                                <div class="p-4 border border-blue-200 rounded-lg bg-blue-50">
                                    <p><strong class="block mb-1 text-gray-700">Medical Information:</strong></p>
                                    <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $item->medical_notes }}</p>
                                </div>
                            @endif
                        </div>
                    @elseif($item_type === 'App\\Models\\Event')
                        <dl class="grid grid-cols-1 text-sm text-gray-700 md:grid-cols-2 gap-x-6 gap-y-4">
                            <div>
                                <dt class="font-medium text-gray-500">Event Title</dt>
                                <dd class="mt-1 text-gray-900">{{ $item->title }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500">Event Date</dt>
                                <dd class="mt-1 text-gray-900">{{ $item->event_date->format('F j, Y') }}</dd>
                            </div>
                        </dl>
                    @endif
                </div>
            @endif

            @if($request->photos || $request->additional_data)
                @php
                    // Process additional_data safely at the top
                    if (is_string($request->additional_data)) {
                        $additionalData = json_decode($request->additional_data, true) ?? [];
                    } elseif (is_array($request->additional_data)) {
                        $additionalData = $request->additional_data;
                    } else {
                        $additionalData = (array) $request->additional_data;
                    }
                @endphp
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <!-- Reason/Proof Section -->
                    <div class="p-4 overflow-hidden bg-white border border-gray-100 shadow-lg rounded-xl">
                        <h2 class="pb-2 mb-3 text-lg font-semibold text-gray-900 border-b">
                            @if($request->type === 'adopt')
                                Reason for Adoption
                            @else
                                Pet Identification
                            @endif
                        </h2>
                        <dd class="p-3 text-gray-700 rounded-lg bg-gray-50">
                            @if($request->type === 'adopt')
                                {{ $additionalData['reason'] ?? $request->reason ?? 'N/A' }}
                            @else
                                {{ $additionalData['proof_of_ownership_description'] ?? $request->reason ?? 'N/A' }}
                            @endif
                        </dd>
                    </div>

                    <!-- Supporting Details/Proof Section -->
                    @if($request->photos)
                        @php
                            // Process photos safely
                            if (is_string($request->photos)) {
                                $photos = json_decode($request->photos, true) ?? [];
                            } elseif (is_array($request->photos)) {
                                $photos = $request->photos;
                            } else {
                                $photos = (array) $request->photos;
                            }
                        @endphp
                        @if(is_array($photos) && count($photos) > 0)
                            <div class="p-4 overflow-hidden bg-white border border-gray-100 shadow-lg rounded-xl">
                                <h2 class="pb-2 mb-3 text-lg font-semibold text-gray-900 border-b">
                                    Supporting Details/Proof
                                </h2>
                                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                                    @foreach($photos as $index => $photo)
                                        <div class="overflow-hidden border border-gray-200 rounded-lg">
                                            <img src="{{ asset('storage/' . $photo) }}" alt="Request Photo {{ $index + 1 }}" class="object-cover w-full h-16 cursor-pointer hover:opacity-90" onclick="openUserRequestImageModal({{ $index }})">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif
                </div>



                <div class="p-6 overflow-hidden bg-white border border-gray-100 shadow-lg rounded-xl sm:p-8">
                    <h2 class="pb-3 mb-6 text-2xl font-bold text-gray-900 border-b">
                        {{ $request->type === 'adopt' ? 'Adoption Application Details' : 'Claimant Information' }}
                    </h2>

                    <dl class="grid grid-cols-1 text-sm text-gray-700 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4">

                        <div>
                            <dt class="font-medium text-gray-500">Full Name</dt>
                            <dd class="mt-1 text-gray-900">{{ $additionalData['first_name'] ?? '' }} {{ $additionalData['middle_name'] ?? '' }} {{ $additionalData['last_name'] ?? '' }}</dd>
                        </div>
                        <div>
                            <dt class="font-medium text-gray-500">Contact Number</dt>
                            <dd class="mt-1 text-gray-900">{{ $additionalData['contact_number'] ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="font-medium text-gray-500">Email</dt>
                            <dd class="mt-1 text-gray-900">{{ $additionalData['email'] ?? 'N/A' }}</dd>
                        </div>
                        <div class="col-span-full">
                            <dt class="font-medium text-gray-500">Address</dt>
                            <dd class="mt-1 text-gray-900">{{ $additionalData['address'] ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="font-medium text-gray-500">Birthday</dt>
                            <dd class="mt-1 text-gray-900">
                                @if(!empty($additionalData['date_of_birth']))
                                    {{ date('M d, Y', strtotime($additionalData['date_of_birth'])) }}
                                @else
                                    N/A
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="font-medium text-gray-500">ID Photo</dt>
                            <dd class="mt-1">
                                @if($additionalData && isset($additionalData['id_photo_path']) && $additionalData['id_photo_path'])
                                    <div onclick="document.getElementById('userRequestIdPhotoModal').classList.remove('hidden')"
                                         class="inline-flex items-center p-2 transition-colors duration-200 bg-teal-100 rounded-lg cursor-pointer hover:bg-teal-200">
                                        <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                        </svg>
                                        <span class="text-sm font-medium">View ID Photo</span>
                                    </div>
                                @else
                                    <span class="text-gray-500">Not provided</span>
                                @endif
                            </dd>
                        </div>

                        @if($request->type === 'adopt')
                            <h4 class="pt-4 mt-4 text-lg font-semibold text-gray-700 border-t col-span-full">Household & Pet History</h4>


                            <div>
                                <dt class="font-medium text-gray-500">Dwelling Type</dt>
                                <dd class="mt-1 text-gray-900">{{ ucfirst(str_replace('_', ' ', $additionalData['dwelling_type'] ?? 'N/A')) }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500">Fenced Property</dt>
                                <dd class="mt-1 text-gray-900">{{ ucfirst($additionalData['fenced_property'] ?? 'N/A') }}</dd>
                            </div>
                            @if(isset($additionalData['landlord_permission']))
                                <div>
                                    <dt class="font-medium text-gray-500">Landlord Permission</dt>
                                    <dd class="mt-1 text-gray-900">{{ ucfirst($additionalData['landlord_permission']) }}</dd>
                                </div>
                            @endif
                            <div>
                                <dt class="font-medium text-gray-500">Adults in Home</dt>
                                <dd class="mt-1 text-gray-900">{{ $additionalData['adults_count'] ?? 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500">Children in Home</dt>
                                <dd class="mt-1 text-gray-900">{{ $additionalData['children_count'] ?? 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500">Allergies</dt>
                                <dd class="mt-1 text-gray-900">{{ ucfirst($additionalData['allergies'] ?? 'N/A') }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500">Other Pets</dt>
                                <dd class="mt-1 text-gray-900">{{ ucfirst($additionalData['other_pets'] ?? 'N/A') }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500">Pet Living Area</dt>
                                <dd class="mt-1 text-gray-900">{{ ucfirst($additionalData['pet_living_area'] ?? 'N/A') }}</dd>
                            </div>
                            @if(isset($additionalData['other_pets_list']))
                                <div class="col-span-full">
                                    <dt class="font-medium text-gray-500">Other Pets List/Details</dt>
                                    <dd class="p-3 mt-1 text-gray-900 whitespace-pre-wrap rounded-lg bg-gray-50">{{ $additionalData['other_pets_list'] }}</dd>
                                </div>
                            @endif
                        @endif
                    </dl>
                </div>
            @endif


        </div>
    </div>
</div>

<!-- Pet Photo Modal -->
@if($request->requestable && $request->requestable_type === 'App\\Models\\Pet' && $request->requestable->photo)
<div id="petPhotoModal" class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 bg-black/30 backdrop-blur-sm" onclick="closePetPhotoModal()">
    <button onclick="closePetPhotoModal()" class="absolute text-gray-100 top-6 right-6 hover:text-white">
        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <img src="{{ asset('storage/' . $request->requestable->photo) }}" alt="Full Size Pet Photo" class="max-w-4xl max-h-[85vh] rounded-lg shadow-2xl">
</div>
@endif

<!-- ID Photo Modal -->
@if($request->additional_data && isset($request->additional_data['id_photo_path']) && $request->additional_data['id_photo_path'])
<div id="userRequestIdPhotoModal"
     class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 transition-opacity duration-300 bg-black/50 backdrop-blur-sm"
     onclick="if(event.target.id === 'userRequestIdPhotoModal') this.classList.add('hidden')">
    <div class="relative max-w-3xl overflow-hidden bg-white shadow-2xl rounded-2xl">
        <div class="sticky top-0 z-10 flex items-center justify-between p-4 bg-white border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-800">Owner ID Photo</h3>
            <button onclick="document.getElementById('userRequestIdPhotoModal').classList.add('hidden')"
                    class="p-2 text-gray-500 transition duration-150 rounded-full hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6 max-h-[80vh] overflow-y-auto">
            <img src="{{ asset('storage/' . $request->additional_data['id_photo_path']) }}"
                 alt="Full Size ID Photo"
                 class="w-full h-auto rounded-lg shadow-md">
        </div>
    </div>
</div>
@endif

<!-- Image Modal (for supporting photo viewing) -->
<div id="userRequestImageModal" class="fixed inset-0 z-50 hidden p-4 bg-black/30 backdrop-blur-sm" onclick="if(event.target.id === 'userRequestImageModal') closeUserRequestImageModal()">
    <div class="flex items-center justify-center min-h-screen">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeUserRequestImageModal()" class="absolute text-gray-100 top-4 right-4 hover:text-white">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <button id="userRequestPrevBtn" type="button" onclick="prevUserRequestImage()" class="absolute left-0 top-1/2 -translate-y-1/2 px-4 py-3 text-white rounded-r-lg bg-black/30 hover:bg-black/50" aria-label="Previous image">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="userRequestNextBtn" type="button" onclick="nextUserRequestImage()" class="absolute right-0 top-1/2 -translate-y-1/2 px-4 py-3 text-white rounded-l-lg bg-black/30 hover:bg-black/50" aria-label="Next image">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            <img id="userRequestModalImage" src="" alt="Enlarged view" class="max-w-full max-h-screen rounded-lg shadow-2xl">
            <div class="mt-4 text-center">
                <p id="userRequestImageCounter" class="text-sm text-white"></p>
                <p id="userRequestImageCaption" class="mt-1 text-sm text-white"></p>
            </div>
        </div>
    </div>
</div>

<script>
@php
    $modalPhotos = [];
    if ($request->photos) {
        if (is_string($request->photos)) {
            $modalPhotos = json_decode($request->photos, true) ?? [];
        } elseif (is_array($request->photos)) {
            $modalPhotos = $request->photos;
        } else {
            $modalPhotos = (array) $request->photos;
        }
    }
@endphp

const userRequestPhotoSources = [
    @foreach($modalPhotos as $idx => $photo)
        { src: "{{ asset('storage/' . $photo) }}", alt: "Request Photo {{ $idx + 1 }}" }@if(!$loop->last),@endif
    @endforeach
];
let currentUserRequestImageIndex = 0;

function openPetPhotoModal() {
    document.getElementById('petPhotoModal').classList.remove('hidden');
}

function closePetPhotoModal() {
    document.getElementById('petPhotoModal').classList.add('hidden');
}

function openUserRequestImageModal(index) {
    if (!userRequestPhotoSources.length) {
        return;
    }

    currentUserRequestImageIndex = index;
    updateUserRequestImageModal();
    document.getElementById('userRequestImageModal').classList.remove('hidden');
}

function updateUserRequestImageModal() {
    const source = userRequestPhotoSources[currentUserRequestImageIndex];
    const image = document.getElementById('userRequestModalImage');
    image.src = source.src;
    image.alt = source.alt;
    document.getElementById('userRequestImageCaption').textContent = source.alt;
    document.getElementById('userRequestImageCounter').textContent = `${currentUserRequestImageIndex + 1} / ${userRequestPhotoSources.length}`;
    const showNav = userRequestPhotoSources.length > 1;
    document.getElementById('userRequestPrevBtn').style.display = showNav ? 'block' : 'none';
    document.getElementById('userRequestNextBtn').style.display = showNav ? 'block' : 'none';
}

function nextUserRequestImage() {
    openUserRequestImageModal((currentUserRequestImageIndex + 1) % userRequestPhotoSources.length);
}

function prevUserRequestImage() {
    openUserRequestImageModal((currentUserRequestImageIndex + userRequestPhotoSources.length - 1) % userRequestPhotoSources.length);
}

function closeUserRequestImageModal() {
    document.getElementById('userRequestImageModal').classList.add('hidden');
}

// Enhanced keyboard event listener for backspace and arrow keys
document.addEventListener('keydown', function(event) {
    if (event.key === 'Backspace') {
        const petModal = document.getElementById('petPhotoModal');
        if (petModal && !petModal.classList.contains('hidden')) {
            closePetPhotoModal();
            return;
        }

        const idModal = document.getElementById('userRequestIdPhotoModal');
        if (idModal && !idModal.classList.contains('hidden')) {
            idModal.classList.add('hidden');
            return;
        }

        const imageModal = document.getElementById('userRequestImageModal');
        if (imageModal && !imageModal.classList.contains('hidden')) {
            closeUserRequestImageModal();
            return;
        }
    }

    if (event.key === 'ArrowLeft') {
        const imageModal = document.getElementById('userRequestImageModal');
        if (imageModal && !imageModal.classList.contains('hidden') && userRequestPhotoSources.length > 1) {
            prevUserRequestImage();
            event.preventDefault();
            return;
        }
    }

    if (event.key === 'ArrowRight') {
        const imageModal = document.getElementById('userRequestImageModal');
        if (imageModal && !imageModal.classList.contains('hidden') && userRequestPhotoSources.length > 1) {
            nextUserRequestImage();
            event.preventDefault();
            return;
        }
    }

    if (event.key === 'Escape') {
        closePetPhotoModal();
        closeUserRequestImageModal();
        if (document.getElementById('userRequestIdPhotoModal')) {
            document.getElementById('userRequestIdPhotoModal').classList.add('hidden');
        }
    }
});

if (document.getElementById('petPhotoModal')) {
    document.getElementById('petPhotoModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closePetPhotoModal();
        }
    });
}

if (document.getElementById('userRequestImageModal')) {
    document.getElementById('userRequestImageModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeUserRequestImageModal();
        }
    });
}
</script>
@endsection
