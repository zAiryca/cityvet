@extends('layouts.admin')

@section('title', 'Pet Registrations Management')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">

    @php
        // Define the possible statuses for the navigation tabs
        $statuses = [
            'All' => null,
            'Pending' => 'pending',
            'Registered' => 'registered',
            'Denied' => 'denied',
        ];

        // Define a readable title using universally supported if/elseif logic
        $pageTitle = 'All Pet Registrations';
        if (isset($currentRegistrationStatus)) {
            if ($currentRegistrationStatus === 'pending') {
                $pageTitle = 'Pending Pet Registrations';
            } elseif ($currentRegistrationStatus === 'registered') {
                $pageTitle = 'Registered Pets';
            } elseif ($currentRegistrationStatus === 'denied') {
                $pageTitle = 'Denied Pet Registrations';
            }
        }
    @endphp

    <div class="p-6 bg-white rounded-lg shadow-md">

        {{-- Dynamic Header --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $pageTitle }}</h1>
        </div>

        {{-- Admin Pet Registration Search Filter --}}
        @livewire('admin-pet-registration-search-filter')
    </div>

</div>
@endsection
