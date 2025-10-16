@extends('layouts.app')

@section('title', '| Poster Details')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <div class="bg-white rounded-lg shadow overflow-hidden max-w-4xl mx-auto">
        <img src="{{ $poster->photo ? asset('storage/' . $poster->photo) : 'https://via.placeholder.com/600x400?text=' . $poster->pet_name }}" alt="{{ $poster->pet_name }}" class="w-full h-96 object-cover">
        <div class="p-8">
            <h1 class="text-3xl font-bold mb-4">{{ $poster->pet_name }}</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <p><strong>Type:</strong> {{ ucfirst($poster->type) }}</p>
                <p><strong>Species:</strong> {{ $poster->species }} - {{ $poster->breed }}</p>
                <p><strong>Gender:</strong> {{ ucfirst($poster->gender) }}</p>
                <p><strong>Colors:</strong> {{ $poster->color_markings }}</p>
                <p><strong>Date:</strong> {{ $poster->date_lost_found->format('M d, Y') }}</p>
                <p><strong>Location:</strong> {{ $poster->location_details }}</p>
                @if($poster->reward)
                    <p><strong>Reward:</strong> ${{ $poster->reward }}</p>
                @endif
            </div>
            <p class="text-lg mb-6"><strong>Contact:</strong> {{ $poster->contact_info }}</p>
            <a href="{{ route('posters.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">Back to Posters</a>
        </div>
    </div>
</div>
@endsection
