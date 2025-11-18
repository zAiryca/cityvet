@extends('layouts.app')

@section('title', '| New Pet')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">New Pet</h1>
    <p class="mb-6">Pre-register your pet for official registration.</p>

    <form action="{{ route('pet-registrations.store') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl bg-white rounded-lg shadow p-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Owner Information -->
            <div class="md:col-span-2">
                <h3 class="text-lg font-semibold mb-4">Owner Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" value="{{ auth()->user()->name }}" readonly class="mt-1 block w-full border border-gray-300 rounded-md p-2 bg-gray-100">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" value="{{ auth()->user()->email }}" readonly class="mt-1 block w-full border border-gray-300 rounded-md p-2 bg-gray-100">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                        <input type="text" name="contact_number" value="{{ old('contact_number', auth()->user()->phone ?? '') }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('contact_number') border-red-500 @enderror">
                        @error('contact_number') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Full Address</label>
                        <textarea name="address" rows="3" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('address') border-red-500 @enderror">{{ old('address', auth()->user()->address ?? '') }}</textarea>
                        @error('address') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Pet Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Pet Name</label>
                <input type="text" name="pet_name" value="{{ old('pet_name') }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('pet_name') border-red-500 @enderror">
                @error('pet_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Species -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Species</label>
                <select name="species" id="species" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('species') border-red-500 @enderror">
                    <option value="">Select Species</option>
                    <option value="Canine" {{ old('species') === 'Canine' ? 'selected' : '' }}>Canine</option>
                    <option value="Feline" {{ old('species') === 'Feline' ? 'selected' : '' }}>Feline</option>
                </select>
                @error('species') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Breed -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Breed</label>
                <select name="breed" id="breed" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('breed') border-red-500 @enderror">
                    <option value="">Select Breed</option>
                    @if(old('species') === 'Canine' || (isset($pet) && $pet->species === 'Canine'))
                        <option value="Aspin" {{ old('breed') === 'Aspin' ? 'selected' : '' }}>Aspin</option>
                        <option value="Poodle" {{ old('breed') === 'Poodle' ? 'selected' : '' }}>Poodle</option>
                        <option value="Shih Tzu" {{ old('breed') === 'Shih Tzu' ? 'selected' : '' }}>Shih Tzu</option>
                        <option value="Maltese" {{ old('breed') === 'Maltese' ? 'selected' : '' }}>Maltese</option>
                        <option value="Pug" {{ old('breed') === 'Pug' ? 'selected' : '' }}>Pug</option>
                        <option value="Beagle" {{ old('breed') === 'Beagle' ? 'selected' : '' }}>Beagle</option>
                        <option value="Cocker Spaniel" {{ old('breed') === 'Cocker Spaniel' ? 'selected' : '' }}>Cocker Spaniel</option>
                        <option value="Labrador Retriever" {{ old('breed') === 'Labrador Retriever' ? 'selected' : '' }}>Labrador Retriever</option>
                        <option value="German Shepherd" {{ old('breed') === 'German Shepherd' ? 'selected' : '' }}>German Shepherd</option>
                        <option value="Golden Retriever" {{ old('breed') === 'Golden Retriever' ? 'selected' : '' }}>Golden Retriever</option>
                    @elseif(old('species') === 'Feline' || (isset($pet) && $pet->species === 'Feline'))
                        <option value="Philippine Domestic Cat" {{ old('breed') === 'Philippine Domestic Cat' ? 'selected' : '' }}>Philippine Domestic Cat</option>
                        <option value="Siamese" {{ old('breed') === 'Siamese' ? 'selected' : '' }}>Siamese</option>
                        <option value="Persian" {{ old('breed') === 'Persian' ? 'selected' : '' }}>Persian</option>
                        <option value="Maine Coon" {{ old('breed') === 'Maine Coon' ? 'selected' : '' }}>Maine Coon</option>
                        <option value="British Shorthair" {{ old('breed') === 'British Shorthair' ? 'selected' : '' }}>British Shorthair</option>
                        <option value="Ragdoll" {{ old('breed') === 'Ragdoll' ? 'selected' : '' }}>Ragdoll</option>
                        <option value="Bengal" {{ old('breed') === 'Bengal' ? 'selected' : '' }}>Bengal</option>
                        <option value="Scottish Fold" {{ old('breed') === 'Scottish Fold' ? 'selected' : '' }}>Scottish Fold</option>
                        <option value="Abyssinian" {{ old('breed') === 'Abyssinian' ? 'selected' : '' }}>Abyssinian</option>
                        <option value="Russian Blue" {{ old('breed') === 'Russian Blue' ? 'selected' : '' }}>Russian Blue</option>
                    @endif
                </select>
                @error('breed') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Birthday -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Birthday</label>
                <input type="date" name="birthday" value="{{ old('birthday') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('birthday') border-red-500 @enderror">
                @error('birthday') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Gender -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('gender') border-red-500 @enderror">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                    <option value="unknown" {{ old('gender') === 'unknown' ? 'selected' : '' }}>Unknown</option>
                </select>
                @error('gender') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Color -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Color</label>
                <div class="grid grid-cols-2 gap-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Black" {{ in_array('Black', old('color_markings', [])) ? 'checked' : '' }} class="mr-2">
                        Black
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="color_markings[]" value="White" {{ in_array('White', old('color_markings', [])) ? 'checked' : '' }} class="mr-2">
                        White
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Brown" {{ in_array('Brown', old('color_markings', [])) ? 'checked' : '' }} class="mr-2">
                        Brown
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Gray" {{ in_array('Gray', old('color_markings', [])) ? 'checked' : '' }} class="mr-2">
                        Gray
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Orange" {{ in_array('Orange', old('color_markings', [])) ? 'checked' : '' }} class="mr-2">
                        Orange
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Cream" {{ in_array('Cream', old('color_markings', [])) ? 'checked' : '' }} class="mr-2">
                        Cream
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Red" {{ in_array('Red', old('color_markings', [])) ? 'checked' : '' }} class="mr-2">
                        Red
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Tabby" {{ in_array('Tabby', old('color_markings', [])) ? 'checked' : '' }} class="mr-2">
                        Tabby
                    </label>
                </div>
                @error('color_markings') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Description -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Photo -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700">Photo</label>
            <input type="file" name="photo" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('photo') border-red-500 @enderror">
            <p class="text-sm text-gray-500 mt-1">No file chosen</p>
            @error('photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('pet-registrations.index') }}" class="mr-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Save</button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const speciesSelect = document.getElementById('species');
            const breedSelect = document.getElementById('breed');

            speciesSelect.addEventListener('change', function() {
                const selectedSpecies = this.value;
                breedSelect.innerHTML = '<option value="">Select Breed</option>';

                if (selectedSpecies === 'Canine') {
                    const canineBreeds = [
                        'Aspin', 'Poodle', 'Shih Tzu', 'Maltese', 'Pug', 'Beagle',
                        'Cocker Spaniel', 'Labrador Retriever', 'German Shepherd', 'Golden Retriever'
                    ];
                    canineBreeds.forEach(breed => {
                        const option = document.createElement('option');
                        option.value = breed;
                        option.textContent = breed;
                        breedSelect.appendChild(option);
                    });
                } else if (selectedSpecies === 'Feline') {
                    const felineBreeds = [
                        'Philippine Domestic Cat', 'Siamese', 'Persian', 'Maine Coon',
                        'British Shorthair', 'Ragdoll', 'Bengal', 'Scottish Fold', 'Abyssinian', 'Russian Blue'
                    ];
                    felineBreeds.forEach(breed => {
                        const option = document.createElement('option');
                        option.value = breed;
                        option.textContent = breed;
                        breedSelect.appendChild(option);
                    });
                }
            });
        });
    </script>
</div>
@endsection
