@extends('layouts.app')

@section('title', '| My Requests')

@section('content')
<div class="px-4 py-4 pt-24 mx-auto max-w-7xl" style="font-family: 'Poppins', sans-serif;">
    <div class="flex flex-col mb-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Poppins', sans-serif;">My Requests</h1>
            <p class="mt-1 text-sm text-gray-600" style="font-family: 'Poppins', sans-serif;">Track your claim, adopt and requests</p>
        </div>
    </div>

    <!-- Status Tabs -->
    <div class="mb-4 bg-white rounded-lg shadow-lg" id="filters-container">
        <div class="px-6 py-2">
            <nav class="flex -mb-px space-x-8" aria-label="Tabs">
                <a href="{{ route('user.requests', array_merge(request()->query(), ['status' => ''])) }}" class="tab-link whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ !request('status') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}" style="font-family: 'Poppins', sans-serif;">
                    All
                </a>
                <a href="{{ route('user.requests', array_merge(request()->query(), ['status' => 'pending'])) }}" class="tab-link whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'pending' ? 'border-yellow-500 text-yellow-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}" style="font-family: 'Poppins', sans-serif;">
                    Pending
                </a>
                <a href="{{ route('user.requests', array_merge(request()->query(), ['status' => 'approved'])) }}" class="tab-link whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'approved' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}" style="font-family: 'Poppins', sans-serif;">
                    Approved
                </a>
                <a href="{{ route('user.requests', array_merge(request()->query(), ['status' => 'denied'])) }}" class="tab-link whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'denied' ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}" style="font-family: 'Poppins', sans-serif;">
                    Denied
                </a>
                <a href="{{ route('user.requests', array_merge(request()->query(), ['status' => 'completed'])) }}" class="tab-link whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'completed' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}" style="font-family: 'Poppins', sans-serif;">
                    Completed
                </a>
            </nav>
        </div>

        <!-- Type Filter Tabs -->
        <div class="px-6 py-2 border-t border-gray-200">
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
        <!-- Table Container -->
        <div class="relative">
            <div class="bg-white rounded-lg shadow" id="table-container">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="sticky top-0 z-10 bg-gray-50">
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
                                        @if($item && isset($item->photo) && $item->photo)
                                            <img src="{{ asset('storage/' . $item->photo) }}"
                                                 alt="{{ $item->display_code ?? ($item->title ?? 'item') }}"
                                                 class="object-cover w-12 h-12 transition-transform rounded-full cursor-pointer hover:scale-110 hover:shadow-lg"
                                                 onclick="openPhotoModal('{{ asset('storage/' . $item->photo) }}', '{{ $item->display_code ?? ($item->title ?? 'Pet Photo') }}')"
                                                 title="Click to enlarge">
                                        @else
                                            <div class="flex items-center justify-center w-12 h-12 text-sm font-medium text-gray-500 transition-all bg-gray-100 rounded-full cursor-pointer hover:bg-gray-200 hover:shadow-md"
                                                 title="No photo available">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
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
                                <div class="flex items-center space-x-2">
                                    <button onclick="window.location.href='{{ route('user.requests.show', $request) }}'"
                                            class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-white bg-indigo-600 border border-indigo-600 rounded-md hover:bg-indigo-700 hover:border-indigo-700 transition-colors"
                                            title="View Details">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        View
                                    </button>
                                    @if($request->status === 'pending')
                                        <form action="{{ route('user.requests.destroy', $request) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to cancel this request? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-white bg-red-600 border border-red-600 rounded-md hover:bg-red-700 hover:border-red-700 transition-colors"
                                                    title="Cancel Request">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                                Cancel
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $requests->appends(request()->query())->links() }}</div>
    @else
        <div class="p-6 text-center bg-white rounded-lg shadow">
            <p class="mb-4 text-gray-500" style="font-family: 'Poppins', sans-serif;">No requests yet. Start by browsing pets or announcements!</p>
            <div class="space-x-4">
                <a href="{{ route('pets.impounded') }}" class="px-4 py-2 text-white transition-colors bg-red-500 rounded hover:bg-red-600" style="font-family: 'Poppins', sans-serif;">View Impounded</a>
                <a href="{{ route('pets.adoptable') }}" class="px-4 py-2 text-white transition-colors bg-green-500 rounded hover:bg-green-600" style="font-family: 'Poppins', sans-serif;">Browse Adoptable</a>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Client-side filtering for cards (legacy support)
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

    // Mobile responsive filter behavior
    function initMobileFilters() {
        const filterContainer = document.getElementById('filters-container');

        if (window.innerWidth < 768) { // Mobile breakpoint
            // Collapse type filters on mobile, show only status tabs
            const typeFilterSection = filterContainer.querySelector('.border-t');
            if (typeFilterSection) {
                typeFilterSection.style.display = 'none';

                // Add a toggle button for type filters
                const toggleButton = document.createElement('button');
                toggleButton.innerHTML = `
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                    </svg>
                    Filter by Type
                `;
                toggleButton.className = 'flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors';
                toggleButton.onclick = function() {
                    typeFilterSection.style.display = typeFilterSection.style.display === 'none' ? 'block' : 'none';
                };

                filterContainer.appendChild(toggleButton);
            }
        }
    }

    // Initialize mobile behavior on load and resize
    initMobileFilters();
    window.addEventListener('resize', initMobileFilters);

    // Photo modal functionality
    function openPhotoModal(src, alt) {
        // Create modal if it doesn't exist
        let modal = document.getElementById('photo-modal');
        if (!modal) {
            modal = document.createElement('div');
            modal.id = 'photo-modal';
            modal.className = 'fixed inset-0 z-50 flex items-center justify-center hidden bg-white bg-opacity-90';
            modal.innerHTML = `
                <div class="relative max-w-4xl max-h-full p-4">
                    <button onclick="closePhotoModal()" class="absolute text-gray-600 top-6 right-6 hover:text-gray-800">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <img id="modal-image" src="" alt="" class="max-w-full max-h-full rounded-lg shadow-2xl">
                </div>
            `;
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closePhotoModal();
                }
            });
            document.body.appendChild(modal);
        }

        // Update modal content
        document.getElementById('modal-image').src = src;
        document.getElementById('modal-image').alt = alt;

        // Show modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closePhotoModal() {
        const modal = document.getElementById('photo-modal');
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    }

    // Close modal on escape and backspace keys
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' || e.key === 'Backspace') {
            closePhotoModal();
        }
    });
</script>
@endsection
