@extends('layouts.app')

@section('title', '| Admin - Requests')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Manage Requests</h1>

    <!-- Filters -->
    <form method="GET" action="{{ route('admin.requests.index') }}" class="bg-white p-4 rounded-lg shadow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <select name="status" class="border p-2 rounded">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="denied" {{ request('status') == 'denied' ? 'selected' : '' }}>Denied</option>
            </select>
            <select name="type" class="border p-2 rounded">
                <option value="">All Types</option>
                <option value="claim" {{ request('type') == 'claim' ? 'selected' : '' }}>Claim</option>
                <option value="adopt" {{ request('type') == 'adopt' ? 'selected' : '' }}>Adopt</option>
                <option value="register" {{ request('type') == 'register' ? 'selected' : '' }}>Event Register</option>
            </select>
            <input type="text" name="search" placeholder="Search by user/pet" value="{{ request('search') }}" class="border p-2 rounded">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
            <a href="{{ route('admin.requests.index') }}" class="ml-2 text-gray-500">Clear</a>
        </div>
    </form>

    @if($requests->count() > 0)
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pet/Event</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($requests as $request)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $request->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($request->pet)
                                    {{ $request->pet->name }} ({{ $request->pet->species }})
                                @elseif($request->event)
                                    {{ $request->event->title }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ucfirst($request->type) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($request->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $request->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.requests.show', $request) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">View</a>
                                <form action="{{ route('admin.requests.destroy', $request) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Delete this request?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $requests->appends(request()->query())->links() }}
    @else
        <p class="text-gray-500 text-center py-8">No requests found. Check back as users submit them.</p>
    @endif
</div>
@endsection
