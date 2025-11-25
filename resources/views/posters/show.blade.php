@extends('layouts.app')

@section('title', '| Poster Details')

@section('content')
<div class="min-h-screen bg-gray-50 pt-24">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <div class="bg-white rounded-full p-3 shadow-sm mr-4">
                    <img src="{{ asset('https://i.ibb.co/8DPN5B7m/logo.png') }}" alt="FindFurEver Logo" class="w-12 h-12 object-contain">
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Poster Details</h1>
                    <p class="text-gray-600 mt-1">
                        @if($poster->type === 'lost')
                            🐕 Lost Pet - {{ $poster->pet_name ?: 'Unknown Pet' }}
                        @else
                            🐕 Found Pet - FND{{ str_pad($poster->id, 4, '0', STR_PAD_LEFT) }}
                        @endif
                    </p>
                </div>
            </div>
            <div class="flex space-x-3">
                @if(Auth::check() && Auth::user()->isAdmin())
                    <a href="{{ route('admin.posters.index') }}"
                       class="px-5 py-2.5 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                        ← Back to Admin Panel
                    </a>
                @else
                    <a href="{{ route('posters.index') }}"
                       class="px-5 py-2.5 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                        ← Back to Posters
                    </a>
                @endif
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Photo & Quick Info -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    @if($poster->photo)
                        <img src="{{ asset('storage/' . $poster->photo) }}"
                             alt="{{ $poster->pet_name }}"
                             class="w-full h-64 object-cover rounded-xl mb-4 shadow-md">
                    @else
                        <div class="w-full h-64 bg-gradient-to-br from-pink-100 to-purple-100 rounded-xl flex items-center justify-center mb-4">
                            <div class="text-center">
                                <span class="text-6xl">🐕</span>
                                <p class="text-gray-500 mt-2">No photo</p>
                            </div>
                        </div>
                    @endif

                    <!-- Status Badge -->
                    @if($poster->status === 'reunited')
                    <div class="flex justify-center mb-4">
                        <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                            🎉 Reunited
                        </span>
                    </div>
                    @endif

                    <!-- Quick Info -->
                    <div class="space-y-3">
                        <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                            <span class="text-2xl mr-3">🏷️</span>
                            <div>
                                <p class="text-sm text-gray-600">Type</p>
                                <p class="font-semibold text-gray-900">{{ ucfirst($poster->type) }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 bg-green-50 rounded-lg">
                            <span class="text-2xl mr-3">🐾</span>
                            <div>
                                <p class="text-sm text-gray-600">Species & Breed</p>
                                <p class="font-semibold text-gray-900">{{ $poster->species }} - {{ $poster->breed }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 bg-purple-50 rounded-lg">
                            <span class="text-2xl mr-3">⚧️</span>
                            <div>
                                <p class="text-sm text-gray-600">Gender</p>
                                <p class="font-semibold text-gray-900">{{ ucfirst($poster->gender) }}</p>
                            </div>
                        </div>

                        <div class="flex items-center p-3 bg-yellow-50 rounded-lg">
                            <span class="text-2xl mr-3">🎂</span>
                            <div>
                                <p class="text-sm text-gray-600">Date {{ $poster->type === 'lost' ? 'Lost' : 'Found' }}</p>
                                <p class="font-semibold text-gray-900">{{ $poster->date_lost_found->format('M d, Y') }}</p>
                            </div>
                        </div>

                        @if($poster->reward)
                        <div class="flex items-center p-3 bg-green-50 rounded-lg">
                            <span class="text-2xl mr-3">💰</span>
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
            <div class="lg:col-span-2 space-y-6">
                <!-- Location & Contact -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <span class="text-2xl mr-2">📍</span>
                        Location & Contact
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">
                                    {{ $poster->type === 'lost' ? 'Last Seen Location' : 'Found Location' }}
                                </label>
                                <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">
                                    {{ $poster->type === 'lost' ? $poster->last_seen : $poster->found_at }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Contact Information</label>
                                <p class="text-lg font-semibold text-blue-700 bg-blue-50 p-3 rounded-lg">
                                    {{ $poster->contact_info }}
                                </p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Colors & Markings</label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(explode(', ', $poster->color_markings) as $color)
                                        <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm font-medium">{{ $color }}</span>
                                    @endforeach
                                </div>
                            </div>

                            @if($poster->user)
                            <div>
                                <label class="block text-sm font-semibold text-gray-600 mb-1">Posted by</label>
                                <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">
                                    {{ $poster->user->first_name }} {{ $poster->user->last_name }}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Description & Comments -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <span class="text-2xl mr-2">📝</span>
                        Additional Information
                    </h2>

                    <div class="space-y-4">
                        @if($poster->description)
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Description</label>
                            <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $poster->description }}</p>
                        </div>
                        @endif

                        @if($poster->uploader_comments)
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Additional Comments</label>
                            <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $poster->uploader_comments }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                @auth
                    @if(Auth::user()->id === $poster->user_id || Auth::user()->isAdmin())
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <span class="text-2xl mr-2">⚡</span>
                            Manage Poster
                        </h2>

                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('posters.edit', $poster) }}"
                               class="px-5 py-2.5 bg-yellow-600 text-white rounded-xl hover:bg-yellow-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                                ✏️ Edit Poster
                            </a>

                            @if($poster->status !== 'reunited')
                                <form action="{{ route('posters.reunite', $poster) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Mark this poster as reunited? This will remove it from the public Lost & Found page.')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="px-5 py-2.5 bg-green-600 text-white rounded-xl hover:bg-green-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                                        🎉 Mark as Reunited
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('posters.destroy', $poster) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Are you sure you want to delete this poster?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-5 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                                    🗑️ Delete Poster
                                </button>
                            </form>

                            @if(Auth::check() && Auth::user()->isAdmin() && Auth::user()->id !== $poster->user_id)
                                <form action="{{ route('posters.destroy', $poster) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this poster?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-5 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                                        🗑️ Delete (Admin)
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
@endsection

