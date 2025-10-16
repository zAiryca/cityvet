@extends('layouts.app')

@section('title', '| Pets')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold mb-6 text-center">CityVet Pets</h1>

    {{-- Impounded Pets Section --}}
    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Impounded Pets</h2>
    @if($impoundedPets->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            @foreach($impoundedPets as $pet)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ $pet->photo ? asset('storage/' . $pet->photo) : 'https://via.placeholder.com/300x200?text=' . $pet->name }}" alt="{{ $pet->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-xl">{{ $pet->name }}</h3>
                        <p class="text-gray-600">{{ ucfirst($pet->species) }} - {{ ucfirst($pet->breed) }}</p>
                        <p class="text-sm text-gray-500">Impounded: {{ $pet->impounded_date ? $pet->impounded_date->format('M d, Y') : 'N/A' }}</p>
                        <p class="mt-2 text-gray-700 text-sm">{{ $pet->description }}</p>

                        @auth
                        <form method="POST" action="{{ route('pets.request', $pet) }}" class="mt-4">
                            @csrf
                            <input type="hidden" name="type" value="claim">
                            <textarea name="reason" rows="2" placeholder="Reason for claim..." class="border rounded w-full p-2 text-sm mb-2" required></textarea>
                            <input type="text" name="contact_info" placeholder="Your contact info" class="border rounded w-full p-2 text-sm mb-2" required>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">Claim Pet</button>
                        </form>
                        @else
                            <a href="{{ route('login') }}" class="block mt-4 bg-blue-600 text-white py-2 rounded text-center">Login to Claim</a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 mb-10">No impounded pets available right now.</p>
    @endif


    {{-- Adoptable Pets Section --}}
    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Adoptable Pets</h2>
    @if($adoptablePets->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($adoptablePets as $pet)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ $pet->photo ? asset('storage/' . $pet->photo) : 'https://via.placeholder.com/300x200?text=' . $pet->name }}" alt="{{ $pet->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-xl">{{ $pet->name }}</h3>
                        <p class="text-gray-600">{{ ucfirst($pet->species) }} - {{ ucfirst($pet->breed) }}</p>
                        @if($pet->urgent_deadline)
                            <p class="text-red-600 font-semibold text-sm">Urgent until {{ $pet->urgent_deadline->format('M d, Y') }}</p>
                        @endif
                        <p class="mt-2 text-gray-700 text-sm">{{ $pet->description }}</p>

                        @auth
                        <form method="POST" action="{{ route('pets.request', $pet) }}" class="mt-4">
                            @csrf
                            <input type="hidden" name="type" value="adopt">
                            <textarea name="reason" rows="2" placeholder="Why do you want to adopt?" class="border rounded w-full p-2 text-sm mb-2" required></textarea>
                            <input type="text" name="contact_info" placeholder="Your contact info" class="border rounded w-full p-2 text-sm mb-2" required>
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">Adopt Pet</button>
                        </form>
                        @else
                            <a href="{{ route('login') }}" class="block mt-4 bg-green-600 text-white py-2 rounded text-center">Login to Adopt</a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 text-center py-8">No adoptable pets at the moment.</p>
    @endif
</div>
@endsection
