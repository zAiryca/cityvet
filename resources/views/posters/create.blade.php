@extends('layouts.app')

@section('title', '| Create Poster')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <h1 class="mb-6 text-3xl font-bold">Create Lost or Found Poster</h1>
    <p class="mb-6">Post your lost or found pet directly.</p>

    <form action="{{ route('posters.store') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl p-6 bg-white rounded-lg shadow">
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
                @error('type') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div id="pet_name_field" style="{{ old('type') === 'found' ? 'display: none;' : '' }}">
                <label class="block text-sm font-medium text-gray-700">Pet Name</label>
                <input type="text" name="pet_name" value="{{ old('pet_name') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('pet_name') border-red-500 @enderror" {{ old('type') === 'lost' ? 'required' : '' }}>
                @error('pet_name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Species</label>
                    <select name="species" id="species" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('species') border-red-500 @enderror" required>
                        <option value="">Select Species</option>
                        <option value="Canine" {{ old('species') === 'Canine' ? 'selected' : '' }}>Canine</option>
                        <option value="Feline" {{ old('species') === 'Feline' ? 'selected' : '' }}>Feline</option>
                    </select>
                    @error('species') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Breed</label>
                    <select name="breed" id="breed" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('breed') border-red-500 @enderror" required>
                        <option value="">Select Breed</option>
                        @if(old('species') === 'Canine')
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
                        @elseif(old('species') === 'Feline')
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
                    @error('breed') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('gender') border-red-500 @enderror">
                        <option value="">Select</option>
                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                        <option value="unknown" {{ old('gender') === 'unknown' ? 'selected' : '' }}>Unknown</option>
                    </select>
                    @error('gender') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Colors/Markings</label>
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        @php $selectedColors = old('color_markings', []); @endphp
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="color_markings[]" value="Black" {{ in_array('Black', $selectedColors) ? 'checked' : '' }} class="text-purple-600 border-gray-300 rounded shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm">Black</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="color_markings[]" value="White" {{ in_array('White', $selectedColors) ? 'checked' : '' }} class="text-purple-600 border-gray-300 rounded shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm">White</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="color_markings[]" value="Brown" {{ in_array('Brown', $selectedColors) ? 'checked' : '' }} class="text-purple-600 border-gray-300 rounded shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm">Brown</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="color_markings[]" value="Gray" {{ in_array('Gray', $selectedColors) ? 'checked' : '' }} class="text-purple-600 border-gray-300 rounded shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm">Gray</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="color_markings[]" value="Orange" {{ in_array('Orange', $selectedColors) ? 'checked' : '' }} class="text-purple-600 border-gray-300 rounded shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm">Orange</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="color_markings[]" value="Cream" {{ in_array('Cream', $selectedColors) ? 'checked' : '' }} class="text-purple-600 border-gray-300 rounded shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm">Cream</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="color_markings[]" value="Red" {{ in_array('Red', $selectedColors) ? 'checked' : '' }} class="text-purple-600 border-gray-300 rounded shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm">Red</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="color_markings[]" value="Tabby" {{ in_array('Tabby', $selectedColors) ? 'checked' : '' }} class="text-purple-600 border-gray-300 rounded shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm">Tabby</span>
                        </label>
                    </div>
                    @error('color_markings') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Date Lost/Found</label>
                <input type="date" name="date_lost_found" value="{{ old('date_lost_found') }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('date_lost_found') border-red-500 @enderror">
                @error('date_lost_found') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Short Description</label>
                <textarea name="description" rows="2" placeholder="Brief description of the pet..." {{ old('description') }} class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('description') border-red-500 @enderror"></textarea>
                @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Additional Comments (Optional)</label>
                <textarea name="uploader_comments" rows="3" placeholder="Any additional information or comments..." {{ old('uploader_comments') }} class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('uploader_comments') border-red-500 @enderror"></textarea>
                @error('uploader_comments') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div id="location-field">
                <label class="block text-sm font-medium text-gray-700" id="location-label">Location Details</label>
                <textarea name="last_seen" id="last_seen_field" rows="3" placeholder="Where was the pet last seen?" {{ old('last_seen') }} class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('last_seen') border-red-500 @enderror" style="display: none;"></textarea>
                <textarea name="found_at" id="found_at_field" rows="3" placeholder="Where was the pet found?" {{ old('found_at') }} class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('found_at') border-red-500 @enderror" style="display: none;"></textarea>
                @error('last_seen') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                @error('found_at') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Photo</label>
                <input type="file" name="photo" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('photo') border-red-500 @enderror">
                @error('photo') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Contact Info</label>
                <input type="text" name="contact_info" value="{{ old('contact_info') }}" placeholder="Email and/or phone" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('contact_info') border-red-500 @enderror">
                @error('contact_info') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div id="reward-field" style="{{ old('type') === 'found' ? 'display: none;' : '' }}">
                <label class="block text-sm font-medium text-gray-700">Reward (Optional)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">₱</span>
                    <input type="number" name="reward" step="0.01" value="{{ old('reward') }}" class="block w-full p-2 pl-8 mt-1 border border-gray-300 rounded-md">
                </div>
                @error('reward') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('posters.index') }}" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md">Cancel</a>
                <button type="submit" class="px-6 py-2 text-white bg-purple-600 rounded-md hover:bg-purple-700">Post Now</button>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeRadios = document.querySelectorAll('input[name="type"]');
            const petNameField = document.getElementById('pet_name_field');
            const speciesSelect = document.getElementById('species');
            const breedSelect = document.getElementById('breed');

            // Handle type change
            typeRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'found') {
                        petNameField.style.display = 'none';
                        document.getElementById('last_seen_field').style.display = 'none';
                        document.getElementById('found_at_field').style.display = 'block';
                        document.getElementById('location-label').textContent = 'Found At';
                        document.getElementById('reward-field').style.display = 'none';
                    } else {
                        petNameField.style.display = 'block';
                        document.getElementById('last_seen_field').style.display = 'block';
                        document.getElementById('found_at_field').style.display = 'none';
                        document.getElementById('location-label').textContent = 'Last Seen At';
                        document.getElementById('reward-field').style.display = 'block';
                    }
                });
            });

            // Handle species change
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
