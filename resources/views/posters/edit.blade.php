@extends('layouts.app')

@section('title', '| Edit Poster')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <h1 class="mb-6 text-3xl font-bold">Edit Poster</h1>
    <p class="mb-6">Update your lost or found pet poster.</p>

    <form action="{{ route('posters.update', $poster) }}" method="POST" enctype="multipart/form-data" class="max-w-2xl p-6 bg-white rounded-lg shadow">
        @csrf
        @method('PATCH')
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Type</label>
                <select name="type" id="type-select" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('type') border-red-500 @enderror">
                    <option value="">Select Type</option>
                    <option value="lost" {{ $poster->type === 'lost' ? 'selected' : '' }}>Lost Pet</option>
                    <option value="found" {{ $poster->type === 'found' ? 'selected' : '' }}>Found Pet</option>
                </select>
                @error('type') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div id="pet-name-field" style="display: {{ $poster->type === 'lost' ? 'block' : 'none' }};">
                <label class="block text-sm font-medium text-gray-700">Pet Name</label>
                <input type="text" name="pet_name" value="{{ old('pet_name', $poster->pet_name) }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('pet_name') border-red-500 @enderror" {{ $poster->type === 'lost' ? 'required' : '' }}>
                @error('pet_name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Species</label>
                    <select name="species" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('species') border-red-500 @enderror" id="species-select">
                        <option value="">Select Species</option>
                        <option value="Canine" {{ $poster->species === 'Canine' ? 'selected' : '' }}>Canine</option>
                        <option value="Feline" {{ $poster->species === 'Feline' ? 'selected' : '' }}>Feline</option>
                    </select>
                    @error('species') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Breed</label>
                    <select name="breed" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('breed') border-red-500 @enderror" id="breed">
                        <option value="">Select Breed</option>
                    </select>
                    @error('breed') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('gender') border-red-500 @enderror">
                        <option value="">Select Gender</option>
                        <option value="male" {{ $poster->gender === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $poster->gender === 'female' ? 'selected' : '' }}>Female</option>
                        <option value="unknown" {{ $poster->gender === 'unknown' ? 'selected' : '' }}>Unknown</option>
                    </select>
                    @error('gender') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Date Lost/Found</label>
                    <input type="date" name="date_lost_found" value="{{ old('date_lost_found', $poster->date_lost_found->format('Y-m-d')) }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('date_lost_found') border-red-500 @enderror">
                    @error('date_lost_found') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div id="location-field">
                <label class="block text-sm font-medium text-gray-700" id="location-label">
                    @if($poster->type === 'lost')
                        Last Seen At
                    @else
                        Found At
                    @endif
                </label>
                <textarea name="last_seen" id="last_seen_field" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('last_seen') border-red-500 @enderror" rows="3" {{ $poster->type === 'lost' ? '' : 'style="display: none;"' }}>{{ old('last_seen', $poster->last_seen) }}</textarea>
                <textarea name="found_at" id="found_at_field" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('found_at') border-red-500 @enderror" rows="3" {{ $poster->type === 'found' ? '' : 'style="display: none;"' }}>{{ old('found_at', $poster->found_at) }}</textarea>
                @error('last_seen') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                @error('found_at') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div id="description-field" style="display: {{ $poster->type === 'lost' || $poster->type === 'found' ? 'block' : 'none' }};">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('description') border-red-500 @enderror" rows="3">{{ old('description', $poster->description) }}</textarea>
                @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div id="uploader-comments-field" style="display: {{ $poster->type === 'lost' || $poster->type === 'found' ? 'block' : 'none' }};">
                <label class="block text-sm font-medium text-gray-700">Uploader Comments</label>
                <textarea name="uploader_comments" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('uploader_comments') border-red-500 @enderror" rows="3">{{ old('uploader_comments', $poster->uploader_comments) }}</textarea>
                @error('uploader_comments') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div id="reward-field" style="display: {{ $poster->type === 'lost' ? 'block' : 'none' }};">
                <label class="block text-sm font-medium text-gray-700">Reward (Optional)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">₱</span>
                    <input type="number" name="reward" step="0.01" value="{{ old('reward', $poster->reward) }}" class="block w-full p-2 pl-8 mt-1 border border-gray-300 rounded-md">
                </div>
                @error('reward') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Contact Information</label>
                <input type="text" name="contact_info" value="{{ old('contact_info', $poster->contact_info) }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('contact_info') border-red-500 @enderror">
                @error('contact_info') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Photo</label>
                @if($poster->photo)
                    <div class="mt-2 mb-2">
                        <img src="{{ asset('storage/' . $poster->photo) }}" alt="Current photo" class="object-cover w-32 h-32 rounded">
                        <p class="mt-1 text-sm text-gray-500">Leave empty to keep current photo</p>
                    </div>
                @endif
                <input type="file" name="photo" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('photo') border-red-500 @enderror">
                @error('photo') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Color Markings</label>
                <div class="grid grid-cols-2 gap-2 mt-2 md:grid-cols-4">
                    @php $selectedColors = old('color_markings', explode(',', $poster->color_markings)); @endphp
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Black" {{ in_array('Black', $selectedColors) ? 'checked' : '' }} class="text-purple-600 border-gray-300 rounded shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm">Black</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="color_markings[]" value="White" {{ in_array('White', $selectedColors) ? 'checked' : '' }} class="text-purple-600 border-gray-300 rounded shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm">White</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Brown" {{ in_array('Brown', $selectedColors) ? 'checked' : '' }} class="text-purple-300 text-purple-600 border-gray-300 rounded shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
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
                        <input type="checkbox" name="color_markings[]" value="Tabby" {{ in_array('Tabby', $selectedColors) ? 'checked' : '' }} class="text-purple-600 border-gray-300 rounded shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm">Tabby</span>
                    </label>
                </div>
                @error('color_markings') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="px-6 py-2 text-white bg-purple-600 rounded hover:bg-purple-700" onclick="return confirm('Are you sure you want to update this poster?')">Update Poster</button>
                <a href="{{ route('user.posters') }}" class="px-6 py-2 text-white bg-gray-500 rounded hover:bg-gray-600">Cancel</a>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type-select');
    const petNameField = document.getElementById('pet-name-field');
    const descriptionField = document.getElementById('description-field');
    const uploaderCommentsField = document.getElementById('uploader-comments-field');
    const rewardField = document.getElementById('reward-field');

    function toggleFields() {
        const selectedType = typeSelect.value;
        if (selectedType === 'lost') {
            petNameField.style.display = 'block';
            petNameField.querySelector('input').setAttribute('required', 'required');
            descriptionField.style.display = 'block';
            uploaderCommentsField.style.display = 'block';
            rewardField.style.display = 'block';
        } else if (selectedType === 'found') {
            petNameField.style.display = 'none';
            petNameField.querySelector('input').removeAttribute('required');
            descriptionField.style.display = 'block';
            uploaderCommentsField.style.display = 'block';
            rewardField.style.display = 'none';
        } else {
            petNameField.style.display = 'none';
            petNameField.querySelector('input').removeAttribute('required');
            descriptionField.style.display = 'none';
            uploaderCommentsField.style.display = 'none';
            rewardField.style.display = 'none';
        }
    }

    typeSelect.addEventListener('change', function() {
        toggleFields();
        updateLocationLabel();
        updateLocationFields();
    });

    function updateLocationLabel() {
        const selectedType = typeSelect.value;
        const locationLabel = document.getElementById('location-label');
        if (selectedType === 'lost') {
            locationLabel.textContent = 'Last Seen At';
        } else if (selectedType === 'found') {
            locationLabel.textContent = 'Found At';
        }
    }

    function updateLocationFields() {
        const selectedType = typeSelect.value;
        const lastSeenField = document.getElementById('last_seen_field');
        const foundAtField = document.getElementById('found_at_field');
        if (selectedType === 'lost') {
            lastSeenField.style.display = 'block';
            foundAtField.style.display = 'none';
        } else if (selectedType === 'found') {
            lastSeenField.style.display = 'none';
            foundAtField.style.display = 'block';
        }
    }

    // Trigger change event on page load to handle pre-selected values
    toggleFields();
    updateLocationLabel();
    updateLocationFields();
});

