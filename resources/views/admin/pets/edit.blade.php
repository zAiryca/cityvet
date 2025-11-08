@extends('layouts.admin')

@section('title', '| Admin - Edit Pet')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Edit Pet: {{ $pet->name }}</h1>
    <form action="{{ route('admin.pets.update', $pet) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow max-w-2xl">
        @csrf @method('PATCH')
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name', $pet->name) }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('name') border-red-500 @enderror">
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Species</label>
                    <select name="species" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('species') border-red-500 @enderror" id="species-select">
                        <option value="">Select Species</option>
                        <option value="Feline" {{ old('species', $pet->species) === 'Feline' ? 'selected' : '' }}>Feline</option>
                        <option value="Canine" {{ old('species', $pet->species) === 'Canine' ? 'selected' : '' }}>Canine</option>
                    </select>
                    @error('species') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Breed</label>
                    <select name="breed" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('breed') border-red-500 @enderror" id="breed-select">
                        <option value="">Select Breed</option>
                        <!-- Feline breeds -->
                        <optgroup label="Feline Breeds" id="feline-breeds" style="display: none;">
                            <option value="Persian" {{ old('breed', $pet->breed) === 'Persian' ? 'selected' : '' }}>Persian</option>
                            <option value="Siamese" {{ old('breed', $pet->breed) === 'Siamese' ? 'selected' : '' }}>Siamese</option>
                            <option value="Maine Coon" {{ old('breed', $pet->breed) === 'Maine Coon' ? 'selected' : '' }}>Maine Coon</option>
                            <option value="British Shorthair" {{ old('breed', $pet->breed) === 'British Shorthair' ? 'selected' : '' }}>British Shorthair</option>
                            <option value="Ragdoll" {{ old('breed', $pet->breed) === 'Ragdoll' ? 'selected' : '' }}>Ragdoll</option>
                            <option value="Bengal" {{ old('breed', $pet->breed) === 'Bengal' ? 'selected' : '' }}>Bengal</option>
                            <option value="Sphynx" {{ old('breed', $pet->breed) === 'Sphynx' ? 'selected' : '' }}>Sphynx</option>
                            <option value="Abyssinian" {{ old('breed', $pet->breed) === 'Abyssinian' ? 'selected' : '' }}>Abyssinian</option>
                            <option value="Scottish Fold" {{ old('breed', $pet->breed) === 'Scottish Fold' ? 'selected' : '' }}>Scottish Fold</option>
                            <option value="Russian Blue" {{ old('breed', $pet->breed) === 'Russian Blue' ? 'selected' : '' }}>Russian Blue</option>
                        </optgroup>
                        <!-- Canine breeds -->
                        <optgroup label="Canine Breeds" id="canine-breeds" style="display: none;">
                            <option value="Aspin" {{ old('breed', $pet->breed) === 'Aspin' ? 'selected' : '' }}>Aspin</option>
                            <option value="Puspin" {{ old('breed', $pet->breed) === 'Puspin' ? 'selected' : '' }}>Puspin</option>
                            <option value="Shih Tzu" {{ old('breed', $pet->breed) === 'Shih Tzu' ? 'selected' : '' }}>Shih Tzu</option>
                            <option value="Poodle" {{ old('breed', $pet->breed) === 'Poodle' ? 'selected' : '' }}>Poodle</option>
                            <option value="Golden Retriever" {{ old('breed', $pet->breed) === 'Golden Retriever' ? 'selected' : '' }}>Golden Retriever</option>
                            <option value="Labrador" {{ old('breed', $pet->breed) === 'Labrador' ? 'selected' : '' }}>Labrador</option>
                            <option value="German Shepherd" {{ old('breed', $pet->breed) === 'German Shepherd' ? 'selected' : '' }}>German Shepherd</option>
                            <option value="Bulldog" {{ old('breed', $pet->breed) === 'Bulldog' ? 'selected' : '' }}>Bulldog</option>
                            <option value="Beagle" {{ old('breed', $pet->breed) === 'Beagle' ? 'selected' : '' }}>Beagle</option>
                            <option value="Chihuahua" {{ old('breed', $pet->breed) === 'Chihuahua' ? 'selected' : '' }}>Chihuahua</option>
                        </optgroup>
                    </select>
                    @error('breed') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Birth Date</label>
                <input type="date" name="birth_date" value="{{ old('birth_date', $pet->birth_date?->format('Y-m-d')) }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('birth_date') border-red-500 @enderror">
                @error('birth_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('gender') border-red-500 @enderror">
                    <option value="">Select</option>
                    <option value="male" {{ old('gender', $pet->gender) === 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $pet->gender) === 'female' ? 'selected' : '' }}>Female</option>
                    <option value="unknown" {{ old('gender', $pet->gender) === 'unknown' ? 'selected' : '' }}>Unknown</option>
                </select>
                @error('gender') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('description') border-red-500 @enderror">{{ old('description', $pet->description) }}</textarea>
                @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Color Markings</label>
                <div class="mt-1 grid grid-cols-5 gap-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Black" {{ in_array('Black', old('color_markings', explode(',', $pet->color_markings))) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm">Black</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="color_markings[]" value="White" {{ in_array('White', old('color_markings', explode(',', $pet->color_markings))) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm">White</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Brown" {{ in_array('Brown', old('color_markings', explode(',', $pet->color_markings))) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm">Brown</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Gray" {{ in_array('Gray', old('color_markings', explode(',', $pet->color_markings))) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm">Gray</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="color_markings[]" value="Orange" {{ in_array('Orange', old('color_markings', explode(',', $pet->color_markings))) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm">Orange</span>
                    </label>
                </div>
                @error('color_markings') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('status') border-red-500 @enderror">
                    <option value="">Select Status</option>
                    <option value="impounded" {{ old('status', $pet->status) === 'impounded' ? 'selected' : '' }}>Impounded</option>
                    <option value="adoptable" {{ old('status', $pet->status) === 'adoptable' ? 'selected' : '' }}>Adoptable</option>
                    <option value="adopted" {{ old('status', $pet->status) === 'adopted' ? 'selected' : '' }}>Adopted</option>
                    <option value="claimed" {{ old('status', $pet->status) === 'claimed' ? 'selected' : '' }}>Claimed</option>
                </select>
                @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="impounded-fields" style="display: none;">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Caught Date</label>
                    <input type="date" name="impounded_date" value="{{ old('impounded_date', $pet->impounded_date ? $pet->impounded_date->format('Y-m-d') : '') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('impounded_date') border-red-500 @enderror">
                    @error('impounded_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Caught Location</label>
                    <input type="text" name="caught_location" value="{{ old('caught_location', $pet->caught_location) }}" placeholder="e.g., Barangay ABC, City" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('caught_location') border-red-500 @enderror">
                    @error('caught_location') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="adoptable-fields" style="display: none;">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Decision Date</label>
                    <input type="date" name="decision_date" value="{{ old('decision_date', $pet->decision_date ? $pet->decision_date->format('Y-m-d') : '') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('decision_date') border-red-500 @enderror">
                    @error('decision_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Urgent Deadline (optional)</label>
                    <input type="date" name="urgent_deadline" value="{{ old('urgent_deadline', $pet->urgent_deadline ? $pet->urgent_deadline->format('Y-m-d') : '') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('urgent_deadline') border-red-500 @enderror">
                    @error('urgent_deadline') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Photo (current: {{ $pet->photo ? 'Uploaded' : 'None' }})</label>
                <input type="file" name="photo" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('photo') border-red-500 @enderror">
                @error('photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                @if($pet->photo)
                    <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->name }}" class="mt-2 h-24 w-24 object-cover rounded">
                @endif
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Registration Status</label>
                <select name="registration_status" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('registration_status') border-red-500 @enderror">
                    <option value="">Select Status</option>
                    <option value="pre-registered" {{ old('registration_status', $pet->registration_status) === 'pre-registered' ? 'selected' : '' }}>Pre-Registered</option>
                    <option value="approved" {{ old('registration_status', $pet->registration_status) === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="denied" {{ old('registration_status', $pet->registration_status) === 'denied' ? 'selected' : '' }}>Denied</option>
                </select>
                @error('registration_status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Admin Notes</label>
                <textarea name="admin_notes" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('admin_notes') border-red-500 @enderror" placeholder="Add notes for the user...">{{ old('admin_notes', $pet->admin_notes) }}</textarea>
                @error('admin_notes') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.pets.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">Update Pet</button>
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
