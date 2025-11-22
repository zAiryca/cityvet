@extends('layouts.app')

@section('title', '| Pet Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('user.adopted-claimed-pets') }}" class="text-sm text-indigo-600 hover:underline">← Back to Claimed & Adopted Pets</a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
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
                        <p class="mt-1 text-sm text-gray-600">{{ ucfirst($pet->species) }} • {{ $pet->breed ?: 'Unknown' }}</p>
                        <p class="mt-3 text-sm text-gray-700">{{ $pet->description ?? 'No description available.' }}</p>

                        <div class="mt-4">
                            <p class="text-sm text-gray-600"><strong>Status:</strong> {{ ucfirst($pet->status) }}</p>
                            <p class="text-sm text-gray-600"><strong>Added:</strong> {{ $pet->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <h3 class="mb-3 text-lg font-semibold text-gray-900">Associated Completed Requests</h3>
            @if($pet->requests && $pet->requests->count() > 0)
                <div class="space-y-3">
                    @foreach($pet->requests as $request)
                        <div class="p-4 border rounded bg-white">
                            @php
                                $additionalData = is_array($request->additional_data)
                                    ? $request->additional_data
                                    : json_decode($request->additional_data, true);
                            @endphp
                            <p class="text-sm font-semibold text-gray-900">{{ $request->type === 'adopt' ? 'Adoption' : 'Claim' }} Request — {{ $request->updated_at->format('M d, Y h:i A') }}</p>
                            <p class="mt-1 text-sm text-gray-600">Submitted by: {{ $additionalData['first_name'] ?? $request->user->name }} {{ $additionalData['last_name'] ?? '' }} • {{ $request->user->email }}</p>
                            <div class="mt-2 text-sm text-gray-700">
                                <p><strong>Contact:</strong> {{ $additionalData['contact_number'] ?? 'N/A' }}</p>
                                @if($request->type === 'claim')
                                    <p class="mt-1"><strong>Proof:</strong> {{ $request->reason ?? 'N/A' }}</p>
                                @elseif($request->type === 'adopt')
                                    <p class="mt-1"><strong>Reason:</strong> {{ $request->reason ?? 'N/A' }}</p>
                                @endif
                            </div>

                            @if($request->photos && count($request->photos) > 0)
                                <div class="mt-3">
                                    <p class="text-sm text-gray-700 font-semibold">Uploaded files:</p>
                                    <div class="flex flex-wrap mt-2 gap-2">
                                        @foreach($request->photos as $ph)
                                            <a href="{{ asset('storage/' . $ph) }}" target="_blank" class="px-3 py-1 text-sm text-indigo-600 bg-indigo-50 rounded">View</a>
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