document.addEventListener('DOMContentLoaded', function() {
    const speciesSelect = document.getElementById('species-select');
    const breedSelect = document.getElementById('breed');

    speciesSelect.addEventListener('change', function() {
        const selectedSpecies = this.value;
        breedSelect.innerHTML = '<option value="">Select Breed</option>';

        if (selectedSpecies === 'Canine') {
            const canineBreeds = [
                'Aspin (Asong Pinoy)', 'Shih Tzu', 'Poodle', 'Pomeranian', 'Golden Retriever',
                'Labrador', 'Beagle', 'Pug', 'Siberian Husky', 'Chihuahua', 'Dachshund',
                'German Shepherd', 'Chow Chow', 'Maltese', 'Doberman Pinscher'
            ];
            canineBreeds.forEach(breed => {
                const option = document.createElement('option');
                option.value = breed;
                option.textContent = breed;
                if (breed === '{{ $poster->breed }}') {
                    option.selected = true;
                }
                breedSelect.appendChild(option);
            });
        } else if (selectedSpecies === 'Feline') {
            const felineBreeds = [
                'Moggy / Mixed-Breed', 'Puspin (Pusang Pinoy)', 'Siamese', 'Persian',
                'British Shorthair', 'Maine Coon', 'Ragdoll', 'Scottish Fold', 'Exotic Shorthair', 'Bengal'
            ];
            felineBreeds.forEach(breed => {
                const option = document.createElement('option');
                option.value = breed;
                option.textContent = breed;
                if (breed === '{{ $poster->breed }}') {
                    option.selected = true;
                }
                breedSelect.appendChild(option);
            });
        }
    });

    // Trigger change event on page load to populate breeds
    speciesSelect.dispatchEvent(new Event('change'));
});
</script>
@endsection
