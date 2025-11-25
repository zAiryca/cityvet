@extends('layouts.app')

@section('title', '| Pet Details')

@section('content')
<div class="min-h-screen bg-gray-50 pt-24">
    <div class="max-w-5xl mx-auto px-3 py-4">
        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-900">{{ $pet->display_code }} - {{ ucfirst($pet->status) }}</h1>
            <a href="{{ route('user.adopted-claimed-pets') }}"
               class="px-4 py-2 text-sm bg-gray-600 text-white rounded hover:bg-gray-700">
                ← Back
            </a>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <!-- Left: Pet Photo & Quick Info -->
            <div class="space-y-3">
                <!-- Photo -->
                <div class="bg-white rounded-lg shadow">
                    @if($pet->photo)
                        <img src="{{ asset('storage/' . $pet->photo) }}"
                             alt="{{ $pet->display_code }}"
                             class="w-full h-56 object-cover rounded-lg">
                    @else
                        <div class="w-full h-56 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-lg flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z" />
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Quick Info Cards -->
                <div class="bg-white rounded-lg shadow p-3 space-y-2">
                    <p class="text-sm"><strong>Species:</strong> {{ ucfirst($pet->species ?? 'N/A') }}</p>
                    <p class="text-sm"><strong>Breed:</strong> {{ $pet->breed ?: 'Not specified' }}</p>
                    <p class="text-sm"><strong>Gender:</strong> {{ ucfirst($pet->gender ?? 'N/A') }}</p>
                    <p class="text-sm"><strong>Age:</strong> {{ $pet->estimated_age_years ? $pet->estimated_age_years . 'y' : '' }} {{ $pet->estimated_age_months ? $pet->estimated_age_months . 'm' : 'N/A' }}</p>
                    <p class="text-sm"><strong>Color:</strong> {{ $pet->color_markings ?: 'Not specified' }}</p>
                    @if($pet->status === 'adopted')
                        <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded text-xs font-medium">✓ Adopted</span>
                    @elseif($pet->status === 'claimed')
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded text-xs font-medium">✓ Claimed</span>
                    @endif
                </div>
            </div>

            <!-- Right: Details & Owner Info -->
            <div class="space-y-3">
                <!-- Pet Details -->
                <div class="bg-white rounded-lg shadow p-3">
                    <h3 class="text-sm font-bold mb-2 border-b pb-2">Pet Details</h3>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <p><strong>Code:</strong> {{ $pet->display_code }}</p>
                        <p><strong>Added:</strong> {{ $pet->created_at->format('M d, Y') }}</p>
                        <p><strong>Description:</strong> {{ substr($pet->description ?? 'No description', 0, 100) }}{{ strlen($pet->description ?? '') > 100 ? '...' : '' }}</p>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="bg-white rounded-lg shadow p-3">
                    <h3 class="text-sm font-bold mb-2 border-b pb-2">Timeline</h3>
                    <div class="space-y-1 text-sm">
                        @if($pet->impounded_date)
                            <p><strong>Impounded:</strong> {{ $pet->impounded_date->format('M d, Y') }}</p>
                        @endif
                        @if($pet->decision_date && !($pet->impounded_date && $pet->status === 'claimed'))
                            <p><strong>Available:</strong> {{ $pet->decision_date->format('M d, Y') }}</p>
                        @endif
                        @if($pet->status === 'claimed')
                            <p><strong>Claimed:</strong> {{ $latestClaim ? $latestClaim->updated_at->format('M d, Y') : $pet->updated_at->format('M d, Y') }}</p>
                        @elseif($pet->status === 'adopted')
                            <p><strong>Adopted:</strong> {{ $latestAdopt ? $latestAdopt->updated_at->format('M d, Y') : $pet->updated_at->format('M d, Y') }}</p>
                        @endif
                        <p><strong>Updated:</strong> {{ $pet->updated_at->format('M d, Y') }}</p>
                    </div>
                </div>

                <!-- Owner Info -->
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

                    <div class="bg-white rounded-lg shadow p-3">
                        <h3 class="text-sm font-bold mb-2 border-b pb-2">Owner Information</h3>
                        <div class="space-y-1 text-sm">
                            <p><strong>Name:</strong> {{ $displayOwner['full_name'] }}</p>
                            <p><strong>Email:</strong> {{ $displayOwner['email'] }}</p>
                            <p><strong>Phone:</strong> {{ $displayOwner['contact_number'] }}</p>
                            <p><strong>Address:</strong> {{ $displayOwner['address'] ?: 'Not provided' }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Photos Gallery (if any) -->
        @if($request->photos)
            @php
                $photos = is_array($request->photos) ? $request->photos : json_decode($request->photos, true);
            @endphp
            @if(is_array($photos) && count($photos) > 0)
                <div class="bg-white rounded-lg shadow p-3 mt-4">
                    <h3 class="text-sm font-bold mb-2 border-b pb-2">Uploaded Photos</h3>
                    <div class="grid grid-cols-3 md:grid-cols-4 gap-2">
                        @foreach($photos as $photo)
                            <img src="{{ asset('storage/' . $photo) }}" alt="Photo" class="w-full h-20 object-cover rounded">
                        @endforeach
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>

@endsection

