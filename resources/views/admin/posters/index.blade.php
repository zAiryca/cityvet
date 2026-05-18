@extends('layouts.admin')

@section('title', '| Admin - Posters')

@section('content')
<div class="px-4 py-4 mx-auto max-w-7xl" style="font-family: 'Poppins', sans-serif;">
    <div class="flex flex-col mb-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Poppins', sans-serif;">Manage Lost & Found Posters</h1>
            <p class="mt-1 text-sm text-gray-600" style="font-family: 'Poppins', sans-serif;">Manage and monitor all lost and found pet posters</p>
        </div>
    </div>

    <!-- Livewire Search Filter Component -->
    @livewire('admin-poster-search-filter')
</div>
@endsection
