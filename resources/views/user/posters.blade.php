@extends('layouts.app')

@section('title', '| My Posters')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Lost & Found Posters</h1>
    <p class="mb-6">Manage your lost and found pet posters.</p>

    <div class="mb-6">
        <a href="{{ route('posters.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Create New Poster</a>
    </div>

    <!-- Active Posters Section -->
    @php
        $activePosters = $posters->where('status', 'active');
        $reunitedPosters = $posters->where('status', 'reunited');
    @endphp

    @if($activePosters->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Active Posters</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($activePosters as $poster)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if($poster->photo)
                            <img src="{{ asset('storage/' . $poster->photo) }}" alt="{{ $poster->pet_name ?: 'Pet' }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">No Photo</span>
                            </div>
                        @endif

                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full text-white text-xs font-bold {{ $poster->type === 'lost' ? 'bg-red-500' : 'bg-green-500' }}">
                                    ●
                                </span>
                                <span class="ml-2 text-sm font-semibold {{ $poster->type === 'lost' ? 'text-red-600' : 'text-green-600' }}">{{ ucfirst($poster->type) }}</span>
                            </div>
                            @if($poster->type === 'lost')
                                @if($poster->pet_name)
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $poster->pet_name }}</h3>
                                @else
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Unknown Pet</h3>
                                @endif
                            @else
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">FND{{ str_pad($poster->id, 4, '0', STR_PAD_LEFT) }}</h3>
                            @endif
                            <p class="text-sm text-gray-600 mb-1">{{ $poster->species }}
                            <p class="text-sm text-gray-600 mb-1">{{ $poster->breed }}</p>
                            <p class="text-sm text-gray-600 mb-1">{{ ucfirst($poster->gender) }}</p>
                            <p class="text-sm text-gray-500 mb-1">{{ $poster->date_lost_found->format('M d, Y') }}</p>
                            @if($poster->reward)
                                <p class="text-sm font-semibold text-green-600 mb-3">₱{{ $poster->reward }} Reward</p>
                            @else
                                <div class="mb-3"></div>
                            @endif

                            <div class="flex space-x-2 mb-2">
                                <a href="{{ route('posters.show', $poster) }}" class="flex-1 bg-purple-600 text-white py-2 rounded text-center hover:bg-purple-700 transition duration-200 text-sm">
                                    View
                                </a>
                                <a href="{{ route('posters.edit', $poster) }}" class="flex-1 bg-blue-600 text-white py-2 rounded text-center hover:bg-blue-700 transition duration-200 text-sm">
                                    Edit
                                </a>
                            </div>



                            <div class="flex space-x-2">
                                <form method="POST" action="{{ route('posters.reunite', $poster) }}" class="flex-1" onsubmit="return confirm('Mark this poster as reunited? This will remove it from the public Lost & Found page.')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition duration-200 text-sm">
                                        Reunited
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('posters.destroy', $poster) }}" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this poster? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700 transition duration-200 text-sm">
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
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Reunited Pets</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($reunitedPosters as $poster)
                    <div class="bg-green-50 border border-green-200 rounded-lg shadow-md overflow-hidden">
                        @if($poster->photo)
                            <img src="{{ asset('storage/' . $poster->photo) }}" alt="{{ $poster->pet_name ?: 'Pet' }}" class="w-full h-48 object-cover opacity-75">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">No Photo</span>
                            </div>
                        @endif

                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                @if($poster->type === 'lost')
                                    @if($poster->pet_name)
                                        <h3 class="text-lg font-semibold text-gray-900 mr-2">{{ $poster->pet_name }}</h3>
                                    @else
                                        <h3 class="text-lg font-semibold text-gray-900 mr-2">Unknown Pet</h3>
                                    @endif
                                @else
                                    <h3 class="text-lg font-semibold text-gray-900 mr-2">FND{{ str_pad($poster->id, 4, '0', STR_PAD_LEFT) }}</h3>
                                @endif
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Reunited</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-1">{{ ucfirst($poster->type) }} - {{ $poster->species }}</p>
                            <p class="text-sm text-gray-600 mb-1">{{ $poster->breed }}</p>
                            <p class="text-sm text-gray-600 mb-1">{{ ucfirst($poster->gender) }}</p>
                            <p class="text-sm text-gray-500 mb-1">{{ $poster->date_lost_found->format('M d, Y') }}</p>
                            @if($poster->reward)
                                <p class="text-sm font-semibold text-green-600 mb-3">₱{{ $poster->reward }} Reward</p>
                            @else
                                <div class="mb-3"></div>
                            @endif

                            <div class="flex space-x-2">
                                <a href="{{ route('posters.show', $poster) }}" class="flex-1 bg-purple-600 text-white py-2 rounded text-center hover:bg-purple-700 transition duration-200 text-sm">
                                    View
                                </a>
                                <form method="POST" action="{{ route('posters.destroy', $poster) }}" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this poster?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700 transition duration-200 text-sm">
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

    @if($activePosters->count() == 0 && $reunitedPosters->count() == 0)
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <p class="text-gray-500 mb-4">You haven't created any posters yet.</p>
            <a href="{{ route('posters.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Create Your First Poster</a>
        </div>
    @endif

    @if($posters->hasPages())
        <div class="mt-8">
            {{ $posters->links() }}
        </div>
    @endif
</div>
@endsection
