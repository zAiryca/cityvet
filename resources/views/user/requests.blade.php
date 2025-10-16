@extends('layouts.app')

@section('title', '| My Requests')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">My Requests</h1>
    <p class="mb-6">Track your claim, adopt, and event registration requests.</p>

    @if($requests->count() > 0)
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
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
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($request->pet)
                                    <a href="#" class="text-blue-600 hover:underline">{{ $request->pet->name }}</a> ({{ $request->pet->species }})
                                @else
                                    {{ $request->event->title ?? 'N/A' }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($request->type) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($request->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $request->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if($request->status === 'pending')
                                    <span class="text-yellow-600">Awaiting Review</span>
                                @elseif($request->status === 'approved')
                                    <a href="#" class="text-green-600 hover:underline">View Details</a>
                                @else
                                    <span class="text-red-600">Denied</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $requests->links() }}
    @else
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <p class="text-gray-500 mb-4">No requests yet. Start by browsing pets or events!</p>
            <div class="space-x-4">
                <a href="{{ route('pets.adoptable') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Browse Adoptable</a>
                <a href="{{ route('pets.impounded') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">View Impounded</a>
                <a href="{{ route('events.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Upcoming Events</a>
            </div>
        </div>
    @endif
</div>
@endsection
