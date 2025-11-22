@extends('layouts.admin')

@section('title', '| Adoption & Claim History')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <div class="p-6 bg-white rounded-lg shadow-md">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">📋 Adoption & Claim History</h1>
                <p class="text-gray-600 mt-2">Shows pets that have a completed adoption or claim request. Only fully completed processes appear here.</p>
            </div>
        </div>

        {{-- Status Filter Tabs --}}
        <div class="mb-6 border-b border-gray-200">
            <nav class="flex pb-2 space-x-4 overflow-x-auto">
                <a href="{{ route('admin.adoption-claim-history') }}"
                   class="@if(!request('status')) border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 @endif whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                    All History
                </a>
                <a href="{{ route('admin.adoption-claim-history', ['status' => 'adopted']) }}"
                   class="@if(request('status') === 'adopted') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 @endif whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                    ✅ Adopted
                </a>
                <a href="{{ route('admin.adoption-claim-history', ['status' => 'claimed']) }}"
                   class="@if(request('status') === 'claimed') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 @endif whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                    🎯 Claimed
                </a>
                <a href="{{ route('admin.adoption-claim-history', ['status' => 'unclaimed']) }}"
                   class="@if(request('status') === 'unclaimed') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 @endif whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                    ❌ Unclaimed/Unadopted
                </a>
            </nav>
        </div>

        @if($pets->count() > 0)
            <div class="space-y-6">
                @foreach($pets as $pet)
                    <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-start space-x-4">
                                    @if($pet->photo)
                                        <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="w-20 h-20 object-cover rounded-lg">
                                    @else
                                        <div class="flex items-center justify-center w-20 h-20 bg-gray-200 rounded-lg">
                                            <span class="text-2xl font-bold text-gray-500">{{ substr($pet->display_code, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-900">{{ $pet->display_code }}</h3>
                                        <p class="text-gray-600">{{ ucfirst($pet->species) }} • {{ $pet->breed ?: 'Unknown' }} • {{ $pet->estimated_age_years ? $pet->estimated_age_years . 'y' : '' }} {{ $pet->estimated_age_months ? $pet->estimated_age_months . 'm' : '' }}</p>
                                        <p class="text-sm text-gray-500 mt-2">
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
                                    <a href="{{ route('admin.pets.show', $pet) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 hover:text-indigo-700 hover:bg-indigo-50 rounded-md">
                                        View Pet Details →
                                    </a>
                                </div>
                            </div>

                            {{-- Completed Requests Section --}}
                            @if($pet->requests && $pet->requests->count() > 0)
                                <div class="bg-gray-50 rounded-lg p-4 mt-4">
                                    <h4 class="font-semibold text-gray-900 mb-3">Completed Requests</h4>
                                    <div class="space-y-3">
                                        @foreach($pet->requests as $request)
                                            <div class="bg-white p-3 rounded border border-gray-200">
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
                                                        <p class="text-xs text-gray-500 mt-1">
                                                            <strong>Type:</strong> {{ ucfirst($request->type) }} Request
                                                            • <strong>Completed:</strong> {{ $request->updated_at->format('M d, Y h:i A') }}
                                                        </p>
                                                    </div>
                                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                        ✓ Completed
                                                    </span>
                                                </div>

                                                {{-- Additional Details --}}
                                                @if($request->type === 'adopt' && isset($additionalData['dwelling_type']))
                                                    <div class="mt-3 pt-3 border-t border-gray-100 text-xs text-gray-600">
                                                        <p><strong>Address:</strong> {{ $additionalData['address'] ?? 'N/A' }}</p>
                                                        <p><strong>Dwelling:</strong> {{ ucfirst(str_replace('_', ' ', $additionalData['dwelling_type'])) }} • <strong>Fenced:</strong> {{ ucfirst($additionalData['fenced_property']) }}</p>
                                                        <p><strong>Household:</strong> {{ $additionalData['adults_count'] ?? 0 }} adults, {{ $additionalData['children_count'] ?? 0 }} children</p>
                                                        <p><strong>Other Pets:</strong> {{ $additionalData['other_pets'] ?? 'None' }}</p>
                                                    </div>
                                                @elseif($request->type === 'claim')
                                                    <div class="mt-3 pt-3 border-t border-gray-100 text-xs text-gray-600">
                                                        <p><strong>Address:</strong> {{ $additionalData['address'] ?? 'N/A' }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mt-4">
                                    <p class="text-sm text-yellow-800">ℹ️ No completed requests recorded for this pet.</p>
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
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-12 text-center">
                <p class="text-gray-600 text-lg">No adoption or claim history found.</p>
                <a href="{{ route('admin.pets.index') }}" class="text-indigo-600 hover:underline mt-2 inline-block">
                    ← Back to Active Pets
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
