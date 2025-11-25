@extends('layouts.admin')

@section('title', '| Admin - Edit Pet')

@section('content')
<div class="min-h-screen py-8 bg-gray-50">
    <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 overflow-hidden bg-white rounded-lg shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Edit Pet: {{ $pet->display_code }}</h1>
                        <p class="mt-1 text-sm text-gray-600">Update pet information in the system</p>
                    </div>
                    <a href="{{ route('admin.pets.index') }}"
                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Pets
                    </a>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="overflow-hidden bg-white rounded-lg shadow-sm">
            <form action="{{ route('admin.pets.update', $pet) }}" method="POST" enctype="multipart/form-data" class="divide-y divide-gray-200">
                @csrf
                @method('PATCH')
                <div class="px-6 py-6">
                <div class="space-y-6">
                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('status') border-red-500 @enderror">
                            <option value="">Select Status</option>
                            <option value="impounded" {{ old('status', $pet->status) === 'impounded' ? 'selected' : '' }}>Impounded</option>
                            <option value="adoptable" {{ old('status', $pet->status) === 'adoptable' ? 'selected' : '' }}>Adoptable</option>
                        </select>
                        @error('status') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Species and Breed -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Species</label>
                            <select name="species" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('species') border-red-500 @enderror" id="species-select">
                                <option value="">Select Species</option>
                                <option value="Feline" {{ old('species', $pet->species) === 'Feline' ? 'selected' : '' }}>Feline</option>
                                <option value="Canine" {{ old('species', $pet->species) === 'Canine' ? 'selected' : '' }}>Canine</option>
                            </select>
                            @error('species') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Breed</label>
                            <select name="breed" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('breed') border-red-500 @enderror" id="breed-select">
                                <option value="">Select Breed</option>
                                <!-- Feline breeds -->
                                <optgroup label="Feline Breeds" id="feline-breeds" style="display: none;">
                                    <option value="Philippine Domestic Cat" {{ old('breed', $pet->breed) === 'Philippine Domestic Cat' ? 'selected' : '' }}>Philippine Domestic Cat</option>
                                    <option value="Siamese" {{ old('breed', $pet->breed) === 'Siamese' ? 'selected' : '' }}>Siamese</option>
                                    <option value="Persian" {{ old('breed', $pet->breed) === 'Persian' ? 'selected' : '' }}>Persian</option>
                                    <option value="Maine Coon" {{ old('breed', $pet->breed) === 'Maine Coon' ? 'selected' : '' }}>Maine Coon</option>
                                    <option value="British Shorthair" {{ old('breed', $pet->breed) === 'British Shorthair' ? 'selected' : '' }}>British Shorthair</option>
                                    <option value="Ragdoll" {{ old('breed', $pet->breed) === 'Ragdoll' ? 'selected' : '' }}>Ragdoll</option>
                                    <option value="Bengal" {{ old('breed', $pet->breed) === 'Bengal' ? 'selected' : '' }}>Bengal</option>
                                    <option value="Scottish Fold" {{ old('breed', $pet->breed) === 'Scottish Fold' ? 'selected' : '' }}>Scottish Fold</option>
                                    <option value="Abyssinian" {{ old('breed', $pet->breed) === 'Abyssinian' ? 'selected' : '' }}>Abyssinian</option>
                                    <option value="Russian Blue" {{ old('breed', $pet->breed) === 'Russian Blue' ? 'selected' : '' }}>Russian Blue</option>
                                </optgroup>
                                <!-- Canine breeds -->
                                <optgroup label="Canine Breeds" id="canine-breeds" style="display: none;">
                                    <option value="Aspin" {{ old('breed', $pet->breed) === 'Aspin' ? 'selected' : '' }}>Aspin</option>
                                    <option value="Poodle" {{ old('breed', $pet->breed) === 'Poodle' ? 'selected' : '' }}>Poodle</option>
                                    <option value="Shih Tzu" {{ old('breed', $pet->breed) === 'Shih Tzu' ? 'selected' : '' }}>Shih Tzu</option>
                                    <option value="Maltese" {{ old('breed', $pet->breed) === 'Maltese' ? 'selected' : '' }}>Maltese</option>
                                    <option value="Pug" {{ old('breed', $pet->breed) === 'Pug' ? 'selected' : '' }}>Pug</option>
                                    <option value="Beagle" {{ old('breed', $pet->breed) === 'Beagle' ? 'selected' : '' }}>Beagle</option>
                                    <option value="Cocker Spaniel" {{ old('breed', $pet->breed) === 'Cocker Spaniel' ? 'selected' : '' }}>Cocker Spaniel</option>
                                    <option value="Labrador Retriever" {{ old('breed', $pet->breed) === 'Labrador Retriever' ? 'selected' : '' }}>Labrador Retriever</option>
                                    <option value="German Shepherd" {{ old('breed', $pet->breed) === 'German Shepherd' ? 'selected' : '' }}>German Shepherd</option>
                                    <option value="Golden Retriever" {{ old('breed', $pet->breed) === 'Golden Retriever' ? 'selected' : '' }}>Golden Retriever</option>
                                </optgroup>
                            </select>
                            @error('breed') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Estimated Age -->
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estimated Age - Years</label>
                            <select name="estimated_age_years" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('estimated_age_years') border-red-500 @enderror">
                                <option value="">Unknown</option>
                                @for($i = 0; $i <= 20; $i++)
                                    <option value="{{ $i }}" {{ old('estimated_age_years', $pet->estimated_age_years) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('estimated_age_years') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estimated Age - Months</label>
                            <select name="estimated_age_months" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('estimated_age_months') border-red-500 @enderror">
                                <option value="">Unknown</option>
                                @for($i = 0; $i <= 11; $i++)
                                    <option value="{{ $i }}" {{ old('estimated_age_months', $pet->estimated_age_months) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('estimated_age_months') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Gender -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gender</label>
                        <select name="gender" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('gender') border-red-500 @enderror">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender', $pet->gender) === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $pet->gender) === 'female' ? 'selected' : '' }}>Female</option>
                            <option value="unknown" {{ old('gender', $pet->gender) === 'unknown' ? 'selected' : '' }}>Unknown</option>
                        </select>
                        @error('gender') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('description') border-red-500 @enderror" placeholder="Describe the pet's appearance, behavior, health condition, etc.">{{ old('description', $pet->description) }}</textarea>
                        @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Color Markings -->
                    <div>
                        <label class="block mb-3 text-sm font-medium text-gray-700">Color Markings</label>
                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                            <label class="inline-flex items-center p-2 text-sm font-medium text-gray-700 transition duration-150 rounded-lg bg-gray-50 hover:bg-indigo-50">
                                <input type="checkbox" name="color_markings[]" value="Black" {{ in_array('Black', old('color_markings', explode(',', $pet->color_markings))) ? 'checked' : '' }} class="w-4 h-4 mr-2 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span>Black</span>
                            </label>
                            <label class="inline-flex items-center p-2 text-sm font-medium text-gray-700 transition duration-150 rounded-lg bg-gray-50 hover:bg-indigo-50">
                                <input type="checkbox" name="color_markings[]" value="White" {{ in_array('White', old('color_markings', explode(',', $pet->color_markings))) ? 'checked' : '' }} class="w-4 h-4 mr-2 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span>White</span>
                            </label>
                            <label class="inline-flex items-center p-2 text-sm font-medium text-gray-700 transition duration-150 rounded-lg bg-gray-50 hover:bg-indigo-50">
                                <input type="checkbox" name="color_markings[]" value="Brown" {{ in_array('Brown', old('color_markings', explode(',', $pet->color_markings))) ? 'checked' : '' }} class="w-4 h-4 mr-2 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span>Brown</span>
                            </label>
                            <label class="inline-flex items-center p-2 text-sm font-medium text-gray-700 transition duration-150 rounded-lg bg-gray-50 hover:bg-indigo-50">
                                <input type="checkbox" name="color_markings[]" value="Gray" {{ in_array('Gray', old('color_markings', explode(',', $pet->color_markings))) ? 'checked' : '' }} class="w-4 h-4 mr-2 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span>Gray</span>
                            </label>
                            <label class="inline-flex items-center p-2 text-sm font-medium text-gray-700 transition duration-150 rounded-lg bg-gray-50 hover:bg-indigo-50">
                                <input type="checkbox" name="color_markings[]" value="Orange" {{ in_array('Orange', old('color_markings', explode(',', $pet->color_markings))) ? 'checked' : '' }} class="w-4 h-4 mr-2 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span>Orange</span>
                            </label>
                            <label class="inline-flex items-center p-2 text-sm font-medium text-gray-700 transition duration-150 rounded-lg bg-gray-50 hover:bg-indigo-50">
                                <input type="checkbox" name="color_markings[]" value="Cream" {{ in_array('Cream', old('color_markings', explode(',', $pet->color_markings))) ? 'checked' : '' }} class="w-4 h-4 mr-2 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span>Cream</span>
                            </label>
                            <label class="inline-flex items-center p-2 text-sm font-medium text-gray-700 transition duration-150 rounded-lg bg-gray-50 hover:bg-indigo-50">
                                <input type="checkbox" name="color_markings[]" value="Tabby" {{ in_array('Tabby', old('color_markings', explode(',', $pet->color_markings))) ? 'checked' : '' }} class="w-4 h-4 mr-2 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span>Tabby</span>
                            </label>
                        </div>
                        @error('color_markings') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Conditional Fields -->
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2" id="impounded-fields" style="display: none;">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Caught Date</label>
                            <input type="date" name="impounded_date" value="{{ old('impounded_date', $pet->impounded_date ? $pet->impounded_date->format('Y-m-d') : '') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('impounded_date') border-red-500 @enderror">
                            @error('impounded_date') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Caught Location</label>
                            <input type="text" name="caught_location" value="{{ old('caught_location', $pet->caught_location) }}" placeholder="e.g., Barangay ABC, City" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('caught_location') border-red-500 @enderror">
                            @error('caught_location') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2" id="adoptable-fields" style="display: none;">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Adoptable Date</label>
                            <input type="date" name="decision_date" value="{{ old('decision_date', $pet->decision_date ? $pet->decision_date->format('Y-m-d') : date('Y-m-d')) }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('decision_date') border-red-500 @enderror">
                            @error('decision_date') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Adoption Reason</label>
                            @php
                                $keyToLabel = [
                                    'surrendered_by_owner' => 'Owner Relocation/Moving',
                                    'remained_unclaimed' => 'Remained Unclaimed',
                                    'found_by_citizen' => 'Found by Citizen',
                                    'other' => 'Other',
                                ];
                                $current = $pet->adoption_reason;
                                if ($current === 'other' && !empty($pet->adoption_reason_other)) {
                                    $currentLabel = $pet->adoption_reason_other;
                                } else {
                                    $currentLabel = $keyToLabel[$current] ?? $current;
                                }
                                $selectedValue = old('adoption_reason', $currentLabel);
                            @endphp
                            <select name="adoption_reason" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('adoption_reason') border-red-500 @enderror">
                                <option value="">Select Reason</option>
                                <option value="Owner Relocation/Moving" {{ $selectedValue === 'Owner Relocation/Moving' ? 'selected' : '' }}>Owner Relocation/Moving</option>
                                <option value="Owner Illness/Death" {{ $selectedValue === 'Owner Illness/Death' ? 'selected' : '' }}>Owner Illness/Death</option>
                                <option value="Financial Hardship" {{ $selectedValue === 'Financial Hardship' ? 'selected' : '' }}>Financial Hardship</option>
                                <option value="Landlord/Housing Restriction" {{ $selectedValue === 'Landlord/Housing Restriction' ? 'selected' : '' }}>Landlord/Housing Restriction</option>
                                <option value="Lifestyle/Schedule Change" {{ $selectedValue === 'Lifestyle/Schedule Change' ? 'selected' : '' }}>Lifestyle/Schedule Change</option>
                                <option value="Incompatibility with Existing Pets" {{ $selectedValue === 'Incompatibility with Existing Pets' ? 'selected' : '' }}>Incompatibility with Existing Pets</option>
                                <option value="Incompatibility with Children" {{ $selectedValue === 'Incompatibility with Children' ? 'selected' : '' }}>Incompatibility with Children</option>
                                <option value="Household Allergies" {{ $selectedValue === 'Household Allergies' ? 'selected' : '' }}>Household Allergies</option>
                                <option value="Needs More Space/Exercise" {{ $selectedValue === 'Needs More Space/Exercise' ? 'selected' : '' }}>Needs More Space/Exercise</option>
                                <option value="Behavioral Issues" {{ $selectedValue === 'Behavioral Issues' ? 'selected' : '' }}>Behavioral Issues (Requires Detail in Notes)</option>
                            </select>
                            @error('adoption_reason') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div id="adoption-notes-field" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700">Adoption Notes</label>
                        <textarea name="adoption_notes" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('adoption_notes') border-red-500 @enderror" placeholder="Additional details about the adoption reason">{{ old('adoption_notes', $pet->adoption_notes) }}</textarea>
                        @error('adoption_notes') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Photo Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Photo</label>
                        <div class="flex justify-center px-6 pt-5 pb-6 mt-1 transition duration-150 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-400">
                            <div class="space-y-1 text-center">
                                <svg class="w-12 h-12 mx-auto text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m-4-4h2m-2 4h4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload" class="relative font-medium text-indigo-600 bg-white rounded-md cursor-pointer hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="file-upload" name="photo" type="file" accept="image/*" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p id="file-name" class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                            </div>
                        </div>
                        @error('photo') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        @if($pet->photo)
                            <div class="mt-4">
                                <p class="text-sm text-gray-600">Current photo:</p>
                                <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="object-cover w-24 h-24 mt-2 border border-gray-300 rounded">
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between px-6 py-4 sm:px-10 bg-gray-50 rounded-b-xl">
                <a href="{{ route('admin.pets.index') }}" class="inline-flex justify-center px-6 py-2 text-sm font-medium text-gray-700 transition duration-150 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-100">
                    Cancel
                </a>
                <button type="submit" class="inline-flex justify-center px-8 py-3 text-base font-medium text-white transition duration-150 bg-indigo-600 border border-transparent rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Update Pet
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.querySelector('select[name="status"]');
    const impoundedFields = document.getElementById('impounded-fields');
    const adoptableFields = document.getElementById('adoptable-fields');
    const adoptionNotesField = document.getElementById('adoption-notes-field');
    const speciesSelect = document.getElementById('species-select');
    const breedSelect = document.getElementById('breed-select');
    const felineBreeds = document.getElementById('feline-breeds');
    const canineBreeds = document.getElementById('canine-breeds');
    const fileUpload = document.getElementById('file-upload');
    const fileNameDisplay = document.getElementById('file-name');

    function toggleStatusFields() {
        const status = statusSelect.value;
        if (status === 'impounded') {
            impoundedFields.style.display = 'grid';
            adoptableFields.style.display = 'none';
            adoptionNotesField.style.display = 'none';
        } else if (status === 'adoptable') {
            impoundedFields.style.display = 'none';
            adoptableFields.style.display = 'grid';
            adoptionNotesField.style.display = 'block';
        } else {
            impoundedFields.style.display = 'none';
            adoptableFields.style.display = 'none';
            adoptionNotesField.style.display = 'none';
        }
    }

    function toggleBreedOptions() {
        const species = speciesSelect.value;
        if (species === 'Feline') {
            felineBreeds.style.display = 'block';
            canineBreeds.style.display = 'none';
        } else if (species === 'Canine') {
            felineBreeds.style.display = 'none';
            canineBreeds.style.display = 'block';
        } else {
            felineBreeds.style.display = 'none';
            canineBreeds.style.display = 'none';
        }
    }

    // Update file name display
    fileUpload.addEventListener('change', function() {
        if (this.files.length > 0) {
            fileNameDisplay.textContent = this.files[0].name;
        } else {
            fileNameDisplay.textContent = 'PNG, JPG, GIF up to 10MB';
        }
    });

    statusSelect.addEventListener('change', toggleStatusFields);
    speciesSelect.addEventListener('change', toggleBreedOptions);

    // Initialize on page load
    toggleStatusFields();
    toggleBreedOptions();
});
</script>
