@extends('layouts.app')

@section('title', '| All Pets')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold mb-6 text-center">Our Pets</h1>

    @if($pets->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($pets as $pet)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ $pet->photo ? asset('storage/' . $pet->photo) : 'https://via.placeholder.com/300x200?text=' . $pet->name }}" alt="{{ $pet->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-xl">{{ $pet->name }}</h3>
                        <p class="text-gray-600">{{ ucfirst($pet->species) }} - {{ ucfirst($pet->breed) }}</p>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                            Status: {{ ucfirst($pet->status) }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $pets->links() }}
        </div>
    @else
        <p class="text-gray-500 text-center py-8">There are no pets listed.</p>
    @endif
</div>
@endsection
