<div>
    <!-- Search and Filter Form -->
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-8 gap-4">
            <!-- Search -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Search Pet Name</label>
                <input type="text" wire:model.live="search" placeholder="Pet name..."
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Type -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                <select wire:model.live="type" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">All Types</option>
                    <option value="lost">Lost</option>
                    <option value="found">Found</option>
                </select>
            </div>

            <!-- Species -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Species</label>
                <select wire:model.live="species" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">Species</option>
                    <option value="Canine">Canine</option>
                    <option value="Feline">Feline</option>
                </select>
            </div>

            <!-- Breed -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Breed</label>
                <select wire:model.live="breed" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">Breed</option>
                    @if($species && isset($breeds[$species]))
                        @foreach($breeds[$species] as $breedOption)
                            <option value="{{ $breedOption }}">{{ $breedOption }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <!-- Gender -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                <select wire:model.live="gender" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="unknown">Unknown</option>
                </select>
            </div>

            <!-- Color -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                <select wire:model.live="color" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">Color</option>
                    @foreach($colors as $colorOption)
                        <option value="{{ $colorOption }}">{{ $colorOption }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Date From -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date From</label>
                <input type="date" wire:model.live="date_from"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Date To -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date To</label>
                <input type="date" wire:model.live="date_to"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
        </div>

        <!-- Clear Filters Button -->
        <div class="mt-4">
            <button wire:click="clearFilters"
                    class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition duration-200">
                Clear All Filters
            </button>
        </div>
    </div>

    <!-- Results -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($posters as $poster)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                @if($poster->photo)
                    <img src="{{ asset('storage/' . $poster->photo) }}" alt="{{ $poster->pet_name }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">No Photo</span>
                    </div>
                @endif

                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $poster->pet_name }}</h3>
                    <p class="text-sm text-gray-600 mb-2">{{ ucfirst($poster->type) }} - {{ $poster->species }}</p>
                    <p class="text-sm text-gray-500 mb-3">{{ $poster->date_lost_found->format('M d, Y') }}</p>

                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500">{{ $poster->gender }}</span>
                        @if($poster->reward)
                            <span class="text-green-600 font-semibold">${{ $poster->reward }} Reward</span>
                        @endif
                    </div>

                    <a href="{{ route('posters.show', $poster) }}" class="block mt-4 bg-purple-600 text-white py-2 rounded text-center hover:bg-purple-700 transition duration-200">
                        View Details
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">No posters found matching your criteria.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($posters->hasPages())
        <div class="mt-8">
            {{ $posters->links() }}
        </div>
    @endif
</div>
