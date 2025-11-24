@extends('layouts.app')

@section('title', '| Request Details')

@section('content')
<div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">

    <div class="flex items-center justify-between pb-4 mb-8 border-b border-gray-200">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">
            {{ ucfirst($request->type) }} Request Details
        </h1>
        <a href="{{ route('user.requests') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition duration-150 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path></svg>
            Back to My Requests
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
                <div class="p-6 overflow-hidden bg-white border border-gray-100 shadow-lg rounded-xl sm:p-8">
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
                                        <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $displayCode ?? $item->name }}" class="object-cover w-40 h-40 rounded-lg shadow-md">
                                    @else
                                        <div class="flex items-center justify-center w-40 h-40 text-gray-500 bg-gray-100 rounded-lg">No Photo</div>
                                    @endif
                                </div>
                                <div class="grid grid-cols-2 text-sm text-gray-700 gap-x-6 gap-y-3">
                                    <p><strong class="block text-gray-500">ID Code:</strong> {{ $displayCode ?? 'N/A' }}</p>
                                    <p><strong class="block text-gray-500">Name:</strong> {{ $item->name ?? 'N/A' }}</p>
                                    <p><strong class="block text-gray-500">Species:</strong> {{ ($item->species ?? '-') }} </p>
                                    <p><strong class="block text-gray-500">Breed:</strong> {{ ($item->breed ?? '-') }}</p>
                                    <p><strong class="block text-gray-500">Age:</strong> {{ ($item->age ?? 'N/A') }}</p>
                                    <p><strong class="block text-gray-500">Color:</strong> {{ ($item->color ?? 'N/A') }}</p>
                                    <p><strong class="block text-gray-500">Weight:</strong> {{ ($item->weight ?? 'N/A') }} kg</p>
                                    <p><strong class="block text-gray-500">Status:</strong> {{ ucfirst($item->status ?? 'N/A') }}</p>
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

            <div class="p-6 overflow-hidden bg-white border border-gray-100 shadow-lg rounded-xl sm:p-8">
                <h2 class="pb-3 mb-6 text-2xl font-bold text-gray-900 border-b">
                    Reason for Request
                </h2>
                <dd class="p-4 text-gray-700 whitespace-pre-wrap rounded-lg bg-gray-50">{{ $request->reason ?? 'N/A' }}</dd>
            </div>

            @if($request->additional_data)
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
                    <div class="p-6 overflow-hidden bg-white border border-gray-100 shadow-lg rounded-xl sm:p-8">
                        <h2 class="pb-3 mb-6 text-2xl font-bold text-gray-900 border-b">
                            Supporting Details/Proof
                        </h2>
                        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                            @foreach($photos as $photo)
                                <a href="{{ asset('storage/' . $photo) }}" target="_blank" rel="noopener noreferrer" class="relative block overflow-hidden transition duration-300 rounded-lg shadow-md group hover:shadow-xl">
                                    <img src="{{ asset('storage/' . $photo) }}" alt="Request Photo" class="object-cover w-full h-32 transition duration-500 sm:h-40 group-hover:scale-105">
                                    <div class="absolute inset-0 flex items-center justify-center transition duration-300 bg-black opacity-0 bg-opacity-30 group-hover:opacity-100">
                                        <span class="text-white text-xs font-semibold p-1.5 bg-black bg-opacity-60 rounded">View</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif

        </div>
    </div>
</div>
@endsection
