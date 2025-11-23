@extends('layouts.admin')

@section('title', '| Admin - Posters')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <h1 class="mb-6 text-3xl font-bold">Manage Lost & Found Posters</h1>

    <form method="GET" action="{{ route('admin.posters.index') }}" class="p-4 mb-6 bg-white rounded-lg shadow">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
            <select name="status" class="p-2 border rounded">
                <option value="">All Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="reunited" {{ request('status') == 'reunited' ? 'selected' : '' }}>Reunited</option>
            </select>
            <select name="type" class="p-2 border rounded">
                <option value="">All Types</option>
                <option value="lost" {{ request('type') == 'lost' ? 'selected' : '' }}>Lost</option>
                <option value="found" {{ request('type') == 'found' ? 'selected' : '' }}>Found</option>
            </select>
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded">Filter</button>
            <a href="{{ route('admin.posters.index') }}" class="ml-2 text-gray-500">Clear</a>
        </div>
    </form>

    @if($posters->count() > 0)
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">#</th> {{-- Added # for numbering --}}
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Photo / Pet Name</th> {{-- Combined column header --}}
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">User </th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($posters as $poster)
                        <tr>
                            {{-- # Column --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $loop->iteration }}</div>
                            </td>

                            {{-- ID Column --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">#{{ $poster->id }}</div>
                            </td>

                            {{-- Photo / Pet Name Column (Combined) --}}
                            <td class="px-6 py-4 font-medium whitespace-nowrap">
                                <div class="flex items-center">
                                    {{-- Photo Display --}}
                                    @if($poster->photo)
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img src="{{ asset('storage/' . $poster->photo) }}" alt="{{ $poster->pet_name ?: 'Pet' }}" class="object-cover w-10 h-10 rounded-full">
                                        </div>
                                    @endif

                                    {{-- Pet Name/ID Display --}}
                                    <div class="{{ $poster->photo ? 'ml-4' : '' }}">
                                        <div class="text-sm font-medium text-gray-900">
                                            @if($poster->type === 'lost')
                                                {{ $poster->pet_name ?: 'Unknown' }}
                                            @else
                                                FND{{ str_pad($poster->id, 4, '0', STR_PAD_LEFT) }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Type Column --}}
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ ucfirst($poster->type) }}</td>

                            {{-- User Column --}}
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $poster->user->name }}</td>

                            {{-- Date Column --}}
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $poster->date_lost_found->format('M d, Y') }}</td>

                            {{-- Status Column --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $poster->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($poster->status) }}
                                </span>
                            </td>

                            {{-- Actions Column --}}
                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                <a href="{{ route('posters.show', $poster) }}" class="mr-4 text-indigo-600 hover:text-indigo-900" target="_blank">View Public</a>
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
        <p class="py-8 text-center text-gray-500">No posters found. Check back as users submit them.</p>
    @endif
</div>
@endsection
