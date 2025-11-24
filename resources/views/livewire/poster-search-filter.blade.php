<div>

    <!-- Search and Filter Form -->

    <div class="p-6 mb-6 bg-white rounded-lg shadow-sm border border-gray-200">

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
                <div class="grid grid-cols-4 gap-1">
                    @foreach($colors as $colorOption)
                        <label class="flex items-center cursor-pointer text-xs">
                            <input type="checkbox" wire:model.live="selectedColors" value="{{ $colorOption }}" class="w-3 h-3 mr-1 border-gray-300 rounded focus:ring-purple-500">
                            <span class="text-xs text-gray-700">{{ $colorOption }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Date From -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('messages.Date From') }}</label>
                <input type="date" wire:model.live="date_from"
                       class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>

            <!-- Date To -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('messages.Date To') }}</label>
                <input type="date" wire:model.live="date_to"
                       class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
            </div>
        </div>

        <!-- Fourth Row: Clear Filters Button -->
        <div>
            <button wire:click="clearFilters"
                    class="px-3 py-1.5 text-xs font-medium text-gray-700 transition duration-200 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200">
                {{ __('messages.Clear All Filters') }}
            </button>
        </div>

    </div>



    <!-- Results -->

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

        @forelse($posters as $poster)

            <div class="overflow-hidden transition duration-300 bg-white rounded-lg shadow-md hover:shadow-lg">

                @if($poster->photo)
                    <img src="{{ asset('storage/' . $poster->photo) }}" alt="{{ $poster->pet_name ?: 'Pet' }}" class="object-cover w-full h-40">
                @else
                    <div class="flex items-center justify-center w-full h-40 bg-gray-200">
                        <span class="text-gray-500">No Photo</span>
                    </div>
                @endif



                <div class="p-3">
                    @if($poster->type === 'lost')
                        @if($poster->pet_name)
                            <h3 class="mb-1 text-base font-semibold text-gray-900">{{ $poster->pet_name }}</h3>
                        @endif
                        <p class="mb-1 text-sm text-gray-600">Lost - {{ $poster->species }}</p>
                        <p class="mb-1 text-sm text-gray-600">{{ $poster->breed }}</p>
                        <p class="mb-1 text-sm text-gray-600">{{ ucfirst($poster->gender) }}</p>
                        <p class="mb-1 text-sm text-gray-500">{{ $poster->date_lost_found->format('M d, Y') }}</p>
                        @if($poster->reward)
                            <p class="mb-3 text-sm font-semibold text-green-600">₱{{ $poster->reward }} Reward</p>
                        @else
                            <div class="mb-3"></div>
                        @endif
                    @else
                        <h3 class="mb-1 text-base font-semibold text-gray-900">FND{{ str_pad($poster->id, 4, '0', STR_PAD_LEFT) }}</h3>
                        <p class="mb-1 text-sm text-gray-600">Found - {{ $poster->species }}</p>
                        <p class="mb-1 text-sm text-gray-600">{{ $poster->breed }}</p>
                        <p class="mb-1 text-sm text-gray-600">{{ ucfirst($poster->gender) }}</p>
                        <p class="mb-1 text-sm text-gray-500">{{ $poster->date_lost_found->format('M d, Y') }}</p>
                        <div class="mb-3"></div>
                    @endif

                    <a href="{{ route('posters.show', $poster) }}" class="block w-full py-2 text-center text-white transition duration-200 bg-purple-600 rounded hover:bg-purple-700">
                        View Details
                    </a>
                </div>

            </div>

        @empty

            <div class="py-12 text-center col-span-full">

                <p class="text-lg text-gray-500">{{ __('messages.No posters found matching your criteria.') }}</p>

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

