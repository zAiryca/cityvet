@extends('layouts.admin')

@section('title', '| Admin - Edit Announcement')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Edit Announcement: {{ $announcement->title }}</h1>
    <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST" class="bg-white p-6 rounded-lg shadow max-w-2xl">
        @csrf @method('PATCH')
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title', $announcement->title) }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('title') border-red-500 @enderror">
                @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4" {{ old('description', $announcement->description) }} class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('description') border-red-500 @enderror"></textarea>
                @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Event Date & Time</label>
                <input type="datetime-local" name="event_date" value="{{ old('event_date', $announcement->event_date ? $announcement->event_date->format('Y-m-d\TH:i') : '') }}" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('event_date') border-red-500 @enderror">
                @error('event_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" name="location" value="{{ old('location', $announcement->location) }}" placeholder="Address or venue" required class="mt-1 block w-full border border-gray-300 rounded-md p-2 @error('location') border-red-500 @enderror">
                @error('location') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.announcements.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">Update Announcement</button>
            </div>
        </div>
    </form>
</div>
@endsection
