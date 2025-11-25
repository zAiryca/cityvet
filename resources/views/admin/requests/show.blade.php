@extends('layouts.admin')

@section('title', '| Admin - Request Details')

@section('content')
<div class="min-h-screen py-8 bg-gray-50">
    <div class="max-w-4xl px-6 mx-auto lg:px-8">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-semibold text-gray-900">Request Details</h1>
                <p class="mt-2 text-gray-600">Review and manage adoption/claim request information</p>
            </div>
            <a href="{{ route('admin.requests.index') }}"
               class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Requests
            </a>
        </div>

        <!-- Main Content Card -->
        <div class="overflow-hidden bg-white border border-gray-200 rounded-xl shadow-sm">
            <!-- Request Header -->
            <div class="px-8 py-6 border-b border-gray-200 bg-gray-50">
                <div class="flex flex-col justify-between md:flex-row md:items-center">
                    <div class="mb-4 md:mb-0">
                        <h2 class="text-xl font-medium text-gray-900">Request #{{ $request->id }}</h2>
                        <p class="mt-1 text-sm text-gray-600">Submitted on {{ $request->created_at->format('F j, Y') }}</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full
                            {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                               ($request->status === 'approved' ? 'bg-green-100 text-green-800' :
                               'bg-red-100 text-red-800') }}">
                            {{ ucfirst($request->status) }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-700 bg-blue-100 rounded-full">
                            {{ ucfirst($request->type) }} Request
                        </span>
                    </div>
                </div>
            </div>

            <!-- Request Information Sections -->
            <div class="divide-y divide-gray-200">
                <!-- Pet Information Section -->
                @if($request->requestable && $request->requestable_type === 'App\\Models\\Pet')
                <div class="px-8 py-6">
                    <div class="flex items-center mb-4">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900">Pet Information</h3>
                    </div>

                    <div class="flex flex-col gap-6 md:flex-row">
                        <!-- Pet Image -->
                        <div class="flex-shrink-0">
                            <div class="w-40 h-32 overflow-hidden border border-gray-200 rounded-lg">
                                <img src="{{ $request->requestable->photo ? asset('storage/' . $request->requestable->photo) : 'https://via.placeholder.com/200x150?text=' . $request->requestable->display_code }}"
                                     alt="{{ $request->requestable->display_code }}"
                                     class="object-cover w-full h-full">
                            </div>
                        </div>

                        <!-- Pet Details -->
                        <div class="flex-1">
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Pet ID</p>
                                        <p class="text-sm text-gray-900">{{ $request->requestable->display_code }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Species</p>
                                        <p class="text-sm text-gray-900">{{ $request->requestable->species }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Breed</p>
                                        <p class="text-sm text-gray-900">{{ $request->requestable->breed ?: 'Unknown' }}</p>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Gender</p>
                                        <p class="text-sm text-gray-900">{{ ucfirst($request->requestable->gender) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Age</p>
                                        <p class="text-sm text-gray-900">
                                            @if($request->requestable->estimated_age_years || $request->requestable->estimated_age_months)
                                                {{ $request->requestable->estimated_age_years ? $request->requestable->estimated_age_years . ' years' : '' }}
                                                {{ $request->requestable->estimated_age_months ? $request->requestable->estimated_age_months . ' months' : '' }}
                                            @else
                                                Unknown
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Color Markings</p>
                                        <p class="text-sm text-gray-900">{{ $request->requestable->color_markings ?: 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Requester Information Section -->
                @if($request->additional_data)
                @php
                    $additionalData = is_array($request->additional_data) ? $request->additional_data : json_decode($request->additional_data, true);
                @endphp
                <div class="px-8 py-6">
                    <div class="flex items-center mb-4">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ $request->type === 'adopt' ? 'Adopter' : ($request->type === 'claim' ? 'Claimant' : 'Requester') }} Information
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Full Name</p>
                                <p class="text-sm text-gray-900">{{ $additionalData['first_name'] ?? '' }} {{ $additionalData['last_name'] ?? '' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Email Address</p>
                                <p class="text-sm text-gray-900">{{ $additionalData['email'] ?? '' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Phone Number</p>
                                <p class="text-sm text-gray-900">{{ $additionalData['contact_number'] ?? '' }}</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Address</p>
                                <p class="text-sm text-gray-900">{{ $additionalData['address'] ?? '' }}</p>
                            </div>
                            @if($request->type === 'adopt')
                            <div>
                                <p class="text-sm font-medium text-gray-500">Home Type</p>
                                <p class="text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $additionalData['dwelling_type'] ?? '')) }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Other Pets</p>
                                <p class="text-sm text-gray-900">{{ ucfirst($additionalData['other_pets'] ?? '') }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- ID Photo Section -->
                @if($additionalData && isset($additionalData['id_photo_path']) && $additionalData['id_photo_path'])
                <div class="px-8 py-6">
                    <div class="flex items-center mb-4">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.75 4h2.5a2 2 0 011.664.89l.812 1.22a2 2 0 001.664.89H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900">ID Photo</h3>
                    </div>

                    <div class="flex flex-col items-center space-y-4">
                        <div onclick="document.getElementById('adminRequestIdPhotoModal').classList.remove('hidden')"
                             class="cursor-pointer transform transition duration-200 hover:scale-105">
                            <img src="{{ asset('storage/' . $additionalData['id_photo_path']) }}"
                                 alt="ID Photo"
                                 class="object-cover w-48 h-64 border-2 border-gray-300 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                        </div>
                        <p class="text-sm text-gray-600">Click to view full size</p>
                    </div>

                    <!-- Modal for Full Size ID Photo -->
                    <div id="adminRequestIdPhotoModal" class="fixed inset-0 z-50 items-center justify-center hidden p-4 transition-opacity duration-300 bg-black bg-opacity-80" onclick="if(event.target.id === 'adminRequestIdPhotoModal') this.classList.add('hidden')">
                        <div class="relative max-w-3xl overflow-hidden bg-white rounded-lg shadow-2xl">
                            <div class="sticky top-0 z-10 flex items-center justify-between p-3 bg-white border-b border-gray-200">
                                <h3 class="text-xl font-semibold text-gray-800">Applicant ID Photo</h3>
                                <button onclick="document.getElementById('adminRequestIdPhotoModal').classList.add('hidden')" class="p-2 text-gray-500 transition duration-150 rounded-full hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div class="p-6 max-h-[80vh] overflow-y-auto">
                                <img src="{{ asset('storage/' . $additionalData['id_photo_path']) }}" alt="Full Size ID Photo" class="w-full h-auto rounded-lg shadow-md">
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Request Details Section -->
                <div class="px-8 py-6">
                    <div class="flex items-center mb-4">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900">Request Details</h3>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Reason for Request</p>
                            <p class="mt-1 text-sm text-gray-900 leading-relaxed">{{ $request->reason }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Contact Information</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $request->contact_info }}</p>
                        </div>
                    </div>
                </div>

                <!-- Uploaded Photos Section -->
                @if($request->photos)
                @php
                    $photos = is_array($request->photos) ? $request->photos : json_decode($request->photos, true);
                @endphp
                @if(is_array($photos) && count($photos) > 0)
                <div class="px-8 py-6">
                    <div class="flex items-center mb-4">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900">Supporting Details/Proof</h3>
                    </div>

                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                        @foreach($photos as $index => $photo)
                        <div class="overflow-hidden border border-gray-200 rounded-lg">
                            <img src="{{ asset('storage/' . $photo) }}"
                                 alt="Request Photo {{ $index + 1 }}"
                                 class="object-cover w-full h-32 cursor-pointer hover:opacity-90"
                                 onclick="openImageModal('{{ asset('storage/' . $photo) }}')">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                @endif
            </div>

            <!-- Action Section -->
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-200">
                <!-- Success Message -->
                @if(session('success'))
                <div class="px-4 py-3 mb-6 text-sm text-green-700 bg-green-100 border border-green-200 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div class="text-sm text-gray-600">
                        @if($request->status === 'pending')
                            <p>This request is awaiting your decision</p>
                        @else
                            <p>Request has been {{ $request->status }}</p>
                        @endif
                    </div>

                    <div class="flex flex-wrap gap-3">
                        @if($request->status === 'pending')
                        <form action="{{ route('admin.requests.approve', $request) }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="redirect_to_pet" value="1">
                            <button type="submit"
                                    class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white transition-colors duration-200 bg-green-600 border border-transparent rounded-lg shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Approve Request
                            </button>
                        </form>
                        <form action="{{ route('admin.requests.deny', $request) }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="redirect_to_pet" value="1">
                            <button type="submit"
                                    onclick="return confirm('Are you sure you want to deny this request? This action cannot be undone.');"
                                    class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white transition-colors duration-200 bg-red-600 border border-transparent rounded-lg shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Deny Request
                            </button>
                        </form>
                        @else
                        <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 border border-gray-300 rounded-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Request {{ ucfirst($request->status) }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal (for photo viewing) -->
<div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white hover:text-gray-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <img id="modalImage" src="" alt="Enlarged view" class="max-w-full max-h-screen rounded-lg">
        </div>
    </div>
</div>

<script>
function openImageModal(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal on escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeImageModal();
    }
});

// Close modal when clicking outside the image
document.getElementById('imageModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeImageModal();
    }
});
</script>
@endsection
