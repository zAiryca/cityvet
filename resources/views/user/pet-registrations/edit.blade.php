@extends('layouts.app')

@section('title', '| Edit Pet Registration')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Edit Pet Registration</h1>
    <p class="mb-6">Update your pet registration details.</p>

    <form action="{{ route('pet-registrations.update', $petRegistration) }}" method="POST" enctype="multipart/form-data" class="max-w-4xl bg-white rounded-lg shadow p-6">
        @csrf
        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="pet_name" class="block text-sm font-medium text-gray-700">Pet Name</label>
                                <input type="text" name="pet_name" id="pet_name" value="{{ old('pet_name', $petRegistration->pet_name) }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('pet_name') border-red-500 @enderror">
                                @error('pet_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Species -->
                            <div>
                                <label for="species" class="block text-sm font-medium text-gray-700">Species</label>
                                <select name="species" id="species" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('species') border-red-500 @enderror">
                                    <option value="">Select Species</option>
                                    <option value="Feline" {{ old('species', $petRegistration->species) == 'Feline' ? 'selected' : '' }}>Feline</option>
                                    <option value="Canine" {{ old('species', $petRegistration->species) == 'Canine' ? 'selected' : '' }}>Canine</option>
                                </select>
                                @error('species') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Breed -->
                            <div>
                                <label for="breed" class="block text-sm font-medium text-gray-700">Breed</label>
                                <input type="text" name="breed" id="breed" value="{{ old('breed', $petRegistration->breed) }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('breed') border-red-500 @enderror">
                                @error('breed') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Birthday -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Birthday</label>
                                <input type="date" name="birthday" value="{{ old('birthday', $petRegistration->birthday ? $petRegistration->birthday->format('Y-m-d') : '') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('birthday') border-red-500 @enderror">
                                @error('birthday') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Gender -->
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                <select name="gender" id="gender" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('gender') border-red-500 @enderror">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender', $petRegistration->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $petRegistration->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="unknown" {{ old('gender', $petRegistration->gender) == 'unknown' ? 'selected' : '' }}>Unknown</option>
                                </select>
                                @error('gender') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Color Markings -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Color Markings</label>
                                <div class="grid grid-cols-2 gap-2">
                                    @php
                                        $colors = ['Black', 'White', 'Brown', 'Gray', 'Orange', 'Cream', 'Red', 'Tabby'];
                                        $selectedColors = old('color_markings', is_array($petRegistration->color_markings) ? $petRegistration->color_markings : []);
                                    @endphp
                                    @foreach($colors as $color)
                                        <label class="flex items-center">
                                            <input type="checkbox" name="color_markings[]" value="{{ $color }}" {{ in_array($color, $selectedColors) ? 'checked' : '' }} class="mr-2">
                                            {{ $color }}
                                        </label>
                                    @endforeach
                                </div>
                                @error('color_markings') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('description') border-red-500 @enderror">{{ old('description', $petRegistration->description) }}</textarea>
                            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Current Photo -->
                        @if($petRegistration->photo)
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700">Current Photo</label>
                                <img src="{{ asset('storage/' . $petRegistration->photo) }}" alt="{{ $petRegistration->pet_name }}" class="max-w-xs rounded-lg shadow-md mt-2">
                            </div>
                        @endif

                        <!-- Photo -->
                        <div class="mt-6">
                            <label for="photo" class="block text-sm font-medium text-gray-700">Update Photo (optional)</label>
                            <input type="file" name="photo" id="photo" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('photo') border-red-500 @enderror">
                            @error('photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('pet-registrations.show', $petRegistration) }}" class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Update</button>
        </div>
    </form>
</div>
@endsection
