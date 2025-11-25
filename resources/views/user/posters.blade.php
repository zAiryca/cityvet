@extends('layouts.app')

@section('title', '| My Posters')

@section('content')



<div class="min-h-screen bg-gradient-to-br from-blue-50 to-green-50 pt-24">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <div class="bg-white rounded-full p-3 shadow-sm mr-4 border-2 border-pink-100">
                    <img src="{{ asset('https://i.ibb.co/8DPN5B7m/logo.png') }}" alt="FindFurEver Logo" class="w-12 h-12 object-contain">
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">My Posters</h1>
                    <p class="text-gray-600 mt-1">Manage your lost and found pet posters</p>
                </div>
            </div>
            <a href="{{ route('posters.create') }}"
               class="px-6 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition-all duration-200 font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center">
                <i class="fas fa-plus mr-2"></i>Create New Poster
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
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-paw mr-2 text-purple-400"></i>Active Posters
                    <span class="text-purple-500 ml-2">({{ $activePosters->count() }})</span>
                </h2>
                <span class="text-sm text-gray-500">Currently searching for owners</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($activePosters as $poster)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-pink-100">
                    <!-- Image Section -->
                    <div class="relative bg-gradient-to-br from-blue-50 to-green-50 p-4">
                        @if($poster->photo)
                            <div class="rounded-xl overflow-hidden border-2 border-white shadow-md">
                                <img src="{{ asset('storage/' . $poster->photo) }}" alt="{{ $poster->pet_name ?: 'Pet' }}" class="w-full h-48 object-cover">
                            </div>
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-pink-50 to-purple-50 rounded-xl border-2 border-white flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-paw text-4xl text-purple-300 mb-2"></i>
                                    <p class="text-purple-400 text-sm">No Photo</p>
                                </div>
                            </div>
                        @endif

                        <!-- Type Badge -->
                        <div class="absolute top-6 left-6">
                            @if($poster->type === 'lost')
                                <span class="px-3 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full shadow-sm border border-red-200 flex items-center">
                                    <i class="fas fa-search mr-1"></i>Lost Pet
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full shadow-sm border border-green-200 flex items-center">
                                    <i class="fas fa-home mr-1"></i>Found Pet
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-5 bg-gradient-to-br from-pink-50 to-purple-50">
                        <!-- Pet Info -->
                        <div class="mb-4">
                            @if($poster->type === 'lost')
                                @if($poster->pet_name)
                                    <h3 class="text-lg font-bold text-gray-800 mb-1 flex items-center">
                                        <i class="fas fa-heart mr-2 text-pink-400"></i>{{ $poster->pet_name }}
                                    </h3>
                                @else
                                    <h3 class="text-lg font-bold text-gray-800 mb-1 flex items-center">
                                        <i class="fas fa-question-circle mr-2 text-blue-400"></i>Unknown Pet
                                    </h3>
                                @endif
                            @else
                                <h3 class="text-lg font-bold text-gray-800 mb-1 flex items-center">
                                    <i class="fas fa-star mr-2 text-yellow-400"></i>FND{{ str_pad($poster->id, 4, '0', STR_PAD_LEFT) }}
                                </h3>
                            @endif

                            <div class="flex items-center text-sm text-gray-600 mb-2">
                                <span class="font-medium bg-white px-2 py-1 rounded-lg border border-blue-100">{{ $poster->species }}</span>
                                <span class="mx-2 text-gray-400">•</span>
                                <span class="bg-white px-2 py-1 rounded-lg border border-green-100">{{ $poster->breed }}</span>
                            </div>

                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center bg-white px-2 py-1 rounded-lg border border-pink-100">
                                    <i class="fas fa-venus-mars mr-1 text-pink-300"></i>
                                    {{ ucfirst($poster->gender) }}
                                </span>
                                <span class="flex items-center bg-white px-2 py-1 rounded-lg border border-yellow-100">
                                    <i class="fas fa-calendar-day mr-1 text-yellow-300"></i>
                                    {{ $poster->date_lost_found->format('M d, Y') }}
                                </span>
                            </div>
                        </div>

                        <!-- Reward -->
                        @if($poster->reward)
                        <div class="mb-4 p-3 bg-gradient-to-r from-green-100 to-green-50 rounded-xl border border-green-200">
                            <div class="flex items-center justify-center">
                                <i class="fas fa-gift text-green-400 mr-2"></i>
                                <span class="font-semibold text-green-700">₱{{ number_format($poster->reward, 2) }} Reward</span>
                            </div>
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="space-y-3">
                            <div class="grid grid-cols-2 gap-2">
                                <a href="{{ route('posters.show', $poster) }}"
                                   class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 text-sm font-medium text-center shadow-sm flex items-center justify-center">
                                    <i class="fas fa-eye mr-2"></i>View
                                </a>
                                <a href="{{ route('posters.edit', $poster) }}"
                                   class="px-3 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-all duration-200 text-sm font-medium text-center shadow-sm flex items-center justify-center">
                                    <i class="fas fa-edit mr-2"></i>Edit
                                </a>
                            </div>

                            <div class="grid grid-cols-2 gap-2">
                                <form method="POST" action="{{ route('posters.reunite', $poster) }}"
                                      onsubmit="return confirm('Mark this poster as reunited? This will remove it from the public Lost & Found page.')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="w-full px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 text-sm font-medium shadow-sm flex items-center justify-center">
                                        <i class="fas fa-heart mr-2"></i>Reunited
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('posters.destroy', $poster) }}"
                                      onsubmit="return confirm('Are you sure you want to delete this poster? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-full px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-200 text-sm font-medium shadow-sm flex items-center justify-center">
                                        <i class="fas fa-trash mr-2"></i>Delete
                                    </button>
                                </form>
                            </div>
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
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-heart mr-2 text-green-400"></i>Reunited Pets
                    <span class="text-green-500 ml-2">({{ $reunitedPosters->count() }})</span>
                </h2>
                <span class="text-sm text-gray-500">Successfully reunited with families</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($reunitedPosters as $poster)
                <div class="bg-gradient-to-br from-green-50 to-blue-50 border border-green-200 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <!-- Image Section -->
                    <div class="relative bg-gradient-to-br from-green-100 to-blue-100 p-4">
                        @if($poster->photo)
                            <div class="rounded-xl overflow-hidden border-2 border-white shadow-md">
                                <img src="{{ asset('storage/' . $poster->photo) }}" alt="{{ $poster->pet_name ?: 'Pet' }}" class="w-full h-48 object-cover opacity-90">
                            </div>
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-green-200 to-blue-200 rounded-xl border-2 border-white flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-heart text-4xl text-green-300 mb-2"></i>
                                    <p class="text-green-500 text-sm font-medium">Reunited</p>
                                </div>
                            </div>
                        @endif

                        <!-- Reunited Badge -->
                        <div class="absolute top-6 left-6">
                            <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full shadow-sm border border-green-200 flex items-center">
                                <i class="fas fa-heart mr-1"></i>Reunited
                            </span>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-5 bg-gradient-to-br from-green-50 to-blue-50">
                        <!-- Pet Info -->
                        <div class="mb-4">
                            @if($poster->type === 'lost')
                                @if($poster->pet_name)
                                    <h3 class="text-lg font-bold text-gray-800 mb-1 flex items-center">
                                        <i class="fas fa-heart mr-2 text-pink-400"></i>{{ $poster->pet_name }}
                                    </h3>
                                @else
                                    <h3 class="text-lg font-bold text-gray-800 mb-1 flex items-center">
                                        <i class="fas fa-question-circle mr-2 text-blue-400"></i>Unknown Pet
                                    </h3>
                                @endif
                            @else
                                <h3 class="text-lg font-bold text-gray-800 mb-1 flex items-center">
                                    <i class="fas fa-star mr-2 text-yellow-400"></i>FND{{ str_pad($poster->id, 4, '0', STR_PAD_LEFT) }}
                                </h3>
                            @endif

                            <div class="flex items-center text-sm text-gray-600 mb-2">
                                <span class="font-medium bg-white px-2 py-1 rounded-lg border border-blue-100">{{ $poster->species }}</span>
                                <span class="mx-2 text-gray-400">•</span>
                                <span class="bg-white px-2 py-1 rounded-lg border border-green-100">{{ $poster->breed }}</span>
                            </div>

                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center bg-white px-2 py-1 rounded-lg border border-pink-100">
                                    <i class="fas fa-venus-mars mr-1 text-pink-300"></i>
                                    {{ ucfirst($poster->gender) }}
                                </span>
                                <span class="flex items-center bg-white px-2 py-1 rounded-lg border border-yellow-100">
                                    <i class="fas fa-calendar-day mr-1 text-yellow-300"></i>
                                    {{ $poster->date_lost_found->format('M d, Y') }}
                                </span>
                            </div>
                        </div>

                        <!-- Success Message -->
                        <div class="mb-4 p-3 bg-gradient-to-r from-green-100 to-green-50 rounded-xl border border-green-200">
                            <p class="text-sm text-green-800 text-center font-medium flex items-center justify-center">
                                <i class="fas fa-heart mr-2"></i>Successfully reunited!
                            </p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('posters.show', $poster) }}"
                               class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 text-sm font-medium text-center shadow-sm flex items-center justify-center">
                                <i class="fas fa-eye mr-2"></i>View
                            </a>
                            <form method="POST" action="{{ route('posters.destroy', $poster) }}"
                                  onsubmit="return confirm('Are you sure you want to delete this poster?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-200 text-sm font-medium shadow-sm flex items-center justify-center">
                                    <i class="fas fa-trash mr-2"></i>Delete
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
        <div class="bg-gradient-to-br from-white to-pink-50 rounded-2xl shadow-lg p-12 text-center border border-pink-100">
            <div class="max-w-md mx-auto">
                <i class="fas fa-paw text-6xl text-purple-300 mx-auto mb-6"></i>
                <h3 class="text-xl font-bold text-gray-800 mb-2">No posters yet</h3>
                <p class="text-gray-600 mb-6">Create your first lost or found pet poster to help reunite pets with their families.</p>
                <a href="{{ route('posters.create') }}"
                   class="inline-flex items-center px-6 py-3 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition-all duration-200 font-medium shadow-md hover:shadow-lg">
                    <i class="fas fa-plus mr-2"></i>Create Your First Poster
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

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

