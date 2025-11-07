@extends('layouts.app')

@section('title', '| Lost & Found')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Lost & Found</h1>
    <p class="mb-6">Browse or post posters for lost or found pets.</p>

    @auth
        <a href="{{ route('posters.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded mb-6 inline-block">Create Poster</a>
    @endauth

    @livewire('poster-search-filter')
</div>
@endsection
