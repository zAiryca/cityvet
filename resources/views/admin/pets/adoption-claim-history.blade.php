@extends('layouts.admin')

@section('title', '| Adoption & Claim History')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <div class="p-6 bg-white rounded-lg shadow-md">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    <svg class="inline w-8 h-8 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Adoption & Claim History
                </h1>
                <p class="mt-2 text-gray-600">View all pets that have been successfully claimed or adopted, including those that are currently unclaimed or unadopted.</p>
            </div>
        </div>

        {{-- Status Filter Tabs --}}
        <div class="mb-6 border-b border-gray-200">
            <nav class="flex pb-2 space-x-4 overflow-x-auto">
                <a href="{{ route('admin.adoption-claim-history') }}"
                   class="@if(!request('status')) border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 @endif whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                    All Claimed/Adopted
                </a>
                <a href="{{ route('admin.adoption-claim-history', ['status' => 'claimed']) }}"
                   class="@if(request('status') === 'claimed') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 @endif whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                    <svg class="inline w-4 h-4 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Claimed
                </a>
                <a href="{{ route('admin.adoption-claim-history', ['status' => 'adopted']) }}"
                   class="@if(request('status') === 'adopted') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 @endif whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                    <svg class="inline w-4 h-4 mr-1 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Adopted
                </a>
                <a href="{{ route('admin.adoption-claim-history', ['status' => 'unclaimed']) }}"
                   class="@if(request('status') === 'unclaimed') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 @endif whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                    <svg class="inline w-4 h-4 mr-1 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Unclaimed/Unadopted
                </a>
            </nav>
        </div>

        @if($pets->count() > 0)
            <div class="space-y-6">
                @php $counter = ($pets->currentPage() - 1) * $pets->perPage() + 1; @endphp
                @foreach($pets as $pet)
                    <div class="overflow-hidden transition-shadow border rounded-lg shadow-sm hover:shadow-md">
                        <div class="flex items-center p-6 gap-4">
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center justify-center w-8 h-8 text-sm font-bold text-gray-600 bg-gray-100 rounded-full">
                                    {{ $counter }}
                                </span>
                            </div>
                            <div class="flex-shrink-0">
                                @if($pet->photo)
                                    <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="object-cover w-16 h-16 border-2 border-gray-200 rounded cursor-pointer hover:opacity-90" onclick="openAdminHistoryPetPhotoModal('{{ asset('storage/' . $pet->photo) }}', '{{ $pet->display_code }}')">
                                @else
                                    <div class="flex items-center justify-center w-16 h-16 bg-gray-100 border-2 border-gray-200 rounded">
                                        <span class="text-xs font-bold text-gray-400">No Photo</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                @if($pet->requests && $pet->requests->count() > 0)
                                    {{-- Claimed/Adopted Pets Layout --}}
                                    <div class="grid grid-cols-2 gap-4 w-full items-center">
                                        <div>
                                            <h3 class="text-lg font-bold text-gray-900">{{ $pet->display_code }}</h3>
                                            <p class="text-sm text-gray-600">{{ ucfirst($pet->species) }} • {{ $pet->breed ?: 'Unknown' }} • {{ $pet->estimated_age_years ? $pet->estimated_age_years . 'y' : '' }} {{ $pet->estimated_age_months ? $pet->estimated_age_months . 'm' : '' }}</p>

                                            {{-- Show most recent return if pet was returned --}}
                                            @if($pet->mostRecentReturn)
                                                @php $lastOwner = $pet->mostRecentReturn; @endphp
                                                @if($lastOwner->user)
                                                    <div class="mt-2 text-xs bg-orange-50 border border-orange-200 text-orange-700 px-2 py-1 rounded inline-block">
                                                        <strong>↩ Returned by:</strong> {{ $lastOwner->user->name }}
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="flex items-center justify-end space-x-3">
                                            @php $latestRequest = $pet->requests->sortByDesc('updated_at')->first(); @endphp
                                            <div class="text-right">
                                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full
                                                    @if($pet->status === 'adopted') bg-green-100 text-green-800
                                                    @elseif($pet->status === 'claimed') bg-blue-100 text-blue-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $pet->status)) }}
                                                </span>
                                                <p class="mt-1 text-xs text-gray-600">{{ $latestRequest->updated_at->format('M d, Y') }}</p>
                                            </div>
                                            <a href="{{ route('admin.pets.show', $pet) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 whitespace-nowrap">
                                                View Pet →
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    {{-- Unclaimed/Unadopted Pets Layout --}}
                                    <div class="grid grid-cols-2 gap-4 w-full items-center">
                                        <div>
                                            <h3 class="text-lg font-bold text-gray-900">{{ $pet->display_code }}</h3>
                                            <p class="text-sm text-gray-600">{{ ucfirst($pet->species) }} • {{ $pet->breed ?: 'Unknown' }} • {{ $pet->estimated_age_years ? $pet->estimated_age_years . 'y' : '' }} {{ $pet->estimated_age_months ? $pet->estimated_age_months . 'm' : '' }}</p>
                                        </div>
                                        <div class="flex items-center justify-end space-x-3">
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Unclaimed/Unadopted
                                            </span>
                                            <a href="{{ route('admin.pets.show', $pet) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 whitespace-nowrap">
                                                View Pet →
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @php $counter++; @endphp
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $pets->links() }}
            </div>
        @else
            <div class="p-12 text-center border border-gray-200 rounded-lg bg-gray-50">
                <p class="text-lg text-gray-600">No adoption or claim history found.</p>
                <a href="{{ route('admin.pets.index') }}" class="inline-block mt-2 text-indigo-600 hover:underline">
                    ← Back to Active Pets
                </a>
            </div>
        @endif
    </div>
