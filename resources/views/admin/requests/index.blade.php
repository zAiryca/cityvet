@extends('layouts.admin')

@section('title', '| Admin - Requests')

@section('content')
<div class="px-4 py-4 mx-auto max-w-7xl" style="font-family: 'Poppins', sans-serif;">
    <div class="flex flex-col mb-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            @php
                $pageTitle = 'Pending Requests';
                if ($requestStatus === 'approved') {
                    $pageTitle = 'Approved Requests';
                } elseif ($requestStatus === 'denied') {
                    $pageTitle = 'Denied Requests';
                }
            @endphp
            <h1 class="text-2xl font-bold text-gray-900" style="font-family: 'Poppins', sans-serif;">{{ $pageTitle }}</h1>
            <p class="mt-1 text-sm text-gray-600" style="font-family: 'Poppins', sans-serif;">Manage adoption and claim requests</p>
        </div>
    </div>

    <div class="p-6 mb-6 bg-white border border-gray-200 rounded-lg shadow-sm">

        {{-- Status Filter Tabs --}}
        <div class="mb-4 bg-white rounded-lg shadow-lg" id="filters-container">
            <div class="px-6 py-2">
                <nav class="flex -mb-px space-x-8" aria-label="Tabs">
                    <a href="{{ route('admin.requests.index', ['status' => 'pending']) }}"
                       class="@if($requestStatus === 'pending') border-blue-500 text-blue-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                        Pending
                    </a>
                    <a href="{{ route('admin.requests.index', ['status' => 'approved']) }}"
                       class="@if($requestStatus === 'approved') border-green-500 text-green-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                        Approved
                    </a>
                </nav>
            </div>
        </div>

        @if($pets->count() > 0)
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Pet ID</th>
                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Photo</th>
                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Species/Breed</th>
                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Requester(s)</th>
                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pets as $pet)
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $pet->display_code }}</div>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @if($pet->photo)
                                        <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="object-cover w-12 h-12 rounded-full cursor-pointer hover:opacity-80 transition-opacity" onclick="openAdminRequestPhotoModal('{{ asset('storage/' . $pet->photo) }}', '{{ $pet->display_code }}')" title="Click to enlarge">
                                    @else
                                        <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-full">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $pet->species }} / {{ $pet->breed }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        @if($pet->status === 'impounded') bg-red-100 text-red-800
                                        @elseif($pet->status === 'adoptable') bg-green-100 text-green-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ ucfirst($pet->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    <span class="text-gray-500">{{ $pet->requests->count() }} requester(s)</span>
                                </td>
                                <td class="px-4 py-3 text-sm font-medium">
                                    <button onclick="window.location.href='{{ route('admin.pets.show', $pet) }}'"
                                            class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-white bg-indigo-600 border border-indigo-600 rounded hover:bg-indigo-700 hover:border-indigo-700 transition-colors">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        View
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $pets->appends(request()->query())->links() }}
        @else
            <p class="py-8 text-center text-gray-500">No pets with {{ strtolower($pageTitle) }}.</p>
        @endif
    </div>
</div>

<!-- Admin Request Pet Photo Modal -->
<div id="adminRequestPetPhotoModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-70" onclick="if(event.target.id === 'adminRequestPetPhotoModal') closeAdminRequestPhotoModal()">
    <button onclick="closeAdminRequestPhotoModal()" class="absolute text-white top-6 right-6 hover:text-gray-300 z-10">
        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <img id="adminRequestPetPhotoImg" src="" alt="Pet Photo" class="max-w-[90vw] max-h-[90vh] object-contain rounded-lg shadow-2xl cursor-pointer" onclick="closeAdminRequestPhotoModal()">
</div>

<script>
function openAdminRequestPhotoModal(imageSrc, petCode) {
    const imgElement = document.getElementById('adminRequestPetPhotoImg');
    imgElement.src = imageSrc;
    imgElement.alt = petCode;
    document.getElementById('adminRequestPetPhotoModal').classList.remove('hidden');
}

function closeAdminRequestPhotoModal() {
    document.getElementById('adminRequestPetPhotoModal').classList.add('hidden');
}

// Add keyboard support for Backspace to close modal
document.addEventListener('keydown', function(event) {
    if (event.key === 'Backspace') {
        const modal = document.getElementById('adminRequestPetPhotoModal');
        if (modal && !modal.classList.contains('hidden')) {
            closeAdminRequestPhotoModal();
        }
    }
});
</script>

@endsection
