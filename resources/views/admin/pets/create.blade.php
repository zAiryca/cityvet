@extends('layouts.admin')

@section('title', '| Admin - Add Pet')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Add New Pet</h1>
    <form action="{{ route('admin.pets.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow max-w-2xl">
        @csrf
        <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('status') border-red-500 @enderror">
                    <option value="">Select Status</option>
                    <option value="impounded" {{ old('status') === 'impounded' ? 'selected' : '' }}>Impounded</option>
                    <option value="adoptable" {{ old('status') === 'adoptable' ? 'selected' : '' }}>Adoptable</option>
                </select>
                @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        <div class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Species</label>
                    <select name="species" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('species') border-red-500 @enderror" id="species-select">
                        <option value="">Select Species</option>
                        <option value="Feline" {{ old('species') === 'Feline' ? 'selected' : '' }}>Feline</option>
                        <option value="Canine" {{ old('species') === 'Canine' ? 'selected' : '' }}>Canine</option>
                    </select>
                    @error('species') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Breed</label>
                    <select name="breed" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('breed') border-red-500 @enderror" id="breed-select">
                        <option value="">Select Breed</option>
                        <!-- Feline breeds -->
                        <optgroup label="Feline Breeds" id="feline-breeds" style="display: none;">
                            <option value="Persian" {{ old('breed') === 'Persian' ? 'selected' : '' }}>Persian</option>
                            <option value="Siamese" {{ old('breed') === 'Siamese' ? 'selected' : '' }}>Siamese</option>
                            <option value="Maine Coon" {{ old('breed') === 'Maine Coon' ? 'selected' : '' }}>Maine Coon</option>
                            <option value="British Shorthair" {{ old('breed') === 'British Shorthair' ? 'selected' : '' }}>British Shorthair</option>
                            <option value="Ragdoll" {{ old('breed') === 'Ragdoll' ? 'selected' : '' }}>Ragdoll</option>
                            <option value="Bengal" {{ old('breed') === 'Bengal' ? 'selected' : '' }}>Bengal</option>
                            <option value="Sphynx" {{ old('breed') === 'Sphynx' ? 'selected' : '' }}>Sphynx</option>
                            <option value="Abyssinian" {{ old('breed') === 'Abyssinian' ? 'selected' : '' }}>Abyssinian</option>
                            <option value="Scottish Fold" {{ old('breed') === 'Scottish Fold' ? 'selected' : '' }}>Scottish Fold</option>
                            <option value="Russian Blue" {{ old('breed') === 'Russian Blue' ? 'selected' : '' }}>Russian Blue</option>
                        </optgroup>
                        <!-- Canine breeds -->
                        <optgroup label="Canine Breeds" id="canine-breeds" style="display: none;">
                            <option value="Aspin" {{ old('breed') === 'Aspin' ? 'selected' : '' }}>Aspin</option>
                            <option value="Puspin" {{ old('breed') === 'Puspin' ? 'selected' : '' }}>Puspin</option>
                            <option value="Shih Tzu" {{ old('breed') === 'Shih Tzu' ? 'selected' : '' }}>Shih Tzu</option>
                            <option value="Poodle" {{ old('breed') === 'Poodle' ? 'selected' : '' }}>Poodle</option>
                            <option value="Golden Retriever" {{ old('breed') === 'Golden Retriever' ? 'selected' : '' }}>Golden Retriever</option>
                            <option value="Labrador" {{ old('breed') === 'Labrador' ? 'selected' : '' }}>Labrador</option>
                            <option value="German Shepherd" {{ old('breed') === 'German Shepherd' ? 'selected' : '' }}>German Shepherd</option>
                            <option value="Bulldog" {{ old('breed') === 'Bulldog' ? 'selected' : '' }}>Bulldog</option>
                            <option value="Beagle" {{ old('breed') === 'Beagle' ? 'selected' : '' }}>Beagle</option>
                            <option value="Chihuahua" {{ old('breed') === 'Chihuahua' ? 'selected' : '' }}>Chihuahua</option>
                        </optgroup>
                    </select>
                    @error('breed') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Estimated Age - Years</label>
                    <select name="estimated_age_years" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('estimated_age_years') border-red-500 @enderror">
                        <option value="">Unknown</option>
                        @for($i = 0; $i <= 20; $i++)
                            <option value="{{ $i }}" {{ old('estimated_age_years') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                    @error('estimated_age_years') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Estimated Age - Months</label>
                    <select name="estimated_age_months" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('estimated_age_months') border-red-500 @enderror">
                        <option value="">Unknown</option>
                        @for($i = 0; $i <= 11; $i++)
                            <option value="{{ $i }}" {{ old('estimated_age_months') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                    @error('estimated_age_months') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
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
            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Color</label>
                <div class="mt-1 grid grid-cols-2 gap-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Black" {{ in_array('Black', old('color_markings', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm">Black</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="color_markings[]" value="White" {{ in_array('White', old('color_markings', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm">White</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Brown" {{ in_array('Brown', old('color_markings', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm">Brown</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Gray" {{ in_array('Gray', old('color_markings', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm">Gray</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Orange" {{ in_array('Orange', old('color_markings', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm">Orange</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Cream" {{ in_array('Cream', old('color_markings', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm">Cream</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Red" {{ in_array('Red', old('color_markings', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm">Red</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Tabby" {{ in_array('Tabby', old('color_markings', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm">Tabby</span>
                    </label>
                </div>
                @error('color_markings') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="impounded-fields" style="display: none;">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Caught Date</label>
                    <input type="date" name="impounded_date" value="{{ old('impounded_date') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('impounded_date') border-red-500 @enderror">
                    @error('impounded_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Caught Location</label>
                    <input type="text" name="caught_location" value="{{ old('caught_location') }}" placeholder="e.g., Barangay ABC, City" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('caught_location') border-red-500 @enderror">
                    @error('caught_location') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="adoptable-fields" style="display: none;">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Decision Date</label>
                    <input type="date" name="decision_date" value="{{ old('decision_date') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('decision_date') border-red-500 @enderror">
                    @error('decision_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Urgent Deadline (optional)</label>
                    <input type="date" name="urgent_deadline" value="{{ old('urgent_deadline') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('urgent_deadline') border-red-500 @enderror">
                    @error('urgent_deadline') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Photo</label>
                <input type="file" name="photo" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('photo') border-red-500 @enderror">
                @error('photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.pets.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700">Cancel</a>
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700">Add Pet</button>
            </div>
        </div>
    </form>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.querySelector('select[name="status"]');
    const impoundedFields = document.getElementById('impounded-fields');
    const adoptableFields = document.getElementById('adoptable-fields');
    const speciesSelect = document.getElementById('species-select');
    const breedSelect = document.getElementById('breed-select');
    const felineBreeds = document.getElementById('feline-breeds');
    const canineBreeds = document.getElementById('canine-breeds');

    function toggleStatusFields() {
        const status = statusSelect.value;
        if (status === 'impounded') {
            impoundedFields.style.display = 'grid';
            adoptableFields.style.display = 'none';
        } else if (status === 'adoptable') {
            impoundedFields.style.display = 'none';
            adoptableFields.style.display = 'grid';
        } else {
            impoundedFields.style.display = 'none';
            adoptableFields.style.display = 'none';
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

    statusSelect.addEventListener('change', toggleStatusFields);
    speciesSelect.addEventListener('change', toggleBreedOptions);

    // Initialize on page load
    toggleStatusFields();
    toggleBreedOptions();
});
</script>