</div>
<!-- Admin History Pet Photo Modal -->
<div id="adminHistoryPetPhotoModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-70" onclick="if(event.target.id === 'adminHistoryPetPhotoModal') closeAdminHistoryPetPhotoModal()">
    <button onclick="closeAdminHistoryPetPhotoModal()" class="absolute text-white top-6 right-6 hover:text-gray-300 z-10">
        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <img id="adminHistoryPetPhotoImg" src="" alt="Pet Photo" class="max-w-[90vw] max-h-[90vh] object-contain rounded-lg shadow-2xl cursor-pointer" onclick="closeAdminHistoryPetPhotoModal()">
</div>

<!-- Admin History ID Photo Modal -->
<div id="adminHistoryIdPhotoModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-70" onclick="if(event.target.id === 'adminHistoryIdPhotoModal') closeAdminHistoryIdPhotoModal()">
    <button onclick="closeAdminHistoryIdPhotoModal()" class="absolute text-white top-6 right-6 hover:text-gray-300 z-10">
        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <img id="adminHistoryIdPhotoImg" src="" alt="ID Photo" class="max-w-[90vw] max-h-[90vh] object-contain rounded-lg shadow-2xl cursor-pointer" onclick="closeAdminHistoryIdPhotoModal()">
</div>

<!-- Admin History Supporting Photo Modal -->
<div id="adminHistoryPhotoModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-70" onclick="if(event.target.id === 'adminHistoryPhotoModal') closeAdminHistoryPhotoModal()">
    <button onclick="closeAdminHistoryPhotoModal()" class="absolute text-white top-6 right-6 hover:text-gray-300 z-10">
        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <img id="adminHistoryPhotoImg" src="" alt="Supporting Photo" class="max-w-[90vw] max-h-[90vh] object-contain rounded-lg shadow-2xl cursor-pointer" onclick="closeAdminHistoryPhotoModal()">
</div>

<script>
function openAdminHistoryPetPhotoModal(imageSrc, altText) {
    const imgElement = document.getElementById('adminHistoryPetPhotoImg');
    imgElement.src = imageSrc;
    imgElement.alt = altText;
    document.getElementById('adminHistoryPetPhotoModal').classList.remove('hidden');
}

function closeAdminHistoryPetPhotoModal() {
    document.getElementById('adminHistoryPetPhotoModal').classList.add('hidden');
}

function closeAdminHistoryIdPhotoModal() {
    document.getElementById('adminHistoryIdPhotoModal').classList.add('hidden');
}

function openAdminHistoryPhotoModal(imageSrc, altText) {
    const imgElement = document.getElementById('adminHistoryPhotoImg');
    imgElement.src = imageSrc;
    imgElement.alt = altText;
    document.getElementById('adminHistoryPhotoModal').classList.remove('hidden');
}

function closeAdminHistoryPhotoModal() {
    document.getElementById('adminHistoryPhotoModal').classList.add('hidden');
}

// Keyboard event listener for backspace key to close modals
document.addEventListener('keydown', function(event) {
    if (event.key === 'Backspace') {
        // Check admin history pet photo modal
        const petModal = document.getElementById('adminHistoryPetPhotoModal');
        if (petModal && !petModal.classList.contains('hidden')) {
            closeAdminHistoryPetPhotoModal();
            return;
        }

        // Check admin history ID photo modal
        const idModal = document.getElementById('adminHistoryIdPhotoModal');
        if (idModal && !idModal.classList.contains('hidden')) {
            closeAdminHistoryIdPhotoModal();
            return;
        }

        // Check admin history supporting photo modal
        const photoModal = document.getElementById('adminHistoryPhotoModal');
        if (photoModal && !photoModal.classList.contains('hidden')) {
            closeAdminHistoryPhotoModal();
            return;
        }
    }

    // Also handle escape key
    if (event.key === 'Escape') {
        closeAdminHistoryPetPhotoModal();
        closeAdminHistoryIdPhotoModal();
        closeAdminHistoryPhotoModal();
    }
});
</script>
@endsection
