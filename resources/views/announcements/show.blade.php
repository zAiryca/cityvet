@extends('layouts.app')

@section('title', '| ' . $announcement->title)

@section('content')
<div class="px-2 py-6 pt-16 pb-12 mx-auto max-w-6xl">
    <!-- Main Content -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header Section -->
        <div class="relative bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-4 md:px-8 md:py-6">
            <div class="flex flex-wrap items-center justify-start gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 flex-wrap mb-0">
                        @if($announcement->category)
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium text-white
                                @if($announcement->category == 'Event') bg-teal-500
                                @elseif($announcement->category == 'Trivia') bg-purple-500
                                @elseif($announcement->category == 'Fun Fact') bg-amber-500
                                @elseif($announcement->category == 'Holiday Notice') bg-rose-500
                                @else bg-gray-500
                                @endif">
                                {{ $announcement->category }}
                            </span>
                        @endif
                        <h1 class="text-3xl md:text-4xl font-bold text-white">{{ $announcement->title }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Meta Information -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 px-6 md:px-8 py-6 border-b border-gray-200 bg-gray-50">
            @if($announcement->date_when)
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Date & Time</p>
                    <div class="flex items-center text-gray-900">
                        <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="font-medium">{{ $announcement->date_when }}</span>
                    </div>
                </div>
            @endif

            @if($announcement->location)
                <div>
                    <p class="text-sm text-gray-500 font-medium mb-1">Location</p>
                    <div class="flex items-center text-gray-900">
                        <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="font-medium">{{ $announcement->location }}</span>
                    </div>
                </div>
            @endif

            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Posted On</p>
                <div class="flex items-center text-gray-900">
                    <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">{{ $announcement->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="px-6 md:px-8 py-8">
            <div class="prose prose-lg max-w-none text-gray-700">
                <p class="text-lg leading-relaxed mb-4 whitespace-pre-wrap">{{ $announcement->description }}</p>
            </div>

            <!-- Photos Section -->
            @if($announcement->photos->count() > 0)
                <div class="mt-8">
                    @if($announcement->photos->count() === 1)
                        <!-- Single photo - full width -->
                        <div class="rounded-lg overflow-hidden shadow-lg cursor-pointer hover:shadow-xl transition-shadow" onclick="openPhotoModal('{{ asset('storage/' . $announcement->photos->first()->photo_path) }}')">
                            <img src="{{ asset('storage/' . $announcement->photos->first()->photo_path) }}" alt="{{ $announcement->title }}" class="w-full h-auto object-cover hover:opacity-90 transition-opacity">
                        </div>
                    @else
                        <!-- Multiple photos - grid layout -->
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($announcement->photos as $photo)
                                <div class="rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 cursor-pointer" onclick="openPhotoModal('{{ asset('storage/' . $photo->photo_path) }}')">
                                    <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="{{ $announcement->title }}" class="w-full h-64 object-cover hover:opacity-90 transition-opacity">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            <!-- Photo Modal -->
            <div id="photoModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75 p-4" onclick="closePhotoModal(event)">
                <div class="relative w-full max-w-5xl" onclick="event.stopPropagation()">
                    <img id="modalImage" src="" alt="Full size photo" class="w-full h-auto rounded-lg max-h-screen object-contain">

                    <!-- Left Arrow Button -->
                    <button onclick="prevPhoto()" class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-12 text-white bg-black bg-opacity-50 rounded-full p-3 hover:bg-opacity-75 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <!-- Right Arrow Button -->
                    <button onclick="nextPhoto()" class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-12 text-white bg-black bg-opacity-50 rounded-full p-3 hover:bg-opacity-75 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Close Button -->
                    <button onclick="closePhotoModal()" class="absolute top-2 right-2 text-white bg-black bg-opacity-50 rounded-full p-2 hover:bg-opacity-75">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Photo Counter -->
                    <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 text-white bg-black bg-opacity-50 rounded-full px-4 py-2">
                        <span id="photoCounter">1 / 1</span>
                    </div>
                </div>
            </div>

            <script>
                let photoArray = [];
                let currentPhotoIndex = 0;

                function initializePhotos(photos) {
                    photoArray = photos;
                }

                function openPhotoModal(src) {
                    currentPhotoIndex = photoArray.indexOf(src);
                    document.getElementById('modalImage').src = src;
                    document.getElementById('photoModal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                    updatePhotoCounter();
                }

                function closePhotoModal(event) {
                    if (event && event.target.id !== 'photoModal') return;
                    document.getElementById('photoModal').classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }

                function nextPhoto() {
                    if (photoArray.length > 0) {
                        currentPhotoIndex = (currentPhotoIndex + 1) % photoArray.length;
                        document.getElementById('modalImage').src = photoArray[currentPhotoIndex];
                        updatePhotoCounter();
                    }
                }

                function prevPhoto() {
                    if (photoArray.length > 0) {
                        currentPhotoIndex = (currentPhotoIndex - 1 + photoArray.length) % photoArray.length;
                        document.getElementById('modalImage').src = photoArray[currentPhotoIndex];
                        updatePhotoCounter();
                    }
                }

                function updatePhotoCounter() {
                    document.getElementById('photoCounter').textContent = (currentPhotoIndex + 1) + ' / ' + photoArray.length;
                }

                document.addEventListener('keydown', function(event) {
                    const modal = document.getElementById('photoModal');
                    if (modal.classList.contains('hidden')) return;

                    if (event.key === 'Escape' || event.key === 'Backspace') {
                        closePhotoModal();
                        event.preventDefault();
                    } else if (event.key === 'ArrowRight') {
                        nextPhoto();
                        event.preventDefault();
                    } else if (event.key === 'ArrowLeft') {
                        prevPhoto();
                        event.preventDefault();
                    }
                });

                @if($announcement->photos->count() > 0)
                    initializePhotos([
                        @foreach($announcement->photos as $photo)
                            '{{ asset('storage/' . $photo->photo_path) }}',
                        @endforeach
                    ]);
                @endif
            </script>
        </div>

        <!-- Share & Footer -->
        <div class="px-6 md:px-8 py-6 border-t border-gray-200 bg-gray-50 flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Last updated: {{ $announcement->updated_at->format('M d, Y \a\t h:i A') }}</p>
            </div>
            <a href="{{ route('announcements.index') }}"
               onclick="event.preventDefault(); if (window.history.length > 1) { window.history.back(); } else { window.location='{{ route('announcements.index') }}'; }"
               class="px-6 py-2 text-white rounded-lg transition duration-300 hover:opacity-90"
               style="background-color: #f39c12;">
                ← Back
            </a>
        </div>
    </div>

    <!-- Related Announcements (Optional) -->
    @php
        $related = \App\Models\Announcement::where('id', '!=', $announcement->id)
            ->where('category', $announcement->category)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
    @endphp

    @if($related->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6">Related Announcements</h2>
            <div class="grid gap-6 md:grid-cols-3">
                @foreach($related as $item)
                    <a href="{{ route('announcements.show', $item) }}"
                       class="block bg-white rounded-lg shadow hover:shadow-lg transition duration-300">
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 mb-2 line-clamp-2">{{ $item->title }}</h3>
                            <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ Str::limit($item->description, 100) }}</p>
                            <span class="text-orange-600 font-semibold text-sm">Read More →</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
