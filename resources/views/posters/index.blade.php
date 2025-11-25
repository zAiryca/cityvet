@extends('layouts.app')

@section('title', '| Lost & Found')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-green-50 pt-24">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <div class="bg-white rounded-full p-3 shadow-sm mr-4 border-2 border-pink-100">
                    <i class="fas fa-search text-2xl text-purple-600"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Lost & Found Pets</h1>
                    <p class="text-gray-600 mt-1">Browse or post posters for lost or found pets</p>
                </div>
            </div>
            @auth
                <a href="{{ route('posters.create') }}"
                   class="px-6 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition-all duration-200 font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center">
                    <i class="fas fa-plus mr-2"></i>Create Poster
                </a>
            @endauth
        </div>

        <!-- Search Filter Section -->
        <div class="bg-white rounded-2xl shadow-lg border border-blue-100 p-6 mb-12">
            @livewire('poster-search-filter')
        </div>
    </div>
</div>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

