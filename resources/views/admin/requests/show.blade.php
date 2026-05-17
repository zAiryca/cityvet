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
            <a href="javascript:void(0)" onclick="history.back()" class="bg-gray-500 text-white hover:bg-gray-700 px-4 py-2 rounded">
                Back
            </a>
        </div>

        <!-- Main Content Card -->
        <div class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl">
            <!-- Request Header -->
            <div class="px-8 py-6 border-b border-gray-200 bg-gray-50">
                <div class="flex flex-col justify-between md:flex-row md:items-center">
                    <div class="mb-4 md:mb-0">
                        <h2 class="text-xl font-medium text-gray-900">Request #{{ $request->id }}</h2>
                        <p class="mt-1 text-sm text-gray-600">Submitted on {{ $request->created_at ? $request->created_at->format('F j, Y') : 'N/A' }}</p>
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
                    @php
                        $additionalData = null;
                        if ($request->additional_data) {
                            // Ensure proper decoding - additional_data might be array or JSON string
                            if (is_string($request->additional_data)) {
                                $additionalData = json_decode($request->additional_data, true);
                            } else {
                                $additionalData = (array) $request->additional_data;
                            }
                        }
                    @endphp

                <!-- Pet Information Section -->
                @if($request->requestable && $request->requestable_type === 'App\\Models\\Pet')
                <div class="px-8 py-6">
                    <div class="flex items-center mb-4">
                        <div class="flex items-center justify-center w-8 h-8 mr-3 bg-blue-100 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-blue-800">Pet Information</h3>
                    </div>

                    <div class="flex flex-col gap-6 md:flex-row">
                        <!-- Pet Image -->
                        <div class="flex-shrink-0">
                            <div class="w-40 h-32 overflow-hidden border border-gray-200 rounded-lg">
                                <img src="{{ $request->requestable->photo ? asset('storage/' . $request->requestable->photo) : 'https://via.placeholder.com/200x150?text=' . $request->requestable->display_code }}"
                                     alt="{{ $request->requestable->display_code }}"
                                     class="object-cover w-full h-full transition-opacity cursor-pointer hover:opacity-90"
                                     onclick="openAdminRequestPetPhotoModal()">
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

                {{-- Unified Form Fields Display --}}
                @if($additionalData)
                    <div class="px-8 py-6">
                        <div class="space-y-6">
                            {{-- Multi-Column Form Fields --}}
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                                {{-- Column 1: Personal Information --}}
                                <div class="space-y-4">
                                    <h4 class="pb-2 text-sm font-semibold text-gray-800 border-b border-gray-200">Personal Information</h4>

                                    <div>
                                        <span class="block mb-1 text-xs font-medium text-gray-600">Full Name</span>
                                        <span class="block text-sm text-gray-900">{{ ($additionalData['first_name'] ?? '') . ' ' . ($additionalData['middle_name'] ?? '') . ' ' . ($additionalData['last_name'] ?? '') }}</span>
                                    </div>

                                    @if(isset($additionalData['date_of_birth']) && $additionalData['date_of_birth'])
                                    <div>
                                        <span class="block mb-1 text-xs font-medium text-gray-600">Date of Birth</span>
                                        <span class="block text-sm text-gray-900">{{ date('M d, Y', strtotime($additionalData['date_of_birth'])) }}</span>
                                    </div>
                                    @endif

                                    @if(isset($additionalData['email']) && $additionalData['email'])
                                    <div>
                                        <span class="block mb-1 text-xs font-medium text-gray-600">Email Address</span>
                                        <span class="block text-sm text-gray-900">{{ $additionalData['email'] }}</span>
                                    </div>
                                    @endif
                                </div>

                                {{-- Column 2: Contact & Housing --}}
                                <div class="space-y-4">
                                    <h4 class="pb-2 text-sm font-semibold text-gray-800 border-b border-gray-200">Contact & Housing</h4>

                                    @if(isset($additionalData['contact_number']) && $additionalData['contact_number'])
                                    <div>
                                        <span class="block mb-1 text-xs font-medium text-gray-600">Contact Number</span>
                                        <span class="block text-sm text-gray-900">{{ $additionalData['contact_number'] }}</span>
                                    </div>
                                    @endif

                                    @if(isset($additionalData['address']) && $additionalData['address'])
                                    <div>
                                        <span class="block mb-1 text-xs font-medium text-gray-600">Address</span>
                                        <span class="block text-sm text-gray-900">{{ $additionalData['address'] }}</span>
                                    </div>
                                    @endif

                                    {{-- Adoption Housing Fields --}}
                                    @if($request->type === 'adopt')
                                        @if(isset($additionalData['dwelling_type']) && $additionalData['dwelling_type'])
                                        <div>
                                            <span class="block mb-1 text-xs font-medium text-gray-600">Dwelling Type</span>
                                            <span class="block text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $additionalData['dwelling_type'])) }}</span>
                                        </div>
                                        @endif

                                        @if(isset($additionalData['landlord_permission']) && $additionalData['landlord_permission'])
                                        <div>
                                            <span class="block mb-1 text-xs font-medium text-gray-600">Landlord Permission</span>
                                            <span class="block text-sm text-gray-900">{{ ucfirst($additionalData['landlord_permission']) }}</span>
                                        </div>
                                        @endif
                                    @endif
                                </div>

                                {{-- Column 3: Household & Details --}}
                                <div class="space-y-4">
                                    <h4 class="pb-2 text-sm font-semibold text-gray-800 border-b border-gray-200">Household & Details</h4>

                                    {{-- Adoption Household Fields --}}
                                    @if($request->type === 'adopt')
                                        @if(isset($additionalData['adults_count']) && $additionalData['adults_count'])
                                        <div>
                                            <span class="block mb-1 text-xs font-medium text-gray-600">Number of Adults</span>
                                            <span class="block text-sm text-gray-900">{{ $additionalData['adults_count'] }}</span>
                                        </div>
                                        @endif

                                        @if(isset($additionalData['children_count']) && $additionalData['children_count'])
                                        <div>
                                            <span class="block mb-1 text-xs font-medium text-gray-600">Number of Children</span>
                                            <span class="block text-sm text-gray-900">{{ $additionalData['children_count'] }}</span>
                                        </div>
                                        @endif

                                        @if(isset($additionalData['allergies']) && $additionalData['allergies'])
                                        <div>
                                            <span class="block mb-1 text-xs font-medium text-gray-600">Allergies</span>
                                            <span class="block text-sm text-gray-900">{{ ucfirst($additionalData['allergies']) }}</span>
                                        </div>
                                        @endif

                                        @if(isset($additionalData['other_pets']) && $additionalData['other_pets'])
                                        <div>
                                            <span class="block mb-1 text-xs font-medium text-gray-600">Other Pets</span>
                                            <span class="block text-sm text-gray-900">{{ ucfirst($additionalData['other_pets']) }}</span>
                                        </div>
                                        @endif

                                        @if(isset($additionalData['fenced_property']) && $additionalData['fenced_property'])
                                        <div>
                                            <span class="block mb-1 text-xs font-medium text-gray-600">Fenced Property</span>
                                            <span class="block text-sm text-gray-900">{{ ucfirst($additionalData['fenced_property']) }}</span>
                                        </div>
                                        @endif

                                        @if(isset($additionalData['pet_living_area']) && $additionalData['pet_living_area'])
                                        <div>
                                            <span class="block mb-1 text-xs font-medium text-gray-600">Pet Living Area</span>
                                            <span class="block text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $additionalData['pet_living_area'])) }}</span>
                                        </div>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            {{-- Full Width Sections --}}
                            @if($request->type === 'adopt' && isset($additionalData['other_pets_list']) && $additionalData['other_pets_list'])
                            <div>
                                <h4 class="mb-2 text-sm font-semibold text-gray-800">Other Pets Description</h4>
                                <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $additionalData['other_pets_list'] }}</p>
                            </div>
                            @endif

                            {{-- Reason Section --}}
                            @if($request->type === 'adopt')
                            <div>
                                <h4 class="mb-2 text-sm font-semibold text-gray-800">Reason for Adoption</h4>
                                @php
                                    $reasonText = $additionalData['reason'] ?? $request->reason ?? '';
                                @endphp
                                @if($reasonText)
                                <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $reasonText }}</p>
                                @else
                                <p class="text-sm italic text-gray-500">No reason provided</p>
                                @endif
                            </div>
                            @elseif($request->type === 'claim')
                                @if($request->status === 'approved')
                                    {{-- Completed Claim - Show Pet Identification --}}
                                    <div>
                                        <h4 class="mb-3 text-sm font-semibold text-gray-800">Pet Identification</h4>
                                        <div class="p-4 border border-blue-200 rounded-lg bg-blue-50">
                                            <p class="mb-2 text-xs font-medium text-blue-700">Pet Traits (Owner Should Know):</p>
                                            <div class="grid grid-cols-2 gap-3 text-sm">
                                                <div><span class="font-medium text-gray-600">Species:</span> <span class="text-gray-900">{{ $request->requestable->species ?? 'N/A' }}</span></div>
                                                <div><span class="font-medium text-gray-600">Breed:</span> <span class="text-gray-900">{{ $request->requestable->breed ?: 'Unknown' }}</span></div>
                                                <div><span class="font-medium text-gray-600">Color:</span> <span class="text-gray-900">{{ $request->requestable->color_markings ?: 'Not specified' }}</span></div>
                                                <div><span class="font-medium text-gray-600">Gender:</span> <span class="text-gray-900">{{ ucfirst($request->requestable->gender ?? 'unknown') }}</span></div>
                                                @if($request->requestable->estimated_age_years || $request->requestable->estimated_age_months)
                                                <div><span class="font-medium text-gray-600">Age:</span> <span class="text-gray-900">
                                                    {{ $request->requestable->estimated_age_years ? $request->requestable->estimated_age_years . ' years' : '' }}
                                                    {{ $request->requestable->estimated_age_months ? $request->requestable->estimated_age_months . ' months' : '' }}
                                                </span></div>
                                                @endif
                                            </div>
                                            @if($request->requestable->description)
                                            <div class="pt-3 mt-3 border-t border-blue-300">
                                                <p class="mb-1 text-xs font-medium text-blue-700">Pet Description:</p>
                                                <p class="text-sm text-gray-800">{{ $request->requestable->description }}</p>
                                            </div>
                                            @endif
                                        </div>
                                        @if(isset($additionalData['proof_of_ownership_description']) && $additionalData['proof_of_ownership_description'])
                                        <div class="mt-3">
                                            <p class="mb-1 text-xs font-medium text-gray-600">Owner's Proof of Ownership:</p>
                                            <p class="p-3 text-sm text-gray-900 whitespace-pre-wrap rounded bg-gray-50">{{ $additionalData['proof_of_ownership_description'] }}</p>
                                        </div>
                                        @elseif($request->reason)
                                        <div class="mt-3">
                                            <p class="mb-1 text-xs font-medium text-gray-600">Owner's Proof of Ownership:</p>
                                            <p class="p-3 text-sm text-gray-900 whitespace-pre-wrap rounded bg-gray-50">{{ $request->reason }}</p>
                                        </div>
                                        @endif
                                    </div>
                                @else
                                    {{-- Pending/Denied Claim - Show Pet Identification --}}
                                    <div>
                                        <h4 class="mb-2 text-sm font-semibold text-gray-800">Pet Identification</h4>
                                        @if(isset($additionalData['proof_of_ownership_description']) && $additionalData['proof_of_ownership_description'])
                                        <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $additionalData['proof_of_ownership_description'] }}</p>
                                        @elseif($request->reason)
                                        <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $request->reason }}</p>
                                        @endif
                                    </div>
                                @endif
                            @endif

                            {{-- Photos Section --}}
                            @if(isset($additionalData['id_photo_path']) && $additionalData['id_photo_path'] || ($request->photos && is_array($request->photos) && count($request->photos) > 0))
                            <div class="pt-4 border-t border-gray-200">
                                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                    {{-- ID Photo --}}
                                    @if(isset($additionalData['id_photo_path']) && $additionalData['id_photo_path'])
                                    <div>
                                        <h4 class="mb-3 text-sm font-semibold text-gray-800">ID Photo</h4>
                                        <div onclick="document.getElementById('adminRequestIdPhotoModal').classList.remove('hidden')"
                                             class="inline-flex items-center p-2 mt-1 transition-colors duration-200 bg-teal-100 rounded-lg cursor-pointer hover:bg-teal-200">
                                            <svg class="w-4 h-4 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                            </svg>
                                            <span class="text-sm font-medium">View ID Photo</span>
                                        </div>
                                    </div>
                                    @endif

                                    {{-- Supporting Photos --}}
                                    @if($request->photos && is_array($request->photos) && count($request->photos) > 0)
                                    <div>
                                        <h4 class="mb-3 text-sm font-semibold text-gray-800">Supporting Details/Proof</h4>
                                        <div class="grid grid-cols-2 gap-2 sm:grid-cols-3 lg:grid-cols-4">
                                            @foreach($request->photos as $index => $photo)
                                            <div class="overflow-hidden border border-gray-200 rounded-lg">
                                                <img src="{{ asset('storage/' . $photo) }}" alt="Request Photo {{ $index + 1 }}" class="object-cover w-full h-20 cursor-pointer hover:opacity-90" onclick="openImageModal({{ $index }})">
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Action Section -->
            <div class="px-8 py-6 border-t border-gray-200 bg-gray-50">
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

