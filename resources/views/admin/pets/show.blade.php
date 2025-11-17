@extends('layouts.admin')

@section('title', '| Admin - Pet Details')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Pet Details: {{ $pet->display_code }}</h1>
    <div class="bg-white rounded-lg shadow overflow-hidden max-w-4xl">
        <img src="{{ $pet->photo ? asset('storage/' . $pet->photo) : 'https://via.placeholder.com/600x400?text=' . $pet->display_code }}" alt="{{ $pet->display_code }}" class="w-full h-96 object-cover">
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <p><strong>Species:</strong> {{ $pet->species }} - {{ $pet->breed }}</p>
                <p><strong>Gender:</strong> {{ ucfirst($pet->gender) }}</p>
                <p><strong>Estimated Age:</strong> {{ $pet->estimated_age }}</p>
                <p><strong>Status:</strong> {{ ucfirst($pet->status) }}</p>
                @if($pet->color_markings)
                    <p><strong>Color Markings:</strong> {{ $pet->color_markings }}</p>
                @endif
                @if($pet->impounded_date)
                    <p><strong>Impounded Date:</strong> {{ $pet->impounded_date->format('M d, Y') }}</p>
                @endif
                @if($pet->caught_location)
                    <p><strong>Caught Location:</strong> {{ $pet->caught_location }}</p>
                @endif
                @if($pet->adoptable_date)
                    <p><strong>Adoptable Date:</strong> {{ $pet->adoptable_date->format('M d, Y') }}</p>
                @endif
                @if($pet->urgent_deadline)
                    <p><strong>Urgent Deadline:</strong> {{ $pet->urgent_deadline->format('M d, Y') }}</p>
                @endif
            </div>
            <p class="text-gray-700 mb-6"><strong>Description:</strong> {{ $pet->description }}</p>
            <div class="flex space-x-4">
                <a href="{{ route('admin.pets.edit', $pet) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Edit</a>
                @if($pet->status === 'impounded')
                    <form action="{{ route('admin.pets.mark-claimed', $pet) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" onclick="return confirm('Mark this pet as claimed?')">Mark as Claimed</button>
                    </form>
                @elseif($pet->status === 'adoptable')
                    <form action="{{ route('admin.pets.mark-adopted', $pet) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" onclick="return confirm('Mark this pet as adopted?')">Mark as Adopted</button>
                    </form>
                @endif
                <a href="{{ route('admin.pets.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Back to List</a>
            </div>
        </div>
    </div>

    <!-- Related Requests -->
    @if($pet->requests->count() > 0)
        <div class="mt-8 bg-white rounded-lg shadow">
            <h2 class="p-6 text-xl font-bold">Adoption/Claim Requests ({{ $pet->requests->count() }})</h2>

            <!-- Status Tabs -->
            <div class="border-b border-gray-200 px-6">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <button type="button" onclick="filterRequests('')" class="tab-button whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ !request('status') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        All ({{ $pet->requests->count() }})
                    </button>
                    <button type="button" onclick="filterRequests('pending')" class="tab-button whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'pending' ? 'border-yellow-500 text-yellow-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Pending ({{ $pet->requests->where('status', 'pending')->count() }})
                    </button>
                    <button type="button" onclick="filterRequests('approved')" class="tab-button whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'approved' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Approved ({{ $pet->requests->where('status', 'approved')->count() }})
                    </button>
                    <button type="button" onclick="filterRequests('denied')" class="tab-button whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'denied' ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Denied ({{ $pet->requests->where('status', 'denied')->count() }})
                    </button>
                </nav>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reason</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pet->requests as $request)
                            <tr class="request-row {{ $request->status }}" style="{{ request('status') && request('status') !== $request->status ? 'display: none;' : '' }}">
                                <td class="px-6 py-4">{{ $request->user->name }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if($request->type === 'adopt')
                                        {{ Str::limit($request->reason, 50) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($request->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.requests.show', $request) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            function filterRequests(status) {
                const rows = document.querySelectorAll('.request-row');
                const tabs = document.querySelectorAll('.tab-button');

                // Update tab styling
                tabs.forEach(tab => {
                    tab.classList.remove('border-indigo-500', 'text-indigo-600', 'border-yellow-500', 'text-yellow-600', 'border-green-500', 'text-green-600', 'border-red-500', 'text-red-600');
                    tab.classList.add('border-transparent', 'text-gray-500');
                });

                const activeTab = document.querySelector(`button[onclick="filterRequests('${status}')"]`);
                if (status === '') {
                    activeTab.classList.remove('border-transparent', 'text-gray-500');
                    activeTab.classList.add('border-indigo-500', 'text-indigo-600');
                } else if (status === 'pending') {
                    activeTab.classList.remove('border-transparent', 'text-gray-500');
                    activeTab.classList.add('border-yellow-500', 'text-yellow-600');
                } else if (status === 'approved') {
                    activeTab.classList.remove('border-transparent', 'text-gray-500');
                    activeTab.classList.add('border-green-500', 'text-green-600');
                } else if (status === 'denied') {
                    activeTab.classList.remove('border-transparent', 'text-gray-500');
                    activeTab.classList.add('border-red-500', 'text-red-600');
                }

                // Filter rows
                rows.forEach(row => {
                    if (status === '' || row.classList.contains(status)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
        </script>
    @endif
</div>
@endsection
