@extends('layouts.app')

@section('title', '| Poster Details')

@section('content')
<div class="min-h-screen pt-12 bg-gray-50">
    <div class="max-w-6xl px-4 py-8 mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <div class="p-0 mr-4 bg-white rounded-full shadow-sm overflow-hidden w-12 h-12">
                    <img src="{{ asset('image/logo.png') }}" alt="FindFurEver Logo" class="w-full h-full object-cover">
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Poster Details</h1>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="javascript:void(0)" onclick="history.back()"
                   class="bg-gray-600 text-white hover:bg-gray-800 px-4 py-2 rounded">
                    Back
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Photo & Quick Info -->
            <div class="lg:col-span-1">
                <div class="p-6 bg-white shadow-lg rounded-2xl">
                    @php $posterPhotoSources = $poster->photo_sources ?: ($poster->photo ? [$poster->photo] : []); @endphp
                    @if(count($posterPhotoSources) > 1)
                        <div class="relative">
                            <img id="posterCarouselImage"
                                 src="{{ asset('storage/' . $posterPhotoSources[0]) }}"
                                 alt="{{ $poster->pet_name }}"
                                 class="object-cover w-full h-64 mb-4 shadow-md rounded-xl cursor-pointer hover:opacity-90 transition-opacity"
                                 onclick="openPosterModalImage(0)"
                                 style="cursor: pointer;">

                            <button type="button" onclick="changePosterSlide(-1)"
                                    class="absolute left-3 top-1/2 -translate-y-1/2 inline-flex items-center justify-center w-10 h-10 text-white bg-black/40 rounded-full hover:bg-black/60">
                                <span class="text-lg font-bold">‹</span>
                            </button>

                            <button type="button" onclick="changePosterSlide(1)"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 inline-flex items-center justify-center w-10 h-10 text-white bg-black/40 rounded-full hover:bg-black/60">
                                <span class="text-lg font-bold">›</span>
                            </button>

                            <div class="absolute left-1/2 bottom-3 -translate-x-1/2 px-3 py-1 text-xs font-semibold text-white bg-black/60 rounded-full">
                                <span id="posterCarouselCounter">1 / {{ count($posterPhotoSources) }}</span>
                            </div>
                        </div>
                    @elseif(count($posterPhotoSources) === 1)
                        <img src="{{ asset('storage/' . $posterPhotoSources[0]) }}"
                             alt="{{ $poster->pet_name }}"
                             class="object-cover w-full h-64 mb-4 shadow-md rounded-xl cursor-pointer hover:opacity-90 transition-opacity"
                             onclick="openPosterModalImage(0)"
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

                    @if($poster->video)
                        @php
                            $ext = strtolower(pathinfo($poster->video, PATHINFO_EXTENSION));
                            $mime = $ext === 'mkv' ? 'video/x-matroska' : "video/{$ext}";
                            $videoUrl = asset('storage/' . $poster->video);
                        @endphp
                        <div class="mb-6">
                            <label class="block mb-3 text-sm font-semibold text-gray-700">Video</label>
                            <video id="posterDetailVideo" controls preload="metadata" playsinline class="w-full h-64 rounded-xl border shadow-sm bg-black">
                                <source src="{{ $videoUrl }}" type="{{ $mime }}">
                                Your browser does not support video playback.
                            </video>
                            <div class="mt-3">
                                <p class="text-sm text-gray-500">Use the player controls to preview the video.</p>
                                @if($ext === 'mkv')
                                    <!-- MKV compatibility note removed as requested -->
                                @endif
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
                                <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-600">Type</p>
                                <p class="font-semibold text-gray-900">{{ ucfirst($poster->type) }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 rounded-lg bg-green-50">
                            <svg class="w-6 h-6 mr-3 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="#111827" d="M234.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5 .3-86.2 32.6-96.8 70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3-14.3-70.1 10.2-84.1 59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5l0 1.6c0 25.8-20.9 46.7-46.7 46.7-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2-25.8 0-46.7-20.9-46.7-46.7l0-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3 29.1 51.7 10.2 84.1-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5 46.9 53.9 32.6 96.8-52.1 69.1-84.4 58.5z"/>
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

                            <!-- Social Media Links -->
                            @if($poster->social_media_links && count(array_filter($poster->social_media_links)) > 0)
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-600">Social Media</label>
                                <div class="flex flex-wrap gap-2">
                                    @php
                                        $platformColors = [
                                            'facebook' => '#1877F2',
                                            'instagram' => '#E1306C',
                                            'x' => '#000000',
                                            'tiktok' => '#000000',
                                            'whatsapp' => '#25D366',
                                        ];
                                    @endphp
                                    @foreach($poster->social_media_links as $platform => $link)
                                        @if($link)
                                        <a href="{{ $link }}" target="_blank" rel="noopener noreferrer"
                                           class="inline-flex items-center px-4 py-2 font-medium text-white rounded-lg hover:opacity-90 transition-all duration-200 shadow-sm hover:shadow-md"
                                           style="background-color: {{ $platformColors[$platform] ?? '#6B7280' }}"
                                           title="Contact on {{ ucfirst($platform) }}">
                                            @if($platform === 'facebook')
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                            @elseif($platform === 'instagram')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2">
                                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                                </svg>
                                            @elseif($platform === 'x')
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24h-6.514l-5.106-6.671-5.848 6.671h-3.308l7.735-8.835L.424 2.25h6.679l4.632 6.135L17.659 2.25h.585zm-1.125 17.5h1.832L6.169 3.881h-1.969l12.07 15.87z"/></svg>
                                            @elseif($platform === 'tiktok')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok w-4 h-4 mr-2" viewBox="0 0 16 16">
                                                    <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
                                                </svg>
                                            @elseif($platform === 'whatsapp')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp w-4 h-4 mr-2" viewBox="0 0 16 16">
                                                    <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/></svg>
                                            @endif
                                            {{ ucfirst($platform) }}
                                        </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @endif
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

                <!-- Action Buttons -->
                @auth
                    @if(Auth::user()->id === $poster->user_id || Auth::user()->isAdmin())
                    <div class="p-6 bg-white shadow-lg rounded-2xl">
                        <h2 class="flex items-center mb-4 text-xl font-bold text-gray-900">
                            <svg class="w-6 h-6 mr-2 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                            </svg>
                            Manage Poster
                        </h2>

                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('posters.edit', $poster) }}"
                               class="inline-flex items-center px-5 py-2.5 bg-yellow-600 text-white rounded-xl hover:bg-yellow-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit Poster
                            </a>

                            @if($poster->status !== 'reunited')
                                <form action="{{ route('posters.reunite', $poster) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Mark this poster as reunited? This will remove it from the public Lost & Found page.')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="inline-flex items-center px-5 py-2.5 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                        </svg>
                                        Mark as Reunited
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('posters.destroy', $poster) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Are you sure you want to delete this poster?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-5 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete Poster
                                </button>
                            </form>

                            @if(Auth::check() && Auth::user()->isAdmin() && Auth::user()->id !== $poster->user_id)
                                <form action="{{ route('posters.destroy', $poster) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this poster?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-5 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete (Admin)
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                    @endif
                @endauth
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

        <button onclick="changeModalPhoto(-1)" class="absolute left-4 top-1/2 -translate-y-1/2 text-white bg-black/30 hover:bg-black/50 rounded-full p-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <button onclick="changeModalPhoto(1)" class="absolute right-4 top-1/2 -translate-y-1/2 text-white bg-black/30 hover:bg-black/50 rounded-full p-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <div id="modalPhotoCounter" class="absolute bottom-4 left-1/2 -translate-x-1/2 px-3 py-1 text-xs font-semibold text-white bg-black/50 rounded-full"></div>
    </div>
