@extends('layouts.admin')

@section('title', '| Admin - Poster Details')

@section('content')
<div class="min-h-screen pt-2 bg-gray-50">
    <div class="max-w-6xl px-4 py-4 mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <div class="p-3 mr-4 bg-white rounded-full shadow-sm">
                    <img src="{{ asset('https://i.ibb.co/8DPN5B7m/logo.png') }}" alt="FindFurEver Logo" class="object-contain w-12 h-12">
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Poster Details</h1>
                    <p class="flex items-center mt-1 text-gray-600">
                        @if($poster->type === 'lost')
                            <svg class="w-5 h-5 mr-2 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                            Lost Pet - {{ $poster->pet_name ?: 'Unknown Pet' }}
                        @else
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-9 9a1 1 0 001.414 1.414L2 12.414V19a1 1 0 001 1h3a1 1 0 001-1v-3a1 1 0 011-1h2a1 1 0 011 1v3a1 1 0 001 1h3a1 1 0 00-1 1v-6.586l.293.293a1 1 0 001.414-1.414l-9-9z" />
                            </svg>
                            Found Pet - FND{{ str_pad($poster->id, 4, '0', STR_PAD_LEFT) }}
                        @endif
                    </p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.posters.index') }}"
                   class="px-5 py-2.5 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                    ← Back to Posters
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Photo & Quick Info -->
            <div class="lg:col-span-1">
                <div class="p-6 bg-white shadow-lg rounded-2xl">
                    @if($poster->photo)
                        <img src="{{ asset('storage/' . $poster->photo) }}"
                             alt="{{ $poster->pet_name }}"
                             class="object-cover w-full h-64 mb-4 shadow-md rounded-xl cursor-pointer hover:opacity-90 transition-opacity"
                             onclick="openPhotoModal('{{ asset('storage/' . $poster->photo) }}')"
                             style="cursor: pointer;">
                    @else
                        <div class="flex items-center justify-center w-full h-64 mb-4 bg-gradient-to-br from-pink-100 to-purple-100 rounded-xl">
                            <div class="text-center">
                                <svg class="w-16 h-16 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="mt-2 text-gray-500">No photo</p>
                            </div>
                        </div>
                    @endif

                    <!-- Status Badge -->
                    @if($poster->status === 'reunited')
                    <div class="flex justify-center mb-4">
                        <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-green-800 bg-green-100 rounded-full">
                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                            </svg>
                            Reunited
                        </span>
                    </div>
                    @endif

                    <!-- Quick Info -->
                    <div class="space-y-3">
                        <div class="flex items-center p-3 rounded-lg bg-blue-50">
                            <svg class="w-6 h-6 mr-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-600">Type</p>
                                <p class="font-semibold text-gray-900">{{ ucfirst($poster->type) }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 rounded-lg bg-green-50">
                            <svg class="w-6 h-6 mr-3 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="#10B981" d="M234.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5 .3-86.2 32.6-96.8 70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3-14.3-70.1 10.2-84.1 59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5l0 1.6c0 25.8-20.9 46.7-46.7 46.7-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2-25.8 0-46.7-20.9-46.7-46.7l0-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3 29.1 51.7 10.2 84.1-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5 46.9 53.9 32.6 96.8-52.1 69.1-84.4 58.5z"/>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-600">Species & Breed</p>
                                <p class="font-semibold text-gray-900">{{ $poster->species }} - {{ $poster->breed }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 rounded-lg bg-purple-50">
                            <svg class="w-6 h-6 mr-3 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-600">Gender</p>
                                <p class="font-semibold text-gray-900">{{ ucfirst($poster->gender) }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 rounded-lg bg-yellow-50">
                            <svg class="w-6 h-6 mr-3 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-600">Date {{ $poster->type === 'lost' ? 'Lost' : 'Found' }}</p>
                                <p class="font-semibold text-gray-900">{{ $poster->date_lost_found->format('M d, Y') }}</p>
                            </div>
                        </div>

                        @if($poster->reward)
                        <div class="flex items-center p-3 rounded-lg bg-green-50">
                            <svg class="w-6 h-6 mr-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-600">Reward</p>
                                <p class="font-semibold text-green-600">₱{{ number_format($poster->reward, 2) }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Details Section -->
            <div class="space-y-6 lg:col-span-2">
                <!-- Location & Contact -->
                <div class="p-6 bg-white shadow-lg rounded-2xl">
                    <h2 class="flex items-center mb-4 text-xl font-bold text-gray-900">
                        <svg class="w-6 h-6 mr-2 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        Location & Contact
                    </h2>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-1 text-sm font-semibold text-gray-600">
                                    {{ $poster->type === 'lost' ? 'Last Seen Location' : 'Found Location' }}
                                </label>
                                <p class="p-3 text-gray-700 rounded-lg bg-gray-50">
                                    {{ $poster->type === 'lost' ? $poster->last_seen : $poster->found_at }}
                                </p>
                            </div>

                            <div>
                                <label class="block mb-1 text-sm font-semibold text-gray-600">Contact Information</label>
                                <p class="p-3 text-lg font-semibold text-blue-700 rounded-lg bg-blue-50">
                                    {{ $poster->contact_info }}
                                </p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block mb-1 text-sm font-semibold text-gray-600">Colors & Markings</label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(explode(', ', $poster->color_markings) as $color)
                                        <span class="px-3 py-1 text-sm font-medium rounded-full bg-amber-100 text-amber-800">{{ $color }}</span>
                                    @endforeach
                                </div>
                            </div>

                            @if($poster->user)
                            <div>
                                <label class="block mb-1 text-sm font-semibold text-gray-600">Posted by</label>
                                <p class="p-3 text-gray-700 rounded-lg bg-gray-50">
                                    {{ $poster->user->first_name }} {{ $poster->user->last_name }}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Description & Comments -->
                <div class="p-6 bg-white shadow-lg rounded-2xl">
                    <h2 class="flex items-center mb-4 text-xl font-bold text-gray-900">
                        <svg class="w-6 h-6 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                        </svg>
                        Additional Information
                    </h2>

                    <div class="space-y-4">
                        @if($poster->description)
                        <div>
                            <label class="block mb-1 text-sm font-semibold text-gray-600">Description</label>
                            <p class="p-4 text-gray-700 rounded-lg bg-gray-50">{{ $poster->description }}</p>
                        </div>
                        @endif

                        @if($poster->uploader_comments)
                        <div>
                            <label class="block mb-1 text-sm font-semibold text-gray-600">Additional Comments</label>
                            <p class="p-4 text-gray-700 rounded-lg bg-gray-50">{{ $poster->uploader_comments }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Admin Actions -->
                <div class="p-6 bg-white shadow-lg rounded-2xl">
                    <h2 class="flex items-center mb-4 text-xl font-bold text-gray-900">
                        <svg class="w-6 h-6 mr-2 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                        </svg>
                        Manage Poster
                    </h2>

                    <div class="flex flex-wrap gap-3">
                        <form action="{{ route('admin.posters.destroy', $poster) }}" method="POST" class="inline"
                              onsubmit="return confirm('Are you sure you want to delete this poster?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center px-5 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete Poster (Admin)
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-pastel-blue { background-color: #dbeafe; }
.hover\:bg-pastel-blue-dark:hover { background-color: #bfdbfe; }

.bg-pastel-green { background-color: #dcfce7; }
.hover\:bg-pastel-green-dark:hover { background-color: #bbf7d0; }

.bg-pastel-yellow { background-color: #fef9c3; }
.hover\:bg-pastel-yellow-dark:hover { background-color: #fef08a; }

.bg-pastel-pink { background-color: #fce7f3; }
.hover\:bg-pastel-pink-dark:hover { background-color: #fbcfe8; }

.bg-pastel-purple { background-color: #e9d5ff; }
.hover\:bg-pastel-purple-dark:hover { background-color: #d8b4fe; }
</style>

<!-- Photo Modal -->
<div id="photoModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-sm p-4" onclick="if(event.target.id === 'photoModal') closePhotoModal()">
    <div class="relative max-w-4xl" onclick="event.stopPropagation()">
        <img id="modalImage" src="" alt="Full size photo" class="max-w-full max-h-[85vh] rounded-lg shadow-2xl object-contain">

        <!-- Close Button -->
        <button onclick="closePhotoModal()" class="absolute top-4 right-4 text-white bg-black/30 hover:bg-black/50 rounded-full p-2">
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
        if (event && event.target.id && event.target.id !== 'photoModal') return;
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
