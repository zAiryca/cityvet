<div>
    <!-- Search and Filter Form -->
    <div class="p-6 mb-6 bg-white rounded-lg shadow-sm border border-gray-200">
        <!-- Single Row: Search, Species, Breed, Gender, Color (4 columns) -->
        <div class="grid grid-cols-1 gap-3 md:grid-cols-5 lg:grid-cols-5">
            <!-- Search -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Search') }}</label>
                <input type="text" wire:model.live="search" placeholder="{{ __('Any field') }}..."
                       class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            </div>

            <!-- Species -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Species') }}</label>
                <select wire:model.live="species" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <option value="">{{ __('All Species') }}</option>
                    <option value="Canine">{{ __('Canine') }}</option>
                    <option value="Feline">{{ __('Feline') }}</option>
                </select>
            </div>

            <!-- Breed -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Breed') }}</label>
                <select wire:model.live="breed" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <option value="">{{ __('All Breeds') }}</option>
                    @if($species && isset($breeds[$species]))
                        @foreach($breeds[$species] as $breedOption)
                            <option value="{{ $breedOption }}">{{ $breedOption }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <!-- Gender -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Gender') }}</label>
                <select wire:model.live="gender" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <option value="">{{ __('All Genders') }}</option>
                    <option value="male">{{ __('Male') }}</option>
                    <option value="female">{{ __('Female') }}</option>
                    <option value="unknown">{{ __('Unknown') }}</option>
                </select>
            </div>

            <!-- Color (4 columns) -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Color') }}</label>
                <div class="grid grid-cols-4 gap-2">
                    @foreach($colors as $colorOption)
                        <label class="flex items-center cursor-pointer text-xs">
                            <input type="checkbox" wire:model.live="selectedColors" value="{{ $colorOption }}" class="w-3 h-3 mr-1 border-gray-300 rounded focus:ring-blue-500">
                            <span class="text-xs text-gray-700">{{ $colorOption }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Clear Filters Button -->
        <div class="mt-3">
            <button wire:click="clearFilters"
                    class="px-3 py-1.5 text-xs font-medium text-gray-700 transition duration-200 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200">
                {{ __('Clear Filters') }}
            </button>
        </div>
    </div>

    <!-- Results -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

        @forelse($pets as $pet)

            <div class="overflow-hidden transition duration-300 bg-white rounded-lg shadow-md hover:shadow-lg">

                @if($pet->photo)
                    <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->name ?: 'Pet' }}" class="object-cover w-full h-40">
                @else
                    <div class="flex items-center justify-center w-full h-40 bg-gray-200">
                        <span class="text-gray-500">No Photo</span>
                    </div>
                @endif

                <div class="p-3">
                    <h3 class="mb-1 text-lg font-semibold text-gray-900">{{ $pet->display_code }}</h3>
                    <p class="mb-2 text-sm text-gray-600">{{ $pet->species }} • {{ $pet->breed }}</p>
                    <p class="mb-2 text-sm text-gray-600">{{ ucfirst($pet->gender) }}</p>
                    <p class="mb-3 text-sm text-gray-500">
                        @if($pet->remaining_days > 0)
                            <span class="font-medium text-green-600">{{ (int)$pet->remaining_days }} days remaining</span>
                        @else
                            <span class="font-medium text-red-600">Expired</span>
                        @endif
                    </p>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('pets.show', $pet) }}" class="px-3 py-1 text-sm text-white transition duration-200 bg-red-600 rounded hover:bg-red-700">
                            Claim
                        </a>
                    </div>
                </div>

            </div>

        @empty

            <div class="py-12 text-center col-span-full">

                <p class="text-lg text-gray-500">{{ __('No pets found matching your criteria.') }}</p>

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
