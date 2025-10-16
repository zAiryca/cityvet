@extends('layouts.app')

@section('title', '| Create Poster')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Create Lost or Found Poster</h1>
    <p class="mb-6">Your poster will be reviewed by an admin before going live.</p>

    <form action="{{ route('posters.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow max-w-2xl">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Type</label>
                <div class="mt-2 space-y-2">
                    <label class="flex items-center">
                        <input type="radio" name="type" value="lost" {{ old('type') === 'lost' ? 'checked' : '' }} class="mr-2" required>
                        Lost Pet
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="type" value="found" {{ old('type') === 'found' ? 'checked' : '' }} class="mr-2" required>
                        Found Pet
                    </label>
                </div>
                @error('type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Pet Name</label>
                <input type="text" name="pet_name" value="{{ old('pet_name') }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('pet_name') border-red-500 @enderror">
                @error('pet_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                    <label class="block text-sm font-medium text-gray-700">Colors/Markings</label>
                    <input type="text" name="color_markings" value="{{ old('color_markings') }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('color_markings') border-red-500 @enderror">
                    @error('color_markings') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Date Lost/Found</label>
                <input type="date" name="date_lost_found" value="{{ old('date_lost_found') }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('date_lost_found') border-red-500 @enderror">
                @error('date_lost_found') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Location Details</label>
                <textarea name="location_details" rows="3" placeholder="Last seen or found at..." {{ old('location_details') }} class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('location_details') border-red-500 @enderror" required></textarea>
                @error('location_details') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Photo</label>
                <input type="file" name="photo" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('photo') border-red-500 @enderror">
                @error('photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Contact Info</label>
                <input type="text" name="contact_info" value="{{ old('contact_info') }}" placeholder="Email and/or phone" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('contact_info') border-red-500 @enderror">
                @error('contact_info') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Reward (Optional, for lost pets)</label>
                <input type="number" name="reward" step="0.01" value="{{ old('reward') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                @error('reward') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('posters.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700">Cancel</a>
                <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-md hover:bg-purple-700">Submit for Review</button>
            </div>
        </div>
    </form>
</div>
@endsection
