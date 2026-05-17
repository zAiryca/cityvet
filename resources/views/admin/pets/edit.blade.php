@extends('layouts.admin')

@section('title', '| Admin - Edit Pet')

@section('content')
<div class="min-h-screen py-8 bg-gray-50">
    <div class="max-w-6xl px-4 mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 overflow-hidden bg-white rounded-lg shadow-sm">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Edit Pet: {{ $pet->display_code }}</h1>
                        <p class="mt-1 text-sm text-gray-600">Update pet information in the system</p>
                    </div>
                    <a href="javascript:void(0)" onclick="history.back()" class="px-4 py-2 text-white bg-gray-600 rounded hover:bg-gray-800">
                        Cancel
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
                    <div class="grid grid-cols-1 gap-4 xl:gap-6 xl:grid-cols-[minmax(260px,_320px)_minmax(0,_1fr)] xl:justify-items-start">
                        <div class="xl:row-span-3 xl:max-w-[320px]">
                            <label class="block text-sm font-medium text-gray-700">Photo</label>
                            <div id="admin-photo-dropzone" class="flex justify-center px-6 pt-5 pb-6 mt-1 transition duration-150 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-indigo-400 hover:bg-indigo-50">
                                <div class="space-y-1 text-center">
                                    <svg class="w-12 h-12 mx-auto text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m-4-4h2m-2 4h4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="file-upload" class="relative font-medium text-indigo-600 bg-white rounded-md cursor-pointer hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Drag and drop or click to upload</span>
                                            <input id="file-upload" name="photo" type="file" accept="image/*" class="sr-only">
                                        </label>
                                    </div>
                                    <p id="file-name" class="text-xs text-gray-500">PNG, JPG, GIF up to 50MB</p>
                                </div>
                            </div>
                            @error('photo') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                            @if($pet->photo)
                                <div class="mt-3">
                                    <p class="text-sm text-gray-600">Current photo:</p>
                                    <div class="h-48 overflow-hidden">
                                        <img id="admin-preview-img" src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="object-cover w-full h-48 mt-2 transition-opacity border border-gray-300 rounded cursor-pointer hover:opacity-90" onclick="openAdminPreviewPhotoModal()">
                                    </div>
                                </div>
                            @endif
                            <div id="admin-photo-preview" class="mt-3">
                                <p class="text-sm text-gray-600">Preview photo:</p>
                                <div class="h-48 overflow-hidden opacity-0 transition-opacity duration-200" id="admin-photo-preview-container">
                                    <img id="selected-file-preview" src="" alt="Selected photo preview" class="object-cover w-full h-48 mt-2 transition-opacity border border-gray-300 rounded cursor-pointer hover:opacity-90" onclick="openAdminPreviewPhotoModal()">
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4">
                            <div class="grid grid-cols-1 gap-4 xl:grid-cols-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" required class="mt-1 block w-full border rounded-md p-2 @error('status') border-red-500 @enderror" style="border-color: #d1d5db; background-color: #f9fafb;">
                                        <option value="" style="color: #6b7280; background-color: white;">Select Status</option>
                                        <option value="impounded" {{ old('status', $pet->status) === 'impounded' ? 'selected' : '' }} style="background-color: #fee2e2; color: #7f1d1d;">Impounded</option>
                                        <option value="adoptable" {{ old('status', $pet->status) === 'adoptable' ? 'selected' : '' }} style="background-color: #dcfce7; color: #14532d;">Adoptable</option>
                                    </select>
                                    @error('status') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Species</label>
                                    <select name="species" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('species') border-red-500 @enderror" id="species-select">
                                        <option value="">Select Species</option>
                                        <option value="Feline" {{ old('species', $pet->species) === 'Feline' ? 'selected' : '' }}>Feline</option>
                                        <option value="Canine" {{ old('species', $pet->species) === 'Canine' ? 'selected' : '' }}>Canine</option>
                                    </select>
                                    @error('species') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Breed</label>
                                    <select name="breed" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('breed') border-red-500 @enderror" id="breed-select">
                                        <option value="">Select Breed</option>
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
                            <div class="grid grid-cols-1 gap-4 xl:grid-cols-3">
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
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Years</label>
                                    <select name="estimated_age_years" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('estimated_age_years') border-red-500 @enderror">
                                        <option value="">Unknown</option>
                                        @for($i = 0; $i <= 20; $i++)
                                            <option value="{{ $i }}" {{ old('estimated_age_years', $pet->estimated_age_years) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('estimated_age_years') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Months</label>
                                    <select name="estimated_age_months" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('estimated_age_months') border-red-500 @enderror">
                                        <option value="">Unknown</option>
                                        @for($i = 0; $i <= 11; $i++)
                                            <option value="{{ $i }}" {{ old('estimated_age_months', $pet->estimated_age_months) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('estimated_age_months') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-3 xl:grid-cols-[minmax(0,_1fr)_minmax(0,_1fr)]">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700">Color Markings</label>
                                    <div class="flex flex-wrap gap-2 py-1">
                                        <label class="inline-flex items-center p-2 text-sm font-medium text-gray-700 transition duration-150 rounded-lg bg-gray-50 hover:bg-indigo-50">
                                            <input type="checkbox" name="color_markings[]" value="Black" {{ in_array('Black', old('color_markings', explode(',', $pet->color_markings))) ? 'checked' : '' }} class="w-5 h-5 mr-2 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                            <span>Black</span>
                                        </label>
                                        <label class="inline-flex items-center p-2 text-sm font-medium text-gray-700 transition duration-150 rounded-lg bg-gray-50 hover:bg-indigo-50">
                                            <input type="checkbox" name="color_markings[]" value="White" {{ in_array('White', old('color_markings', explode(',', $pet->color_markings))) ? 'checked' : '' }} class="w-5 h-5 mr-2 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                            <span>White</span>
                                        </label>
                                        <label class="inline-flex items-center p-2 text-sm font-medium text-gray-700 transition duration-150 rounded-lg bg-gray-50 hover:bg-indigo-50">
                                            <input type="checkbox" name="color_markings[]" value="Brown" {{ in_array('Brown', old('color_markings', explode(',', $pet->color_markings))) ? 'checked' : '' }} class="w-5 h-5 mr-2 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                            <span>Brown</span>
                                        </label>
                                        <label class="inline-flex items-center p-2 text-sm font-medium text-gray-700 transition duration-150 rounded-lg bg-gray-50 hover:bg-indigo-50">
                                            <input type="checkbox" name="color_markings[]" value="Gray" {{ in_array('Gray', old('color_markings', explode(',', $pet->color_markings))) ? 'checked' : '' }} class="w-5 h-5 mr-2 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                            <span>Gray</span>
                                        </label>
                                        <label class="inline-flex items-center p-2 text-sm font-medium text-gray-700 transition duration-150 rounded-lg bg-gray-50 hover:bg-indigo-50">
                                            <input type="checkbox" name="color_markings[]" value="Orange" {{ in_array('Orange', old('color_markings', explode(',', $pet->color_markings))) ? 'checked' : '' }} class="w-5 h-5 mr-2 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                            <span>Orange</span>
                                        </label>
                                        <label class="inline-flex items-center p-2 text-sm font-medium text-gray-700 transition duration-150 rounded-lg bg-gray-50 hover:bg-indigo-50">
                                            <input type="checkbox" name="color_markings[]" value="Cream" {{ in_array('Cream', old('color_markings', explode(',', $pet->color_markings))) ? 'checked' : '' }} class="w-5 h-5 mr-2 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                            <span>Cream</span>
                                        </label>
                                        <label class="inline-flex items-center p-2 text-sm font-medium text-gray-700 transition duration-150 rounded-lg bg-gray-50 hover:bg-indigo-50">
                                            <input type="checkbox" name="color_markings[]" value="Tabby" {{ in_array('Tabby', old('color_markings', explode(',', $pet->color_markings))) ? 'checked' : '' }} class="w-5 h-5 mr-2 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                            <span>Tabby</span>
                                        </label>
                                    </div>
                                    @error('color_markings') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea name="description" rows="2" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('description') border-red-500 @enderror" placeholder="Pet description(appearance, behavior, health, etc.">{{ old('description', $pet->description) }}</textarea>
                                    @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div id="impounded-fields" class="grid grid-cols-3 gap-3 rounded-lg p-4 max-w-lg" style="display: none; background-color: #fee2e2; color: #7f1d1d; border: 1px solid #fca5a5;">
                                <div class="col-span-1">
                                    <label class="block text-sm font-medium">Caught Date</label>
                                    <input type="date" name="impounded_date" value="{{ old('impounded_date', $pet->impounded_date ? $pet->impounded_date->format('Y-m-d') : '') }}" class="block w-full p-2 mt-1 border rounded-md text-sm" style="border-color: #fca5a5; background-color: rgba(255, 255, 255, 0.8); height: 2.5rem;">
                                    @error('impounded_date') <p class="mt-1 text-sm" style="color: #7f1d1d;">{{ $message }}</p> @enderror
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium">Caught Location</label>
                                    <input type="text" name="caught_location" value="{{ old('caught_location', $pet->caught_location) }}" placeholder="e.g., Barangay Poblacion, Cpark" class="block w-full p-2 mt-1 border rounded-md text-sm" style="border-color: #fca5a5; background-color: rgba(255, 255, 255, 0.8); height: 2.5rem;">
                                    @error('caught_location') <p class="mt-1 text-sm" style="color: #7f1d1d;">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div id="adoptable-fields" class="grid grid-cols-4 gap-3 rounded-lg p-4" style="display: none; background-color: #dcfce7; color: #14532d; border: 1px solid #86efac;">
                                <div class="col-span-1">
                                    <label class="block text-sm font-medium">Adoptable Date</label>
                                    <input type="date" name="decision_date" value="{{ old('decision_date', $pet->decision_date ? $pet->decision_date->format('Y-m-d') : date('Y-m-d')) }}" class="block w-full p-2 mt-1 border rounded-md text-sm" style="border-color: #86efac; background-color: rgba(255, 255, 255, 0.8); height: 2.5rem;">
                                    @error('decision_date') <p class="mt-1 text-sm" style="color: #14532d;">{{ $message }}</p> @enderror
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium">Adoption Reason</label>
                                    <select name="adoption_reason" class="block w-full p-2 mt-1 border rounded-md text-sm" style="border-color: #86efac; background-color: rgba(255, 255, 255, 0.8); height: 2.5rem;">
                                        <option value="">Select Reason</option>
                                        <option value="Owner Relocation/Moving" {{ old('adoption_reason', $pet->adoption_reason) === 'Owner Relocation/Moving' ? 'selected' : '' }}>Owner Relocation/Moving</option>
                                        <option value="Owner Illness/Death" {{ old('adoption_reason', $pet->adoption_reason) === 'Owner Illness/Death' ? 'selected' : '' }}>Owner Illness/Death</option>
                                        <option value="Financial Hardship" {{ old('adoption_reason', $pet->adoption_reason) === 'Financial Hardship' ? 'selected' : '' }}>Financial Hardship</option>
                                        <option value="Landlord/Housing Restriction" {{ old('adoption_reason', $pet->adoption_reason) === 'Landlord/Housing Restriction' ? 'selected' : '' }}>Landlord/Housing Restriction</option>
                                        <option value="Lifestyle/Schedule Change" {{ old('adoption_reason', $pet->adoption_reason) === 'Lifestyle/Schedule Change' ? 'selected' : '' }}>Lifestyle/Schedule Change</option>
                                        <option value="Incompatibility with Existing Pets" {{ old('adoption_reason', $pet->adoption_reason) === 'Incompatibility with Existing Pets' ? 'selected' : '' }}>Incompatibility with Existing Pets</option>
                                        <option value="Incompatibility with Children" {{ old('adoption_reason', $pet->adoption_reason) === 'Incompatibility with Children' ? 'selected' : '' }}>Incompatibility with Children</option>
                                        <option value="Household Allergies" {{ old('adoption_reason', $pet->adoption_reason) === 'Household Allergies' ? 'selected' : '' }}>Household Allergies</option>
                                        <option value="Needs More Space/Exercise" {{ old('adoption_reason', $pet->adoption_reason) === 'Needs More Space/Exercise' ? 'selected' : '' }}>Needs More Space/Exercise</option>
                                        <option value="Behavioral Issues" {{ old('adoption_reason', $pet->adoption_reason) === 'Behavioral Issues' ? 'selected' : '' }}>Behavioral Issues (Requires Detail in Notes)</option>
                                    </select>
                                    @error('adoption_reason') <p class="mt-1 text-sm" style="color: #14532d;">{{ $message }}</p> @enderror
                                </div>
                                <div class="col-span-1">
                                    <label class="block text-sm font-medium">Adoption Notes</label>
                                    <input type="text" name="adoption_notes" value="{{ old('adoption_notes', $pet->adoption_notes) }}" class="block w-full p-2 mt-1 border rounded-md text-sm" style="border-color: #86efac; background-color: rgba(255, 255, 255, 0.8); height: 2.5rem;" placeholder="Short Note">
                                    @error('adoption_notes') <p class="mt-1 text-sm" style="color: #14532d;">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between px-6 py-4 sm:px-10 bg-gray-50 rounded-b-xl">
                <a href="javascript:void(0)" onclick="history.back()" class="px-4 py-2 text-white bg-gray-600 rounded hover:bg-gray-800">
                    Cancel
                </a>
                <button type="submit" onclick="return confirm('Are you sure you want to update this pet?');" class="inline-flex justify-center px-8 py-3 text-base font-medium text-white transition duration-150 bg-indigo-600 border border-transparent rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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

    function setStatusSelectColor() {
        const status = statusSelect.value;
        if (status === 'impounded') {
            statusSelect.style.color = '#7f1d1d';
            statusSelect.style.backgroundColor = '#fee2e2';
            statusSelect.style.borderColor = '#fca5a5';
        } else if (status === 'adoptable') {
            statusSelect.style.color = '#14532d';
            statusSelect.style.backgroundColor = '#dcfce7';
            statusSelect.style.borderColor = '#86efac';
        } else {
            statusSelect.style.color = '#111827';
            statusSelect.style.backgroundColor = '#ffffff';
            statusSelect.style.borderColor = '#d1d5db';
        }
    }

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
        setStatusSelectColor();
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

    // Update file name display and preview image
    fileUpload.addEventListener('change', function() {
        const previewContainer = document.getElementById('admin-photo-preview-container');
        const previewImg = document.getElementById('selected-file-preview');

        if (this.files.length > 0) {
            fileNameDisplay.textContent = this.files[0].name;
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewContainer.classList.remove('opacity-0');
                previewContainer.classList.add('opacity-100');
            };
            reader.readAsDataURL(this.files[0]);
        } else {
            fileNameDisplay.textContent = 'PNG, JPG, GIF up to 50MB';
            previewImg.src = '';
            previewContainer.classList.remove('opacity-100');
            previewContainer.classList.add('opacity-0');
        }
    });

    statusSelect.addEventListener('change', toggleStatusFields);
    speciesSelect.addEventListener('change', toggleBreedOptions);

    // Initialize on page load
    toggleStatusFields();
    toggleBreedOptions();
    setStatusSelectColor();

    // Make preview photo clickable when uploaded
    const previewImg = document.getElementById('admin-preview-img');
    if (previewImg) {
        previewImg.addEventListener('click', function() {
            if (this.src) {
                openAdminPreviewPhotoModal();
            }
        });
    }
});
</script>

<!-- Admin Preview Photo Modal -->
<div id="adminPreviewPhotoModal" class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 bg-black/30 backdrop-blur-sm" onclick="if(event.target.id === 'adminPreviewPhotoModal') closeAdminPreviewPhotoModal()">
    <div class="relative flex flex-col items-center justify-center max-w-6xl max-h-[90vh]">
        <button onclick="closeAdminPreviewPhotoModal()" class="absolute z-10 text-white top-6 right-6 hover:text-gray-300">
            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <img id="adminPreviewPhotoImg" src="" alt="Full Size Preview Photo" class="max-w-4xl max-h-[85vh] object-contain rounded-lg shadow-2xl cursor-pointer" onclick="closeAdminPreviewPhotoModal()">
    </div>
</div>

<script>
function openAdminPreviewPhotoModal() {
    const previewImg = document.getElementById('selected-file-preview');
    const currentImg = document.getElementById('admin-preview-img');
    const src = (previewImg && previewImg.src) ? previewImg.src : (currentImg ? currentImg.src : '');
    if (src) {
        document.getElementById('adminPreviewPhotoImg').src = src;
        document.getElementById('adminPreviewPhotoModal').classList.remove('hidden');
    }
}

function closeAdminPreviewPhotoModal() {
    document.getElementById('adminPreviewPhotoModal').classList.add('hidden');
}

// Add Backspace key support for preview photo modal
document.addEventListener('keydown', function(event) {
    if (event.key === 'Backspace') {
        const previewModal = document.getElementById('adminPreviewPhotoModal');
        if (previewModal && !previewModal.classList.contains('hidden')) {
            closeAdminPreviewPhotoModal();
            event.preventDefault();
            return;
        }
    }
});
</script>
