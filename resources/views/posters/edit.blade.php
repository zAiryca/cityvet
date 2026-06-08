@extends('layouts.app')

@section('title', '| Edit Poster')

@section('content')
<div class="min-h-screen pt-20 bg-gray-50">
    <div class="max-w-3xl px-4 py-8 mx-auto">
        <!-- Header -->
        <div class="flex items-center mb-4">
            <div class="p-1 mr-2 bg-white rounded-full shadow-sm -mt-1 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="w-12 h-12 text-indigo-600" fill="currentColor" aria-hidden="true"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M535.6 85.7C513.7 63.8 478.3 63.8 456.4 85.7L432 110.1L529.9 208L554.3 183.6C576.2 161.7 576.2 126.3 554.3 104.4L535.6 85.7zM236.4 305.7C230.3 311.8 225.6 319.3 222.9 327.6L193.3 416.4C190.4 425 192.7 434.5 199.1 441C205.5 447.5 215 449.7 223.7 446.8L312.5 417.2C320.7 414.5 328.2 409.8 334.4 403.7L496 241.9L398.1 144L236.4 305.7zM160 128C107 128 64 171 64 224L64 480C64 533 107 576 160 576L416 576C469 576 512 533 512 480L512 384C512 366.3 497.7 352 480 352C462.3 352 448 366.3 448 384L448 480C448 497.7 433.7 512 416 512L160 512C142.3 512 128 497.7 128 480L128 224C128 206.3 142.3 192 160 192L256 192C273.7 192 288 177.7 288 160C288 142.3 273.7 128 256 128L160 128z"/></svg>
            </div>
                <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Poster</h1>
                <p class="mt-0 text-gray-600">Update your lost or found pet information</p>
            </div>
        </div>

        <!-- Form Card -->
        <form id="poster-edit-form" action="{{ route('posters.update', $poster) }}" method="POST" enctype="multipart/form-data" class="p-6 bg-white shadow-lg rounded-2xl md:p-8">
            @csrf
            @method('PATCH')
            <input type="hidden" name="remove_existing_video" id="remove_existing_video" value="0">

            <!-- Poster Type -->
            <div class="mb-8">
                <label class="block mb-3 text-sm font-semibold text-gray-900">Poster Type</label>
                <div class="grid grid-cols-2 gap-4" id="type-container">
                    <!-- Lost Pet -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="type" value="lost" {{ $poster->type === 'lost' ? 'checked' : '' }} class="sr-only type-radio" required>
                        <div class="p-4 text-center transition-all duration-200 border-2 border-gray-200 rounded-xl hover:border-purple-300 type-option" data-type="lost">
                            <div class="flex items-center justify-center w-8 h-8 mx-auto mb-2 bg-red-100 rounded-full">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900">Lost Pet</span>
                        </div>
                    </label>

                    <!-- Found Pet -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="type" value="found" {{ $poster->type === 'found' ? 'checked' : '' }} class="sr-only type-radio">
                        <div class="p-4 text-center transition-all duration-200 border-2 border-gray-200 rounded-xl hover:border-green-300 type-option" data-type="found">
                            <div class="flex items-center justify-center w-8 h-8 mx-auto mb-2 bg-green-100 rounded-full">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900">Found Pet</span>
                        </div>
                    </label>
                </div>
                @error('type') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Photo Upload -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-semibold text-gray-900">Pet Photos</label>
                @if(count($poster->photo_sources) > 0)
                    <div id="existing-photo-grid" class="grid grid-cols-3 gap-3 mb-4">
                        <input type="hidden" name="existing_photos_present" value="1">
                        @foreach($poster->photo_sources as $existingPhoto)
                            <div class="relative group rounded-xl overflow-hidden border shadow-sm">
                                <img src="{{ asset('storage/' . $existingPhoto) }}" alt="Existing poster photo" class="object-cover w-full h-24 cursor-pointer hover:opacity-90 transition-opacity" onclick="openPosterPreviewPhotoModal('{{ asset('storage/' . $existingPhoto) }}')">
                                <button type="button" class="absolute top-2 right-2 z-10 p-1 text-white bg-black/60 rounded-full hover:bg-black" onclick="removeExistingPhoto(event, '{{ $existingPhoto }}')" aria-label="Remove photo">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                                <input type="hidden" name="existing_photos[]" value="{{ $existingPhoto }}" data-photo-path="{{ $existingPhoto }}">
                            </div>
                        @endforeach
                    </div>
                @endif
                <div id="photo-dropzone" class="p-6 text-center transition-colors duration-200 border-2 border-gray-300 border-dashed rounded-xl hover:border-indigo-400 hover:bg-indigo-50 cursor-pointer">
                    <input type="file" name="photos[]" accept="image/*" multiple
                        class="hidden" id="photo-upload">
                    <label for="photo-upload" class="cursor-pointer block">
                        <svg class="w-10 h-10 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-indigo-600 font-medium">Drag and drop or click to upload</p>
                        <p class="mt-1 text-sm text-gray-500">PNG, JPG up to 50MB. Uploading new photos will add them to the existing photos unless you remove a photo first.</p>
                    </label>
                </div>
                @error('photos') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                @error('photos.*') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror

                <div id="poster-photo-preview" class="hidden mt-4">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-sm font-semibold text-gray-900">Selected Photos</h3>
                        <span id="poster-preview-count" class="text-sm text-gray-500"></span>
                    </div>
                    <div id="poster-preview-grid" class="grid grid-cols-2 gap-3"></div>
                </div>
            </div>

            <!-- Video Upload -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-semibold text-gray-900">Pet Video (Optional)</label>
                @if($poster->video)
                    @php
                        $ext = strtolower(pathinfo($poster->video, PATHINFO_EXTENSION));
                        $mime = $ext === 'mkv' ? 'video/x-matroska' : "video/{$ext}";
                        $existingVideoUrl = asset('storage/' . $poster->video);
                    @endphp
                    <div class="mb-4 relative" id="existing-video-block">
                        <label class="block mb-2 text-sm font-medium text-gray-700">Existing Video</label>
                        <video controls preload="metadata" playsinline class="w-full rounded-xl border shadow-sm bg-black">
                            <source src="{{ $existingVideoUrl }}" type="{{ $mime }}">
                            Your browser does not support video playback.
                        </video>
                        <button type="button" id="existing-video-remove" class="absolute top-3 right-3 z-20 p-2 text-white bg-black/60 rounded-full" aria-label="Remove existing video">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                @endif
                <div id="video-dropzone" class="p-6 text-center transition-colors duration-200 border-2 border-gray-300 border-dashed rounded-xl hover:border-indigo-400 hover:bg-indigo-50 cursor-pointer">
                    <input type="file" name="video" accept="video/*,.mkv" class="hidden" id="video-upload">
                    <label for="video-upload" class="cursor-pointer block">
                        <svg class="w-10 h-10 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14v2.382a1 1 0 01-1.447.894L7 14.236V9.764l6.553-3.04A1 1 0 0115 6.618V10z" />
                        </svg>
                        <p class="text-indigo-600 font-medium">Drag and drop or click to upload</p>
                        <p class="mt-1 text-sm text-gray-500">MP4, MOV, AVI, WEBM up to 100MB. Video uploads may take longer to submit, please wait for the form to finish.</p>
                    </label>
                </div>
                @error('video') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror

                <div id="poster-video-preview" class="hidden mt-4">
                    <label class="block mb-2 text-sm font-semibold text-gray-900">Video Preview</label>
                    <video id="poster-preview-video" controls preload="metadata" class="w-full rounded-xl border shadow-sm bg-black">
                        <source id="poster-video-source" src="" type="video/mp4">
                        Your browser does not support video playback.
                    </video>
                    <button type="button" id="poster-video-remove" class="absolute top-3 right-3 z-20 p-2 text-white bg-black/60 rounded-full hidden" aria-label="Remove selected video">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                    <div class="mt-3">
                        <span id="poster-video-preview-note" class="text-sm text-gray-500">Use the player controls to preview the selected video.</span>
                    </div>
                </div>
            </div>

            <!-- Pet Name (Conditional) -->
            <div id="pet-name-field" class="mb-6 {{ $poster->type === 'found' ? 'hidden' : 'block' }}">
                <label class="block mb-2 text-sm font-semibold text-gray-900">Pet Name</label>
                <input type="text" name="pet_name" value="{{ old('pet_name', $poster->pet_name) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('pet_name') border-red-500 @enderror"
                    placeholder="Enter pet's name">
                @error('pet_name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Species & Breed -->
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-900">Species</label>
                    <select name="species" id="species" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('species') border-red-500 @enderror">
                        <option value="">Select Species</option>
                        <option value="Canine" {{ $poster->species === 'Canine' ? 'selected' : '' }}>Canine</option>
                        <option value="Feline" {{ $poster->species === 'Feline' ? 'selected' : '' }}>Feline</option>
                    </select>
                    @error('species') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-900">Breed</label>
                    <select name="breed" id="breed" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('breed') border-red-500 @enderror">
                        <option value="">Select Breed</option>
                    </select>
                    @error('breed') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Gender & Colors -->
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-900">Gender</label>
                    <select name="gender"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('gender') border-red-500 @enderror">
                        <option value="">Select Gender</option>
                        <option value="male" {{ $poster->gender === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $poster->gender === 'female' ? 'selected' : '' }}>Female</option>
                        <option value="unknown" {{ $poster->gender === 'unknown' ? 'selected' : '' }}>Unknown</option>
                    </select>
                    @error('gender') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-900">Colors & Markings</label>
                    <div class="grid grid-cols-2 gap-3">
                        @php $selectedColors = old('color_markings', explode(',', $poster->color_markings)); @endphp
                        @foreach(['Black', 'White', 'Brown', 'Gray', 'Orange', 'Cream', 'Tabby'] as $color)
                        <label class="flex items-center space-x-3 cursor-pointer group">
                            <input type="checkbox" name="color_markings[]" value="{{ $color }}"
                                {{ in_array($color, $selectedColors) ? 'checked' : '' }}
                                class="w-4 h-4 text-purple-600 transition-colors duration-200 border-gray-300 rounded focus:ring-purple-500 group-hover:border-purple-400">
                            <span class="text-sm text-gray-700 transition-colors duration-200 group-hover:text-gray-900">{{ $color }}</span>
                        </label>
                        @endforeach
                    </div>
                    @error('color_markings') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Date & Contact Info -->
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-900">Date Lost/Found</label>
                    <input type="date" name="date_lost_found" value="{{ old('date_lost_found', $poster->date_lost_found->format('Y-m-d')) }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('date_lost_found') border-red-500 @enderror">
                    @error('date_lost_found') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-900">Contact Information</label>
                    <input type="text" name="contact_info" value="{{ old('contact_info', $poster->contact_info) }}" placeholder="Email and/or phone number" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('contact_info') border-red-500 @enderror">
                    @error('contact_info') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Social Media Links -->
            <div class="mb-6">
                <label class="block mb-3 text-sm font-semibold text-gray-900">Social Media Links <span class="text-xs font-normal text-gray-500">(Optional)</span></label>
                <p class="mb-4 text-sm text-gray-600">Add your social media profiles so people can reach you directly</p>
                <div class="space-y-3">
                    @php $socialMediaLinks = old('social_media_links', $poster->social_media_links ?? []); @endphp
                    @foreach(['facebook' => 'Facebook', 'instagram' => 'Instagram', 'x' => 'X (Twitter)', 'tiktok' => 'TikTok', 'whatsapp' => 'WhatsApp'] as $key => $label)
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">{{ $label }}</label>
                        <input type="url" name="social_media_links[{{ $key }}]" value="{{ $socialMediaLinks[$key] ?? '' }}"
                            placeholder="https://{{ $key === 'x' ? 'x.com' : $key }}.com/yourprofile"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('social_media_links.' . $key) border-red-500 @enderror">
                        @error('social_media_links.' . $key) <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Descriptions -->
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-900">Short Description</label>
                    <textarea name="description" rows="2" placeholder="Brief description of the pet..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('description') border-red-500 @enderror">{{ old('description', $poster->description) }}</textarea>
                    @error('description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-900">Additional Comments</label>
                    <textarea name="uploader_comments" rows="2" placeholder="Any additional information or comments..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('uploader_comments') border-red-500 @enderror">{{ old('uploader_comments', $poster->uploader_comments) }}</textarea>
                    @error('uploader_comments') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Location -->
            <div id="location-field" class="mb-6">
                <label class="block mb-2 text-sm font-semibold text-gray-900" id="location-label">Location Details</label>
                <textarea name="last_seen" id="last_seen_field" rows="2" placeholder="Where was the pet last seen?"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('last_seen') border-red-500 @enderror"
                    style="{{ $poster->type === 'found' ? 'display: none;' : 'display: block;' }}">{{ old('last_seen', $poster->last_seen) }}</textarea>
                <textarea name="found_at" id="found_at_field" rows="2" placeholder="Where was the pet found?"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('found_at') border-red-500 @enderror"
                    style="{{ $poster->type === 'lost' ? 'display: none;' : 'display: block;' }}">{{ old('found_at', $poster->found_at) }}</textarea>
                @error('last_seen') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                @error('found_at') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>



            <!-- Reward (Conditional) -->
            <div id="reward-field" class="mb-8 {{ $poster->type === 'found' ? 'hidden' : 'block' }}">
                <label class="block mb-2 text-sm font-semibold text-gray-900">Reward (Optional)</label>
                <div class="relative">
                    <span class="absolute text-gray-500 transform -translate-y-1/2 left-4 top-1/2">₱</span>
                    <input type="number" name="reward" step="0.01" value="{{ old('reward', $poster->reward) }}" placeholder="0.00"
                        class="w-full py-3 pl-12 pr-4 transition-all duration-200 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
                @error('reward') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end pt-6 space-x-4 border-t border-gray-200">
                <a href="javascript:void(0)" onclick="history.back()"
                    class="bg-gray-600 text-white hover:bg-gray-800 px-4 py-2 rounded flex items-center justify-center">
                    Cancel
                </a>
                <button type="submit" id="update-poster-button"
                    class="px-8 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-xl hover:from-purple-700 hover:to-purple-800 transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                    onclick="return confirm('Are you sure you want to update this poster?')">
                    Update Poster
                </button>
            </div>
            <p id="poster-submit-status" class="mt-3 text-sm text-gray-500 hidden">Uploading files, please wait… this may take longer when a video is attached.</p>
            <div id="poster-upload-progress" class="mt-3 h-2 overflow-hidden rounded-full bg-gray-200 hidden">
                <div id="poster-upload-progress-bar" class="h-full w-0 rounded-full bg-purple-600"></div>
            </div>
            <p id="poster-upload-progress-label" class="mt-2 text-sm text-gray-500 hidden">0%</p>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.querySelectorAll('input[name="type"]');
        const petNameField = document.getElementById('pet-name-field');
        const speciesSelect = document.getElementById('species');
        const breedSelect = document.getElementById('breed');

        // Handle type selection styling
        function updateTypeStyles() {
            // Remove all selected styles first
            document.querySelectorAll('.type-option').forEach(option => {
                option.classList.remove('border-purple-500', 'bg-purple-50', 'border-green-500', 'bg-green-50');
                option.classList.add('border-gray-200');
            });

            // Add styles to selected option
            const selectedType = document.querySelector('input[name="type"]:checked');
            if (selectedType) {
                const selectedOption = selectedType.closest('label').querySelector('.type-option');
                if (selectedType.value === 'lost') {
                    selectedOption.classList.add('border-purple-500', 'bg-purple-50');
                    selectedOption.classList.remove('border-gray-200');
                } else if (selectedType.value === 'found') {
                    selectedOption.classList.add('border-green-500', 'bg-green-50');
                    selectedOption.classList.remove('border-gray-200');
                }
            }
        }

        function toggleFields() {
            const selectedType = document.querySelector('input[name="type"]:checked')?.value;

            if (selectedType === 'found') {
                petNameField.classList.add('hidden');
                document.getElementById('last_seen_field').style.display = 'none';
                document.getElementById('found_at_field').style.display = 'block';
                document.getElementById('location-label').textContent = 'Found Location';
                document.getElementById('reward-field').classList.add('hidden');
            } else if (selectedType === 'lost') {
                petNameField.classList.remove('hidden');
                document.getElementById('last_seen_field').style.display = 'block';
                document.getElementById('found_at_field').style.display = 'none';
                document.getElementById('location-label').textContent = 'Last Seen Location';
                document.getElementById('reward-field').classList.remove('hidden');
            }
        }

        // Combined function for both styling and field toggling
        function handleTypeChange() {
            updateTypeStyles();
            toggleFields();
        }

        typeSelect.forEach(radio => {
            radio.addEventListener('change', handleTypeChange);
        });

        const updateButton = document.getElementById('update-poster-button');
        const submitStatus = document.getElementById('poster-submit-status');
        const progressContainer = document.getElementById('poster-upload-progress');
        const progressBar = document.getElementById('poster-upload-progress-bar');
        const progressLabel = document.getElementById('poster-upload-progress-label');
        const posterForm = document.getElementById('poster-edit-form');

        function handleUploadProgress(event, button, actionText, successText) {
            if (!posterForm) {
                return;
            }

            event.preventDefault();
            button.disabled = true;
            button.textContent = actionText;

            if (submitStatus) {
                submitStatus.classList.remove('hidden');
                submitStatus.textContent = 'Uploading files, please wait… 0%';
            }
            if (progressContainer && progressLabel && progressBar) {
                progressContainer.classList.remove('hidden');
                progressContainer.style.display = 'block';
                progressBar.style.width = '0%';
                progressLabel.classList.remove('hidden');
                progressLabel.style.display = 'block';
                progressLabel.textContent = '0%';
            }

            const xhr = new XMLHttpRequest();
            const formData = new FormData(posterForm);

            xhr.upload.addEventListener('progress', function(e) {
                if (!e.lengthComputable) {
                    return;
                }
                const percent = Math.round((e.loaded / e.total) * 100);
                if (submitStatus) {
                    submitStatus.textContent = 'Uploading files, please wait… ' + percent + '%';
                }
                if (progressBar) {
                    progressBar.style.width = percent + '%';
                }
                if (progressLabel) {
                    progressLabel.textContent = percent + '%';
                }
            });

            xhr.onreadystatechange = function() {
                if (xhr.readyState !== XMLHttpRequest.DONE) {
                    return;
                }
                if (xhr.status >= 200 && xhr.status < 400) {
                    const redirectUrl = xhr.responseURL || posterForm.action;
                    if (redirectUrl && redirectUrl !== window.location.href) {
                        window.location.href = redirectUrl;
                    } else {
                        button.textContent = successText;
                    }
                } else {
                    button.disabled = false;
                    button.textContent = 'Update Poster';
                    if (submitStatus) {
                        submitStatus.textContent = 'Upload failed. Please try again.';
                    }
                }
            };

            xhr.open('POST', posterForm.action, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.send(formData);
        }

        if (posterForm && updateButton) {
            posterForm.addEventListener('submit', function(event) {
                handleUploadProgress(event, updateButton, 'Updating...', 'Update Poster');
            });
        }

        // Initialize on page load
        updateTypeStyles();
        toggleFields();

        // Handle photo upload and drag-drop
        const photoUpload = document.getElementById('photo-upload');
        const photoDropzone = document.getElementById('photo-dropzone');
        const videoUpload = document.getElementById('video-upload');
        const videoDropzone = document.getElementById('video-dropzone');
        const videoPreviewBlock = document.getElementById('poster-video-preview');
        const videoSource = document.getElementById('poster-video-source');
        const videoPlayer = document.getElementById('poster-preview-video');

        function handleFileSelect(files) {
            if (!files || files.length === 0) {
                document.getElementById('poster-photo-preview').style.display = 'none';
                return;
            }

            const dataTransfer = new DataTransfer();
            Array.from(files).forEach(file => dataTransfer.items.add(file));
            photoUpload.files = dataTransfer.files;

            const previewGrid = document.getElementById('poster-preview-grid');
            previewGrid.innerHTML = '';

            Array.from(files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'relative rounded-xl overflow-hidden border shadow-sm';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = file.name;
                    img.className = 'object-cover w-full h-32 cursor-pointer';
                    img.onclick = function() {
                        openPosterPreviewPhotoModal(e.target.result);
                    };

                    const removeButton = document.createElement('button');
                    removeButton.type = 'button';
                    removeButton.className = 'absolute top-2 right-2 z-10 p-1 text-white bg-black/60 rounded-full hover:bg-black';
                    removeButton.setAttribute('aria-label', 'Remove selected photo');
                    removeButton.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>';
                    removeButton.addEventListener('click', function(event) {
                        event.stopPropagation();
                        removeSelectedPreview(index);
                    });

                    wrapper.appendChild(img);
                    wrapper.appendChild(removeButton);
                    previewGrid.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });

            document.getElementById('poster-preview-count').textContent = files.length + ' photo' + (files.length > 1 ? 's selected' : ' selected');
            document.getElementById('poster-photo-preview').style.display = 'block';
        }

        function removeSelectedPreview(index) {
            const files = Array.from(photoUpload.files);
            if (index < 0 || index >= files.length) {
                return;
            }
            files.splice(index, 1);

            const dataTransfer = new DataTransfer();
            files.forEach(file => dataTransfer.items.add(file));
            photoUpload.files = dataTransfer.files;
            handleFileSelect(photoUpload.files);
        }

        function handleVideoSelect(file) {
            if (!file) {
                return;
            }

            const url = URL.createObjectURL(file);
            videoSource.src = url;
            videoPlayer.load();
            videoPreviewBlock.style.display = 'block';
            const removeBtn = document.getElementById('poster-video-remove');
            if (removeBtn) removeBtn.classList.remove('hidden');

        }

        // Allow removing selected preview video (create/edit)
        const posterVideoRemove = document.getElementById('poster-video-remove');
        if (posterVideoRemove) {
            posterVideoRemove.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (videoUpload) {
                    videoUpload.value = null;
                }
                if (videoSource) {
                    videoSource.src = '';
                }
                if (videoPlayer) {
                    try { videoPlayer.pause(); } catch(_) {}
                }
                if (videoPreviewBlock) {
                    videoPreviewBlock.style.display = 'none';
                }
                if (posterVideoRemove) {
                    posterVideoRemove.classList.add('hidden');
                }
            });
        }

        // Existing video remove (edit page): mark removal via hidden input
        const existingVideoRemove = document.getElementById('existing-video-remove');
        if (existingVideoRemove) {
            existingVideoRemove.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const removeInput = document.getElementById('remove_existing_video');
                if (removeInput) {
                    removeInput.value = '1';
                } else {
                    const form = document.querySelector('form');
                    if (form) {
                        const inp = document.createElement('input');
                        inp.type = 'hidden';
                        inp.name = 'remove_existing_video';
                        inp.value = '1';
                        form.appendChild(inp);
                    }
                }
                const existingBlock = document.getElementById('existing-video-block');
                if (existingBlock) existingBlock.remove();
            });
        }

        window.removeExistingPhoto = function(event, photoPath) {
            event.stopPropagation();

            const button = event.currentTarget;
            const wrapper = button.closest('.relative');
            if (!wrapper) {
                return;
            }

            const hiddenInput = wrapper.querySelector('input[name="existing_photos[]"]');
            if (hiddenInput) {
                hiddenInput.remove();
            }
            wrapper.remove();

            const existingGrid = document.getElementById('existing-photo-grid');
            if (existingGrid && existingGrid.children.length === 1) {
                // The marker input remains as the only child, remove it too.
                existingGrid.remove();
            }
        }

        photoUpload.addEventListener('change', function() {
            handleFileSelect(this.files);
        });

        videoUpload.addEventListener('change', function() {
            handleVideoSelect(this.files[0]);
        });

        // Drag and drop events for photos
        photoDropzone.addEventListener('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            photoDropzone.style.backgroundColor = '#f3e8ff';
            photoDropzone.style.borderColor = '#a855f7';
        });

        photoDropzone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            photoDropzone.style.backgroundColor = '';
            photoDropzone.style.borderColor = '#d1d5db';
        });

        photoDropzone.addEventListener('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            photoDropzone.style.backgroundColor = '';
            photoDropzone.style.borderColor = '#d1d5db';

            const files = e.dataTransfer.files;
            if (files && files.length > 0) {
                handleFileSelect(files);
            }
        });

        // Drag and drop events for video
        videoDropzone.addEventListener('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            videoDropzone.style.backgroundColor = '#f3e8ff';
            videoDropzone.style.borderColor = '#a855f7';
        });

        videoDropzone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            videoDropzone.style.backgroundColor = '';
            videoDropzone.style.borderColor = '#d1d5db';
        });

        videoDropzone.addEventListener('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            videoDropzone.style.backgroundColor = '';
            videoDropzone.style.borderColor = '#d1d5db';

            const files = e.dataTransfer.files;
            if (files && files.length > 0) {
                videoUpload.files = files;
                handleVideoSelect(files[0]);
            }
        });

        // Prevent default drag behavior on entire document
        document.addEventListener('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
        });

        document.addEventListener('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
        });

        // Handle species change for breeds
        speciesSelect.addEventListener('change', function() {
            const selectedSpecies = this.value;
            breedSelect.innerHTML = '<option value="">Select Breed</option>';

            const breeds = {
                'Canine': ['Aspin', 'Poodle', 'Shih Tzu', 'Maltese', 'Pug', 'Beagle', 'Cocker Spaniel', 'Labrador Retriever', 'German Shepherd', 'Golden Retriever'],
                'Feline': ['Philippine Domestic Cat', 'Siamese', 'Persian', 'Maine Coon', 'British Shorthair', 'Ragdoll', 'Bengal', 'Scottish Fold', 'Abyssinian', 'Russian Blue']
            };

            if (breeds[selectedSpecies]) {
                breeds[selectedSpecies].forEach(breed => {
                    const option = document.createElement('option');
                    option.value = breed;
                    option.textContent = breed;
                    // Select the current poster's breed
                    if (breed === '{{ $poster->breed }}') {
                        option.selected = true;
                    }
                    breedSelect.appendChild(option);
                });
            }
        });

        // Initialize breeds on page load
        speciesSelect.dispatchEvent(new Event('change'));
    });
