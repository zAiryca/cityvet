@extends('layouts.app')

@section('title', '| Admin - Edit Pet')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Edit Pet: {{ $pet->name }}</h1>
    <form action="{{ route('admin.pets.update', $pet) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow max-w-2xl">
        @csrf @method('PATCH')
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name', $pet->name) }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('name') border-red-500 @enderror">
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Species</label>
                    <input type="text" name="species" value="{{ old('species', $pet->species) }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('species') border-red-500 @enderror">
                    @error('species') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Breed</label>
                    <input type="text" name="breed" value="{{ old('breed', $pet->breed) }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('breed') border-red-500 @enderror">
                    @error('breed') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('gender') border-red-500 @enderror">
                    <option value="">Select</option>
                    <option value="male" {{ old('gender', $pet->gender) === 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $pet->gender) === 'female' ? 'selected' : '' }}>Female</option>
                    <option value="unknown" {{ old('gender', $pet->gender) === 'unknown' ? 'selected' : '' }}>Unknown</option>
                </select>
                @error('gender') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4" {{ old('description', $pet->description) }} class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('description') border-red-500 @enderror"></textarea>
                @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('status') border-red-500 @enderror">
                    <option value="impounded" {{ old('status', $pet->status) === 'impounded' ? 'selected' : '' }}>Impounded</option>
                    <option value="adoptable" {{ old('status', $pet->status) === 'adoptable' ? 'selected' : '' }}>Adoptable</option>
                    <option value="registered" {{ old('status', $pet->status) === 'registered' ? 'selected' : '' }}>Registered</option>
                </select>
                @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Impounded Date (if applicable)</label>
                    <input type="date" name="impounded_date" value="{{ old('impounded_date', $pet->impounded_date ? $pet->impounded_date->format('Y-m-d') : '') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('impounded_date') border-red-500 @enderror">
                    @error('impounded_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Urgent Deadline (for adoptable)</label>
                    <input type="date" name="urgent_deadline" value="{{ old('urgent_deadline', $pet->urgent_deadline ? $pet->urgent_deadline->format('Y-m-d') : '') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('urgent_deadline') border-red-500 @enderror">
                    @error('urgent_deadline') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Photo (current: {{ $pet->photo ? 'Uploaded' : 'None' }})</label>
                <input type="file" name="photo" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('photo') border-red-500 @enderror">
                @error('photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                @if($pet->photo)
                    <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->name }}" class="mt-2 h-24 w-24 object-cover rounded">
                @endif
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.pets.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">Update Pet</button>
            </div>
        </div>
    </form>
</div>
@endsection