</div>

<script>
    const posterPhotoSources = @json($posterPhotoSources ?? []);
    let currentPosterPhotoIndex = 0;

    function updatePosterCarousel() {
        if (!posterPhotoSources.length) {
            return;
        }

        const carouselImage = document.getElementById('posterCarouselImage');
        const counter = document.getElementById('posterCarouselCounter');

        if (carouselImage) {
            carouselImage.src = '{{ asset("storage") }}/' + posterPhotoSources[currentPosterPhotoIndex];
        }
        if (counter) {
            counter.textContent = `${currentPosterPhotoIndex + 1} / ${posterPhotoSources.length}`;
        }
    }

    function changePosterSlide(direction) {
        if (!posterPhotoSources.length) {
            return;
        }

        currentPosterPhotoIndex = (currentPosterPhotoIndex + direction + posterPhotoSources.length) % posterPhotoSources.length;
        updatePosterCarousel();
    }

    function openPosterModalImage(index) {
        if (!posterPhotoSources[index]) {
            return;
        }
        currentPosterPhotoIndex = index;
        openPhotoModal('{{ asset("storage") }}/' + posterPhotoSources[index]);
    }

    function openPhotoModal(src) {
        document.getElementById('modalImage').src = src;
        updateModalCounter();
        document.getElementById('photoModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function changeModalPhoto(direction) {
        if (!posterPhotoSources.length) {
            return;
        }

        currentPosterPhotoIndex = (currentPosterPhotoIndex + direction + posterPhotoSources.length) % posterPhotoSources.length;
        const src = '{{ asset('storage') }}/' + posterPhotoSources[currentPosterPhotoIndex];
        document.getElementById('modalImage').src = src;
        updateModalCounter();
    }

    function updateModalCounter() {
        const counter = document.getElementById('modalPhotoCounter');
        if (!counter || !posterPhotoSources.length) {
            return;
        }
        counter.textContent = `${currentPosterPhotoIndex + 1} / ${posterPhotoSources.length}`;
    }

    function closePhotoModal(event) {
        if (event && event.target.id && event.target.id !== 'photoModal') return;
        document.getElementById('photoModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    const posterDetailVideo = document.getElementById('posterDetailVideo');

    document.addEventListener('keydown', function(event) {
        const modal = document.getElementById('photoModal');
        if (modal.classList.contains('hidden')) return;

        if (event.key === 'Escape' || event.key === 'Backspace') {
            closePhotoModal();
            event.preventDefault();
        }

        if (event.key === 'ArrowLeft') {
            changeModalPhoto(-1);
            event.preventDefault();
        }

        if (event.key === 'ArrowRight') {
            changeModalPhoto(1);
            event.preventDefault();
        }
    });
</script>

@endsection
