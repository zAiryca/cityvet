@extends('layouts.app')

@section('title', '| Profile')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">My Profile</h1>

    <div class="bg-white p-6 rounded-lg shadow mb-8">
        <h2 class="text-xl font-bold mb-4">Account Info</h2>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
        <!-- Edit profile form can be added here later -->
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Registered Pets List -->
        <div>
            <h2 class="text-xl font-bold mb-4">My Registered Pets</h2>
            @if($pets->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    @foreach($pets as $pet)
                        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                            <img src="{{ $pet->photo ? asset('storage/' . $pet->photo) : 'https://via.placeholder.com/100?text=' . $pet->name }}" alt="{{ $pet->name }}" class="w-full h-24 object-cover rounded mb-2">
                            <h3 class="font-bold">{{ $pet->name }}</h3>
                            <p class="text-gray-600">{{ $pet->species }} - {{ $pet->breed }}</p>
                            <p class="text-sm text-gray-500">{{ Str::limit($pet->description, 50) }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 mb-6">No registered pets yet. Register one below to use for events or adoptions!</p>
            @endif
        </div>

        <!-- Register New Pet Form -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Register a New Pet</h2>
            <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('name') border-red-500 @enderror">
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Species</label>
                        <input type="text" name="species" value="{{ old('species') }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('species') border-red-500 @enderror">
                        @error('species') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Breed</label>
                        <input type="text" name="breed" value="{{ old('breed') }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('breed') border-red-500 @enderror">
                        @error('breed') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="3" placeholder="About your pet..." {{ old('description') }} class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('description') border-red-500 @enderror"></textarea>
                    @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('gender') border-red-500 @enderror">
                        <option value="">Select</option>
                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                        <option value="unknown" {{ old('gender') === 'unknown' ? 'selected' : '' }}>Unknown</option>
                    </select>
                    @error('gender') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Photo</label>
                    <input type="file" name="photo" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('photo') border-red-500 @enderror">
                    @error('photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Register Pet</button>
            </form>
        </div>
    </div>
</div>
@endsection
