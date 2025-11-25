@extends('layouts.app')

@section('title', '| Pet Details')

@section('content')
<div class="min-h-screen bg-gray-50 pt-24">
    <div class="max-w-6xl mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl font-bold text-gray-900">{{ $pet->display_code }}</h1>
                <div class="flex items-center mt-1">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if($pet->status === 'adopted') bg-green-100 text-green-800
                        @elseif($pet->status === 'claimed') bg-blue-100 text-blue-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($pet->status) }}
                    </span>
                    <span class="ml-2 text-sm text-gray-500">Added {{ $pet->created_at->format('M d, Y') }}</span>
                </div>
            </div>
            <a href="{{ route('user.adopted-claimed-pets') }}"
               class="inline-flex items-center px-4 py-2 text-sm font-medium bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to List
            </a>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Photo & Basic Info -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Photo Section -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    @if($pet->photo)
                        <img src="{{ asset('storage/' . $pet->photo) }}"
                             alt="{{ $pet->display_code }}"
                             class="w-full h-64 sm:h-80 object-cover">
                    @else
                        <div class="w-full h-64 sm:h-80 bg-gradient-to-br from-blue-50 to-indigo-100 flex flex-col items-center justify-center p-4">
                            <svg class="w-16 h-16 text-gray-400 mb-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-gray-500 text-center">No photo available</p>
                        </div>
                    @endif
                </div>

                <!-- Supporting Evidence Section -->
                @if($request->photos)
                    @php
                        $photos = is_array($request->photos) ? $request->photos : json_decode($request->photos, true);
                    @endphp
                    @if(is_array($photos) && count($photos) > 0)
                        <div class="bg-white rounded-xl shadow-sm p-5">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Supporting Evidence</h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                @foreach($photos as $photo)
                                    <div class="group relative overflow-hidden rounded-lg bg-gray-100 aspect-square">
                                        <img src="{{ asset('storage/' . $photo) }}"
                                             alt="Supporting evidence"
                                             class="w-full h-full object-cover transition-transform group-hover:scale-105">
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
            </div>

            <!-- Right Column: Details & Info Cards -->
            <div class="space-y-6">
                <!-- Quick Info Card -->
                <div class="bg-white rounded-xl shadow-sm p-5">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Quick Info</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Species</span>
                            <span class="font-medium">{{ ucfirst($pet->species ?? 'N/A') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Breed</span>
                            <span class="font-medium">{{ $pet->breed ?: 'Not specified' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Gender</span>
                            <span class="font-medium">{{ ucfirst($pet->gender ?? 'N/A') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Age</span>
                            <span class="font-medium">
                                {{ $pet->estimated_age_years ? $pet->estimated_age_years . 'y' : '' }}
                                {{ $pet->estimated_age_months ? $pet->estimated_age_months . 'm' : 'N/A' }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Color</span>
                            <span class="font-medium">{{ $pet->color_markings ?: 'Not specified' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Timeline Card -->
                <div class="bg-white rounded-xl shadow-sm p-5">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Timeline</h3>
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

                    <div class="bg-white rounded-xl shadow-sm p-5">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b">Owner Information</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-gray-600 text-sm">Name</p>
                                <p class="font-medium">{{ $displayOwner['full_name'] }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Email</p>
                                <p class="font-medium">{{ $displayOwner['email'] }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Phone</p>
                                <p class="font-medium">{{ $displayOwner['contact_number'] }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Address</p>
                                <p class="font-medium">{{ $displayOwner['address'] ?: 'Not provided' }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
