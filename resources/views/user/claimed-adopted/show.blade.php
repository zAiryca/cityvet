@extends('layouts.app')

@section('title', '| Pet Details')

@section('content')
<div class="py-10 pt-24 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="flex items-center justify-between pb-4 mb-8 border-b border-gray-200">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">
            {{ ucfirst($pet->status) }} Pet Details
        </h1>
        <a href="javascript:void(0)" onclick="history.back()" class="bg-gray-600 text-white hover:bg-gray-800 px-4 py-2 rounded">
            Back
        </a>
    </div>

    <!-- Header with Pet ID and Status -->
    <div class="mb-8 overflow-hidden bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-indigo-600">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $pet->display_code }}</h1>
                    <p class="mt-1 text-blue-100">{{ ucfirst($pet->status) }} Pet Details</p>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold
                        @if($pet->status === 'adopted') bg-green-200 text-green-900
                        @elseif($pet->status === 'claimed') bg-blue-200 text-blue-900
                        @else bg-gray-200 text-gray-900 @endif">
                        {{ ucfirst(str_replace('_', ' ', $pet->status)) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Pet Photo Modal -->
    @if($pet->photo)
    <div id="petPhotoModal" class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 bg-black/30 backdrop-blur-sm" onclick="if(event.target.id === 'petPhotoModal') closePetPhotoModal()">
        <button onclick="closePetPhotoModal()" class="absolute text-white top-6 right-6 hover:text-white">
            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <img src="{{ asset('storage/' . $pet->photo) }}" alt="Full Size Pet Photo" class="max-w-4xl max-h-[85vh] rounded-lg shadow-2xl">
    </div>
    @endif

    <!-- Supporting Photo Modal -->
    <div id="supportingPhotoModal" class="fixed inset-0 z-50 hidden p-4 bg-black/30 backdrop-blur-sm" onclick="if(event.target.id === 'supportingPhotoModal') closeSupportingPhotoModal()">
        <div class="flex items-center justify-center min-h-screen">
            <div class="relative max-w-4xl max-h-full">
                <button onclick="closeSupportingPhotoModal()" class="absolute text-white top-4 right-4 hover:text-white">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <button id="supportingPrevBtn" type="button" onclick="prevSupportingPhoto()" class="absolute left-0 top-1/2 -translate-y-1/2 px-4 py-3 text-white rounded-r-lg bg-black/30 hover:bg-black/50" aria-label="Previous image">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="supportingNextBtn" type="button" onclick="nextSupportingPhoto()" class="absolute right-0 top-1/2 -translate-y-1/2 px-4 py-3 text-white rounded-l-lg bg-black/30 hover:bg-black/50" aria-label="Next image">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <img id="supportingPhotoImg" src="" alt="Supporting Photo" class="max-w-full max-h-screen rounded-lg shadow-2xl">
                <div class="mt-4 text-center">
                    <p id="supportingPhotoCounter" class="text-sm text-white"></p>
                    <p id="supportingPhotoCaption" class="mt-1 text-sm text-white"></p>
                </div>
            </div>
        </div>
    </div>


    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

        <!-- Left Column: Main Content -->
        <div class="space-y-6 lg:col-span-2">

            <!-- Pet Information Card -->
            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-xl font-bold text-gray-900">
                        <svg class="inline w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Pet Information
                    </h2>
                </div>
                <div class="px-6 py-6">
                    <div class="flex gap-8 mb-6">
                        {{-- Photo Section --}}
                        <div class="flex-shrink-0">
                            @if($pet->photo)
                                <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="object-cover w-64 h-64 transition-opacity border-4 border-gray-200 rounded-lg shadow-md cursor-pointer hover:opacity-90" onclick="openPetPhotoModal()">
                            @else
                                <div class="flex items-center justify-center w-64 h-64 bg-gray-100 border-4 border-gray-200 rounded-lg">
                                    <div class="text-center">
                                        <span class="text-7xl font-bold text-gray-300">{{ substr($pet->display_code, 0, 1) }}</span>
                                        <p class="text-xs text-gray-400 mt-2">No Photo</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        {{-- Details Section (2 Columns) --}}
                        <div class="flex-1">
                            <div class="grid grid-cols-2 gap-x-8 gap-y-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Species</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $pet->species }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Breed</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $pet->breed }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Gender</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ ucfirst($pet->gender) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Estimated Age</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $pet->estimated_age }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Color Markings</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $pet->color_markings ?: 'Not specified' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Current Status</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ ucfirst($pet->status) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($pet->description)
                        <div class="p-4 mt-6 rounded-lg bg-gray-50">
                            <p class="text-sm font-medium text-gray-600">Description</p>
                            <p class="mt-2 text-gray-900">{{ $pet->description }}</p>
                        </div>
                    @endif
                </div>
            </div>



            <!-- Combined 2-Column Layout: Reason/Pet Identification and Supporting Details -->
            @if($request->additional_data || $request->photos)
                @php
                    // Process additional_data safely
                    if (is_string($request->additional_data)) {
                        $additionalData = json_decode($request->additional_data, true) ?? [];
                    } elseif (is_array($request->additional_data)) {
                        $additionalData = $request->additional_data;
                    } else {
                        $additionalData = (array) $request->additional_data;
                    }
                @endphp

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <!-- Reason for Adoption / Pet Identification Section -->
                    <div class="overflow-hidden bg-white border border-gray-100 shadow-lg rounded-xl">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h2 class="text-xl font-bold text-gray-900">
                                <svg class="inline w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                @if($pet->status === 'adopted')
                                    Reason for Adoption
                                @else
                                    Pet Identification
                                @endif
                            </h2>
                        </div>
                        <div class="p-6">
                            <dd class="text-gray-700">
                                @if($pet->status === 'adopted')
                                    {{ $additionalData['reason'] ?? $request->reason ?? 'N/A' }}
                                @else
                                    {{ $additionalData['proof_of_ownership_description'] ?? $request->reason ?? 'N/A' }}
                                @endif
                            </dd>
                        </div>
                    </div>

                    <!-- Supporting Details/Proof Section -->
                    @if($request->photos)
                        @php
                            $photos = is_array($request->photos) ? $request->photos : json_decode($request->photos, true);
                        @endphp
                        @if(is_array($photos) && count($photos) > 0)
                            <div class="overflow-hidden bg-white border border-gray-100 shadow-lg rounded-xl">
                                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                    <h2 class="text-xl font-bold text-gray-900">
                                        <svg class="inline w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Supporting Details/Proof
                                    </h2>
                                </div>
                                <div class="p-6">
                                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3">
                                        @foreach($photos as $index => $photo)
                                            <div class="relative block overflow-hidden transition duration-300 rounded-lg shadow-md cursor-pointer group hover:shadow-xl" onclick="openSupportingPhotoModal({{ $index }})">
                                                <img src="{{ asset('storage/' . $photo) }}" alt="Supporting Photo" class="object-cover w-full h-24 transition duration-500 group-hover:scale-105">
                                                <div class="absolute inset-0 flex items-center justify-center transition duration-300 bg-black opacity-0 bg-opacity-30 group-hover:opacity-100">
                                                    <span class="text-white text-xs font-semibold p-1.5 bg-black bg-opacity-60 rounded">View</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            @endif

            <!-- Admin Feedback Section -->
            @if($request->admin_notes)
                <div class="overflow-hidden bg-white border border-gray-100 shadow-lg rounded-xl">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="flex items-center text-xl font-semibold text-gray-900">
                            <svg class="w-6 h-6 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10m-9 4h6m-9-4L7 4m0 0h6m-6 0h6"></path></svg>
                            Shelter/Admin Feedback
                        </h2>
                    </div>
                    <div class="p-6">
                        <p class="text-sm italic text-gray-700 whitespace-pre-wrap">{{ $request->admin_notes }}</p>
                    </div>
                </div>
            @endif
        </div>

            <!-- Right Column: Details & Info Cards -->
            <div class="space-y-6">

                <!-- Timeline Card -->
                <div class="p-5 bg-white shadow-sm rounded-xl">
                    <h3 class="pb-2 mb-4 text-lg font-semibold text-gray-900 border-b">Timeline</h3>
                    <div class="space-y-3">
                        @if($pet->impounded_date)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Impounded</span>
                                <span class="font-medium">{{ $pet->impounded_date->format('M d, Y') }}</span>
                            </div>
                        @endif
                        @if($pet->decision_date && !($pet->impounded_date && $pet->status === 'claimed'))
                            <div class="flex justify-between">
                                <span class="text-gray-600">Available</span>
                                <span class="font-medium">{{ $pet->decision_date->format('M d, Y') }}</span>
                            </div>
                        @endif
                        @if($pet->status === 'claimed')
                            <div class="flex justify-between">
                                <span class="text-gray-600">Claimed</span>
                                <span class="font-medium">{{ $latestClaim ? $latestClaim->updated_at->format('M d, Y') : $pet->updated_at->format('M d, Y') }}</span>
                            </div>
                        @elseif($pet->status === 'adopted')
                            <div class="flex justify-between">
                                <span class="text-gray-600">Adopted</span>
                                <span class="font-medium">{{ $latestAdopt ? $latestAdopt->updated_at->format('M d, Y') : $pet->updated_at->format('M d, Y') }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between">
                            <span class="text-gray-600">Updated</span>
                            <span class="font-medium">{{ $pet->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Owner Information Card -->
                @if($owner && is_object($owner))
                    @php
                        $completedRequest = $pet->requests->where('status', 'completed')
                            ->when($owner, function ($col) use ($owner) { return $col->where('user_id', $owner->id); })
                            ->sortByDesc('updated_at')
                            ->first();

                        $displayOwner = [
                            'full_name' => $owner->name,
                            'email' => $owner->email,
                            'contact_number' => $owner->contact_number ?? 'N/A',
                            'address' => trim(($owner->street ?? '') . ' ' . ($owner->barangay ?? '') . ' ' . ($owner->city_municipality ?? '')),
                        ];

                        if(in_array($pet->status, ['claimed','adopted']) && $completedRequest) {
                            $ad = is_array($completedRequest->additional_data) ? $completedRequest->additional_data : json_decode($completedRequest->additional_data, true);
                            if(!empty($ad) && is_array($ad)) {
                                $displayOwner = array_merge($displayOwner, array_filter([
                                    'full_name' => trim(($ad['first_name'] ?? '') . ' ' . ($ad['last_name'] ?? '')) ?: $owner->name,
                                    'email' => $ad['email'] ?? $owner->email,
                                    'contact_number' => $ad['contact_number'] ?? $owner->contact_number ?? 'N/A',
                                    'address' => trim(($ad['address'] ?? '') . ' ' . ($ad['barangay'] ?? '') . ' ' . ($ad['city_municipality'] ?? '')) ?: $displayOwner['address'],
                                ]));
                            }
                        }
                    @endphp

                    <div class="p-5 bg-white shadow-sm rounded-xl">
                        <h3 class="pb-2 mb-4 text-lg font-semibold text-gray-900 border-b">Owner Information</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-600">Name</p>
                                <p class="font-medium">{{ $displayOwner['full_name'] }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Email</p>
                                <p class="font-medium">{{ $displayOwner['email'] }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Phone</p>
                                <p class="font-medium">{{ $displayOwner['contact_number'] }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Address</p>
                                <p class="font-medium">{{ $displayOwner['address'] ?: 'Not provided' }}</p>
                            </div>
                            @if($completedRequest && isset($completedRequest->additional_data['id_photo_path']) && $completedRequest->additional_data['id_photo_path'])
                                <div>
                                    <p class="text-sm text-gray-600">ID Photo</p>
                                    <div onclick="document.getElementById('ownerIdPhotoModal').classList.remove('hidden')"
                                         class="inline-flex items-center p-2 mt-1 transition-colors duration-200 bg-teal-100 rounded-lg cursor-pointer hover:bg-teal-200">
                                        <svg class="w-4 h-4 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                        </svg>
                                        <span class="text-sm font-medium">View ID Photo</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Owner ID Photo Modal -->
                    @if($completedRequest && isset($completedRequest->additional_data['id_photo_path']) && $completedRequest->additional_data['id_photo_path'])
                    <div id="ownerIdPhotoModal"
                         class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 transition-opacity duration-300 bg-black bg-opacity-80"
                         onclick="if(event.target.id === 'ownerIdPhotoModal') this.classList.add('hidden')">
                        <div class="relative max-w-3xl overflow-hidden bg-white shadow-2xl rounded-2xl">
                            <div class="sticky top-0 z-10 flex items-center justify-between p-4 bg-white border-b border-gray-200">
                                <h3 class="text-xl font-semibold text-gray-800">Owner ID Photo</h3>
                                <button onclick="document.getElementById('ownerIdPhotoModal').classList.add('hidden')"
                                        class="p-2 text-gray-500 transition duration-150 rounded-full hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div class="p-6 max-h-[80vh] overflow-y-auto">
                                <img src="{{ asset('storage/' . $completedRequest->additional_data['id_photo_path']) }}"
                                     alt="Owner ID Photo"
                                     class="w-full h-auto rounded-lg shadow-md">
                            </div>
                        </div>
                    </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

<script>
@php
    $supportingPhotos = [];
    if (isset($completedRequest) && $completedRequest->photos) {
        if (is_string($completedRequest->photos)) {
            $supportingPhotos = json_decode($completedRequest->photos, true) ?? [];
        } elseif (is_array($completedRequest->photos)) {
            $supportingPhotos = $completedRequest->photos;
        } else {
            $supportingPhotos = (array) $completedRequest->photos;
        }
    }
@endphp

const supportingPhotoSources = [
    @foreach($supportingPhotos as $idx => $photo)
        { src: "{{ asset('storage/' . $photo) }}", alt: "Supporting Photo {{ $idx + 1 }}" }@if(!$loop->last),@endif
    @endforeach
];
let currentSupportingPhotoIndex = 0;

function openPetPhotoModal() {
    document.getElementById('petPhotoModal').classList.remove('hidden');
}

function closePetPhotoModal() {
    document.getElementById('petPhotoModal').classList.add('hidden');
}

function openSupportingPhotoModal(index) {
    if (!supportingPhotoSources.length) {
        return;
    }

    currentSupportingPhotoIndex = index;
    updateSupportingPhotoModal();
    document.getElementById('supportingPhotoModal').classList.remove('hidden');
}

function updateSupportingPhotoModal() {
    const source = supportingPhotoSources[currentSupportingPhotoIndex];
    const image = document.getElementById('supportingPhotoImg');
    image.src = source.src;
    image.alt = source.alt;
    document.getElementById('supportingPhotoCaption').textContent = source.alt;
    document.getElementById('supportingPhotoCounter').textContent = `${currentSupportingPhotoIndex + 1} / ${supportingPhotoSources.length}`;
    const showNav = supportingPhotoSources.length > 1;
    document.getElementById('supportingPrevBtn').style.display = showNav ? 'block' : 'none';
    document.getElementById('supportingNextBtn').style.display = showNav ? 'block' : 'none';
}

function nextSupportingPhoto() {
    openSupportingPhotoModal((currentSupportingPhotoIndex + 1) % supportingPhotoSources.length);
}

function prevSupportingPhoto() {
    openSupportingPhotoModal((currentSupportingPhotoIndex + supportingPhotoSources.length - 1) % supportingPhotoSources.length);
}

function closeSupportingPhotoModal() {
    document.getElementById('supportingPhotoModal').classList.add('hidden');
}

function closeOwnerIdPhotoModal() {
    document.getElementById('ownerIdPhotoModal').classList.add('hidden');
}

// Add keyboard event listener for backspace and arrow keys
document.addEventListener('keydown', function(event) {
    if (event.key === 'Backspace') {
        const petModal = document.getElementById('petPhotoModal');
        if (petModal && !petModal.classList.contains('hidden')) {
            closePetPhotoModal();
            return;
        }

        const supportingModal = document.getElementById('supportingPhotoModal');
        if (supportingModal && !supportingModal.classList.contains('hidden')) {
            closeSupportingPhotoModal();
            return;
        }

        const ownerIdModal = document.getElementById('ownerIdPhotoModal');
        if (ownerIdModal && !ownerIdModal.classList.contains('hidden')) {
            closeOwnerIdPhotoModal();
            return;
        }
    }

    if (event.key === 'ArrowLeft') {
        const supportingModal = document.getElementById('supportingPhotoModal');
        if (supportingModal && !supportingModal.classList.contains('hidden') && supportingPhotoSources.length > 1) {
            prevSupportingPhoto();
            event.preventDefault();
            return;
        }
    }

    if (event.key === 'ArrowRight') {
        const supportingModal = document.getElementById('supportingPhotoModal');
        if (supportingModal && !supportingModal.classList.contains('hidden') && supportingPhotoSources.length > 1) {
            nextSupportingPhoto();
            event.preventDefault();
            return;
        }
    }

    if (event.key === 'Escape') {
        if (document.getElementById('supportingPhotoModal') && !document.getElementById('supportingPhotoModal').classList.contains('hidden')) {
            closeSupportingPhotoModal();
        }
        if (document.getElementById('petPhotoModal') && !document.getElementById('petPhotoModal').classList.contains('hidden')) {
            closePetPhotoModal();
        }
        if (document.getElementById('ownerIdPhotoModal') && !document.getElementById('ownerIdPhotoModal').classList.contains('hidden')) {
            closeOwnerIdPhotoModal();
        }
    }
});
</script>
@endsection