</script>

<!-- Poster Preview Photo Modal -->
<div id="posterPreviewPhotoModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/30 backdrop-blur-sm" onclick="if(event.target.id === 'posterPreviewPhotoModal') closePosterPreviewPhotoModal()">
    <button onclick="closePosterPreviewPhotoModal()" class="absolute z-10 text-white top-6 right-6 hover:text-gray-300">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
    <img id="posterPreviewPhotoImg" src="" alt="Full Size Preview Photo" class="max-w-4xl max-h-[85vh] object-contain rounded-lg shadow-2xl cursor-pointer" onclick="closePosterPreviewPhotoModal()">
</div>

<script>
function openPosterPreviewPhotoModal(src = null) {
    const modalImage = document.getElementById('posterPreviewPhotoImg');
    if (src) {
        modalImage.src = src;
    } else {
        const sourceImg = document.getElementById('poster-preview-img') || document.querySelector('img[src*="storage"]');
        if (!sourceImg || !sourceImg.src) {
            return;
        }
        modalImage.src = sourceImg.src;
    }
    document.getElementById('posterPreviewPhotoModal').classList.remove('hidden');
}

function closePosterPreviewPhotoModal() {
    document.getElementById('posterPreviewPhotoModal').classList.add('hidden');
}

// Add Backspace key support for preview photo modal
document.addEventListener('keydown', function(e) {
    if (e.key === 'Backspace') {
        const previewModal = document.getElementById('posterPreviewPhotoModal');
        if (previewModal && !previewModal.classList.contains('hidden')) {
            closePosterPreviewPhotoModal();
        }
    }
});
</script>
@endsection
