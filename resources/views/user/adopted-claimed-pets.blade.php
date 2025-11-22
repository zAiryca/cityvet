@extends('layouts.app')

@section('title', '| Claimed or Adopted Pets')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <h1 class="mb-8 text-3xl font-extrabold text-gray-900">📋 Claimed or Adopted Pets</h1>
    <p class="mb-6 text-gray-600">View all pets you have successfully claimed or adopted.</p>

    @if($pets->count() > 0)
        <div class="space-y-6">
            @foreach($pets as $pet)
                <div class="overflow-hidden transition-shadow border rounded-lg shadow-sm hover:shadow-md">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-start space-x-4">
                                @if($pet->photo)
                                    <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="object-cover w-20 h-20 rounded-lg">
                                @else
                                    <div class="flex items-center justify-center w-20 h-20 bg-gray-200 rounded-lg">
                                        <span class="text-2xl font-bold text-gray-500">{{ substr($pet->display_code, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $pet->display_code }}</h3>
                                    <p class="text-gray-600">{{ ucfirst($pet->species) }} • {{ $pet->breed ?: 'Unknown' }} • {{ $pet->estimated_age_years ? $pet->estimated_age_years . 'y' : '' }} {{ $pet->estimated_age_months ? $pet->estimated_age_months . 'm' : '' }}</p>
                                    <p class="mt-2 text-sm text-gray-500">
                                        <strong>Status:</strong>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                                            @if($pet->status === 'adopted') bg-green-100 text-green-800
                                            @elseif($pet->status === 'claimed') bg-blue-100 text-blue-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $pet->status)) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="{{ route('pets.show', $pet) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 rounded-md hover:text-indigo-700 hover:bg-indigo-50">
                                    View Pet Details →
                                </a>
                            </div>
                        </div>

                        {{-- Completed Requests Section --}}
                        @if($pet->requests && $pet->requests->count() > 0)
                            <div class="p-4 mt-4 rounded-lg bg-gray-50">
                                <h4 class="mb-3 font-semibold text-gray-900">Completed Request Details</h4>
                                <div class="space-y-3">
                                    @foreach($pet->requests as $request)
                                        <div class="p-3 bg-white border border-gray-200 rounded">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="font-semibold text-gray-900">
                                                        @php
                                                            $additionalData = is_array($request->additional_data)
                                                                ? $request->additional_data
                                                                : json_decode($request->additional_data, true);
                                                        @endphp
                                                        {{ $additionalData['first_name'] ?? $request->user->name }} {{ $additionalData['last_name'] ?? '' }}
                                                    </p>
                                                    <p class="text-sm text-gray-600">
                                                        {{ $request->user->email }} • {{ $additionalData['contact_number'] ?? 'N/A' }}
                                                    </p>
                                                    <p class="mt-1 text-xs text-gray-500">
                                                        <strong>Type:</strong> {{ ucfirst($request->type) }} Request
                                                        • <strong>Completed:</strong> {{ $request->updated_at->format('M d, Y h:i A') }}
                                                    </p>
                                                </div>
                                                <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">
                                                    ✓ Completed
                                                </span>
                                            </div>

                                            {{-- Additional Details --}}
                                            @if($request->type === 'adopt' && isset($additionalData['dwelling_type']))
                                                <div class="pt-3 mt-3 text-xs text-gray-600 border-t border-gray-100">
                                                    <p><strong>Address:</strong> {{ $additionalData['address'] ?? 'N/A' }}</p>
                                                    <p><strong>Dwelling:</strong> {{ ucfirst(str_replace('_', ' ', $additionalData['dwelling_type'])) }} • <strong>Fenced:</strong> {{ ucfirst($additionalData['fenced_property']) }}</p>
                                                    <p><strong>Household:</strong> {{ $additionalData['adults_count'] ?? 0 }} adults, {{ $additionalData['children_count'] ?? 0 }} children</p>
                                                    <p><strong>Other Pets:</strong> {{ $additionalData['other_pets'] ?? 'None' }}</p>
                                                </div>
                                            @elseif($request->type === 'claim')
                                                <div class="pt-3 mt-3 text-xs text-gray-600 border-t border-gray-100">
                                                    <p><strong>Address:</strong> {{ $additionalData['address'] ?? 'N/A' }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="p-4 mt-4 border border-yellow-200 rounded-lg bg-yellow-50">
                                <p class="text-sm text-yellow-800">ℹ️ No completed request details available.</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $pets->links() }}
        </div>
    @else
        <div class="p-12 text-center border border-gray-200 rounded-lg bg-gray-50">
            <p class="text-lg text-gray-600">You haven't claimed or adopted any pets yet.</p>
            <a href="{{ route('pets.adoptable') }}" class="inline-block mt-2 text-indigo-600 hover:underline">
                ← Browse Adoptable Pets
            </a>
        </div>
    @endif
</div>
@endsection
