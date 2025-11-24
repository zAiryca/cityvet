@extends('layouts.admin')

@section('title', '| Admin - Pets')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    @php
        // Define the possible statuses for the navigation tabs
        $statuses = [
            'All Pets' => null, // Link with no status filter
            'Adoptable' => 'adoptable',
            'Impounded' => 'impounded',
        ];

        // Define a readable title using universally supported if/elseif logic
        $pageTitle = 'All Pets'; // Default title
        if (isset($currentStatus)) { // Check if the variable exists and is not null
            if ($currentStatus === 'impounded') {
                $pageTitle = 'Impounded Pets';
            } elseif ($currentStatus === 'adoptable') {
                $pageTitle = 'Adoptable Pets';
            }
        }
    @endphp

    <div class="p-6 bg-white rounded-lg shadow-md">

        {{-- Dynamic Header and Create Button --}}
        <div class="flex items-center justify-between mb-6">
            {{-- This heading will now show the correct, dynamic title --}}
            <h1 class="text-3xl font-bold text-gray-800">{{ $pageTitle }}</h1>

            <a href="{{ route('admin.pets.create') }}"
               class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25">
                Add New Pet
            </a>
        </div>

        {{-- Admin Pet Search Filter --}}
        @livewire('admin-pet-search-filter')
    </div>
</div>
@endsection
