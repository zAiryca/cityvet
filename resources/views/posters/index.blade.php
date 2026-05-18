@extends('layouts.app')

@section('title', '| Lost & Found')

@section('content')
<div class="px-4 py-6 pt-24 mx-auto max-w-7xl" style="font-family: Georgia, serif;">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold"><span style="color: #23bd04d2">Lost & Found</span> Pets</h1>
                <p class="mt-1 text-gray-600">Browse or post posters for lost or found pets</p>
            </div>
            @auth
                <a href="{{ route('posters.create') }}"
                   class="px-6 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition-all duration-200 font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center">
                    <i class="mr-2 fas fa-plus"></i>Create Poster
                </a>
            @endauth
        </div>

        @livewire('poster-search-filter')
    </div>
</div>

@endsection
