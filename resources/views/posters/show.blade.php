@extends('layouts.app')

@section('title', '| Poster Details')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <div class="flex items-center mb-6">
        <img src="{{ asset('images/findfurever-logo.png') }}" alt="FindFurEver Logo" class="w-12 h-12 mr-4">
        <h1 class="text-3xl font-bold">Poster Details</h1>
    </div>
<div class="px-4 py-6 mx-auto max-w-7xl">
    <div class="max-w-6xl mx-auto overflow-hidden bg-white rounded-lg shadow">
        <div class="md:flex">
            <!-- Photo Section -->
            <div class="md:w-1/2">
                <img src="{{ $poster->photo ? asset('storage/' . $poster->photo) : 'https://via.placeholder.com/600x400?text=' . $poster->pet_name }}" alt="{{ $poster->pet_name }}" class="object-cover w-full h-96 md:h-full">
            </div>

            <!-- Info Section -->
            <div class="p-8 md:w-1/2">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-3xl font-bold">
                        @if($poster->type === 'lost')
                            {{ $poster->pet_name ?: 'Unknown Pet' }}
                        @else
                            FND{{ str_pad($poster->id, 4, '0', STR_PAD_LEFT) }}
                        @endif
                    </h1>
                    @if($poster->status === 'reunited')
                        <span class="px-3 py-1 text-sm text-green-800 bg-green-100 rounded-full">Reunited</span>
                    @endif
                </div>

                <div class="grid grid-cols-1 gap-4 mb-6">
                    <div class="grid grid-cols-2 gap-4">
                        <p><strong>Type:</strong> {{ ucfirst($poster->type) }}</p>
                        <p><strong>Species:</strong> {{ $poster->species }} - {{ $poster->breed }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <p><strong>Gender:</strong> {{ ucfirst($poster->gender) }}</p>
                        <p><strong>Colors:</strong> {{ $poster->color_markings }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <p><strong>Date:</strong> {{ $poster->date_lost_found->format('M d, Y') }}</p>
                        @if($poster->reward)
                            <p><strong>Reward:</strong> ₱{{ $poster->reward }}</p>
                        @endif
                    </div>

                    <p class="mb-4"><strong>{{ $poster->type === 'lost' ? 'Last Seen At' : 'Found At' }}:</strong> {{ $poster->type === 'lost' ? $poster->last_seen : $poster->found_at }}</p>
                </div>

                @if($poster->description)
                    <div class="mb-4">
                        <h3 class="mb-2 font-semibold">Description:</h3>
                        <p class="text-gray-700">{{ $poster->description }}</p>
                    </div>
                @endif

                @if($poster->uploader_comments)
                    <div class="mb-4">
                        <h3 class="mb-2 font-semibold">Additional Comments:</h3>
                        <p class="text-gray-700">{{ $poster->uploader_comments }}</p>
                    </div>
                @endif

                @if($poster->user)
                    <div class="mb-4">
                        <h3 class="mb-2 font-semibold">Posted by:</h3>
                        <p class="text-gray-700">{{ $poster->user->first_name }} {{ $poster->user->last_name }}</p>
                    </div>
                @endif

                <div class="mb-6">
                    <h3 class="mb-2 font-semibold">Contact Information:</h3>
                    <p class="text-lg text-gray-700">{{ $poster->contact_info }}</p>
                </div>

                @auth
                    @if(Auth::user()->id === $poster->user_id || Auth::user()->isAdmin())
                        <div class="flex flex-wrap gap-2 mb-4">
                            <a href="{{ route('posters.edit', $poster) }}" class="px-6 py-3 text-white bg-yellow-600 rounded hover:bg-yellow-700">Edit Poster</a>

                            @if($poster->status !== 'reunited')
                                <form action="{{ route('posters.reunite', $poster) }}" method="POST" class="inline" onsubmit="return confirm('Mark this poster as reunited? This will remove it from the public Lost & Found page.')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-6 py-3 text-white bg-green-600 rounded hover:bg-green-700">Mark as Reunited</button>
                                </form>
                            @endif
                        </div>
                    @endif
                @endauth

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('posters.index') }}" class="px-6 py-3 text-white bg-blue-600 rounded hover:bg-blue-700">Back to Posters</a>

                    @auth
                        @if(Auth::user()->id === $poster->user_id || Auth::user()->isAdmin())
                            <form action="{{ route('posters.destroy', $poster) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this poster?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-6 py-3 text-white bg-red-600 rounded hover:bg-red-700">Delete Poster</button>
                            </form>
                        @endif
                    @endauth

                    @if(Auth::check() && Auth::user()->isAdmin() && Auth::user()->id !== $poster->user_id)
                        <form action="{{ route('posters.destroy', $poster) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Are you sure you want to delete this poster?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-6 py-3 text-white bg-red-600 rounded hover:bg-red-700">Delete Poster (Admin)</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
