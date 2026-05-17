@extends('layouts.admin')

@section('title', 'Pet Registrations Management')

@section('content')
<div class="px-4 py-4 mx-auto max-w-7xl" style="font-family: 'Poppins', sans-serif;">
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

    <div class="flex flex-col mb-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Poppins', sans-serif;">{{ $pageTitle }}</h1>
            <p class="mt-1 text-sm text-gray-600" style="font-family: 'Poppins', sans-serif;">Manage pet registration requests and approvals</p>
        </div>
    </div>

    {{-- Admin Pet Registration Search Filter --}}
    @livewire('admin-pet-registration-search-filter')
</div>
@endsection
