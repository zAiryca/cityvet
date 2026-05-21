@extends('layouts.app')

@section('title', '| My Posters')

@section('content')



<div class="min-h-screen pt-24 bg-gradient-to-br from-blue-50 to-green-50">
    <div class="px-4 py-8 mx-auto max-w-7xl">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8" style="margin-top: -5rem">
            <div class="flex items-center">
                <div class="p-3 mr-4 bg-white border-2 border-pink-100 rounded-full shadow-sm">
                    <img src="{{ asset('image/logo1.png') }}" alt="FindFurEver Logo" class="object-contain w-12 h-12">
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">My Posters</h1>
                    <p class="mt-1 text-gray-600">Manage your lost and found pet posters</p>
                </div>
            </div>
            <a href="{{ route('posters.create') }}"
               class="px-6 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition-all duration-200 font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center">
                <i class="mr-2 fas fa-plus"></i>Create New Poster
            </a>
        </div>

        @php
            $activePosters = $posters->where('status', 'active');
            $reunitedPosters = $posters->where('status', 'reunited');
        @endphp



        <!-- Active Posters Section -->
        @if($activePosters->count() > 0)
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="flex items-center text-xl font-bold text-gray-800">
                    <svg class="flex-shrink-0 w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="#B197FC" d="M234.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5 .3-86.2 32.6-96.8 70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3-14.3-70.1 10.2-84.1 59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5l0 1.6c0 25.8-20.9 46.7-46.7 46.7-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2-25.8 0-46.7-20.9-46.7-46.7l0-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3 29.1 51.7 10.2 84.1-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5 46.9 53.9 32.6 96.8-52.1 69.1-84.4 58.5z"/>
                    </svg>Active Posters
                    <span class="ml-2 text-purple-500">({{ $activePosters->count() }})</span>
                </h2>
                <span class="text-sm text-gray-500">Currently searching for owners</span>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($activePosters as $poster)
                <div class="overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl hover:scale-105">
                    <!-- Photo Section with Status Badge -->
                    <div class="relative h-48 overflow-hidden bg-gray-100">
                        @if($poster->photo)
                            <img src="{{ asset('storage/' . $poster->photo) }}" alt="{{ $poster->pet_name ?: 'Pet' }}" class="object-cover w-full h-full cursor-pointer hover:opacity-90 transition-opacity" onclick="openPhotoModal('{{ asset('storage/' . $poster->photo) }}')" style="cursor: pointer;">
                        @else
                            <div class="flex items-center justify-center w-full h-full">
                                <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3">
                            @if($poster->type === 'lost')
                                <span class="inline-flex items-center px-3 py-1 text-xs font-bold text-red-800 bg-red-100 rounded-full">
                                    <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                    Lost
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 text-xs font-bold text-green-800 bg-green-100 rounded-full">
                                    <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-9 9a1 1 0 001.414 1.414L2 12.414V19a1 1 0 001 1h3a1 1 0 001-1v-3a1 1 0 011-1h2a1 1 0 011 1v3a1 1 0 001 1h3a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-9-9z" />
                                    </svg>
                                    Found
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="p-4">
                        <!-- ID and Species -->
                        <div class="mb-3">
                            <h3 class="text-lg font-bold text-gray-900">
                                @if($poster->type === 'lost')
                                    @if($poster->pet_name)
                                        {{ $poster->pet_name }}
                                    @else
                                        LST{{ str_pad($poster->id, 4, '0', STR_PAD_LEFT) }}
                                    @endif
                                    @if($poster->reward)
                                        <span class="inline-flex items-center px-2 py-1 ml-2 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                            ₱{{ $poster->reward }}
                                        </span>
                                    @endif
                                @else
                                    FND{{ str_pad($poster->id, 4, '0', STR_PAD_LEFT) }}
                                @endif
                            </h3>
                            <p class="mt-1 text-sm text-gray-600">{{ ucfirst($poster->species) }} • {{ ucfirst($poster->breed) }}</p>
                        </div>

                        <!-- Quick Info -->
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <div class="text-xs">
                                <p class="font-semibold text-gray-500 uppercase">Gender</p>
                                <p class="font-semibold text-gray-900">{{ ucfirst($poster->gender) }}</p>
                            </div>
                            <div class="text-xs">
                                <p class="font-semibold text-gray-500 uppercase">
                                    @if($poster->type === 'lost') Lost @else Found @endif Date
                                </p>
                                <p class="font-semibold text-gray-900">{{ $poster->date_lost_found->format('M d, Y') }}</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('posters.show', $poster) }}"
                               class="flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-white transition-colors bg-purple-600 rounded-lg shadow-sm hover:bg-purple-700">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View
                            </a>
                            <a href="{{ route('posters.edit', $poster) }}"
                               class="flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-white transition-colors bg-yellow-600 rounded-lg shadow-sm hover:bg-yellow-700">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                        </div>

                        <div class="mt-2">
                            <form method="POST" action="{{ route('posters.reunite', $poster) }}"
                                  onsubmit="return confirm('Mark this poster as reunited? This will remove it from the public Lost & Found page.')">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-white transition-colors bg-green-600 rounded-lg shadow-sm hover:bg-green-700">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                    </svg>
                                    Mark as Reunited
                                </button>
                            </form>
                        </div>

                        <div class="mt-2">
                            <form method="POST" action="{{ route('posters.destroy', $poster) }}"
                                  onsubmit="return confirm('Are you sure you want to delete this poster? This action cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-white transition-colors bg-red-600 rounded-lg shadow-sm hover:bg-red-700">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Reunited Posters Section -->
        @if($reunitedPosters->count() > 0)
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="flex items-center text-xl font-bold text-gray-800">
                    <i class="mr-2 text-green-400 fas fa-heart"></i>Reunited Pets
                    <span class="ml-2 text-green-500">({{ $reunitedPosters->count() }})</span>
                </h2>
                <span class="text-sm text-gray-500">Successfully reunited with families</span>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($reunitedPosters as $poster)
                <div class="overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl hover:scale-105">
                    <!-- Photo Section with Status Badge -->
                    <div class="relative h-48 overflow-hidden bg-gray-100">
                        @if($poster->photo)
                            <img src="{{ asset('storage/' . $poster->photo) }}" alt="{{ $poster->pet_name ?: 'Pet' }}" class="object-cover w-full h-full cursor-pointer hover:opacity-90 transition-opacity" onclick="openPhotoModal('{{ asset('storage/' . $poster->photo) }}')" style="cursor: pointer;">
                        @else
                            <div class="flex items-center justify-center w-full h-full">
                                <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold text-green-800 bg-green-100 rounded-full">
                                <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                </svg>
                                Reunited
                            </span>
                        </div>
                    </div>

                    <div class="p-4">
                        <!-- ID and Species -->
                        <div class="mb-3">
                            <h3 class="text-lg font-bold text-gray-900">
                                @if($poster->type === 'lost')
                                    @if($poster->pet_name)
                                        {{ $poster->pet_name }}
                                    @else
                                        LST{{ str_pad($poster->id, 4, '0', STR_PAD_LEFT) }}
                                    @endif
                                @else
                                    FND{{ str_pad($poster->id, 4, '0', STR_PAD_LEFT) }}
                                @endif
                            </h3>
                            <p class="mt-1 text-sm text-gray-600">{{ ucfirst($poster->species) }} • {{ ucfirst($poster->breed) }}</p>
                        </div>

                        <!-- Quick Info -->
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <div class="text-xs">
                                <p class="font-semibold text-gray-500 uppercase">Gender</p>
                                <p class="font-semibold text-gray-900">{{ ucfirst($poster->gender) }}</p>
                            </div>
                            <div class="text-xs">
                                <p class="font-semibold text-gray-500 uppercase">
                                    @if($poster->type === 'lost') Lost @else Found @endif Date
                                </p>
                                <p class="font-semibold text-gray-900">{{ $poster->date_lost_found->format('M d, Y') }}</p>
                            </div>
                        </div>

                        <!-- Success Message -->
                        <div class="mb-4">
                            <p class="flex items-center justify-center text-sm font-medium text-green-800">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                </svg>
                                Successfully reunited!
                            </p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('posters.show', $poster) }}"
                               class="flex items-center justify-center px-3 py-2 text-sm font-medium text-center text-white transition-colors bg-purple-600 rounded-lg shadow-sm hover:bg-purple-700">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View
                            </a>
                            <form method="POST" action="{{ route('posters.destroy', $poster) }}"
                                  onsubmit="return confirm('Are you sure you want to delete this poster?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-white transition-colors bg-red-600 rounded-lg shadow-sm hover:bg-red-700">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Empty State -->
        @if($activePosters->count() == 0 && $reunitedPosters->count() == 0)
        <div class="p-12 text-center border border-pink-100 shadow-lg bg-gradient-to-br from-white to-pink-50 rounded-2xl">
            <div class="max-w-md mx-auto">
                <h3 class="mb-2 text-xl font-bold text-gray-800">No posters yet</h3>
                <p class="mb-6 text-gray-600">Create your first lost or found pet poster to help reunite pets with their families.</p>
                <a href="{{ route('posters.create') }}"
                   class="inline-flex items-center px-6 py-3 font-medium text-white transition-all duration-200 bg-purple-600 shadow-md rounded-xl hover:bg-purple-700 hover:shadow-lg">
                    <i class="mr-2 fas fa-plus"></i>Create Your First Poster
                </a>
            </div>
        </div>
        @endif

        <!-- Pagination -->
        @if($posters->hasPages())
        <div class="mt-12">
            {{ $posters->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Photo Modal -->
<div id="photoModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75 p-4" onclick="closePhotoModal(event)">
    <div class="relative w-full max-w-5xl" onclick="event.stopPropagation()">
        <img id="modalImage" src="" alt="Full size photo" class="w-full h-auto rounded-lg max-h-screen object-contain">

        <!-- Close Button -->
        <button onclick="closePhotoModal()" class="absolute top-2 right-2 text-white bg-black bg-opacity-50 rounded-full p-2 hover:bg-opacity-75">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

<script>
    function openPhotoModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('photoModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closePhotoModal(event) {
        if (event && event.target.id !== 'photoModal') return;
        document.getElementById('photoModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('keydown', function(event) {
        const modal = document.getElementById('photoModal');
        if (modal.classList.contains('hidden')) return;

        if (event.key === 'Escape' || event.key === 'Backspace') {
            closePhotoModal();
            event.preventDefault();
        }
    });
</script>

@endsection
