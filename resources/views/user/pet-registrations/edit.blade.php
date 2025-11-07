<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pet Pre-Registration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('pet-registrations.update', $pet) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Pet Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $pet->name) }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('name') border-red-500 @enderror">
                                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Species -->
                            <div>
                                <label for="species" class="block text-sm font-medium text-gray-700">Species</label>
                                <select name="species" id="species" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('species') border-red-500 @enderror">
                                    <option value="">Select Species</option>
                                    <option value="Feline" {{ old('species', $pet->species) == 'Feline' ? 'selected' : '' }}>Feline</option>
                                    <option value="Canine" {{ old('species', $pet->species) == 'Canine' ? 'selected' : '' }}>Canine</option>
                                </select>
                                @error('species') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Breed -->
                            <div>
                                <label for="breed" class="block text-sm font-medium text-gray-700">Breed</label>
                                <input type="text" name="breed" id="breed" value="{{ old('breed', $pet->breed) }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('breed') border-red-500 @enderror">
                                @error('breed') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Birth Date -->
                            <div>
                                <label for="birth_date" class="block text-sm font-medium text-gray-700">Birth Date</label>
                                <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date', $pet->birth_date ? $pet->birth_date->format('Y-m-d') : '') }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('birth_date') border-red-500 @enderror">
                                @error('birth_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Gender -->
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                <select name="gender" id="gender" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('gender') border-red-500 @enderror">
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ old('gender', $pet->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender', $pet->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <!-- Color Markings -->
                            <div>
                                <label for="color_markings" class="block text-sm font-medium text-gray-700">Color Markings</label>
                                <input type="text" name="color_markings" id="color_markings" value="{{ old('color_markings', $pet->color_markings) }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('color_markings') border-red-500 @enderror">
                                @error('color_markings') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('description') border-red-500 @enderror">{{ old('description', $pet->description) }}</textarea>
                            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Current Photo -->
                        @if($pet->photo)
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700">Current Photo</label>
                                <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->name }}" class="max-w-xs rounded-lg shadow-md mt-2">
                            </div>
                        @endif

                        <!-- Photo -->
                        <div class="mt-6">
                            <label for="photo" class="block text-sm font-medium text-gray-700">Update Photo (optional)</label>
                            <input type="file" name="photo" id="photo" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('photo') border-red-500 @enderror">
                            @error('photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('pet-registrations.show', $pet) }}" class="mr-4 text-gray-600 hover:text-gray-900">Cancel</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Pre-Registration
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
