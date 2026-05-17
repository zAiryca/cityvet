@extends('layouts.app')

@section('title', '| Edit Pet Registration')

@section('content')
<div class="min-h-screen px-4 py-12 pt-24 bg-gray-50 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">

      <div class="pt-24">
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-extrabold text-indigo-700 sm:text-5xl">Edit Pet Registration</h1>
        <p class="mt-3 text-xl text-gray-600">Update your pet's registration details.</p>
    </div>
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
                        <div onclick="document.getElementById('petEditIdPhotoModal').classList.remove('hidden')"
                             tabindex="0"
                             data-id-photo-container="true"
                             class="inline-flex flex-col items-center justify-center w-24 h-16 transition duration-150 ease-in-out border-2 border-indigo-400 rounded cursor-pointer bg-gradient-to-br from-indigo-500 to-indigo-700 hover:from-indigo-600 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.75 4h2.5a2 2 0 011.664.89l.812 1.22a2 2 0 001.664.89H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="mt-1 text-xs font-semibold text-white">Click to View ID </span>
                        </div>

                        <!-- Modal for Full Size ID Photo -->
                        <div id="petEditIdPhotoModal"
                             class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 transition-opacity duration-300 bg-black bg-opacity-80"
                             onclick="if(event.target.id === 'petEditIdPhotoModal') this.classList.add('hidden');">
                            <div class="relative max-w-3xl overflow-hidden bg-white rounded-lg shadow-2xl">
                                <div class="sticky top-0 z-10 flex items-center justify-between p-3 bg-white border-b border-gray-200">
                                    <h3 class="text-xl font-semibold text-gray-800">Your ID Photo</h3>
                                    <button onclick="document.getElementById('petEditIdPhotoModal').classList.add('hidden')"
                                            class="p-2 text-gray-500 transition duration-150 rounded-full hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="p-6 max-h-[80vh] overflow-y-auto">
                                    <img src="{{ asset('storage/' . auth()->user()->id_photo) }}"
                                         alt="Full Size ID Photo"
                                         class="w-full h-auto rounded-lg shadow-md">
                                </div>
                            </div>
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
    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-hidden="true">
        <path fill="currentColor" d="M234.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5 .3-86.2 32.6-96.8 70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3-14.3-70.1 10.2-84.1 59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5l0 1.6c0 25.8-20.9 46.7-46.7 46.7-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2-25.8 0-46.7-20.9-46.7-46.7l0-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3 29.1 51.7 10.2 84.1-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5 46.9 53.9 32.6 96.8-52.1 69.1-84.4 58.5z"/>
    </svg>
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
                            <option value="Canine" {{ old('species', $petRegistration->species) === 'Canine' ? 'selected' : '' }}>Canine</option>
                            <option value="Feline" {{ old('species', $petRegistration->species) === 'Feline' ? 'selected' : '' }}>Feline</option>
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
                            $colors = ['Black', 'White', 'Brown', 'Gray', 'Orange', 'Cream', 'Tabby'];
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

                <!-- Current Pet Photo (Always shown if exists) -->
                @if($petRegistration->photo)
                    <div class="mb-6">
                        <label class="block mb-3 text-sm font-medium text-gray-700">Current Pet Photo</label>
                        <img src="{{ asset('storage/' . $petRegistration->photo) }}" alt="{{ $petRegistration->pet_name }}" class="object-cover w-32 h-24 transition border-2 border-gray-300 rounded-lg shadow-md cursor-pointer hover:border-indigo-500 hover:shadow-lg" onclick="document.getElementById('petEditCurrentPhotoModal').classList.remove('hidden')">
                        <p class="mt-1 text-xs text-gray-500">Click to view full size</p>

                        <!-- Modal for Current Pet Photo -->
                        <div id="petEditCurrentPhotoModal"
                             class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 transition-opacity duration-300 bg-black bg-opacity-80"
                             onclick="if(event.target.id === 'petEditCurrentPhotoModal') this.classList.add('hidden');">
                            <div class="relative max-w-3xl overflow-hidden bg-white rounded-lg shadow-2xl">
                                <div class="sticky top-0 z-10 flex items-center justify-between p-3 bg-white border-b border-gray-200">
                                    <h3 class="text-xl font-semibold text-gray-800">Current Pet Photo</h3>
                                    <button onclick="document.getElementById('petEditCurrentPhotoModal').classList.add('hidden')"
                                            class="p-2 text-gray-500 transition duration-150 rounded-full hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="p-6 max-h-[80vh] overflow-y-auto">
                                    <img src="{{ asset('storage/' . $petRegistration->photo) }}" alt="{{ $petRegistration->pet_name }}" class="w-full h-auto rounded-lg shadow-md">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Upload New Photo Section -->
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
                            <p id="file-name" class="text-xs text-gray-500">PNG, JPG, GIF up to 50MB</p>
                        </div>
                    </div>
                    @error('photo') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Preview shown only after upload (Comparison view) -->
                <div id="petRegistration-photos-section" class="mt-6" style="display: none;">
                    <p class="mb-4 text-sm font-medium text-gray-700">Compare: Current & New Preview</p>
                    <div class="grid grid-cols-2 gap-6">
                        @if($petRegistration->photo)
                        <div>
                            <p class="mb-2 text-xs text-gray-600">Current:</p>
                            <img src="{{ asset('storage/' . $petRegistration->photo) }}" alt="{{ $petRegistration->pet_name }}" class="object-cover w-full transition border-2 border-gray-300 rounded-lg shadow-md cursor-pointer hover:border-indigo-500 hover:shadow-lg max-h-48" onclick="document.getElementById('petEditCurrentPhotoModal').classList.remove('hidden')">
                        </div>
                        @endif
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-xs text-gray-600">New Preview:</p>
                                <button type="button" id="petRegistration-clear-photo" class="text-xs font-medium text-red-600 hover:text-red-800 focus:outline-none">
                                    Clear
                                </button>
                            </div>
                            <img id="petRegistration-preview-img" src="" alt="Photo preview" class="object-cover w-full transition border-2 border-gray-300 rounded-lg shadow-md cursor-pointer hover:border-indigo-500 hover:shadow-lg max-h-48" onclick="document.getElementById('petEditNewPhotoModal').classList.remove('hidden')">
                        </div>
                    </div>
                </div>

                <!-- Modal for New Preview Photo -->
                <div id="petEditNewPhotoModal"
                     class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 transition-opacity duration-300 bg-black bg-opacity-80"
                     onclick="if(event.target.id === 'petEditNewPhotoModal') this.classList.add('hidden');">
                    <div class="relative max-w-3xl overflow-hidden bg-white rounded-lg shadow-2xl">
                        <div class="sticky top-0 z-10 flex items-center justify-between p-3 bg-white border-b border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-800">New Photo Preview</h3>
                            <button onclick="document.getElementById('petEditNewPhotoModal').classList.add('hidden')"
                                    class="p-2 text-gray-500 transition duration-150 rounded-full hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="p-6 max-h-[80vh] overflow-y-auto">
                            <img id="petEditNewPhotoModal-img" src="" alt="New Photo Preview" class="w-full h-auto rounded-lg shadow-md">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between px-6 py-4 sm:px-10 bg-gray-50 rounded-b-xl">
                <a href="javascript:void(0)" onclick="history.back()" class="px-4 py-2 text-white bg-gray-600 rounded hover:bg-gray-800">
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

        // Update file name display and photo preview
        fileUpload.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileNameDisplay.textContent = this.files[0].name;
                // Show photo preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('petRegistration-preview-img').src = e.target.result;
                    document.getElementById('petEditNewPhotoModal-img').src = e.target.result;
                    document.getElementById('petRegistration-photos-section').style.display = 'block';
                };
                reader.readAsDataURL(this.files[0]);
            } else {
                fileNameDisplay.textContent = 'PNG, JPG, GIF up to 50MB';
                document.getElementById('petRegistration-photos-section').style.display = 'none';
            }
        });

        // Clear photo button
        const clearPhotoBtn = document.getElementById('petRegistration-clear-photo');
        if (clearPhotoBtn) {
            clearPhotoBtn.addEventListener('click', function(e) {
                e.preventDefault();
                fileUpload.value = '';
                fileNameDisplay.textContent = 'PNG, JPG, GIF up to 50MB';
                document.getElementById('petRegistration-photos-section').style.display = 'none';
                document.getElementById('petEditNewPhotoModal').classList.add('hidden');
            });
        }

        // Global keyboard handler for backspace to go back (close modals)
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' || e.code === 'Backspace') {
                // If new photo modal is open, close it
                if (!document.getElementById('petEditNewPhotoModal').classList.contains('hidden')) {
                    e.preventDefault();
                    document.getElementById('petEditNewPhotoModal').classList.add('hidden');
                }
                // If current photo modal is open, close it
                else if (document.getElementById('petEditCurrentPhotoModal') && !document.getElementById('petEditCurrentPhotoModal').classList.contains('hidden')) {
                    e.preventDefault();
                    document.getElementById('petEditCurrentPhotoModal').classList.add('hidden');
                }
                // If ID photo modal is open, close it
                else if (!document.getElementById('petEditIdPhotoModal').classList.contains('hidden')) {
                    e.preventDefault();
                    document.getElementById('petEditIdPhotoModal').classList.add('hidden');
                }
            }
        });
    });
</script>
@endsection
