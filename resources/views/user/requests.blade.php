@extends('layouts.app')

@section('title', '| My Requests')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl pt-24">
    <h1 class="mb-6 text-3xl font-bold">My Requests</h1>
    <p class="mb-6">Track your claim, adopt and requests.</p>

    <!-- Status Tabs -->
    <div class="mb-6 bg-white rounded-lg shadow">
        <div class="border-b border-gray-200">
            <nav class="flex px-6 -mb-px space-x-8" aria-label="Tabs">
                <a href="{{ route('user.requests', array_merge(request()->query(), ['status' => ''])) }}" class="tab-link whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ !request('status') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    All
                </a>
                <a href="{{ route('user.requests', array_merge(request()->query(), ['status' => 'pending'])) }}" class="tab-link whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'pending' ? 'border-yellow-500 text-yellow-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Pending
                </a>
                <a href="{{ route('user.requests', array_merge(request()->query(), ['status' => 'approved'])) }}" class="tab-link whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'approved' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Approved
                </a>
                <a href="{{ route('user.requests', array_merge(request()->query(), ['status' => 'denied'])) }}" class="tab-link whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'denied' ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Denied
                </a>
                <a href="{{ route('user.requests', array_merge(request()->query(), ['status' => 'completed'])) }}" class="tab-link whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'completed' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Completed
                </a>
            </nav>
        </div>

        <!-- Type Filter Tabs -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex space-x-4">
                <span class="text-sm font-medium text-gray-700">Filter by Type:</span>
                <a href="{{ route('user.requests', array_merge(request()->query(), ['type' => ''])) }}" class="type-filter whitespace-nowrap py-1 px-2 text-xs font-medium rounded-full {{ !request('type') ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    All Types
                </a>
                <a href="{{ route('user.requests', array_merge(request()->query(), ['type' => 'adopt'])) }}" class="type-filter whitespace-nowrap py-1 px-2 text-xs font-medium rounded-full {{ request('type') === 'adopt' ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Adoption
                </a>
                <a href="{{ route('user.requests', array_merge(request()->query(), ['type' => 'claim'])) }}" class="type-filter whitespace-nowrap py-1 px-2 text-xs font-medium rounded-full {{ request('type') === 'claim' ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Claim
                </a>

            </div>
        </div>
    </div>

    @if($requests->count() > 0)
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Code Name</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Photo</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Species / Breed</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Request Status</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Submitted</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($requests as $index => $request)
                        @php $item = $request->requestable; @endphp
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                {{ $requests->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    @if($item && $request->requestable_type === 'App\\Models\\Pet')
                                        {{ $item->display_code }}
                                    @elseif($item && $request->requestable_type === 'App\\Models\\Announcement')
                                        {{ Str::limit($item->title, 40) }}
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($item && isset($item->photo))
                                    <img src="{{ $item->photo ? asset('storage/' . $item->photo) : 'https://via.placeholder.com/40?text=' . substr((($item->display_code ?? $item->title) ?? 'N'), 0, 1) }}" alt="{{ $item->display_code ?? ($item->title ?? 'item') }}" class="w-10 h-10 rounded-full">
                                @else
                                    <div class="flex items-center justify-center w-10 h-10 text-gray-500 bg-gray-100 rounded-full">-</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                @if($item && $request->requestable_type === 'App\\Models\\Pet')
                                    {{ $item->species }} / {{ $item->breed }}
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full @if($request->status === 'pending') bg-yellow-100 text-yellow-800 @elseif($request->status === 'approved') bg-green-100 text-green-800 @elseif($request->status === 'completed') bg-blue-100 text-blue-800 @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 whitespace-nowrap">{{ $request->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 whitespace-nowrap">{{ ucfirst($request->type) }}</td>
                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                <a href="{{ route('user.requests.show', $request) }}" class="mr-3 text-indigo-600 hover:text-indigo-900">View</a>
                                @if($request->status === 'pending')
                                    <form action="{{ route('user.requests.destroy', $request) }}" method="POST" class="inline" onsubmit="return confirm('Cancel this request?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Cancel</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $requests->appends(request()->query())->links() }}</div>
    @else
        <div class="p-6 text-center bg-white rounded-lg shadow">
            <p class="mb-4 text-gray-500">No requests yet. Start by browsing pets or announcements!</p>
            <div class="space-x-4">
                <a href="{{ route('pets.impounded') }}" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">View Impounded</a>
                <a href="{{ route('pets.adoptable') }}" class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">Browse Adoptable</a>
            </div>
        </div>
    @endif
</div>

<script>
    // Client-side filtering for cards
    document.addEventListener('DOMContentLoaded', function() {
        const statusParam = '{{ request("status") }}';
        const typeParam = '{{ request("type") }}';

        if (statusParam || typeParam) {
            filterCards();
        }
    });

    function filterCards() {
        const statusParam = '{{ request("status") }}';
        const typeParam = '{{ request("type") }}';

        const cards = document.querySelectorAll('.request-card');

        cards.forEach(card => {
            let showCard = true;

            // Filter by status
            if (statusParam && !card.classList.contains(statusParam)) {
                showCard = false;
            }

            // Filter by type
            if (typeParam) {
                const cardType = card.querySelector('p.text-sm.text-gray-600').textContent.toLowerCase();
                if (!cardType.includes(typeParam)) {
                    showCard = false;
                }
            }

            card.style.display = showCard ? '' : 'none';
        });
    }
</script>
@endsection

