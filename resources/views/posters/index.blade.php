@extends('layouts.app')

@section('title', '| Lost & Found')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Lost & Found</h1>
    <p class="mb-6">Browse or post posters for lost or found pets.</p>

    <!-- Filters -->
    <form method="GET" action="{{ route('posters.index') }}" class="bg-white p-4 rounded-lg shadow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <select name="type" class="border p-2 rounded">
                <option value="">All Types</option>
                <option value="lost" {{ request('type') == 'lost' ? 'selected' : '' }}>Lost</option>
                <option value="found" {{ request('type') == 'found' ? 'selected' : '' }}>Found</option>
            </select>
            <input type="text" name="species" placeholder="Species" value="{{ request('species') }}" class="border p-2 rounded">
            <input type="date" name="date_lost_found" value="{{ request('date_lost_found') }}" class="border p-2 rounded">
        </div>
        <button type="submit" class="mt-2 bg-purple-600 text-white px-4 py-2 rounded">Filter</button>
        <a href="{{ route('posters.index') }}" class="ml-2 text-gray-500">Clear</a>
    </form>

    @auth
        <a href="{{ route('posters.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded mb-6 inline-block">Create Poster</a>
    @endauth

    @if($posters->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posters as $poster)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ $poster->photo ? asset('storage/' . $poster->photo) : 'https://via.placeholder.com/300x200?text=' . $poster->pet_name }}" alt="{{ $poster->pet_name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-xl">{{ $poster->pet_name }}</h3>
                        <p class="text-gray-600">{{ ucfirst($poster->type) }} - {{ $poster->species }}</p>
                        <p class="text-sm text-gray-500">{{ $poster->date_lost_found->format('M d') }}</p>
                        @if($poster->reward)
                            <p class="text-green-600">${{ $poster->reward }} Reward</p>
                        @endif
                        <a href="{{ route('posters.show', $poster) }}" class="block mt-4 bg-purple-600 text-white py-2 rounded text-center">View Details</a>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $posters->appends(request()->query())->links() }}
    @else
        <p class="text-gray-500 text-center py-8">No posters found.</p>
        @auth
            <a href="{{ route('posters.create') }}" class="block mx-auto text-center bg-purple-600 text-white px-6 py-3 rounded w-48">Post a Poster</a>
        @else
            <a href="{{ route('login') }}" class="block mx-auto text-center bg-blue-600 text-white px-6 py-3 rounded w-48">Login to Post</a>
        @endauth
    @endif
</div>
@endsection
