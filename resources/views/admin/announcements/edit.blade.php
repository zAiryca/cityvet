@extends('layouts.admin')

@section('title', '| Admin - Edit Announcement')

@section('content')
<div class="flex flex-col items-center justify-center px-4 py-6 mx-auto max-w-7xl">
    <h1 class="mb-6 text-3xl font-bold">Edit Announcement: {{ $announcement->title }}</h1>
    <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST" enctype="multipart/form-data" class="w-full max-w-2xl p-6 bg-white rounded-lg shadow">
        @csrf @method('PATCH')
        <div class="space-y-4">

            <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('category') border-red-500 @enderror">
                    <option value="">Select Category</option>
                    {{-- Use old() with $announcement->category as the default --}}
                    <option value="Event" {{ old('category', $announcement->category) == 'Event' ? 'selected' : '' }}>Event</option>
                    <option value="Trivia" {{ old('category', $announcement->category) == 'Trivia' ? 'selected' : '' }}>Trivia</option>
                    <option value="Fun Fact" {{ old('category', $announcement->category) == 'Fun Fact' ? 'selected' : '' }}>Fun Fact</option>
                    <option value="Holiday Notice" {{ old('category', $announcement->category) == 'Holiday Notice' ? 'selected' : '' }}>Holiday Notice</option>
                </select>
                @error('category') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title', $announcement->title) }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('title') border-red-500 @enderror">
                @error('title') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                {{-- Ensure textarea content is correctly wrapped. It should not be inside the attributes, but between the tags. --}}
                <textarea name="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('description') border-red-500 @enderror">{{ old('description', $announcement->description) }}</textarea>
                @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Date/When (e.g., Nov 16th, or 'Posted Now')</label>
                <input type="text" name="date_when" value="{{ old('date_when', $announcement->date_when) }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('date_when') border-red-500 @enderror">
                @error('date_when') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Location (optional)</label>
                <input type="text" name="location" value="{{ old('location', $announcement->location) }}" placeholder="Address or venue" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('location') border-red-500 @enderror">
                @error('location') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Photos (optional)</label>

                <!-- Existing Photos -->
                @if($announcement->photos->count() > 0)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Current Photos:</p>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach($announcement->photos as $photo)
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="photo" class="w-full h-auto rounded-md shadow">
                                    <button type="button" onclick="deletePhoto({{ $photo->id }})" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Add New Photos -->
                <input type="file" name="photos[]" accept="image/*" multiple class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('photos') border-red-500 @enderror">
                <p class="mt-1 text-xs text-gray-500">Accepted formats: JPG, PNG, GIF. No size limit. You can upload multiple photos.</p>
                @error('photos') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                @error('photos.*') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <!-- Hidden input to store deleted photos -->
            <input type="hidden" id="deletedPhotos" name="deleted_photos" value="">

            <script>
                const deletedPhotos = [];
                function deletePhoto(photoId) {
                    event.preventDefault();
                    // Find and remove the photo element
                    const photoElement = event.target.closest('button').closest('div').parentElement;
                    photoElement.remove();
                    deletedPhotos.push(photoId);
                    // Update the hidden input with JSON array
                    document.getElementById('deletedPhotos').value = JSON.stringify(deletedPhotos);
                }
            </script>

            <div class="flex justify-end space-x-4">
                <a href="javascript:void(0)" onclick="history.back()" class="bg-gray-600 text-white hover:bg-gray-800 px-4 py-2 rounded">Cancel</a>
                <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">Update Announcement</button>
            </div>
        </div>
    </form>
</div>
@endsection
