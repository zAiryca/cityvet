@extends('layouts.app')

@section('title', '| Admin - Request Details')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Request Details</h1>
    <div class="bg-white rounded-lg shadow max-w-4xl">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <p><strong>User:</strong> {{ $request->user->name }} ({{ $request->user->email }})</p>
                <p><strong>Type:</strong> {{ ucfirst($request->type) }}</p>
                @if($request->pet)
                    <p><strong>Pet:</strong> {{ $request->pet->name }} ({{ $request->pet->species }})</p>
                @endif
                @if($request->event)
                    <p><strong>Event:</strong> {{ $request->event->title }} on {{ $request->event->event_date->format('M d, Y') }}</p>
                @endif
                <p><strong>Status:</strong>
                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($request->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                        {{ ucfirst($request->status) }}
                    </span>
                </p>
                <p><strong>Date:</strong> {{ $request->created_at->format('M d, Y h:i A') }}</p>
            </div>
            <p class="mb-6"><strong>Reason:</strong> {{ $request->reason }}</p>
            <p class="mb-6"><strong>Contact Info:</strong> {{ $request->contact_info }}</p>

            <!-- Update Status Form -->
            <form action="{{ route('admin.requests.update', $request) }}" method="POST" class="mb-6">
                @csrf @method('PATCH')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <select name="status" required class="border p-2 rounded @error('status') border-red-500 @enderror">
                        <option value="pending" {{ old('status', $request->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ old('status', $request->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="denied" {{ old('status', $request->status) == 'denied' ? 'selected' : '' }}>Denied</option>
                    </select>
                    <textarea name="admin_notes" rows="2" placeholder="Admin notes (optional)" {{ old('admin_notes') }} class="border p-2 rounded col-span-2 @error('admin_notes') border-red-500 @enderror"></textarea>
                </div>
                @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-4">Update Status</button>
            </form>

            <div class="flex space-x-4">
                <a href="{{ route('admin.requests.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Back to List</a>
                <form action="{{ route('admin.requests.destroy', $request) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" onclick="return confirm('Delete this request?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