<!-- Admin Request Pet Photo Modal -->
@if($request->requestable && $request->requestable->photo)
<div id="adminRequestPetPhotoModal" class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 bg-black/30 backdrop-blur-sm" onclick="closeAdminRequestPetPhotoModal()">
    <button onclick="closeAdminRequestPetPhotoModal()" class="absolute text-white top-6 right-6 hover:text-gray-100">
        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <img src="{{ asset('storage/' . $request->requestable->photo) }}" alt="Full Size Pet Photo" class="max-w-4xl max-h-[85vh] rounded-lg shadow-2xl">
</div>
@endif

<!-- Image Modal (for supporting photo viewing) -->
<div id="imageModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/30 backdrop-blur-sm" onclick="if(event.target.id === 'imageModal') closeImageModal()">
    <div class="relative flex flex-col items-center justify-center max-w-6xl max-h-[90vh]">
        <button onclick="closeImageModal()" class="absolute text-white top-6 right-6 hover:text-gray-300 z-10">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <button id="adminRequestPrevBtn" type="button" onclick="prevRequestImage()" class="absolute left-4 top-1/2 -translate-y-1/2 p-2 text-white rounded-full bg-black/50 hover:bg-black/70 z-10" aria-label="Previous image">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button id="adminRequestNextBtn" type="button" onclick="nextRequestImage()" class="absolute right-4 top-1/2 -translate-y-1/2 p-2 text-white rounded-full bg-black/50 hover:bg-black/70 z-10" aria-label="Next image">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
        <img id="modalImage" src="" alt="Enlarged view" class="max-w-4xl max-h-[85vh] rounded-lg shadow-2xl object-contain">
        <div class="mt-4 text-center">
            <p id="adminRequestImageCounter" class="text-sm text-white"></p>
            <p id="adminRequestImageCaption" class="mt-1 text-sm text-white"></p>
        </div>
    </div>
