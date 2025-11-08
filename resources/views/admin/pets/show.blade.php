@extends('layouts.admin')

@section('title', '| Admin - Pet Details')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Pet Details: {{ $pet->name }}</h1>
    <div class="bg-white rounded-lg shadow overflow-hidden max-w-4xl">
        <img src="{{ $pet->photo ? asset('storage/' . $pet->photo) : 'https://via.placeholder.com/600x400?text=' . $pet->name }}" alt="{{ $pet->name }}" class="w-full h-96 object-cover">
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <p><strong>Species:</strong> {{ $pet->species }} - {{ $pet->breed }}</p>
                <p><strong>Gender:</strong> {{ ucfirst($pet->gender) }}</p>
                <p><strong>Status:</strong> <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $pet->status === 'impounded' ? 'bg-red-100 text-red-800' : ($pet->status === 'adoptable' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800') }}">{{ ucfirst($pet->status) }}</span></p>
                @if($pet->impounded_date)
                    <p><strong>Impounded:</strong> {{ $pet->impounded_date->format('M d, Y') }} ({{ $pet->remaining_days }} days left)</p>
                @endif
                @if($pet->urgent_deadline)
                    <p><strong>Urgent Deadline:</strong> {{ $pet->urgent_deadline->format('M d, Y') }}</p>
                @endif
            </div>
            <p class="text-gray-700 mb-6"><strong>Description:</strong> {{ $pet->description }}</p>
            <div class="flex space-x-4">
                <a href="{{ route('admin.pets.edit', $pet) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Edit</a>
                <a href="{{ route('admin.pets.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Back to List</a>
            </div>
        </div>
    </div>

    <!-- Related Requests -->
    @if($pet->requests->count() > 0)
        <div class="mt-8 bg-white rounded-lg shadow">
            <h2 class="p-6 text-xl font-bold">Adoption/Claim Requests ({{ $pet->requests->count() }})</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reason</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pet->requests as $request)
                            <tr>
                                <td class="px-6 py-4">{{ $request->user->name }}</td>
                                <td class="px-6 py-4 text-sm">{{ Str::limit($request->reason, 50) }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($request->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.requests.show', $request) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
