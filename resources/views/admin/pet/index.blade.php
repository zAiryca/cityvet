@extends('layouts.app')

@section('title', '| Admin - Pets')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Manage Pets</h1>

    <!-- Search/Filter -->
    <form method="GET" action="{{ route('admin.pets.index') }}" class="bg-white p-4 rounded-lg shadow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="text" name="search" placeholder="Search by name/species" value="{{ request('search') }}" class="border p-2 rounded">
            <select name="status" class="border p-2 rounded">
                <option value="">All Statuses</option>
                <option value="impounded" {{ request('status') === 'impounded' ? 'selected' : '' }}>Impounded</option>
                <option value="adoptable" {{ request('status') === 'adoptable' ? 'selected' : '' }}>Adoptable</option>
                <option value="registered" {{ request('status') === 'registered' ? 'selected' : '' }}>Registered</option>
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
            <a href="{{ route('admin.pets.index') }}" class="ml-2 text-gray-500">Clear</a>
        </div>
    </form>

    <a href="{{ route('admin.pets.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-6 inline-block">Add New Pet</a>

    @if($pets->count() > 0)
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Species/Breed</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Impounded/Adopt Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($pets as $pet)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="{{ $pet->photo ? asset('storage/' . $pet->photo) : 'https://via.placeholder.com/40?text=' . substr($pet->name, 0, 1) }}" alt="{{ $pet->name }}" class="h-10 w-10 rounded-full mr-4">
                                    <span class="font-medium">{{ $pet->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pet->species }} / {{ $pet->breed }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $pet->status === 'impounded' ? 'bg-red-100 text-red-800' : ($pet->status === 'adoptable' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800') }}">
                                    {{ ucfirst($pet->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $pet->impounded_date ? $pet->impounded_date->format('M d, Y') : ($pet->adoptable_date ? $pet->adoptable_date->format('M d, Y') : 'N/A') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.pets.show', $pet) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">View</a>
                                <a href="{{ route('admin.pets.edit', $pet) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                @if($pet->status === 'adoptable')
                                    <form action="{{ route('admin.pets.set-urgent', $pet) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-yellow-600 hover:text-yellow-900">Set Urgent</button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.pets.destroy', $pet) }}" method="POST" class="inline ml-4">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Delete this pet?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $pets->appends(request()->query())->links() }}
    @else
        <p class="text-gray-500 text-center py-8">No pets found. <a href="{{ route('admin.pets.create') }}" class="text-blue-600">Add the first one</a>.</p>
    @endif
</div>
@endsection