</div>

<!-- Admin Request ID Photo Modal -->
@if(isset($additionalData['id_photo_path']) && $additionalData['id_photo_path'])
<div id="adminRequestIdPhotoModal" class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 bg-black/30 backdrop-blur-sm" onclick="if(event.target.id === 'adminRequestIdPhotoModal') this.classList.add('hidden')">
    <button onclick="document.getElementById('adminRequestIdPhotoModal').classList.add('hidden')" class="absolute text-white top-6 right-6 hover:text-gray-100">
        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <img src="{{ asset('storage/' . $additionalData['id_photo_path']) }}" alt="Requester ID Photo" class="max-w-4xl max-h-[85vh] rounded-lg shadow-2xl">
</div>
@endif

<script>
function openAdminRequestPetPhotoModal() {
    document.getElementById('adminRequestPetPhotoModal').classList.remove('hidden');
}

function closeAdminRequestPetPhotoModal() {
    document.getElementById('adminRequestPetPhotoModal').classList.add('hidden');
}

@php
    $requestPhotoSources = [];
    if ($request->photos) {
        if (is_string($request->photos)) {
            $requestPhotoSources = json_decode($request->photos, true) ?? [];
        } elseif (is_array($request->photos)) {
            $requestPhotoSources = $request->photos;
        } else {
            $requestPhotoSources = (array) $request->photos;
        }
    }
