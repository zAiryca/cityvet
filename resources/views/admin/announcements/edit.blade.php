@extends('layouts.admin')

@section('title', '| Admin - Edit Announcement')

@section('content')
<div class="flex flex-col items-center justify-center px-4 py-6 mx-auto max-w-7xl">
    <h1 class="mb-6 text-3xl font-bold">Edit Announcement: {{ $announcement->title }}</h1>
    <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST" class="w-full max-w-2xl p-6 bg-white rounded-lg shadow">
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

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.announcements.index') }}" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md">Cancel</a>
                <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">Update Announcement</button>
            </div>
        </div>
    </form>
</div>
@endsection
