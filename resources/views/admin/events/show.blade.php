@extends('layouts.app')

@section('title', '| Admin - Event Details')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Event Details: {{ $event->title }}</h1>
    <div class="bg-white rounded-lg shadow overflow-hidden max-w-4xl">
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <p><strong>Date & Time:</strong> {{ $event->event_date->format('M d, Y h:i A') }}</p>
                <p><strong>Location:</strong> {{ $event->location }}</p>
                <p><strong>Capacity:</strong> {{ $event->registrations->count() }} / {{ $event->capacity }} registered</p>
            </div>
            <p class="text-gray-700 mb-6"><strong>Description:</strong> {{ $event->description }}</p>
            <div class="flex space-x-4">
                <a href="{{ route('admin.events.edit', $event) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Edit</a>
                <a href="{{ route('admin.events.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Back to List</a>
            </div>
        </div>
    </div>

    <!-- Registrations List -->
    @if($event->registrations->count() > 0)
        <div class="mt-8 bg-white rounded-lg shadow">
            <h2 class="p-6 text-xl font-bold">Registrations ({{ $event->registrations->count() }})</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pet</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Registration Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($event->registrations as $registration)
                            <tr>
                                <td class="px-6 py-4">{{ $registration->user->name }} ({{ $registration->user->email }})</td>
                                <td class="px-6 py-4">{{ $registration->pet->name ?? 'N/A' }} ({{ $registration->pet->species ?? '' }})</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $registration->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="mt-8 text-center py-8 text-gray-500">No registrations yet.</div>
    @endif
</div>
@endsection
