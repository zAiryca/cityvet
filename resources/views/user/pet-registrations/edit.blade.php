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

                            <!-- Estimated Age -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Estimated Age</label>
                                <div class="grid grid-cols-2 gap-2 mt-1">
                                    <div>
                                        <label class="block text-xs text-gray-600">Years</label>
                                        <select name="estimated_age_years" class="block w-full border border-gray-300 rounded-md p-2 @error('estimated_age_years') border-red-500 @enderror">
                                            <option value="">Select Years</option>
                                            @for($i = 0; $i <= 20; $i++)
                                                <option value="{{ $i }}" {{ old('estimated_age_years', $pet->estimated_age_years) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-600">Months</label>
                                        <select name="estimated_age_months" class="block w-full border border-gray-300 rounded-md p-2 @error('estimated_age_months') border-red-500 @enderror">
                                            <option value="">Select Months</option>
                                            @for($i = 0; $i <= 11; $i++)
                                                <option value="{{ $i }}" {{ old('estimated_age_months', $pet->estimated_age_months) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                @error('estimated_age_years') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                                @error('estimated_age_months') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
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
                                <label class="block text-sm font-medium text-gray-700 mb-2">Color Markings</label>
                                <div class="grid grid-cols-2 gap-2">
                                    @php
                                        $colors = ['Black', 'White', 'Brown', 'Gray', 'Orange', 'Cream', 'Red', 'Tabby'];
                                        $selectedColors = old('color_markings', explode(',', $pet->color_markings ?? ''));
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
