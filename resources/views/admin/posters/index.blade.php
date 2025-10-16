@extends('layouts.app')

@section('title', '| Admin - Posters')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Manage Lost & Found Posters</h1>

    <!-- Filters -->
    <form method="GET" action="{{ route('admin.posters.index') }}" class="bg-white p-4 rounded-lg shadow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <select name="approved" class="border p-2 rounded">
                <option value="">All</option>
                <option value="0" {{ request('approved') == '0' ? 'selected' : '' }}>Pending</option>
                <option value="1" {{ request('approved') == '1' ? 'selected' : '' }}>Approved</option>
            </select>
            <input type="text" name="type" placeholder="Type (lost/found)" value="{{ request('type') }}" class="border p-2 rounded">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
            <a href="{{ route('admin.posters.index') }}" class="ml-2 text-gray-500">Clear</a>
        </div>
    </form>

    @if($posters->count() > 0)
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pet Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Approved</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($posters as $poster)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $poster->pet_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ucfirst($poster->type) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $poster->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $poster->date_lost_found->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $poster->approved ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $poster->approved ? 'Yes' : 'Pending' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('posters.show', $poster) }}" class="text-indigo-600 hover:text-indigo-900 mr-4" target="_blank">View Public</a>
                                @if(!$poster->approved)
                                    <form action="{{ route('admin.posters.approve', $poster) }}" method="POST" class="inline">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="text-green-600 hover:text-green-900 mr-4">Approve</button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.posters.destroy', $poster) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Delete this poster?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $posters->appends(request()->query())->links() }}
    @else
        <p class="text-gray-500 text-center py-8">No posters found. Check back as users submit them.</p>
    @endif
</div>
@endsection
