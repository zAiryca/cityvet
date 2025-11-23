@extends('layouts.app')

@section('title', '| Pet Details')

@section('content')
<div class="min-h-screen px-4 py-12 bg-gradient-to-br from-blue-50 to-indigo-100 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('user.adopted-claimed-pets') }}" class="text-sm text-indigo-600 hover:underline">← Back to Claimed & Adopted Pets</a>
        </div>

        <div class="overflow-hidden bg-white shadow-xl rounded-2xl">
            <div class="px-6 py-6">
                <div class="flex items-start space-x-6">
                    <div class="w-48">
                        @if($pet->photo)
                            <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="object-cover w-full h-48 rounded-md">
                        @else
                            <div class="flex items-center justify-center w-full h-48 bg-gray-100 rounded-md">
                                <span class="text-3xl font-bold text-gray-500">{{ substr($pet->display_code, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $pet->display_code }}</h2>
                        @if(!empty($pet->name) && $pet->name !== $pet->display_code)
                            <p class="mt-1 text-sm font-medium text-gray-700">{{ $pet->name }}</p>
                        @endif
                        <p class="mt-1 text-sm text-gray-600">{{ ucfirst($pet->species ?? 'Not specified') }} • {{ $pet->breed ?: 'Not specified' }}</p>
                        <p class="mt-3 text-sm text-gray-700">{{ $pet->description ?? 'No description available.' }}</p>

                        <div class="mt-4">
                            <p class="text-sm text-gray-600"><strong>Status:</strong> {{ ucfirst($pet->status) }}</p>
                            <p class="text-sm text-gray-600"><strong>Added:</strong> {{ $pet->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 mt-6">
            @php
                $owner = $pet->user;
                // Prepare completed requests for timeline and owner display
                $completedRequest = $pet->requests->where('status', 'completed')
                    ->when($owner, function ($col) use ($owner) { return $col->where('user_id', $owner->id); })
                    ->sortByDesc('updated_at')
                    ->first();

                $latestCompleted = $pet->requests->where('status', 'completed')->sortByDesc('updated_at')->first();
                $latestClaim = $pet->requests->where('status', 'completed')->where('type', 'claim')->sortByDesc('updated_at')->first();
                $latestAdopt = $pet->requests->where('status', 'completed')->where('type', 'adopt')->sortByDesc('updated_at')->first();
            @endphp
            <!-- Pet Details (match admin view) -->
            <div class="p-6 bg-white rounded-lg shadow">
                <h3 class="mb-3 text-lg font-semibold text-gray-900">Pet Details</h3>
                <div class="grid grid-cols-1 gap-3 text-sm text-gray-700 md:grid-cols-2">
                    <div>
                        <p class="text-xs font-medium text-gray-600">Species</p>
                        <p class="font-semibold text-gray-900">{{ ucfirst($pet->species) }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-600">Breed</p>
                        <p class="font-semibold text-gray-900">{{ $pet->breed ?: 'Not specified' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-600">Gender</p>
                        <p class="font-semibold text-gray-900">{{ $pet->gender ? ucfirst($pet->gender) : 'Not specified' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-600">Estimated Age</p>
                        <p class="font-semibold text-gray-900">{{ $pet->estimated_age ?? $pet->age ?? 'Not specified' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-600">Color / Markings</p>
                        <p class="font-semibold text-gray-900">{{ $pet->color_markings ?: 'Not specified' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-600">Status</p>
                        <p class="font-semibold text-gray-900">{{ ucfirst($pet->status) }}</p>
                    </div>
                </div>
                @if($pet->description)
                    <div class="mt-4">
                        <p class="text-xs font-medium text-gray-600">Description</p>
                        <p class="mt-1 text-gray-900">{{ $pet->description }}</p>
                    </div>
                @endif
            </div>

            <!-- Timeline -->
            <div class="p-6 bg-white rounded-lg shadow">
                <h3 class="mb-3 text-lg font-semibold text-gray-900">Timeline</h3>
                <div class="grid grid-cols-1 gap-2 text-sm text-gray-700">
                    @if($pet->impounded_date)
                        <div><strong>Impounded:</strong> {{ $pet->impounded_date->format('M d, Y H:i') }}</div>
                    @endif

                    {{-- Show Adoptable Date only when appropriate. If the pet was impounded and later directly claimed (no adoptable phase), hide adoptable date. --}}
                    @if($pet->decision_date && !($pet->impounded_date && $pet->status === 'claimed'))
                        <div><strong>Adoptable Date:</strong> {{ $pet->decision_date->format('M d, Y H:i') }}</div>
                    @endif

                    {{-- Show Claim/Adopt dates with preference to completed request timestamps. --}}
                    @if($pet->status === 'claimed')
                        <div><strong>Claimed On:</strong> {{ $latestClaim ? $latestClaim->updated_at->format('M d, Y H:i') : $pet->updated_at->format('M d, Y H:i') }}</div>
                    @elseif($pet->status === 'adopted')
                        <div><strong>Adopted On:</strong> {{ $latestAdopt ? $latestAdopt->updated_at->format('M d, Y H:i') : ($latestCompleted ? $latestCompleted->updated_at->format('M d, Y H:i') : $pet->updated_at->format('M d, Y H:i')) }}</div>
                    @elseif($completedRequest)
                        <div><strong>Completed On:</strong> {{ $completedRequest->updated_at->format('M d, Y H:i') }}</div>
                    @endif
                    <div><strong>Last Updated:</strong> {{ $pet->updated_at->format('M d, Y H:i') }}</div>
                </div>
            </div>

            <!-- New Owner Information (read-only) -->
            @if($owner)
                @php
                    // Prefer latest completed request additional_data when pet is claimed/adopted
                    $displayOwner = [
                        'full_name' => $owner->name,
                        'first_name' => $owner->first_name ?? null,
                        'last_name' => $owner->last_name ?? null,
                        'email' => $owner->email,
                        'contact_number' => $owner->contact_number ?? null,
                        'street' => $owner->street ?? null,
                        'barangay' => $owner->barangay ?? null,
                        'city_municipality' => $owner->city_municipality ?? null,
                        'province' => $owner->province ?? null,
                        'zip_code' => $owner->zip_code ?? null,
                        'birthday' => $owner->birthday ? $owner->birthday->format('Y-m-d') : null,
                        'id_photo_path' => $owner->id_photo ?? null,
                    ];

                    if(in_array($pet->status, ['claimed','adopted']) && $completedRequest) {
                        $ad = is_array($completedRequest->additional_data) ? $completedRequest->additional_data : json_decode($completedRequest->additional_data, true);
                        if(!empty($ad) && is_array($ad)) {
                            $displayOwner = array_merge($displayOwner, array_filter([
                                'first_name' => $ad['first_name'] ?? null,
                                'last_name' => $ad['last_name'] ?? null,
                                'full_name' => trim(($ad['first_name'] ?? '') . ' ' . ($ad['last_name'] ?? '')) ?: ($ad['first_name'] ?? $owner->name),
                                'email' => $ad['email'] ?? $owner->email,
                                'contact_number' => $ad['contact_number'] ?? $owner->contact_number,
                                'street' => $ad['street'] ?? $owner->street,
                                'barangay' => $ad['barangay'] ?? $owner->barangay,
                                'city_municipality' => $ad['city_municipality'] ?? $owner->city_municipality,
                                'province' => $ad['province'] ?? $owner->province,
                                'zip_code' => $ad['zip_code'] ?? $owner->zip_code,
                                'birthday' => $ad['date_of_birth'] ?? $displayOwner['birthday'],
                                'id_photo_path' => $ad['id_photo_path'] ?? $displayOwner['id_photo_path'],
                            ]));
                        }
                    }
                @endphp

                <div class="p-6 bg-white rounded-lg shadow">
                    <h3 class="mb-3 text-lg font-semibold text-gray-900">New Owner Information</h3>
                    <div class="grid grid-cols-1 gap-3 text-sm text-gray-700 md:grid-cols-2">
                        <div>
                            <p class="text-xs font-medium text-gray-600">Full Name</p>
                            <p class="font-semibold text-gray-900">{{ $displayOwner['full_name'] }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-600">Email</p>
                            <p class="font-semibold text-gray-900">{{ $displayOwner['email'] }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-600">Contact</p>
                            <p class="font-semibold text-gray-900">{{ $displayOwner['contact_number'] ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-600">Complete Address</p>
                            <p class="font-semibold text-gray-900">
                                {{ trim(($displayOwner['street'] ?? '') . ' ' . ($displayOwner['barangay'] ?? '') . ' ' . ($displayOwner['city_municipality'] ?? '') . ' ' . ($displayOwner['province'] ?? '') . ' ' . ($displayOwner['zip_code'] ?? '')) ?: 'Not provided' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-600">Birthday</p>
                            <p class="font-semibold text-gray-900">{{ $displayOwner['birthday'] ? date('M d, Y', strtotime($displayOwner['birthday'])) : 'Not provided' }}</p>
                        </div>
                    </div>

                    @if(!empty($displayOwner['id_photo_path']))
                        <div class="mt-4">
                            <p class="text-xs font-medium text-gray-600">ID Photo</p>
                            <img src="{{ asset('storage/' . $displayOwner['id_photo_path']) }}" alt="Owner ID" class="object-cover w-48 h-32 mt-2 border rounded shadow-sm">
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="mt-6">
            <h3 class="mb-3 text-lg font-semibold text-gray-900">Associated Completed Requests</h3>
            @if($pet->requests && $pet->requests->count() > 0)
                <div class="space-y-3">
                    @foreach($pet->requests as $request)
                        <div class="p-4 bg-white border rounded">
                            @php
                                $additionalData = is_array($request->additional_data)
                                    ? $request->additional_data
                                    : json_decode($request->additional_data, true);
                            @endphp
                            <p class="text-sm font-semibold text-gray-900">{{ $request->type === 'adopt' ? 'Adoption' : 'Claim' }} Request — {{ $request->updated_at->format('M d, Y h:i A') }}</p>
                            <p class="mt-1 text-sm text-gray-600">Submitted by: {{ $additionalData['first_name'] ?? $request->user->name }} {{ $additionalData['last_name'] ?? '' }} • {{ $request->user->email }}</p>
                            <div class="mt-2 text-sm text-gray-700">
                                <p><strong>Contact:</strong> {{ $additionalData['contact_number'] ?? 'N/A' }}</p>
                                <p><strong>Birthday:</strong>
                                    @if(!empty($additionalData['date_of_birth']))
                                        {{ date('M d, Y', strtotime($additionalData['date_of_birth'])) }}
                                    @elseif($request->user && $request->user->birthday)
                                        {{ $request->user->birthday->format('M d, Y') }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                                @if($request->type === 'claim')
                                    <p class="mt-1"><strong>Proof:</strong> {{ $request->reason ?? 'N/A' }}</p>
                                @elseif($request->type === 'adopt')
                                    <p class="mt-1"><strong>Reason:</strong> {{ $request->reason ?? 'N/A' }}</p>
                                @endif
                            </div>

                            @if($request->photos && count($request->photos) > 0)
                                <div class="mt-3">
                                    <p class="text-sm font-semibold text-gray-700">Uploaded files:</p>
                                    <div class="flex flex-wrap gap-2 mt-2">
                                        @foreach($request->photos as $ph)
                                            <a href="{{ asset('storage/' . $ph) }}" target="_blank" class="px-3 py-1 text-sm text-indigo-600 rounded bg-indigo-50">View</a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-600">No completed requests available for this pet.</p>
            @endif
        </div>
    </div>
@endsection
