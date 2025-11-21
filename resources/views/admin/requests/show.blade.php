@extends('layouts.admin')

@section('title', '| Admin - Request Details')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <h1 class="mb-6 text-3xl font-bold">Request Details</h1>
    <div class="max-w-4xl bg-white rounded-lg shadow">
        <div class="p-6">
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                <p><strong>User:</strong> {{ $request->user->name }} ({{ $request->user->email }})</p>
                <p><strong>Type:</strong> {{ ucfirst($request->type) }}</p>
                <p><strong>Status:</strong>
                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($request->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                        {{ ucfirst($request->status) }}
                    </span>
                </p>
                <p><strong>Date:</strong> {{ $request->created_at->format('M d, Y h:i A') }}</p>
            </div>

            @if($request->requestable && $request->requestable_type === 'App\\Models\\Pet')
                <div class="mb-6 text-center">
                    <h3 class="mb-4 text-lg font-semibold">{{ $request->type === 'adopt' ? 'Adopted' : 'Impounded' }} Pet Photo</h3>
                    <img src="{{ $request->requestable->photo ? asset('storage/' . $request->requestable->photo) : 'https://via.placeholder.com/600x400?text=' . $request->requestable->display_code }}" alt="{{ $request->requestable->display_code }}" class="object-cover w-full h-96">
                </div>

                <div class="mb-6">
                    <h3 class="mb-4 text-lg font-semibold">{{ $request->type === 'adopt' ? 'Adopted' : 'Impounded' }} Pet Information</h3>
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
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="mb-4 text-lg font-semibold">{{ ucfirst($request->type) }}er Information</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <p><strong>Name:</strong> {{ $request->user->name }}</p>
                        <p><strong>Email:</strong> {{ $request->user->email }}</p>
                        <p><strong>Phone:</strong> {{ $request->user->phone ?: 'Not provided' }}</p>
                        <p><strong>Address:</strong> {{ $request->user->address ?: 'Not provided' }}</p>
                        @if($request->additional_data)
                            @php
                                $additionalData = is_array($request->additional_data) ? $request->additional_data : json_decode($request->additional_data, true);
                            @endphp
                            @if(isset($additionalData['reason']))
                                <p><strong>Reason:</strong> {{ $additionalData['reason'] }}</p>
                            @endif
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
                        @if($request->user->id_photo)
                            <div class="mt-4">
                                <h4 class="mb-2 font-semibold text-md">User ID Photo</h4>
                                <img src="{{ asset('storage/' . $request->user->id_photo) }}" alt="User ID Photo" class="object-cover w-48 h-32 border rounded-lg shadow-md">
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
                            <p><strong>Birthday:</strong> {{ isset($additionalData['birthday']) ? date('M d, Y', strtotime($additionalData['birthday'])) : 'Not provided' }}</p>
                        </div>
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
                                <img src="{{ asset('storage/' . $request->user->id_photo) }}" alt="User ID Photo" class="object-cover w-48 h-32 border rounded-lg shadow-md">
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




            <div class="flex space-x-4">
                <a href="{{ route('admin.requests.index') }}" class="px-4 py-2 text-white bg-gray-600 rounded hover:bg-gray-700">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection
