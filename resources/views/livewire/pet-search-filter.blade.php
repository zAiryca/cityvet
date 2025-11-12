<div>
    <!-- Search and Filter Form -->
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
            <!-- Search -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.Search') }}</label>
                <input type="text" wire:model.live="search" placeholder="{{ __('messages.Name') }} {{ __('messages.or') }} {{ __('messages.Description') }}..."
                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Species -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.Species') }}</label>
                <select wire:model.live="species" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">{{ __('messages.Species') }}</option>
                    <option value="Canine">{{ __('messages.Canine') }}</option>
                    <option value="Feline">{{ __('messages.Feline') }}</option>
                </select>
            </div>

            <!-- Breed -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.Breed') }}</label>
                <select wire:model.live="breed" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">{{ __('messages.Breed') }}</option>
                    @if($species && isset($breeds[$species]))
                        @foreach($breeds[$species] as $breedOption)
                            <option value="{{ $breedOption }}">{{ $breedOption }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <!-- Gender -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.Gender') }}</label>
                <select wire:model.live="gender" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">{{ __('messages.Gender') }}</option>
                    <option value="male">{{ __('messages.Male') }}</option>
                    <option value="female">{{ __('messages.Female') }}</option>
                    <option value="unknown">{{ __('messages.Unknown') }}</option>
                </select>
            </div>

            <!-- Color -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('messages.Color') }}</label>
                <div class="grid grid-cols-5 gap-2">
                    @foreach($colors as $colorOption)
                        <button type="button"
                                wire:click="$set('color', '{{ $colorOption }}')"
                                class="px-3 py-2 text-sm border rounded-md transition-colors duration-200
                                       {{ $color === $colorOption ? 'bg-green-500 text-white border-green-500' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                            {{ $colorOption }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Clear Filters -->
            <div class="flex items-end">
                <button wire:click="$set('species', ''); $set('breed', ''); $set('gender', ''); $set('color', ''); $set('search', '');"
                        class="w-full bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition duration-200">
                    {{ __('messages.Clear Filters') }}
                </button>
            </div>
        </div>
    </div>

    <!-- Results -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($pets as $pet)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                @if($pet->photo)
                    <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->name }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">No Photo</span>
                    </div>
                @endif

                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $pet->name }}</h3>
                    <p class="text-sm text-gray-600 mb-2">{{ $pet->species }} • {{ $pet->breed }}</p>
                    <p class="text-sm text-gray-500 mb-3">{{ Str::limit($pet->description, 80) }}</p>

                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500">{{ $pet->gender }}</span>
                        @if($pet->status === 'adoptable')
                            <a href="{{ route('pets.show', $pet) }}" class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700 transition duration-200">
                                Adopt
                            </a>
                        @elseif($pet->status === 'impounded')
                            <a href="{{ route('pets.show', $pet) }}" class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700 transition duration-200">
                                Claim
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">{{ __('messages.No pets found matching your criteria.') }}</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($pets->hasPages())
        <div class="mt-8">
            {{ $pets->links() }}
        </div>
    @endif
</div>
