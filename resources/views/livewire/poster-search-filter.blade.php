<div>

    <!-- Search and Filter Form -->

    <form id="publicPosterFilterForm" class="px-7 py-6 mb-6 bg-white border border-gray-200 rounded-lg shadow-sm">

        <!-- First Row: Search, Type, Species, Breed, Gender -->
        <div class="grid grid-cols-1 gap-2 mb-3 md:grid-cols-2 lg:grid-cols-5">

            <!-- Search -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Search') }}</label>
                <input type="text" wire:model.live="search" placeholder="{{ __('Any field') }}..."
                       class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>

            <!-- Type -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Type') }}</label>
                <select wire:model.live="type" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
                    <option value="">{{ __('All') }}</option>
                    <option value="lost">{{ __('Lost') }}</option>
                    <option value="found">{{ __('Found') }}</option>
                </select>
            </div>

            <!-- Species -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Species') }}</label>
                <select wire:model.live="species" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
                    <option value="">{{ __('All Species') }}</option>
                    <option value="Canine">{{ __('Canine') }}</option>
                    <option value="Feline">{{ __('Feline') }}</option>
                </select>
            </div>

            <!-- Breed -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Breed') }}</label>
                <select wire:model.live="breed" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
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
                <select wire:model.live="gender" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
                    <option value="">{{ __('All Genders') }}</option>
                    <option value="male">{{ __('Male') }}</option>
                    <option value="female">{{ __('Female') }}</option>
                    <option value="unknown">{{ __('Unknown') }}</option>
                </select>
            </div>
        </div>

        <!-- Second Row: Color (4 columns), Date From, Date To -->
        <div class="grid grid-cols-1 gap-2 mb-3 md:grid-cols-2 lg:grid-cols-6">
            <!-- Color (4 columns) -->
            <div class="lg:col-span-4">
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Color') }}</label>
                <div class="flex flex-wrap gap-x-4 gap-y-2 mt-1">
                    @foreach($colors as $colorOption)
                        <label class="flex items-center text-xs cursor-pointer select-none">
                            <input type="checkbox" wire:model.live="selectedColors" value="{{ $colorOption }}" class="w-3.5 h-3.5 mr-1.5 border-gray-300 rounded focus:ring-purple-500 text-purple-600 transition">
                            <span class="text-xs font-medium text-gray-700">{{ $colorOption }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Date From -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Date From') }}</label>
                <input type="date" wire:model.live="date_from"
                       class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>

            <!-- Date To -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Date To') }}</label>
                <input type="date" wire:model.live="date_to"
                       class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
        </div>

        <!-- Fourth Row: Clear Filters Button -->
        <div>
            <button type="button" wire:click="clearFilters" onclick="document.getElementById('publicPosterFilterForm').reset()"
                    class="px-3 py-1.5 text-xs font-medium text-gray-700 transition duration-200 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200">
                {{ __('Clear Filters') }}
            </button>
        </div>

    </form>



    <!-- Results -->

    <!-- Results -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

        @forelse($posters as $poster)

            <div class="overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl hover:scale-105">

                <!-- Photo Section with Status Badge -->
                <div class="relative h-48 overflow-hidden bg-gray-100">
                    @if($poster->photo)
                        <img src="{{ asset('storage/' . $poster->photo) }}" alt="{{ $poster->pet_name ?: 'Pet' }}" class="object-cover w-full h-full">
                    @else
                        <div class="flex items-center justify-center w-full h-full">
                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                    <div class="absolute top-3 right-3">
                        @if($poster->type === 'lost')
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold text-red-800 bg-red-100 rounded-full">
                                <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                                Lost
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold text-green-800 bg-green-100 rounded-full">
                                <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-9 9a1 1 0 001.414 1.414L2 12.414V19a1 1 0 001 1h3a1 1 0 001-1v-3a1 1 0 011-1h2a1 1 0 011 1v3a1 1 0 001 1h3a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-9-9z" />
                                </svg>
                                Found
                            </span>
                        @endif
                    </div>
                </div>

                <div class="p-4">
                    <!-- ID and Species -->
                    <div class="mb-3">
                        <h3 class="text-lg font-bold text-gray-900">
                            @if($poster->type === 'lost')
                                @if($poster->pet_name)
                                    {{ $poster->pet_name }}
                                @else
                                    LST{{ str_pad($poster->id, 4, '0', STR_PAD_LEFT) }}
                                @endif
                                @if($poster->reward)
                                    <span class="inline-flex items-center px-2 py-1 ml-2 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                        ₱{{ $poster->reward }}
                                    </span>
                                @endif
                            @else
                                FND{{ str_pad($poster->id, 4, '0', STR_PAD_LEFT) }}
                            @endif
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">{{ ucfirst($poster->species) }} • {{ ucfirst($poster->breed) }}</p>
                    </div>

                    <!-- Quick Info -->
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <div class="text-xs">
                            <p class="font-semibold text-gray-500 uppercase">Gender</p>
                            <p class="font-semibold text-gray-900">{{ ucfirst($poster->gender) }}</p>
                        </div>
                        <div class="text-xs">
                            <p class="font-semibold text-gray-500 uppercase">
                                @if($poster->type === 'lost') Lost @else Found @endif Date
                            </p>
                            <p class="font-semibold text-gray-900">{{ $poster->date_lost_found->format('M d, Y') }}</p>
                        </div>
                    </div>



                    <!-- Action Button -->
                    <a href="{{ route('posters.show', $poster) }}" class="block w-full px-4 py-2 font-bold text-center text-white transition-colors bg-purple-600 rounded-lg shadow-sm hover:bg-purple-700">
                        View Details
                    </a>
                </div>

            </div>

        @empty

            <div class="py-12 text-center col-span-full">

                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>

                <p class="text-lg text-gray-500">{{ __('No posters found matching your criteria.') }}</p>

            </div>

        @endforelse

    </div>
