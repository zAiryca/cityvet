@extends('layouts.admin')

@section('title', '| Admin - Pet Details & Request Workflow')

@section('content')
<div class="min-h-screen py-8 bg-gray-50">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Header with Pet Info -->
        <div class="mb-8 overflow-hidden bg-white rounded-lg shadow-md">
            <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-indigo-600">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white">{{ $pet->display_code }}</h1>
                        <p class="mt-1 text-blue-100">Pet Details & Request Workflow</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold
                            @if($pet->status === 'impounded') bg-red-200 text-red-900
                            @elseif($pet->status === 'adoptable') bg-green-200 text-green-900
                            @elseif($pet->status === 'claimed') bg-blue-200 text-blue-900
                            @elseif($pet->status === 'adopted') bg-purple-200 text-purple-900
                            @else bg-gray-200 text-gray-900 @endif">
                            @if(in_array($pet->status, ['impounded', 'adoptable', 'claimed', 'adopted']))
                                {{ ucfirst(str_replace('_', ' ', $pet->status)) }}
                            @else
                                Unclaimed/Unadopted
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <!-- Main Content Area -->
            <div class="space-y-8 lg:col-span-2">
                <!-- Pet Details Card -->
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
                                    <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="object-cover w-64 h-64 transition-opacity border-4 border-gray-200 rounded-lg shadow-md cursor-pointer hover:opacity-90" onclick="openAdminPetPhotoModal()">
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
                                        <p class="text-lg font-semibold text-gray-900">{{ str_replace(',', ', ', $pet->color_markings) ?: 'Not specified' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">Current Owner</p>
                                        <p class="text-lg font-semibold text-gray-900">
                                            @if($pet->user)
                                                {{ $pet->user->name }}
                                            @else
                                                <span class="text-red-600">Unassigned</span>
                                            @endif
                                        </p>
                                    </div>
                                    @if($pet->caught_location)
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Caught Location</p>
                                            <p class="text-lg font-semibold text-gray-900">{{ $pet->caught_location }}</p>
                                        </div>
                                    @endif
                                    @if($pet->description)
                                        <div class="col-span-2">
                                            <p class="text-sm font-medium text-gray-600" style="font-weight: bold;">Description</p>
                                            <p class="mt-1 text-gray-900" style="background-color: #f3f4f6; color: #000000; padding: 8px 12px; border-radius: 6px;">{{ $pet->description }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Adoption meta visible for all adoptable pets (including those converted from impounded) --}}
                        @if($pet->status === 'adoptable')
                            @php
                                    $adoptionReasonLabels = [
                                        'surrendered_by_owner' => 'Surrendered by Owner',
                                        'remained_unclaimed' => 'Remained Unclaimed',
                                        'found_by_citizen' => 'Found by Citizen',
                                    ];
                                    $returnReasonLabels = [
                                        'owner_relocation' => 'Owner Relocation/Moving',
                                        'owner_illness_death' => 'Owner Illness/Death',
                                        'financial_hardship' => 'Financial Hardship',
                                        'housing_restriction' => 'Housing Restriction',
                                        'lifestyle_change' => 'Lifestyle Change',
                                        'incompatibility_pets' => 'Incompatibility with Pets',
                                        'incompatibility_children' => 'Incompatibility with Children',
                                        'allergies' => 'Allergies',
                                        'space_exercise' => 'Lack of Space/Exercise',
                                        'behavioral_issues' => 'Behavioral Issues',
                                        'other' => 'Other',
                                    ];

                                    if ($pet->mostRecentReturn && $pet->mostRecentReturn->return_date) {
                                        $reason = $returnReasonLabels[$pet->mostRecentReturn->return_reason] ?? ucfirst(str_replace('_', ' ', $pet->mostRecentReturn->return_reason));
                                        $notes = $pet->mostRecentReturn->return_notes;
                                        $isReturned = true;
                                    } else {
                                        if (!empty($pet->adoption_reason_other)) {
                                            $reason = $pet->adoption_reason_other;
                                        } else {
                                            $reason = $pet->adoption_reason ? ($adoptionReasonLabels[$pet->adoption_reason] ?? ucfirst(str_replace('_', ' ', $pet->adoption_reason))) : 'Remained Unclaimed';
                                        }
                                        $notes = $pet->adoption_notes;
                                        $isReturned = false;
                                    }
                            @endphp

                            <div class="p-4 mt-6 rounded-lg {{ $isReturned ? 'bg-orange-50' : 'bg-green-50' }}">
                                <p class="text-sm font-medium {{ $isReturned ? 'text-orange-700' : 'text-green-700' }}">{{ $isReturned ? 'Return Information' : 'Adoption Information' }}</p>
                                <p class="mt-2"><strong>{{ $isReturned ? 'Return' : 'Adoption' }} Reason:</strong> {{ $reason }}</p>
                                @if($notes)
                                    <p class="mt-2"><strong>{{ $isReturned ? 'Return' : 'Adoption' }} Notes:</strong> {{ $notes }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Completed Request Details (for adopted/claimed pets) -->
                @if(in_array($pet->status, ['claimed','adopted']))
                    @php
                        $completedRequests = $pet->requests->where('status', 'completed');

                        // If pet was returned, filter to only show requests after the return date
                        if ($pet->mostRecentReturn && $pet->mostRecentReturn->return_date) {
                            $completedRequests = $completedRequests->filter(function($request) use ($pet) {
                                return $request->created_at >= $pet->mostRecentReturn->return_date;
                            });
                        }

                        $completedRequest = $completedRequests->sortByDesc('updated_at')->first();
                    @endphp
                    @if($completedRequest)
                        <div class="overflow-hidden bg-white rounded-lg shadow-md">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h2 class="text-xl font-bold text-gray-900">
                                    <svg class="inline w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Completed Request Details
                                </h2>
                            </div>
                            <div class="px-6 py-6">
                                @php
                                    $additionalData = is_array($completedRequest->additional_data) ? $completedRequest->additional_data : json_decode($completedRequest->additional_data, true);
                                @endphp

                                {{-- Request Header --}}
                                <div class="p-4 mb-6 rounded-lg bg-gray-50">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <span class="inline-flex items-center px-3 py-1 text-sm font-bold text-white bg-green-500 rounded-full">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                COMPLETED
                                            </span>
                                            <span class="ml-3 text-sm text-gray-600">
                                                {{ $completedRequest->type === 'claim' ? 'Claim Request' : 'Adoption Request' }} - {{ $completedRequest->user->name }}
                                            </span>
                                        </div>
                                        <div class="text-sm text-gray-500">Completed {{ $completedRequest->updated_at->format('M d, Y h:i A') }}</div>
                                    </div>
                                </div>

                                {{-- Submitted Form Fields --}}
                                @if($additionalData)
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
                                                @if($completedRequest->type === 'adopt')
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
                                                @if($completedRequest->type === 'adopt')
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
                                        @if($completedRequest->type === 'adopt' && isset($additionalData['other_pets_list']) && $additionalData['other_pets_list'])
                                        <div>
                                            <h4 class="mb-2 text-sm font-semibold text-gray-800">Other Pets Description</h4>
                                            <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $additionalData['other_pets_list'] }}</p>
                                        </div>
                                        @endif

                                        {{-- Reason Section --}}
                                        @if($completedRequest->type === 'adopt' && isset($additionalData['reason']) && $additionalData['reason'])
                                        <div>
                                            <h4 class="mb-2 text-sm font-semibold text-gray-800">Reason for Adoption</h4>
                                            <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $additionalData['reason'] }}</p>
                                        </div>
                                        @endif

                                        {{-- Proof of Ownership Section - For both claims and adoptions --}}
                                        <div>
                                            <h4 class="mb-2 text-sm font-semibold text-gray-800">{{ $completedRequest->type === 'claim' ? 'Pet Identification' : 'Reason for Adoption' }}</h4>
                                            @if($completedRequest->type === 'claim')
                                                @if(isset($additionalData['proof_of_ownership_description']) && $additionalData['proof_of_ownership_description'])
                                                <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $additionalData['proof_of_ownership_description'] }}</p>
                                                @elseif($completedRequest->reason)
                                                <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $completedRequest->reason }}</p>
                                                @endif
                                            @elseif($completedRequest->type === 'adopt')
                                                @if(isset($additionalData['proof_of_ownership_description']) && $additionalData['proof_of_ownership_description'])
                                                <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $additionalData['proof_of_ownership_description'] }}</p>
                                                @elseif($completedRequest->reason)
                                                <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $completedRequest->reason }}</p>
                                                @else
                                                <p class="text-sm italic text-gray-500">No proof of ownership provided</p>
                                                @endif
                                            @endif
                                        </div>

                                        {{-- Photos Section --}}
                                        @if(isset($additionalData['id_photo_path']) && $additionalData['id_photo_path'] || ($completedRequest->photos && is_array($completedRequest->photos) && count($completedRequest->photos) > 0))
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
                                                        <span class="text-sm font-medium">View Owner ID Photo</span>
                                                    </div>
                                                </div>
                                                @endif

                                                {{-- Supporting Photos --}}
                                                @if($completedRequest->photos && is_array($completedRequest->photos) && count($completedRequest->photos) > 0)
                                                <div>
                                                    <h4 class="mb-3 text-sm font-semibold text-gray-800">Supporting Details/Proof</h4>
                                                    <div class="grid grid-cols-2 gap-2 sm:grid-cols-3 lg:grid-cols-4">
                                                        @foreach($completedRequest->photos as $index => $photo)
                                                        <div class="overflow-hidden border border-gray-200 rounded-lg">
                                                            <img src="{{ asset('storage/' . $photo) }}" alt="Request Photo {{ $index + 1 }}" class="object-cover w-full h-20 cursor-pointer hover:opacity-90" onclick="openRequestPhotoModal({{ $index }})">
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                @endif




                            </div>
                        </div>
                    @endif
                @endif

                <!-- Requests Timeline Card -->
                @if(!in_array($pet->status, ['claimed','adopted']))
                <div class="overflow-hidden bg-white rounded-lg shadow-md">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-xl font-bold text-gray-900">
                            <svg class="inline w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Claim/Adoption Requests
                        </h2>
                    </div>
                    <div class="px-6 py-6">
                        @php
                            $allRequests = $pet->requests()->get();

                            // If pet was returned, filter to only show requests after the return date
                            if ($pet->mostRecentReturn && $pet->mostRecentReturn->return_date) {
                                $allRequests = $allRequests->filter(function($request) use ($pet) {
                                    return $request->created_at >= $pet->mostRecentReturn->return_date;
                                });
                            }

                            $pendingRequests = $allRequests->where('status', 'pending');
                            $approvedRequests = $allRequests->where('status', 'approved');
                            $deniedRequests = $allRequests->where('status', 'denied');
                        @endphp

                        @if($allRequests->isEmpty())
                            <div class="p-4 border border-yellow-200 rounded-lg bg-yellow-50">
                                <p class="text-yellow-800">
                                    <svg class="inline w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    No requests yet for this pet.
                                </p>
                            </div>
                        @else
                            <!-- Approved Requests Section (list all if any) -->
                            @if($approvedRequests->count() > 0)
                                <div class="mb-6 space-y-4">
                                    @foreach($approvedRequests as $approvedRequest)
                                        <div class="p-6 border-2 border-green-500 rounded-lg bg-green-50">
                                            <div class="flex items-center justify-between mb-4">
                                                <div class="flex items-center">
                                                    <span class="inline-flex items-center px-3 py-1 text-sm font-bold text-white bg-green-500 rounded-full">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                        APPROVED
                                                    </span>
                                                    <span class="ml-3 text-sm text-gray-600">
                                                        {{ $approvedRequest->type === 'claim' ? 'Claim Request' : 'Adoption Request' }} - {{ $approvedRequest->user->name }}
                                                    </span>
                                                </div>
                                                <div class="text-sm text-gray-500">Submitted {{ $approvedRequest->updated_at->diffForHumans() }}</div>
                                            </div>

                                            @php
                                                $additionalData = is_array($approvedRequest->additional_data) ? $approvedRequest->additional_data : json_decode($approvedRequest->additional_data, true);
                                            @endphp

                                            {{-- Action buttons for approved request --}}
                                            <div class="flex gap-2 mb-4">
                                                @if($approvedRequest->type === 'claim')
                                                    <form method="POST" action="{{ route('admin.requests.finalize', $approvedRequest) }}" class="inline">
                                                        @csrf
                                                        <button type="submit" class="px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700" onclick="return confirm('Mark pet as CLAIMED?')">
                                                            <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                            </svg>
                                                            Mark as Claimed
                                                        </button>
                                                    </form>
                                                @elseif($approvedRequest->type === 'adopt')
                                                    <form method="POST" action="{{ route('admin.requests.finalize', $approvedRequest) }}" class="inline">
                                                        @csrf
                                                        <button type="submit" class="px-3 py-1 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-700" onclick="return confirm('Mark pet as ADOPTED?')">
                                                            <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                                            </svg>
                                                            Mark as Adopted
                                                        </button>
                                                    </form>
                                                @endif
                                                <a href="{{ route('admin.requests.show', $approvedRequest) }}" class="px-3 py-1 text-sm font-medium text-indigo-600 hover:text-indigo-900">
                                                    View Details
                                                </a>
                                            </div>

                                            <div class="grid grid-cols-2 gap-4 mb-4">
                                                <div>
                                                    <p class="text-xs font-medium text-gray-600">Name</p>
                                                    <p class="font-semibold text-gray-900">
                                                        {{ $additionalData['first_name'] ?? $approvedRequest->user->name }}
                                                        {{ $additionalData['last_name'] ?? '' }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <p class="text-xs font-medium text-gray-600">Email</p>
                                                    <p class="font-semibold text-gray-900">{{ $approvedRequest->user->email }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-xs font-medium text-gray-600">Contact</p>
                                                    <p class="font-semibold text-gray-900">{{ $additionalData['contact_number'] ?? $approvedRequest->contact_info ?? 'N/A' }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-xs font-medium text-gray-600">Address</p>
                                                    <p class="font-semibold text-gray-900">{{ $additionalData['address'] ?? 'N/A' }}</p>
                                                </div>
                                            </div>

                                            @if($approvedRequest->type === 'adopt' && isset($additionalData['dwelling_type']))
                                                <div class="p-3 bg-white border border-green-200 rounded">
                                                    <p class="mb-2 text-xs font-medium text-gray-600">Adoption Details</p>
                                                    <div class="grid grid-cols-2 gap-2 text-sm">
                                                        <div><span class="font-medium">Dwelling:</span> {{ ucfirst(str_replace('_', ' ', $additionalData['dwelling_type'])) }}</div>
                                                        <div><span class="font-medium">Fenced Property:</span> {{ ucfirst($additionalData['fenced_property']) }}</div>
                                                        <div><span class="font-medium">Adults:</span> {{ $additionalData['adults_count'] ?? 'N/A' }}</div>
                                                        <div><span class="font-medium">Children:</span> {{ $additionalData['children_count'] ?? 'N/A' }}</div>
                                                        <div><span class="font-medium">Other Pets:</span> {{ $additionalData['other_pets'] ?? 'N/A' }}</div>
                                                        @if($approvedRequest->reason)
                                                            <div class="col-span-2"><span class="font-medium">Reason:</span> {{ $approvedRequest->reason }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @elseif($approvedRequest->type === 'claim')
                                                @if($approvedRequest->reason)
                                                    <div class="p-3 bg-white border border-green-200 rounded">
                                                        <p class="mb-2 text-xs font-medium text-gray-600">Claim Details</p>
                                                        <p class="text-sm text-gray-900">{{ $approvedRequest->reason }}</p>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Pending Requests -->
                            @if($pendingRequests->count() > 0)
                                <div class="mb-6 overflow-x-auto">
                                    <h3 class="mb-4 text-lg font-semibold text-yellow-900">
                                        <svg class="inline w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Pending Requests ({{ $pendingRequests->count() }})
                                    </h3>
                                    <table class="w-full text-sm">
                                        <thead>
                                            <tr class="border-b border-yellow-300">
                                                <th class="px-3 py-2 font-medium text-left text-gray-700">Requester</th>
                                                <th class="px-3 py-2 font-medium text-left text-gray-700">Type</th>
                                                <th class="px-3 py-2 font-medium text-left text-gray-700">Date</th>
                                                <th class="px-3 py-2 font-medium text-center text-gray-700">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-yellow-200">
                                            @foreach($pendingRequests as $req)
                                                <tr class="bg-yellow-50 hover:bg-yellow-100">
                                                    <td class="px-3 py-2 font-semibold text-gray-900">{{ $req->user->name }}</td>
                                                    <td class="px-3 py-2">
                                                        <span class="px-2 py-1 text-xs font-semibold rounded {{ $req->type === 'adopt' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                                            {{ ucfirst($req->type) }}
                                                        </span>
                                                    </td>
                                                    <td class="px-3 py-2 text-gray-600">{{ $req->created_at->format('M d, Y') }}</td>
                                                    <td class="flex justify-center px-3 py-2 space-x-2 text-center">
                                                        <a href="{{ route('admin.requests.show', $req) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-blue-600 rounded-lg transition-colors duration-200 hover:bg-blue-700">
                                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            </svg>
                                                            View
                                                        </a>
                                                        <form method="POST" action="{{ route('admin.requests.approve', $req) }}" class="inline">
                                                            @csrf
                                                            <button type="submit" onclick="return confirm('Approve this request?')" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-green-600 rounded-lg transition-colors duration-200 hover:bg-green-700">
                                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                                </svg>
                                                                Approve
                                                            </button>
                                                        </form>
                                                        <form method="POST" action="{{ route('admin.requests.deny', $req) }}" class="inline">
                                                            @csrf
                                                            <button type="submit" onclick="return confirm('Deny this request?')" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-red-600 rounded-lg transition-colors duration-200 hover:bg-red-700">
                                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                                Deny
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            <!-- Denied Requests -->
                            @if($deniedRequests->count() > 0)
                                <div>
                                    <h3 class="mb-4 text-lg font-semibold text-red-900">
                                        <svg class="inline w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Denied Requests ({{ $deniedRequests->count() }})
                                    </h3>
                                    <div class="space-y-2">
                                        @foreach($deniedRequests as $req)
                                            <div class="p-3 text-sm border border-red-200 rounded bg-red-50">
                                                <p class="font-semibold text-gray-900">{{ $req->user->name }}</p>
                                                <p class="text-gray-600">{{ ucfirst($req->type) }} Request - {{ $req->created_at->format('M d, Y') }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar: Quick Actions -->
            <div class="space-y-6">
                <!-- Action Buttons -->
                <div class="overflow-hidden bg-white rounded-lg shadow-md">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-bold text-gray-900">
                            <svg class="inline w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Actions
                        </h2>
                    </div>
                    <div class="px-6 py-6 space-y-3">
                        @php
                            $completedRequests = $pet->requests->where('status', 'completed');

                            // If pet was returned, filter to only show requests after the return date
                            if ($pet->mostRecentReturn && $pet->mostRecentReturn->return_date) {
                                $completedRequests = $completedRequests->filter(function($request) use ($pet) {
                                    return $request->created_at >= $pet->mostRecentReturn->return_date;
                                });
                            }

                            $completedRequest = $completedRequests->sortByDesc(function($r){
                                return $r->updated_at ? $r->updated_at->timestamp : 0;
                            })->first();
                        @endphp
                        @php
                            $approvedRequests = $pet->requests->where('status', 'approved');
                        @endphp

                        @if(in_array($pet->status, ['impounded', 'adoptable']) && $approvedRequests->count() > 0)
                            @if($approvedRequests->count() === 1)
                                @php $approvedRequest = $approvedRequests->first(); @endphp
                                @if($approvedRequest->type === 'claim')
                                    <form action="{{ route('admin.pets.mark-claimed', $pet) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="pet_request_id" value="{{ $approvedRequest->id }}">
                                        <button type="submit" class="w-full px-4 py-3 font-semibold text-white transition bg-blue-600 rounded-lg hover:bg-blue-700"
                                                onclick="return confirm('Mark this pet as CLAIMED and transfer ownership to {{ $approvedRequest->user->name }}?')">
                                            <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Mark as Claimed
                                        </button>
                                    </form>
                                @elseif($approvedRequest->type === 'adopt')
                                    <form action="{{ route('admin.pets.mark-adopted', $pet) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="pet_request_id" value="{{ $approvedRequest->id }}">
                                        <button type="submit" class="w-full px-4 py-3 font-semibold text-white transition bg-green-600 rounded-lg hover:bg-green-700"
                                                onclick="return confirm('Mark this pet as ADOPTED and transfer ownership to {{ $approvedRequest->user->name }}?')">
                                            🏠 Mark as Adopted
                                        </button>
                                    </form>
                                @endif
                            @else
                                {{-- Multiple approved requests: choose which to finalize --}}
                                <div class="mb-4">
                                    <label for="pet_request_id" class="block mb-2 text-sm font-medium text-gray-700">Select Approved Requester</label>
                                    <form action="{{ $pet->status === 'impounded' ? route('admin.pets.mark-claimed', $pet) : route('admin.pets.mark-adopted', $pet) }}" method="POST">
                                        @csrf
                                        <select name="pet_request_id" id="pet_request_id" class="w-full p-2 mb-3 border rounded">
                                            @foreach($approvedRequests as $req)
                                                <option value="{{ $req->id }}">{{ $req->user->name }} — {{ ucfirst($req->type) }} (submitted {{ $req->updated_at->diffForHumans() }})</option>
                                            @endforeach
                                        </select>

                                        <button type="submit" class="w-full px-4 py-3 font-semibold text-white transition bg-indigo-600 rounded-lg hover:bg-indigo-700"
                                                onclick="return confirm('Finalize selected approved requester and transfer ownership?')">
                                            <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Finalize Selected Requester
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @elseif(in_array($pet->status, ['impounded', 'adoptable']))
                        @elseif(in_array($pet->status, ['impounded', 'adoptable']))
                            <div class="p-4 border border-yellow-200 rounded-lg bg-yellow-50">
                                <p class="text-sm text-yellow-800">
                                    <svg class="inline w-4 h-4 mr-1 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                    </svg>
                                    No approved request yet. Admin approval required before marking pet as adopted/claimed.
                                </p>
                            </div>
                        @endif

                        @if(!in_array($pet->status, ['claimed','adopted']))
                        <a href="{{ route('admin.pets.edit', $pet) }}" class="block w-full px-4 py-3 font-semibold text-center text-gray-700 transition bg-white border-2 border-gray-300 rounded-lg hover:bg-gray-50">
                            <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Pet
                        </a>
                        @endif

                        <form action="{{ route('admin.pets.destroy', $pet) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full px-4 py-3 font-semibold text-white transition bg-red-600 rounded-lg hover:bg-red-700"
                                    onclick="return confirm('Delete this pet? This action cannot be undone.')">
                                <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete Pet
                            </button>
                        </form>
                    </div>
                </div>

                <!-- New Owner Information (show only after claimed/adopted) -->
                @if($pet->user && in_array($pet->status, ['claimed','adopted']))
                    <div class="overflow-hidden bg-white rounded-lg shadow-md">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h2 class="admin-new-owner-info-heading text-base font-bold text-gray-900">
                            <svg class="inline w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            New Owner Information
                        </h2>
                        </div>
                        <div class="px-6 py-6">
                            <div class="grid grid-cols-1 gap-3 text-sm text-gray-700 md:grid-cols-2">
                                <div>
                                    <p class="text-xs font-medium text-gray-600">Full Name</p>
                                    <p class="font-semibold text-gray-900">{{ $pet->user->name }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-600">Contact</p>
                                    <p class="font-semibold text-gray-900">{{ $pet->user->contact_number ?? 'Not provided' }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-xs font-medium text-gray-600">Email</p>
                                    <p class="font-semibold text-gray-900">{{ $pet->user->email }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-xs font-medium text-gray-600">Complete Address</p>
                                    <p class="font-semibold text-gray-900">{{ collect([$pet->user->street, $pet->user->barangay, $pet->user->city_municipality, $pet->user->province, $pet->user->zip_code])->filter()->implode(', ') ?: 'Not provided' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-600">Birthday</p>
                                    <p class="font-semibold text-gray-900">{{ $pet->user->birthday ? $pet->user->birthday->format('M d, Y') : 'Not provided' }}</p>
                                </div>
                                @if($pet->user->id_photo)
                                    <div>
                                        <p class="text-xs font-medium text-gray-600">ID Photo</p>
                                        <div onclick="document.getElementById('adminPetsNewOwnerIdPhotoModal').classList.remove('hidden')"
                                             class="inline-flex items-center p-2 mt-1 transition-colors duration-200 bg-teal-100 rounded-lg cursor-pointer hover:bg-teal-200">
                                            <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                            </svg>
                                            <span class="text-sm font-medium">View ID Photo</span>
                                        </div>
                                        <div id="adminPetsNewOwnerIdPhotoModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-white bg-opacity-90" onclick="if(event.target.id === 'adminPetsNewOwnerIdPhotoModal') this.classList.add('hidden')">
                                            <button onclick="document.getElementById('adminPetsNewOwnerIdPhotoModal').classList.add('hidden')" class="absolute text-gray-600 top-6 right-6 hover:text-gray-800">
                                                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                            <img src="{{ asset('storage/' . $pet->user->id_photo) }}" alt="Owner ID Photo" class="max-w-4xl max-h-[85vh] rounded-lg shadow-2xl">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Pet Timeline -->
                @php
                    $completedRequests = $pet->requests->where('status', 'completed');

                    // If pet was returned, filter to only show requests after the return date
                    if ($pet->mostRecentReturn && $pet->mostRecentReturn->return_date) {
                        $completedRequests = $completedRequests->filter(function($request) use ($pet) {
                            return $request->created_at >= $pet->mostRecentReturn->return_date;
                        });
                    }

                    $latestCompleted = $completedRequests->sortByDesc('updated_at')->first();
                    $latestClaim = $completedRequests->where('type', 'claim')->sortByDesc('updated_at')->first();
                    $latestAdopt = $completedRequests->where('type', 'adopt')->sortByDesc('updated_at')->first();
                @endphp
                <div class="overflow-hidden bg-white rounded-lg shadow-md">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-bold text-gray-900">Timeline</h2>
                    </div>
                    <div class="px-6 py-6 space-y-3">
                        @if($pet->impounded_date)
                            <div class="flex justify-between">
                                <p class="text-xs font-medium text-gray-600">Impounded</p>
                                <p class="font-semibold text-gray-900">{{ $pet->impounded_date->format('M d, Y') }}</p>
                            </div>
                        @endif

                        {{-- Show Adoptable Date only when appropriate. If the pet was impounded and later directly claimed (no adoptable phase), hide adoptable date. --}}
                        @if($pet->decision_date && !($pet->impounded_date && $pet->status === 'claimed'))
                            <div class="flex justify-between">
                                <p class="text-xs font-medium text-gray-600">Adoptable Date</p>
                                <p class="font-semibold text-gray-900">{{ $pet->decision_date->format('M d, Y') }}</p>
                            </div>
                        @endif

                        @if($pet->status === 'claimed')
                            <div class="flex justify-between">
                                <p class="text-xs font-medium text-gray-600">Claimed On</p>
                                <p class="font-semibold text-gray-900">{{ $latestClaim ? $latestClaim->updated_at->format('M d, Y H:i') : $pet->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        @elseif($pet->status === 'adopted')
                            <div class="flex justify-between">
                                <p class="text-xs font-medium text-gray-600">Adopted On</p>
                                <p class="font-semibold text-gray-900">{{ $latestAdopt ? $latestAdopt->updated_at->format('M d, Y H:i') : ($latestCompleted ? $latestCompleted->updated_at->format('M d, Y H:i') : $pet->updated_at->format('M d, Y H:i')) }}</p>
                            </div>
                        @elseif($completedRequest)
                            <div class="flex justify-between">
                                <p class="text-xs font-medium text-gray-600">Completed On</p>
                                <p class="font-semibold text-gray-900">{{ $completedRequest->updated_at->format('M d, Y H:i') }}</p>
                            </div>
                        @endif

                        @if($pet->remaining_days !== null && !in_array($pet->status, ['adopted','claimed']))
                            @php $remainingDays = max(0, (int) floor($pet->remaining_days)); @endphp
                            <div class="flex justify-between">
                                <p class="text-xs font-medium text-gray-600">Days remaining</p>
                                <p class="text-sm font-semibold {{ $remainingDays <= 1 ? 'text-red-600' : 'text-orange-600' }}">{{ $remainingDays }} day{{ $remainingDays !== 1 ? 's' : '' }}</p>
                            </div>
                        @endif

                        <div class="flex justify-between">
                            <p class="text-xs font-medium text-gray-600">Last Updated</p>
                            <p class="font-semibold text-gray-900">{{ $pet->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Ownership History Section -->
                @if($pet->ownershipHistory->count() > 0)
                    <div class="overflow-hidden bg-white rounded-lg shadow-md">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h2 class="text-lg font-bold text-gray-900">
                                <svg class="inline w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Ownership History
                            </h2>
                        </div>
                        <div class="px-6 py-6 space-y-4">
                            @foreach($pet->ownershipHistory as $record)
                                <div class="border-l-4 {{ $record->return_date ? 'border-orange-400 bg-orange-50' : 'border-green-400 bg-green-50' }} p-4 rounded-r-lg">
                                    <div class="flex items-start justify-between mb-3">
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Owner {{ $loop->iteration }}</p>
                                            <p class="text-lg font-bold text-gray-900">{{ $record->user->name }}</p>
                                            <p class="text-xs text-gray-500 mt-1">{{ $record->user->email }} • {{ $record->user->contact_number ?? 'No phone' }}</p>
                                        </div>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $record->return_date ? 'bg-orange-200 text-orange-900' : 'bg-green-200 text-green-900' }}">
                                            {{ $record->return_date ? '↩ Returned' : '✓ Current Owner' }}
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3 text-sm">
                                        <div>
                                            <p class="text-xs font-medium text-gray-600">Type</p>
                                            <p class="font-semibold text-gray-900">{{ ucfirst($record->type) }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-600">Date Assigned</p>
                                            <p class="font-semibold text-gray-900">{{ $record->assigned_date->format('M d, Y') }}</p>
                                        </div>

                                        @if($record->adoption_reason_other)
                                            <div class="col-span-2">
                                                <p class="text-xs font-medium text-gray-600">Adoption Reason</p>
                                                <p class="font-semibold text-gray-900">{{ $record->adoption_reason_other }}</p>
                                            </div>
                                        @endif

                                        @if($record->adoption_notes)
                                            <div class="col-span-2">
                                                <p class="text-xs font-medium text-gray-600">Adoption Notes</p>
                                                <p class="text-gray-900">{{ $record->adoption_notes }}</p>
                                            </div>
                                        @endif

                                        @if($record->return_date)
                                            <div>
                                                <p class="text-xs font-medium text-gray-600">Return Date</p>
                                                <p class="font-semibold text-gray-900">{{ $record->return_date->format('M d, Y') }}</p>
                                            </div>

                                            @if($record->return_reason_other)
                                                <div class="col-span-2">
                                                    <p class="text-xs font-medium text-gray-600">Return Reason</p>
                                                    <p class="font-semibold text-gray-900">{{ $record->return_reason_other }}</p>
                                                </div>
                                            @endif

                                            @if($record->return_notes)
                                                <div class="col-span-2">
                                                    <p class="text-xs font-medium text-gray-600">Return Notes</p>
                                                    <p class="text-gray-900">{{ $record->return_notes }}</p>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Return Pet Button (only for current claimed/adopted pets) -->
                @if(in_array($pet->status, ['claimed', 'adopted']) && $pet->user)
                    <div class="p-4 rounded-lg bg-orange-50 border border-orange-200">
                        <p class="text-sm font-medium text-orange-900">
                            Pet Status: This pet is currently owned by {{ $pet->user->name }}. Use the button below if they are bringing it back to the shelter.
                        </p>
                        <button onclick="openReturnModal()" class="mt-4 px-4 py-2 font-semibold text-white transition bg-orange-600 rounded-lg hover:bg-orange-700 whitespace-nowrap">
                            <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Mark as Returned
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8">
            <a href="javascript:void(0)" onclick="history.back()"
               class="px-5 py-2.5 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                ← Back
            </a>
        </div>
    </div>
</div>

<!-- Include Mark Returned Modal -->
@include('admin.pets.modals.mark-returned-modal')

<!-- Admin Pet Photo Modal -->
@if($pet->photo)
<div id="adminPetPhotoModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/30 backdrop-blur-sm" onclick="if(event.target.id === 'adminPetPhotoModal') closeAdminPetPhotoModal()">
    <div class="relative flex flex-col items-center justify-center max-w-6xl max-h-[90vh]">
        <button onclick="closeAdminPetPhotoModal()" class="absolute text-white top-6 right-6 hover:text-gray-300 z-10">
            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <img id="adminPetPhotoImg" src="{{ asset('storage/' . $pet->photo) }}" alt="Full Size Pet Photo" class="max-w-4xl max-h-[85vh] object-contain rounded-lg shadow-2xl cursor-pointer" onclick="closeAdminPetPhotoModal()">
    </div>
</div>
@endif

<!-- Request Photo Modal -->
<div id="requestPhotoModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/30 backdrop-blur-sm" onclick="if(event.target.id === 'requestPhotoModal') closeRequestPhotoModal()">
    <div class="relative flex flex-col items-center justify-center max-w-6xl max-h-[90vh]">
        <button onclick="closeRequestPhotoModal()" class="absolute text-white top-6 right-6 hover:text-gray-300 z-10">
            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <button id="adminPetRequestPrevBtn" type="button" onclick="prevRequestPhoto()" class="absolute left-4 top-1/2 -translate-y-1/2 p-2 text-white rounded-full bg-black/50 hover:bg-black/70 z-10" aria-label="Previous image">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button id="adminPetRequestNextBtn" type="button" onclick="nextRequestPhoto()" class="absolute right-4 top-1/2 -translate-y-1/2 p-2 text-white rounded-full bg-black/50 hover:bg-black/70 z-10" aria-label="Next image">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
        <img id="requestPhotoImg" src="" alt="Request Photo" class="max-w-4xl max-h-[85vh] object-contain rounded-lg shadow-2xl">
        <div class="mt-4 text-center">
            <p id="adminPetRequestImageCounter" class="text-sm text-white"></p>
            <p id="adminPetRequestImageCaption" class="mt-1 text-sm text-white"></p>
        </div>
    </div>
</div>

<!-- Admin Request ID Photo Modal -->
@if(in_array($pet->status, ['claimed','adopted']))
    @php
        $completedRequests = $pet->requests->where('status', 'completed');

        // If pet was returned, filter to only show requests after the return date
        if ($pet->mostRecentReturn && $pet->mostRecentReturn->return_date) {
            $completedRequests = $completedRequests->filter(function($request) use ($pet) {
                return $request->created_at >= $pet->mostRecentReturn->return_date;
            });
        }

        $completedRequest = $completedRequests->sortByDesc('updated_at')->first();
        $additionalData = $completedRequest ? (is_array($completedRequest->additional_data) ? $completedRequest->additional_data : json_decode($completedRequest->additional_data, true)) : null;
    @endphp
    @if($completedRequest && isset($additionalData['id_photo_path']) && $additionalData['id_photo_path'])
    <div id="adminRequestIdPhotoModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-70" onclick="if(event.target.id === 'adminRequestIdPhotoModal') document.getElementById('adminRequestIdPhotoModal').classList.add('hidden')">
        <button onclick="document.getElementById('adminRequestIdPhotoModal').classList.add('hidden')" class="absolute text-white top-6 right-6 hover:text-gray-300 z-10">
            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <img src="{{ asset('storage/' . $additionalData['id_photo_path']) }}" alt="Requester ID Photo" class="max-w-[90vw] max-h-[90vh] object-contain rounded-lg shadow-2xl cursor-pointer" onclick="document.getElementById('adminRequestIdPhotoModal').classList.add('hidden')">
    </div>
    @endif
@endif

<script>
function openAdminPetPhotoModal() {
    document.getElementById('adminPetPhotoModal').classList.remove('hidden');
}

function closeAdminPetPhotoModal() {
    document.getElementById('adminPetPhotoModal').classList.add('hidden');
}

@php
    $adminPetRequestPhotos = [];
    if (isset($completedRequest) && $completedRequest->photos) {
        if (is_string($completedRequest->photos)) {
            $adminPetRequestPhotos = json_decode($completedRequest->photos, true) ?? [];
        } elseif (is_array($completedRequest->photos)) {
            $adminPetRequestPhotos = $completedRequest->photos;
        } else {
            $adminPetRequestPhotos = (array) $completedRequest->photos;
        }
    }
@endphp

const adminPetRequestPhotoSources = [
    @foreach($adminPetRequestPhotos as $idx => $photo)
        { src: "{{ asset('storage/' . $photo) }}", alt: "Request Photo {{ $idx + 1 }}" }@if(!$loop->last),@endif
    @endforeach
];
let currentAdminPetRequestImageIndex = 0;

function openRequestPhotoModal(index) {
    if (!adminPetRequestPhotoSources.length) {
        return;
    }

    currentAdminPetRequestImageIndex = index;
    updateRequestPhotoModal();
    document.getElementById('requestPhotoModal').classList.remove('hidden');
}

function updateRequestPhotoModal() {
    const source = adminPetRequestPhotoSources[currentAdminPetRequestImageIndex];
    const img = document.getElementById('requestPhotoImg');
    img.src = source.src;
    img.alt = source.alt;
    document.getElementById('adminPetRequestImageCaption').textContent = source.alt;
    document.getElementById('adminPetRequestImageCounter').textContent = `${currentAdminPetRequestImageIndex + 1} / ${adminPetRequestPhotoSources.length}`;
    const showNav = adminPetRequestPhotoSources.length > 1;
    document.getElementById('adminPetRequestPrevBtn').style.display = showNav ? 'block' : 'none';
    document.getElementById('adminPetRequestNextBtn').style.display = showNav ? 'block' : 'none';
}

function nextRequestPhoto() {
    openRequestPhotoModal((currentAdminPetRequestImageIndex + 1) % adminPetRequestPhotoSources.length);
}

function prevRequestPhoto() {
    openRequestPhotoModal((currentAdminPetRequestImageIndex + adminPetRequestPhotoSources.length - 1) % adminPetRequestPhotoSources.length);
}

function closeRequestPhotoModal() {
    document.getElementById('requestPhotoModal').classList.add('hidden');
}

// Add keyboard support for Backspace, Escape and arrow keys
document.addEventListener('keydown', function(event) {
    if (event.key === 'Backspace') {
        const requestModal = document.getElementById('requestPhotoModal');
        if (requestModal && !requestModal.classList.contains('hidden')) {
            closeRequestPhotoModal();
            return;
        }

        const adminPetModal = document.getElementById('adminPetPhotoModal');
        if (adminPetModal && !adminPetModal.classList.contains('hidden')) {
            closeAdminPetPhotoModal();
            return;
        }

        const adminRequestIdModal = document.getElementById('adminRequestIdPhotoModal');
        if (adminRequestIdModal && !adminRequestIdModal.classList.contains('hidden')) {
            adminRequestIdModal.classList.add('hidden');
            return;
        }

        const idModal = document.getElementById('adminPetsNewOwnerIdPhotoModal');
        if (idModal && !idModal.classList.contains('hidden')) {
            idModal.classList.add('hidden');
            return;
        }
    }

    if (event.key === 'ArrowLeft') {
        const requestModal = document.getElementById('requestPhotoModal');
        if (requestModal && !requestModal.classList.contains('hidden') && adminPetRequestPhotoSources.length > 1) {
            prevRequestPhoto();
            event.preventDefault();
            return;
        }
    }

    if (event.key === 'ArrowRight') {
        const requestModal = document.getElementById('requestPhotoModal');
        if (requestModal && !requestModal.classList.contains('hidden') && adminPetRequestPhotoSources.length > 1) {
            nextRequestPhoto();
            event.preventDefault();
            return;
        }
    }

    if (event.key === 'Escape') {
        closeRequestPhotoModal();
        closeAdminPetPhotoModal();
        if (document.getElementById('adminRequestIdPhotoModal')) {
            document.getElementById('adminRequestIdPhotoModal').classList.add('hidden');
        }
        if (document.getElementById('adminPetsNewOwnerIdPhotoModal')) {
            document.getElementById('adminPetsNewOwnerIdPhotoModal').classList.add('hidden');
        }
    }
});

if (document.getElementById('requestPhotoModal')) {
    document.getElementById('requestPhotoModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeRequestPhotoModal();
        }
    });
}
</script>
@endsection