@endphp

const adminRequestPhotoSources = [
    @foreach($requestPhotoSources as $idx => $photo)
        { src: "{{ asset('storage/' . $photo) }}", alt: "Request Photo {{ $idx + 1 }}" }@if(!$loop->last),@endif
    @endforeach
];
let currentAdminRequestImageIndex = 0;

function openImageModal(index) {
    if (!adminRequestPhotoSources.length) {
        return;
    }

    currentAdminRequestImageIndex = index;
    updateImageModal();
    document.getElementById('imageModal').classList.remove('hidden');
}

function updateImageModal() {
    const source = adminRequestPhotoSources[currentAdminRequestImageIndex];
    const image = document.getElementById('modalImage');
    image.src = source.src;
    image.alt = source.alt;
    document.getElementById('adminRequestImageCaption').textContent = source.alt;
    document.getElementById('adminRequestImageCounter').textContent = `${currentAdminRequestImageIndex + 1} / ${adminRequestPhotoSources.length}`;
    const showNav = adminRequestPhotoSources.length > 1;
    document.getElementById('adminRequestPrevBtn').style.display = showNav ? 'block' : 'none';
    document.getElementById('adminRequestNextBtn').style.display = showNav ? 'block' : 'none';
}

function nextRequestImage() {
    openImageModal((currentAdminRequestImageIndex + 1) % adminRequestPhotoSources.length);
}

