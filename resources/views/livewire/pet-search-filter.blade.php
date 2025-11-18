<div>
    <!-- Search and Filter Form -->
    <div class="p-6 mb-6 bg-white rounded-lg shadow">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-6">
            <!-- Search -->
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">{{ __('messages.Search') }}</label>
                <input type="text" wire:model.live="search" placeholder= " Search"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Species -->
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">{{ __('messages.Species') }}</label>
                <select wire:model.live="species" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">{{ __('messages.Species') }}</option>
                    <option value="Canine">{{ __('messages.Canine') }}</option>
                    <option value="Feline">{{ __('messages.Feline') }}</option>
                </select>
            </div>

            <!-- Breed -->
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">{{ __('messages.Breed') }}</label>
                <select wire:model.live="breed" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" @if(!$species) disabled @endif>
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
                <label class="block mb-1 text-sm font-medium text-gray-700">{{ __('messages.Gender') }}</label>
                <select wire:model.live="gender" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">{{ __('messages.Gender') }}</option>
                    <option value="male">{{ __('messages.Male') }}</option>
                    <option value="female">{{ __('messages.Female') }}</option>
                    <option value="unknown">{{ __('messages.Unknown') }}</option>
                </select>
            </div>

            <!-- Color -->
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">{{ __('messages.Color') }}</label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($colors as $colorOption)
                        <label class="flex items-center">
                            <input type="checkbox" wire:model.live="selectedColors" value="{{ $colorOption }}" class="mr-2">
                            <span class="text-sm">{{ $colorOption }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Clear Filters -->
            <div class="flex items-end">
                <button wire:click="clearFilters"
                        class="w-full px-4 py-2 text-white transition duration-200 bg-gray-500 rounded-md hover:bg-gray-600">
                    {{ __('messages.Clear Filters') }}
                </button>
            </div>
        </div>
    </div>

    <!-- Results -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @forelse($pets as $pet)
            <div class="overflow-hidden transition duration-300 bg-white rounded-lg shadow-md hover:shadow-lg">
                @if($pet->photo)
                    <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="object-cover w-full h-48">
                @else
                    <div class="flex items-center justify-center w-full h-48 bg-gray-200">
                        <span class="text-gray-500">{{ $pet->display_code }}</span>
                    </div>
                @endif

                <div class="p-4">
                    <h3 class="mb-1 text-lg font-semibold text-gray-900">{{ $pet->display_code }}</h3>
                    <p class="mb-2 text-sm text-gray-600">{{ $pet->species }} • {{ $pet->breed }}</p>
                    <p class="mb-2 text-sm text-gray-600">{{ ucfirst($pet->gender) }}</p>
                    <p class="mb-3 text-sm text-gray-500">
                        @if($pet->remaining_days > 0)
                            <span class="text-green-600 font-medium">{{ (int)$pet->remaining_days }} days remaining</span>
                        @else
                            <span class="text-red-600 font-medium">Expired</span>
                        @endif
                    </p>

                    <div class="flex items-center justify-between">
                        @if($pet->status === 'adoptable')
                            <a href="{{ route('pets.show', $pet) }}" class="px-3 py-1 text-sm text-white transition duration-200 bg-green-600 rounded hover:bg-green-700">
                                Adopt
                            </a>
                        @elseif($pet->status === 'impounded')
                            <a href="{{ route('pets.show', $pet) }}" class="px-3 py-1 text-sm text-white transition duration-200 bg-red-600 rounded hover:bg-red-700">
                                Claim
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="py-12 text-center col-span-full">
                <p class="text-lg text-gray-500">{{ __('messages.No pets found matching your criteria.') }}</p>
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
