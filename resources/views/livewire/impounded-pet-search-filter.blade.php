<div>
    <!-- Search and Filter Form -->
    <div class="p-6 mb-6 bg-white border border-gray-200 rounded-lg shadow-sm">
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
                        <label class="flex items-center text-xs cursor-pointer">
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

            <div class="overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl hover:scale-105">

                <!-- Photo Section with Status Badge -->
                <div class="relative h-48 overflow-hidden bg-gray-100">
                    @if($pet->photo)
                        <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->name ?: 'Pet' }}" class="object-cover w-full h-full">
                    @else
                        <div class="flex items-center justify-center w-full h-full">
                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                    <div class="absolute top-3 right-3">
                        <span class="inline-flex items-center px-3 py-1 text-xs font-bold text-red-800 bg-red-100 rounded-full">
                            <span class="w-2 h-2 mr-1.5 bg-red-600 rounded-full animate-pulse"></span>
                            Impounded
                        </span>
                    </div>
                </div>

                <div class="p-4">
                    <!-- ID and Species -->
                    <div class="mb-3">
                        <h3 class="text-lg font-bold text-gray-900">{{ $pet->display_code }}</h3>
                        <p class="mt-1 text-sm text-gray-600">{{ ucfirst($pet->species) }} • {{ ucfirst($pet->breed) }}</p>
                    </div>

                    <!-- Quick Info -->
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <div class="text-xs">
                            <p class="font-semibold text-gray-500 uppercase">Gender</p>
                            <p class="font-semibold text-gray-900">{{ ucfirst($pet->gender) }}</p>
                        </div>
                        <div class="text-xs">
                            <p class="font-semibold text-gray-500 uppercase">Estimated Age</p>
                            <p class="font-semibold text-gray-900">{{ $pet->estimated_age ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Days Remaining Alert -->
                    <div class="mb-4 p-2 rounded-lg {{ $pet->remaining_days <= 3 ? 'bg-red-50 border border-red-200' : 'bg-yellow-50 border border-yellow-200' }}">
                        <p class="text-xs {{ $pet->remaining_days <= 3 ? 'text-red-700 font-bold' : 'text-yellow-700 font-semibold' }}">
                            @if($pet->remaining_days > 0)
                                ⏰ {{ (int)$pet->remaining_days }} day{{ (int)$pet->remaining_days !== 1 ? 's' : '' }} left
                            @else
                                ⏳ Expired
                            @endif
                        </p>
                    </div>

                    <!-- Action Button -->
                    <a href="{{ route('pets.show', $pet) }}" class="block w-full px-4 py-2 font-bold text-center text-white transition-colors bg-red-600 rounded-lg shadow-sm hover:bg-red-700">
                        <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        View Details
                    </a>
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
