@extends('layouts.admin')

@section('title', '| Admin - Announcement Details')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <h1 class="mb-6 text-3xl font-bold">Announcement Details: {{ $announcement->title }}</h1>
    <div class="max-w-4xl overflow-hidden bg-white rounded-lg shadow">
        <div class="p-8">
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                <p><strong>Date/When:</strong> {{ $announcement->date_when ?: 'N/A' }}</p>
                <p><strong>Location:</strong> {{ $announcement->location ?: 'N/A' }}</p>
                <p><strong>Category:</strong> {{ $announcement->category ?: 'N/A' }}</p>
            </div>
            <p class="mb-6 text-gray-700"><strong>Description:</strong> {{ $announcement->description }}</p>

            <!-- Photos Section -->
            @if($announcement->photos->count() > 0)
                <div class="mb-6">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($announcement->photos as $index => $photo)
                            <div class="rounded-lg overflow-hidden shadow-lg cursor-pointer hover:shadow-xl transition-shadow" onclick="openPhotoModal('{{ asset('storage/' . $photo->photo_path) }}')">
                                <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="announcement photo" class="w-full h-auto object-cover hover:opacity-90 transition-opacity">
                            </div>
                        @endforeach
                    </div>
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

            <div class="flex space-x-4">
                <a href="{{ route('admin.announcements.edit', $announcement) }}" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Edit</a>
                <a href="javascript:void(0)" onclick="history.back()" class="bg-gray-500 text-white hover:bg-gray-700 px-4 py-2 rounded">Back</a>
            </div>
        </div>
    </div>

    <!-- No registrations section na ta pang announce nlng to -->
</div>
@endsection
