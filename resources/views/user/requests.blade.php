@extends('layouts.app')

@section('title', '| My Requests')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">My Requests</h1>
    <p class="mb-6">Track your claim, adopt, and announcement registration requests.</p>

    <!-- Status Tabs -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                <a href="{{ route('user.requests', array_merge(request()->query(), ['status' => ''])) }}" class="tab-link whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ !request('status') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    All ({{ $requests->total() }})
                </a>
                <a href="{{ route('user.requests', array_merge(request()->query(), ['status' => 'pending'])) }}" class="tab-link whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'pending' ? 'border-yellow-500 text-yellow-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Pending ({{ $requests->where('status', 'pending')->count() }})
                </a>
                <a href="{{ route('user.requests', array_merge(request()->query(), ['status' => 'approved'])) }}" class="tab-link whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'approved' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Approved ({{ $requests->where('status', 'approved')->count() }})
                </a>
                <a href="{{ route('user.requests', array_merge(request()->query(), ['status' => 'denied'])) }}" class="tab-link whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'denied' ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Denied ({{ $requests->where('status', 'denied')->count() }})
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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($requests as $request)
                <div class="request-card bg-white rounded-lg shadow-md overflow-hidden {{ $request->status }}" style="{{ request('status') && request('status') !== $request->status ? 'display: none;' : '' }}">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">
                                    @if($request->requestable_type === 'App\Models\Pet' && $request->requestable)
                                        {{ $request->requestable->display_code }}
                                    @elseif($request->requestable_type === 'App\Models\Announcement' && $request->requestable)
                                        {{ Str::limit($request->requestable->title, 30) }}
                                    @else
                                        N/A
                                    @endif
                                </h3>
                                <p class="text-sm text-gray-600">{{ ucfirst($request->type) }}</p>
                            </div>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($request->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($request->status) }}
                            </span>
                        </div>

                        <div class="space-y-2 mb-4">
                            <p class="text-sm text-gray-600">
                                <strong>Submitted:</strong> {{ $request->created_at->format('M d, Y') }}
                            </p>
                            @if($request->requestable_type === 'App\Models\Pet' && $request->requestable)
                                <p class="text-sm text-gray-600">
                                    <strong>Species:</strong> {{ $request->requestable->species }}
                                </p>
                            @endif
                        </div>

                        <div class="flex justify-between items-center">
                            @if($request->status === 'pending')
                                <span class="text-yellow-600 text-sm">Awaiting Review</span>
                            @else
                                <a href="{{ route('user.requests.show', $request) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Details</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $requests->links() }}
    @else
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <p class="text-gray-500 mb-4">No requests yet. Start by browsing pets or announcements!</p>
            <div class="space-x-4">
                <a href="{{ route('pets.adoptable') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Browse Adoptable</a>
                <a href="{{ route('pets.impounded') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">View Impounded</a>
                <a href="{{ route('announcements.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Upcoming Announcements</a>
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
