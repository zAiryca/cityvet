@extends('layouts.admin')

@section('title', '| Admin - Request Details')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <h1 class="mb-6 text-3xl font-bold">Request Details</h1>
    <div class="max-w-4xl bg-white rounded-lg shadow">
        <div class="p-6">
            @php
                $sidebarAdditionalData = [];
                if ($request->additional_data) {
                    $sidebarAdditionalData = is_array($request->additional_data) ? $request->additional_data : (json_decode($request->additional_data, true) ?? []);
                }
            @endphp
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                @php
                    $petId = $request->requestable && isset($request->requestable->display_code) ? $request->requestable->display_code : 'N/A';
                @endphp
                <p><strong>Pet ID:</strong> {{ $petId }}</p>
                <p><strong>Type:</strong> {{ ucfirst($request->type) }}</p>
                <p>
                    <strong>Status:</strong>
                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($request->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">{{ ucfirst($request->status) }}</span>
                </p>
                <p><strong>Date:</strong> {{ $request->created_at->format('M d, Y h:i A') }}</p>
            </div>

            @if($request->requestable && $request->requestable_type === 'App\\Models\\Pet')
                <div class="mb-6 text-center">
                    <h3 class="mb-4 text-lg font-semibold">{{ $request->type === 'adopt' ? 'Adoptable' : 'Impounded' }} Pet Photo</h3>
                    <img src="{{ $request->requestable->photo ? asset('storage/' . $request->requestable->photo) : 'https://via.placeholder.com/600x400?text=' . $request->requestable->display_code }}" alt="{{ $request->requestable->display_code }}" class="object-cover w-full h-96">
                </div>

                <div class="mb-6">
                    <h3 class="mb-4 text-lg font-semibold">{{ $request->type === 'adopt' ? 'Adoptable' : 'Impounded' }} Pet Information</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <p><strong>Pet ID:</strong> {{ $request->requestable->display_code }}</p>
                        <p><strong>Species:</strong> {{ $request->requestable->species }}</p>
                        <p><strong>Breed:</strong> {{ $request->requestable->breed ?: 'Unknown' }}</p>
                        <p><strong>Gender:</strong> {{ ucfirst($request->requestable->gender) }}</p>
                        <p><strong>Age:</strong> {{ $request->requestable->estimated_age_years ? $request->requestable->estimated_age_years . ' years' : '' }} {{ $request->requestable->estimated_age_months ? $request->requestable->estimated_age_months . ' months' : '' }}</p>
                        <p><strong>Color Markings:</strong> {{ $request->requestable->color_markings ?: 'Not specified' }}</p>
                        <p><strong>Description:</strong> {{ $request->requestable->description ?: 'No description' }}</p>
                        @if($request->requestable->caught_location)
                            <p><strong>Location Found:</strong> {{ $request->requestable->caught_location }}</p>
                        @endif
                        @if($request->requestable->adoption_reason)
                            <p><strong>Adoption Reason:</strong> {{ $request->requestable->adoption_reason }}</p>
                        @endif
                        @if($request->requestable->adoption_notes)
                            <p><strong>Adoption Notes:</strong> {{ $request->requestable->adoption_notes }}</p>
                        @endif
                    </div>
                </div>


            @endif

            @if($request->additional_data)
                @php
                    $additionalData = is_array($request->additional_data) ? $request->additional_data : json_decode($request->additional_data, true);
                @endphp
                @if($request->type === 'adopt')
                    <div class="mb-6">
                        <h3 class="mb-4 text-lg font-semibold">Adopter Information</h3>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <p><strong>Name:</strong> {{ $additionalData['first_name'] ?? '' }} {{ $additionalData['middle_name'] ?? '' }} {{ $additionalData['last_name'] ?? '' }}</p>
                            <p><strong>Address:</strong> {{ $additionalData['address'] ?? '' }}</p>
                            <p><strong>Contact:</strong> {{ $additionalData['contact_number'] ?? '' }}</p>
                            <p><strong>Email:</strong> {{ $additionalData['email'] ?? '' }}</p>
                            <p><strong>Date of Birth:</strong>
                                @if(!empty($additionalData['date_of_birth']))
                                    {{ date('M d, Y', strtotime($additionalData['date_of_birth'])) }}
                                @elseif($request->user && $request->user->birthday)
                                    {{ $request->user->birthday->format('M d, Y') }}
                                @else
                                    N/A
                                @endif
                            </p>
                            <p><strong>Dwelling Type:</strong> {{ ucfirst(str_replace('_', ' ', $additionalData['dwelling_type'] ?? '')) }}</p>
                            @if(isset($additionalData['landlord_permission']))
                                <p><strong>Landlord Permission:</strong> {{ ucfirst($additionalData['landlord_permission']) }}</p>
                            @endif
                            <p><strong>Fenced Property:</strong> {{ ucfirst($additionalData['fenced_property'] ?? '') }}</p>
                            <p><strong>Adults in Home:</strong> {{ $additionalData['adults_count'] ?? '' }}</p>
                            <p><strong>Children in Home:</strong> {{ $additionalData['children_count'] ?? '' }}</p>
                            <p><strong>Allergies:</strong> {{ ucfirst($additionalData['allergies'] ?? '') }}</p>
                            <p><strong>Other Pets:</strong> {{ ucfirst($additionalData['other_pets'] ?? '') }}</p>
                            @if(isset($additionalData['other_pets_list']))
                                <p><strong>Other Pets List:</strong> {{ $additionalData['other_pets_list'] }}</p>
                            @endif
                            <p><strong>Pet Living Area:</strong> {{ ucfirst($additionalData['pet_living_area'] ?? '') }}</p>
                        </div>
                        <div class="mt-4">
                            <p><strong>Reason for Adoption:</strong> {{ $additionalData['reason'] ?? '' }}</p>
                        </div>
                        @if($request->user->id_photo)
                            <div class="mt-4">
                                <h4 class="mb-2 font-semibold text-md">User ID Photo</h4>
                                <div onclick="document.getElementById('adminRequestIdPhotoModal1').style.display = 'flex'"
                                     class="flex flex-col items-center justify-center w-48 h-32 bg-black border-4 border-gray-400 rounded-lg cursor-pointer hover:bg-gray-900">
                                    <svg class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div id="adminRequestIdPhotoModal1" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-black bg-opacity-80" style="display: none;">
                                    <button onclick="document.getElementById('adminRequestIdPhotoModal1').style.display = 'none'" class="absolute top-6 right-6 text-gray-400 hover:text-white">
                                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                    <img src="{{ asset('storage/' . $request->user->id_photo) }}" alt="User ID Photo" class="max-w-4xl max-h-[85vh] rounded-lg shadow-2xl">
                                </div>
                            </div>
                        @endif
                    </div>
                @elseif($request->type === 'claim')
                    <div class="mb-6">
                        <h3 class="mb-4 text-lg font-semibold">Claimant Information</h3>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <p><strong>Name:</strong> {{ $additionalData['first_name'] ?? '' }} {{ $additionalData['middle_name'] ?? '' }} {{ $additionalData['last_name'] ?? '' }}</p>
                            <p><strong>Address:</strong> {{ $additionalData['address'] ?? '' }}</p>
                            <p><strong>Contact:</strong> {{ $additionalData['contact_number'] ?? '' }}</p>
                            <p><strong>Email:</strong> {{ $additionalData['email'] ?? '' }}</p>
                            <p><strong>Birthday:</strong>
                                @if(!empty($additionalData['date_of_birth']))
                                    {{ date('M d, Y', strtotime($additionalData['date_of_birth'])) }}
                                @elseif($request->user && $request->user->birthday)
                                    {{ $request->user->birthday->format('M d, Y') }}
                                @else
                                    Not provided
                                @endif
                            </p>
                        </div>
                        @if($request->user->id_photo)
                            <div class="mt-4">
                                <h4 class="mb-2 font-semibold text-md">User ID Photo</h4>
                                <div onclick="document.getElementById('adminRequestIdPhotoModal2').style.display = 'flex'"
                                     class="flex flex-col items-center justify-center w-48 h-32 bg-black border-4 border-gray-400 rounded-lg cursor-pointer hover:bg-gray-900">
                                    <svg class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div id="adminRequestIdPhotoModal2" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-black bg-opacity-80" style="display: none;">
                                    <button onclick="document.getElementById('adminRequestIdPhotoModal2').style.display = 'none'" class="absolute top-6 right-6 text-gray-400 hover:text-white">
                                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                    <img src="{{ asset('storage/' . $request->user->id_photo) }}" alt="User ID Photo" class="max-w-4xl max-h-[85vh] rounded-lg shadow-2xl">
                                </div>
                            </div>
                        @endif
                    </div>
                @elseif($request->type === 'impound')
                    <div class="mb-6">
                        <h3 class="mb-4 text-lg font-semibold">Impound Request Information</h3>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <p><strong>Name:</strong> {{ $additionalData['first_name'] ?? '' }} {{ $additionalData['middle_name'] ?? '' }} {{ $additionalData['last_name'] ?? '' }}</p>
                            <p><strong>Address:</strong> {{ $additionalData['address'] ?? '' }}</p>
                            <p><strong>Contact:</strong> {{ $additionalData['contact_number'] ?? '' }}</p>
                            <p><strong>Email:</strong> {{ $additionalData['email'] ?? '' }}</p>
                            <p><strong>Location Found:</strong> {{ $additionalData['location_found'] ?? '' }}</p>
                            <p><strong>Description:</strong> {{ $additionalData['description'] ?? '' }}</p>
                        </div>
                        @if($request->user->id_photo)
                            <div class="mt-4">
                                <h4 class="mb-2 font-semibold text-md">User ID Photo</h4>
                                <div onclick="document.getElementById('adminRequestIdPhotoModal3').style.display = 'flex'"
                                     class="flex flex-col items-center justify-center w-48 h-32 bg-black border-4 border-gray-400 rounded-lg cursor-pointer hover:bg-gray-900">
                                    <svg class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div id="adminRequestIdPhotoModal3" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-black bg-opacity-80" style="display: none;">
                                    <button onclick="document.getElementById('adminRequestIdPhotoModal3').style.display = 'none'" class="absolute top-6 right-6 text-gray-400 hover:text-white">
                                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                    <img src="{{ asset('storage/' . $request->user->id_photo) }}" alt="User ID Photo" class="max-w-4xl max-h-[85vh] rounded-lg shadow-2xl">
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            @endif

            <p class="mb-6"><strong>Reason:</strong> {{ $request->reason }}</p>
            <p class="mb-6"><strong>Contact Info:</strong> {{ $request->contact_info }}</p>

            <!-- Display Photos -->
            @if($request->photos)
                @php
                    $photos = is_array($request->photos) ? $request->photos : json_decode($request->photos, true);
                @endphp
                @if(is_array($photos) && count($photos) > 0)
                    <div class="mb-6">
                        <h3 class="mb-4 text-lg font-semibold">Claimant/Adopter Uploaded Photos</h3>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($photos as $photo)
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $photo) }}" alt="Request Photo" class="object-cover w-full h-48 rounded-lg shadow-md">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif

            <!-- Success Message -->
            @if(session('success'))
                <div class="px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center gap-3">
                @if($request->status === 'pending')
                    <!-- Approve Button -->
                    <form action="{{ route('admin.requests.approve', $request) }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="redirect_to_pet" value="1">
                        <button type="submit" class="px-6 py-2 font-semibold text-white bg-green-600 rounded hover:bg-green-700">
                            ✓ Approve Request
                        </button>
                    </form>

                    <!-- Deny Button -->
                    <form action="{{ route('admin.requests.deny', $request) }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="redirect_to_pet" value="1">
                        <button type="submit" class="px-6 py-2 font-semibold text-white bg-red-600 rounded hover:bg-red-700" onclick="return confirm('Are you sure you want to deny this request?');">
                            ✗ Deny Request
                        </button>
                    </form>
                @else
                    <span class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-200 rounded">
                        Status: {{ ucfirst($request->status) }}
                    </span>
                @endif

                <!-- Back Buttons -->
                @if(request()->referrer && str_contains(request()->referrer, 'admin/pets'))
                    <a href="{{ url()->previous() }}" class="px-4 py-2 text-gray-700 bg-gray-300 rounded hover:bg-gray-400">← Back to Pet</a>
                @else
                    <a href="{{ route('admin.requests.index') }}" class="px-4 py-2 text-gray-700 bg-gray-300 rounded hover:bg-gray-400">← Back to Requests</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
