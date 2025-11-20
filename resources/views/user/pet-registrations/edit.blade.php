@extends('layouts.app')

@section('title', '| Edit Pet Registration')

@section('content')
<div class="min-h-screen px-4 py-12 bg-gray-50 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">

        <div class="mb-10 text-center">
            <h1 class="text-4xl font-extrabold text-indigo-700 sm:text-5xl">Edit Pet Registration 🐶🐱</h1>
            <p class="mt-3 text-xl text-gray-600">Update your pet's registration details.</p>
        </div>

        <form action="{{ route('pet-registrations.update', $petRegistration) }}" method="POST" enctype="multipart/form-data" class="bg-white divide-y divide-gray-200 shadow-2xl rounded-xl">
            @csrf
            @method('PUT')

            <div class="px-6 py-8 sm:p-10">
                <div class="flex items-center mb-6 space-x-4">
                    <span class="p-3 text-indigo-600 bg-indigo-100 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </span>
                    <h2 class="text-2xl font-bold text-gray-900">1. Owner Information</h2>
                </div>
                <p class="mb-6 text-sm text-gray-500">This information is pre-filled from your user account and is read-only.</p>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input
                            type="text"
                            id="first_name"
                            value="{{ auth()->user()->first_name ?? 'N/A' }}"
                            readonly
                            class="block w-full p-3 mt-1 text-gray-600 bg-gray-100 border border-gray-200 rounded-lg shadow-sm cursor-not-allowed"
                        >
                    </div>

                    <div>
                        <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name</label>
                        <input
                            type="text"
                            id="middle_name"
                            value="{{ auth()->user()->middle_name ?? '' }}"
                            readonly
                            class="block w-full p-3 mt-1 text-gray-600 bg-gray-100 border border-gray-200 rounded-lg shadow-sm cursor-not-allowed"
                        >
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input
                            type="text"
                            id="last_name"
                            value="{{ auth()->user()->last_name ?? 'N/A' }}"
                            readonly
                            class="block w-full p-3 mt-1 text-gray-600 bg-gray-100 border border-gray-200 rounded-lg shadow-sm cursor-not-allowed"
                        >
                    </div>

                    <div>
                        <label for="owner_email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input
                            type="email"
                            id="owner_email"
                            value="{{ auth()->user()->email ?? 'N/A' }}"
                            readonly
                            class="block w-full p-3 mt-1 text-gray-600 bg-gray-100 border border-gray-200 rounded-lg shadow-sm cursor-not-allowed"
                        >
                    </div>

                    <div>
                        <label for="contact_number_display" class="block text-sm font-medium text-gray-700">Contact Number</label>
                        <input
                            type="text"
                            id="contact_number_display"
                            value="{{ auth()->user()->contact_number ?? 'N/A' }}"
                            readonly
                            class="block w-full p-3 mt-1 text-gray-600 bg-gray-100 border border-gray-200 rounded-lg shadow-sm cursor-not-allowed"
                        >
                    </div>

                    <div>
                        <label for="address_display" class="block text-sm font-medium text-gray-700">Complete Address</label>
                        <textarea
                            id="address_display"
                            rows="3"
                            readonly
                            class="block w-full p-3 mt-1 text-gray-600 bg-gray-100 border border-gray-200 rounded-lg shadow-sm cursor-not-allowed resize-none"
                        >{{ (auth()->user()->street ?? '') . ', ' . (auth()->user()->barangay ?? '') . ', ' . (auth()->user()->city_municipality ?? '') }}</textarea>
                    </div>
                </div>

                <input type="hidden" name="contact_number" value="{{ auth()->user()->contact_number ?? '' }}">
                <input type="hidden" name="address" value="{{ (auth()->user()->street ?? '') . ', ' . (auth()->user()->barangay ?? '') . ', ' . (auth()->user()->city_municipality ?? '') }}">
                @if(auth()->user()->id_photo)
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">ID Photo</label>
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset('storage/' . auth()->user()->id_photo) }}" alt="Your ID Photo" class="object-cover w-24 h-16 border border-gray-300 rounded">
                            <span class="text-sm text-gray-600">Your uploaded ID photo will be used for verification.</span>
                        </div>
                    </div>
                    <input type="hidden" name="id_photo_path" value="{{ auth()->user()->id_photo }}">
                @else
                    <div class="p-3 mb-4 border border-yellow-200 rounded bg-yellow-50">
                        <p class="text-sm text-yellow-800"><strong>Note:</strong> You haven't uploaded an ID photo yet. Please upload one in your <a href="{{ route('profile.edit') }}" class="text-blue-600 underline hover:text-blue-800">profile settings</a> for faster verification.</p>
                    </div>
                @endif

            </div>

            <div class="px-6 py-8 sm:p-10">
                <div class="flex items-center mb-6 space-x-4">
                    <span class="p-3 text-teal-600 bg-teal-100 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zM12 2a10 10 0 100 20 10 10 0 000-20z"></path></svg>
                    </span>
                    <h2 class="text-2xl font-bold text-gray-900">2. Pet Details</h2>
                </div>
                <p class="mb-6 text-sm text-gray-500">Update your furry friend's information.</p>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                    <div class="lg:col-span-1">
                        <label for="pet_name" class="block text-sm font-medium text-gray-700">Pet Name <span class="text-red-500">*</span></label>
                        <input type="text" name="pet_name" id="pet_name" value="{{ old('pet_name', $petRegistration->pet_name) }}" required class="mt-1 block w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-teal-500 focus:border-teal-500 @error('pet_name') border-red-500 @enderror" placeholder="e.g., Buddy or Princess">
                        @error('pet_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="lg:col-span-1">
                        <label for="species" class="block text-sm font-medium text-gray-700">Species <span class="text-red-500">*</span></label>
                        <select name="species" id="species" required class="mt-1 block w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-teal-500 focus:border-teal-500 @error('species') border-red-500 @enderror">
                            <option value="">Select Species</option>
                            <option value="Canine" {{ old('species', $petRegistration->species) === 'Canine' ? 'selected' : '' }}>Canine 🐕</option>
                            <option value="Feline" {{ old('species', $petRegistration->species) === 'Feline' ? 'selected' : '' }}>Feline 🐈</option>
                        </select>
                        @error('species') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="lg:col-span-1">
                        <label for="breed" class="block text-sm font-medium text-gray-700">Breed <span class="text-red-500">*</span></label>
                        <select name="breed" id="breed" required class="mt-1 block w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-teal-500 focus:border-teal-500 @error('breed') border-red-500 @enderror">
                            <option value="">Select Species First</option>
                        </select>
                        @error('breed') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="birthday" class="block text-sm font-medium text-gray-700">Birthday (Approximate)</label>
                        <input type="date" name="birthday" id="birthday" value="{{ old('birthday', $petRegistration->birthday ? $petRegistration->birthday->format('Y-m-d') : '') }}" class="mt-1 block w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-teal-500 focus:border-teal-500 @error('birthday') border-red-500 @enderror">
                        @error('birthday') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender <span class="text-red-500">*</span></label>
                        <select name="gender" id="gender" required class="mt-1 block w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-teal-500 focus:border-teal-500 @error('gender') border-red-500 @enderror">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender', $petRegistration->gender) === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $petRegistration->gender) === 'female' ? 'selected' : '' }}>Female</option>
                            <option value="unknown" {{ old('gender', $petRegistration->gender) === 'unknown' ? 'selected' : '' }}>Unknown</option>
                        </select>
                        @error('gender') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block mb-3 text-sm font-medium text-gray-700">Color/Markings (Select all that apply)</label>
                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                        @php
                            $colors = ['Black', 'White', 'Brown', 'Gray', 'Orange', 'Cream', 'Red', 'Tabby'];
                            $old_colors = old('color_markings', is_array($petRegistration->color_markings) ? $petRegistration->color_markings : []);
                        @endphp

                        @foreach($colors as $color)
                        <label class="flex items-center p-2 text-sm font-medium text-gray-700 transition duration-150 rounded-lg bg-gray-50 hover:bg-teal-50">
                            <input type="checkbox" name="color_markings[]" value="{{ $color }}" {{ in_array($color, $old_colors) ? 'checked' : '' }} class="w-4 h-4 mr-2 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                            {{ $color }}
                        </label>
                        @endforeach
                    </div>
                    @error('color_markings') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description / Unique Characteristics</label>
                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-lg p-3 shadow-sm focus:ring-teal-500 focus:border-teal-500 @error('description') border-red-500 @enderror" placeholder="Describe any distinguishing features, special needs, or temperament.">{{ old('description', $petRegistration->description) }}</textarea>
                    @error('description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="px-6 py-8 sm:p-10">
                <div class="flex items-center mb-6 space-x-4">
                    <span class="p-3 text-indigo-600 bg-indigo-100 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.808-1.212A2 2 0 0110.608 4h2.784a2 2 0 011.664.89l.808 1.212a2 2 0 001.664.89H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </span>
                    <h2 class="text-2xl font-bold text-gray-900">3. Photo & Finalize</h2>
                </div>

                @if($petRegistration->photo)
                    <div class="mb-6">
                        <label class="block mb-3 text-sm font-medium text-gray-700">Current Pet Photo</label>
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset('storage/' . $petRegistration->photo) }}" alt="{{ $petRegistration->pet_name }}" class="object-cover w-32 h-24 border border-gray-300 rounded-lg shadow-md">
                            <span class="text-sm text-gray-600">This is the current photo. You can update it below if needed.</span>
                        </div>
                    </div>
                @endif

                <div class="mt-6">
                    <label for="photo" class="block text-sm font-medium text-gray-700">Update Pet Photo (optional)</label>
                    <div class="flex justify-center px-6 pt-5 pb-6 mt-1 transition duration-150 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-400">
                        <div class="space-y-1 text-center">
                            <svg class="w-12 h-12 mx-auto text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m-4-4h2m-2 4h4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="file-upload" class="relative font-medium text-indigo-600 bg-white rounded-md cursor-pointer hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span>Upload a new file</span>
                                    <input id="file-upload" name="photo" type="file" accept="image/*" class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p id="file-name" class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
                    @error('photo') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center justify-between px-6 py-4 sm:px-10 bg-gray-50 rounded-b-xl">
                <a href="{{ route('pet-registrations.index') }}" class="inline-flex justify-center px-6 py-2 text-sm font-medium text-gray-700 transition duration-150 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-100">
                    Cancel
                </a>
                <button type="submit" class="inline-flex justify-center px-8 py-3 text-base font-medium text-white transition duration-150 bg-teal-600 border border-transparent rounded-lg shadow-md hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                    Update Registration
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const speciesSelect = document.getElementById('species');
        const breedSelect = document.getElementById('breed');
        const fileUpload = document.getElementById('file-upload');
        const fileNameDisplay = document.getElementById('file-name');

        const canineBreeds = [
            'Aspin', 'Poodle', 'Shih Tzu', 'Maltese', 'Pug', 'Beagle',
            'Cocker Spaniel', 'Labrador Retriever', 'German Shepherd', 'Golden Retriever'
        ];
        const felineBreeds = [
            'Philippine Domestic Cat', 'Siamese', 'Persian', 'Maine Coon',
            'British Shorthair', 'Ragdoll', 'Bengal', 'Scottish Fold', 'Abyssinian', 'Russian Blue'
        ];

        function updateBreedOptions(selectedSpecies) {
            breedSelect.innerHTML = '<option value="">Select Breed</option>';
            let breeds = [];

            if (selectedSpecies === 'Canine') {
                breeds = canineBreeds;
            } else if (selectedSpecies === 'Feline') {
                breeds = felineBreeds;
            }

            const oldBreed = "{{ old('breed', $petRegistration->breed) }}";

            breeds.forEach(breed => {
                const option = document.createElement('option');
                option.value = breed;
                option.textContent = breed;
                if (breed === oldBreed) {
                    option.selected = true;
                }
                breedSelect.appendChild(option);
            });
        }

        // Initialize breeds on load if old input exists
        updateBreedOptions(speciesSelect.value);

        // Update breeds on species change
        speciesSelect.addEventListener('change', function() {
            updateBreedOptions(this.value);
        });

        // Update file name display
        fileUpload.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileNameDisplay.textContent = this.files[0].name;
            } else {
                fileNameDisplay.textContent = 'PNG, JPG, GIF up to 10MB';
            }
        });
    });
</script>
@endsection
