@extends('layouts.app')

@section('title', '| Edit Poster')

@section('content')
<div class="min-h-screen pt-24 bg-gray-50">
    <div class="max-w-3xl px-4 py-8 mx-auto">
        <!-- Header -->
        <div class="flex items-center mb-8">
            <div class="p-3 mr-4 bg-white rounded-full shadow-sm">
                <img src="{{ asset('https://i.ibb.co/8DPN5B7m/logo.png') }}" alt="FindFurEver Logo" class="object-contain w-12 h-12">
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Poster</h1>
                <p class="mt-1 text-gray-600">Update your lost or found pet information</p>
            </div>
        </div>

        <!-- Form Card -->
        <form action="{{ route('posters.update', $poster) }}" method="POST" enctype="multipart/form-data" class="p-6 bg-white shadow-lg rounded-2xl md:p-8">
            @csrf
            @method('PATCH')

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
                <label class="block mb-2 text-sm font-semibold text-gray-900">Pet Photo</label>
                @if($poster->photo)
                    <div class="mb-4">
                        <p class="mb-2 text-sm text-gray-600">Current Photo:</p>
                        <img src="{{ asset('storage/' . $poster->photo) }}" alt="Current poster photo" class="object-cover w-32 h-32 border rounded-xl cursor-pointer hover:opacity-90 transition-opacity" onclick="openPosterPreviewPhotoModal()">
                        <p class="mt-2 text-sm text-gray-500">Upload new photo to replace current one</p>
                    </div>
                @endif
                <div id="photo-dropzone" class="p-6 text-center transition-colors duration-200 border-2 border-gray-300 border-dashed rounded-xl hover:border-indigo-400 hover:bg-indigo-50 cursor-pointer">
                    <input type="file" name="photo" accept="image/*"
                        class="hidden" id="photo-upload">
                    <label for="photo-upload" class="cursor-pointer block">
                        <svg class="w-10 h-10 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-indigo-600 font-medium">Drag and drop or click to upload</p>
                        <p class="mt-1 text-sm text-gray-500">PNG, JPG up to 50MB</p>
                    </label>
                </div>
                @error('photo') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                <div id="poster-photo-preview" class="mt-4" style="display: none;">
                    <p class="text-sm font-medium text-gray-900 mb-2">Preview:</p>
                    <img id="poster-preview-img" src="" alt="Photo preview" class="max-w-sm max-h-64 rounded-xl shadow-md border border-gray-300 cursor-pointer hover:opacity-90 transition-opacity" onclick="openPosterPreviewPhotoModal()">
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
                <button type="submit"
                    class="px-8 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-xl hover:from-purple-700 hover:to-purple-800 transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                    onclick="return confirm('Are you sure you want to update this poster?')">
                    Update Poster
                </button>
            </div>
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

        // Initialize on page load
        updateTypeStyles();
        toggleFields();

        // Handle photo upload and drag-drop
        const photoUpload = document.getElementById('photo-upload');
        const photoDropzone = document.getElementById('photo-dropzone');

        // Function to handle file selection
        function handleFileSelect(files) {
            if (files && files[0]) {
                // Set the file to the input
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(files[0]);
                photoUpload.files = dataTransfer.files;

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('poster-preview-img').src = e.target.result;
                    document.getElementById('poster-photo-preview').style.display = 'block';
                };
                reader.readAsDataURL(files[0]);
            }
        }

        // Click to upload
        photoUpload.addEventListener('change', function() {
            handleFileSelect(this.files);
        });

        // Drag and drop events
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
function openPosterPreviewPhotoModal() {
    const sourceImg = document.getElementById('poster-preview-img') || document.querySelector('img[src*="storage"]');
    if (sourceImg && sourceImg.src) {
        document.getElementById('posterPreviewPhotoImg').src = sourceImg.src;
        document.getElementById('posterPreviewPhotoModal').classList.remove('hidden');
    }
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
