@extends('layouts.admin')

@section('title', '| Admin - Add Announcement')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <h1 class="mb-6 text-3xl font-bold">Add New Announcement</h1>
    <form action="{{ route('admin.announcements.store') }}" method="POST" class="max-w-2xl p-6 bg-white rounded-lg shadow">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('title') border-red-500 @enderror">
                @error('title') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4" {{ old('description') }} class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('description') border-red-500 @enderror"></textarea>
                @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('category') border-red-500 @enderror">
                    <option value="">Select Category</option>
                    <option value="Event" {{ old('category') == 'Event' ? 'selected' : '' }}>Event</option>
                    <option value="Trivia" {{ old('category') == 'Trivia' ? 'selected' : '' }}>Trivia</option>
                    <option value="Fun Fact" {{ old('category') == 'Fun Fact' ? 'selected' : '' }}>Fun Fact</option>
                    <option value="Holiday Notice" {{ old('category') == 'Holiday Notice' ? 'selected' : '' }}>Holiday Notice</option>
                </select>
                @error('category') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Date/When (e.g., Nov 16th, or 'Posted Now')</label>
                <input type="text" name="date_when" value="{{ old('date_when') }}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('date_when') border-red-500 @enderror">
                @error('date_when') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Location (optional)</label>
                <input type="text" name="location" value="{{ old('location') }}" placeholder="Address or venue" class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('location') border-red-500 @enderror">
                @error('location') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.announcements.index') }}" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md">Cancel</a>
                <button type="submit" class="px-6 py-2 text-white bg-green-600 rounded-md hover:bg-green-700">Add Announcement</button>
            </div>
        </div>
    </form>
</div>
@endsection
