@extends('layouts.admin')

@section('title', '| Admin - Posters')

@section('content')
<div class="px-6 py-8 mx-auto max-w-7xl">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Manage Lost & Found Posters</h1>
        <p class="mt-2 text-gray-600">Manage and monitor all lost and found pet posters</p>
    </div>

    <!-- Livewire Search Filter Component -->
    @livewire('admin-poster-search-filter')
</div>
@endsection