function prevRequestImage() {
    openImageModal((currentAdminRequestImageIndex + adminRequestPhotoSources.length - 1) % adminRequestPhotoSources.length);
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
}

// Enhanced keyboard event listener for backspace and arrow keys
document.addEventListener('keydown', function(event) {
    if (event.key === 'Backspace') {
        const petModal = document.getElementById('adminRequestPetPhotoModal');
        if (petModal && !petModal.classList.contains('hidden')) {
            closeAdminRequestPetPhotoModal();
            return;
        }

        const idModal = document.getElementById('adminRequestIdPhotoModal');
        if (idModal && !idModal.classList.contains('hidden')) {
            idModal.classList.add('hidden');
            return;
        }

        const imageModal = document.getElementById('imageModal');
        if (imageModal && !imageModal.classList.contains('hidden')) {
            closeImageModal();
            return;
        }
    }

    if (event.key === 'ArrowLeft') {
        const imageModal = document.getElementById('imageModal');
        if (imageModal && !imageModal.classList.contains('hidden') && adminRequestPhotoSources.length > 1) {
            prevRequestImage();
            event.preventDefault();
            return;
        }
    }

    if (event.key === 'ArrowRight') {
        const imageModal = document.getElementById('imageModal');
        if (imageModal && !imageModal.classList.contains('hidden') && adminRequestPhotoSources.length > 1) {
            nextRequestImage();
            event.preventDefault();
            return;
        }
    }

    if (event.key === 'Escape') {
        closeImageModal();
        closeAdminRequestPetPhotoModal();
        if (document.getElementById('adminRequestIdPhotoModal')) {
            document.getElementById('adminRequestIdPhotoModal').classList.add('hidden');
        }
    }
});

if (document.getElementById('imageModal')) {
    document.getElementById('imageModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeImageModal();
        }
    });
}

</script>
@endsection
