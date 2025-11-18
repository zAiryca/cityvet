@extends('layouts.app')

@section('title', '| Request Details')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Request Details</h1>
    <div class="bg-white rounded-lg shadow max-w-4xl">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <p><strong>Type:</strong> {{ ucfirst($request->type) }}</p>
                @if($request->requestable)
                    @if($request->requestable_type === 'App\\Models\\Pet')
                        <p><strong>Pet:</strong> <a href="{{ route('pets.show', $request->requestable) }}" class="text-blue-600 hover:underline">{{ $request->requestable->display_code }}</a> ({{ $request->requestable->species }})</p>
                    @elseif($request->requestable_type === 'App\\Models\\Event')
                        <p><strong>Event:</strong> {{ $request->requestable->title }} on {{ $request->requestable->event_date->format('M d, Y') }}</p>
                    @endif
                @endif
                <p><strong>Status:</strong>
                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($request->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                        {{ ucfirst($request->status) }}
                    </span>
                </p>
                <p><strong>Date:</strong> {{ $request->created_at->format('M d, Y h:i A') }}</p>
            </div>

            @if($request->additional_data)
                @php
                    $additionalData = json_decode($request->additional_data, true);
                @endphp
                @if($request->type === 'adopt')
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Adopter Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <p><strong>Name:</strong> {{ $additionalData['first_name'] ?? '' }} {{ $additionalData['middle_name'] ?? '' }} {{ $additionalData['last_name'] ?? '' }}</p>
                            <p><strong>Address:</strong> {{ $additionalData['address'] ?? '' }}</p>
                            <p><strong>Contact:</strong> {{ $additionalData['contact_number'] ?? '' }}</p>
                            <p><strong>Email:</strong> {{ $additionalData['email'] ?? '' }}</p>
                            <p><strong>Date of Birth:</strong> {{ isset($additionalData['date_of_birth']) ? date('M d, Y', strtotime($additionalData['date_of_birth'])) : '' }}</p>
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
                    </div>
                @elseif($request->type === 'claim')
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Claimant Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <p><strong>Name:</strong> {{ $additionalData['first_name'] ?? '' }} {{ $additionalData['middle_name'] ?? '' }} {{ $additionalData['last_name'] ?? '' }}</p>
                            <p><strong>Address:</strong> {{ $additionalData['address'] ?? '' }}</p>
                            <p><strong>Contact:</strong> {{ $additionalData['contact_number'] ?? '' }}</p>
                            <p><strong>Email:</strong> {{ $additionalData['email'] ?? '' }}</p>
                        </div>
                    </div>
                @endif
            @endif

            <p class="mb-6"><strong>Reason:</strong> {{ $request->reason }}</p>
            <p class="mb-6"><strong>Contact Info:</strong> {{ $request->contact_info }}</p>

            <!-- Display Photos -->
            @if($request->photos)
                @php
                    $photos = json_decode($request->photos, true);
                @endphp
                @if(is_array($photos) && count($photos) > 0)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Uploaded Photos</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($photos as $photo)
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $photo) }}" alt="Request Photo" class="w-full h-48 object-cover rounded-lg shadow-md">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif

            @if($request->admin_notes)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Admin Notes</h3>
                    <p class="text-gray-700 bg-gray-100 p-4 rounded">{{ $request->admin_notes }}</p>
                </div>
            @endif

            <div class="flex space-x-4">
                <a href="{{ route('user.requests') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Back to My Requests</a>
            </div>
        </div>
    </div>
</div>
@endsection
