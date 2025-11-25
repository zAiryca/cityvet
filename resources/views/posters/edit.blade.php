@extends('layouts.app')

@section('title', '| Edit Poster')

@section('content')
<div class="min-h-screen bg-gray-50 pt-24">
    <div class="max-w-3xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex items-center mb-8">
            <div class="bg-white rounded-full p-3 shadow-sm mr-4">
                <img src="{{ asset('https://i.ibb.co/8DPN5B7m/logo.png') }}" alt="FindFurEver Logo" class="w-12 h-12 object-contain">
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Poster</h1>
                <p class="text-gray-600 mt-1">Update your lost or found pet information</p>
            </div>
        </div>

        <!-- Form Card -->
        <form action="{{ route('posters.update', $poster) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
            @csrf
            @method('PATCH')

            <!-- Poster Type -->
            <div class="mb-8">
                <label class="block text-sm font-semibold text-gray-900 mb-3">Poster Type</label>
                <div class="grid grid-cols-2 gap-4" id="type-container">
                    <!-- Lost Pet -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="type" value="lost" {{ $poster->type === 'lost' ? 'checked' : '' }} class="sr-only type-radio" required>
                        <div class="border-2 border-gray-200 rounded-xl p-4 text-center transition-all duration-200 hover:border-purple-300 type-option" data-type="lost">
                            <div class="w-8 h-8 mx-auto mb-2 rounded-full bg-red-100 flex items-center justify-center">
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
                        <div class="border-2 border-gray-200 rounded-xl p-4 text-center transition-all duration-200 hover:border-green-300 type-option" data-type="found">
                            <div class="w-8 h-8 mx-auto mb-2 rounded-full bg-green-100 flex items-center justify-center">
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

            <!-- Pet Name (Conditional) -->
            <div id="pet-name-field" class="mb-6 {{ $poster->type === 'found' ? 'hidden' : 'block' }}">
                <label class="block text-sm font-semibold text-gray-900 mb-2">Pet Name</label>
                <input type="text" name="pet_name" value="{{ old('pet_name', $poster->pet_name) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('pet_name') border-red-500 @enderror"
                    placeholder="Enter pet's name">
                @error('pet_name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Species & Breed -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Species</label>
                    <select name="species" id="species" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('species') border-red-500 @enderror">
                        <option value="">Select Species</option>
                        <option value="Canine" {{ $poster->species === 'Canine' ? 'selected' : '' }}>🐕 Canine</option>
                        <option value="Feline" {{ $poster->species === 'Feline' ? 'selected' : '' }}>🐈 Feline</option>
                    </select>
                    @error('species') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Breed</label>
                    <select name="breed" id="breed" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('breed') border-red-500 @enderror">
                        <option value="">Select Breed</option>
                    </select>
                    @error('breed') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Gender & Colors -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Gender</label>
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
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Colors & Markings</label>
                    <div class="grid grid-cols-2 gap-3">
                        @php $selectedColors = old('color_markings', explode(',', $poster->color_markings)); @endphp
                        @foreach(['Black', 'White', 'Brown', 'Gray', 'Orange', 'Cream', 'Tabby'] as $color)
                        <label class="flex items-center space-x-3 cursor-pointer group">
                            <input type="checkbox" name="color_markings[]" value="{{ $color }}"
                                {{ in_array($color, $selectedColors) ? 'checked' : '' }}
                                class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500 group-hover:border-purple-400 transition-colors duration-200">
                            <span class="text-sm text-gray-700 group-hover:text-gray-900 transition-colors duration-200">{{ $color }}</span>
                        </label>
                        @endforeach
                    </div>
                    @error('color_markings') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Date -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-900 mb-2">Date Lost/Found</label>
                <input type="date" name="date_lost_found" value="{{ old('date_lost_found', $poster->date_lost_found->format('Y-m-d')) }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('date_lost_found') border-red-500 @enderror">
                @error('date_lost_found') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Descriptions -->
            <div class="space-y-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Short Description</label>
                    <textarea name="description" rows="2" placeholder="Brief description of the pet..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('description') border-red-500 @enderror">{{ old('description', $poster->description) }}</textarea>
                    @error('description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Additional Comments</label>
                    <textarea name="uploader_comments" rows="3" placeholder="Any additional information or comments..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('uploader_comments') border-red-500 @enderror">{{ old('uploader_comments', $poster->uploader_comments) }}</textarea>
                    @error('uploader_comments') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Location -->
            <div id="location-field" class="mb-6">
                <label class="block text-sm font-semibold text-gray-900 mb-2" id="location-label">
                    @if($poster->type === 'lost')
                        Last Seen Location
                    @else
                        Found Location
                    @endif
                </label>
                <textarea name="last_seen" id="last_seen_field" rows="3" placeholder="Where was the pet last seen?"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('last_seen') border-red-500 @enderror"
                    style="{{ $poster->type === 'found' ? 'display: none;' : 'display: block;' }}">{{ old('last_seen', $poster->last_seen) }}</textarea>
                <textarea name="found_at" id="found_at_field" rows="3" placeholder="Where was the pet found?"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('found_at') border-red-500 @enderror"
                    style="{{ $poster->type === 'lost' ? 'display: none;' : 'display: block;' }}">{{ old('found_at', $poster->found_at) }}</textarea>
                @error('last_seen') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                @error('found_at') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Photo Upload -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-900 mb-2">Pet Photo</label>
                @if($poster->photo)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Current Photo:</p>
                        <img src="{{ asset('storage/' . $poster->photo) }}" alt="Current poster photo" class="w-32 h-32 object-cover rounded-xl border">
                        <p class="text-sm text-gray-500 mt-2">Upload new photo to replace current one</p>
                    </div>
                @endif
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-purple-400 transition-colors duration-200">
                    <input type="file" name="photo" accept="image/*"
                        class="hidden" id="photo-upload">
                    <label for="photo-upload" class="cursor-pointer">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-gray-600">Click to upload a new photo</p>
                        <p class="text-sm text-gray-500 mt-1">PNG, JPG up to 5MB</p>
                    </label>
                </div>
                @error('photo') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Contact Info -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-900 mb-2">Contact Information</label>
                <input type="text" name="contact_info" value="{{ old('contact_info', $poster->contact_info) }}" placeholder="Email and/or phone number" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('contact_info') border-red-500 @enderror">
                @error('contact_info') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Reward (Conditional) -->
            <div id="reward-field" class="mb-8 {{ $poster->type === 'found' ? 'hidden' : 'block' }}">
                <label class="block text-sm font-semibold text-gray-900 mb-2">Reward (Optional)</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">₱</span>
                    <input type="number" name="reward" step="0.01" value="{{ old('reward', $poster->reward) }}" placeholder="0.00"
                        class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                </div>
                @error('reward') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('user.posters') }}"
                    class="px-6 py-3 text-gray-700 border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors duration-200 font-medium">
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
@endsection

