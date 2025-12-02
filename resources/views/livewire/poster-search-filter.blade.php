<div>

    <!-- Search and Filter Form -->

    <div class="p-6 mb-6 bg-white border border-gray-200 rounded-lg shadow-sm">

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
                        <label class="flex items-center text-xs cursor-pointer">
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

    <!-- Results -->
<div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
    @forelse($posters as $poster)
        <div class="overflow-hidden transition duration-300 transform bg-white border border-pink-100 shadow-lg rounded-2xl hover:shadow-xl hover:-translate-y-1">
            <!-- Image Section -->
            <div class="p-4 bg-gradient-to-br from-blue-50 to-green-50">
                @if($poster->photo)
                    <div class="overflow-hidden border-2 border-white shadow-md rounded-xl">
                        <img src="{{ asset('storage/' . $poster->photo) }}" alt="{{ $poster->pet_name ?: 'Pet' }}" class="object-cover w-full h-40">
                    </div>
                @else
                    <div class="flex items-center justify-center w-full h-40 border-2 border-white bg-gradient-to-br from-pink-50 to-purple-50 rounded-xl">
                        <div class="text-center">
                            <i class="mb-2 text-3xl text-purple-300 fas fa-paw"></i>
                            <p class="text-sm text-purple-400">No Photo</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Content Section -->
            <div class="p-4 bg-gradient-to-br from-pink-50 to-purple-50">
                @if($poster->type === 'lost')
                    @if($poster->pet_name)
                        <h3 class="flex items-center mb-2 text-base font-bold text-gray-800">
                            <i class="mr-2 text-red-400 fas fa-search"></i>{{ $poster->pet_name }}
                        </h3>
                    @endif
                    <div class="mb-3 space-y-1">
                        <p class="flex items-center text-sm text-gray-600">
                            <i class="mr-2 text-purple-400 fas fa-tag"></i>Lost - {{ $poster->species }}
                        </p>
                        <p class="flex items-center text-sm text-gray-600">
                            <i class="mr-2 text-yellow-400 fas fa-dna"></i>{{ $poster->breed }}
                        </p>
                        <p class="flex items-center text-sm text-gray-600">
                            <i class="mr-2 text-pink-400 fas fa-venus-mars"></i>{{ ucfirst($poster->gender) }}
                        </p>
                        <p class="flex items-center text-sm text-gray-500">
                            <i class="mr-2 text-blue-400 fas fa-calendar-day"></i>{{ $poster->date_lost_found->format('M d, Y') }}
                        </p>
                    </div>
                    @if($poster->reward)
                        <div class="p-2 mb-3 border border-green-200 rounded-lg bg-gradient-to-r from-green-100 to-green-50">
                            <p class="flex items-center justify-center text-sm font-semibold text-green-700">
                                <i class="mr-2 fas fa-gift"></i>₱{{ $poster->reward }} Reward
                            </p>
                        </div>
                    @else
                        <div class="mb-3"></div>
                    @endif
                @else
                    <h3 class="flex items-center mb-2 text-base font-bold text-gray-800">
                        <i class="mr-2 text-green-400 fas fa-home"></i>FND{{ str_pad($poster->id, 4, '0', STR_PAD_LEFT) }}
                    </h3>
                    <div class="mb-3 space-y-1">
                        <p class="flex items-center text-sm text-gray-600">
                            <i class="mr-2 text-purple-400 fas fa-tag"></i>Found - {{ $poster->species }}
                        </p>
                        <p class="flex items-center text-sm text-gray-600">
                            <i class="mr-2 text-yellow-400 fas fa-dna"></i>{{ $poster->breed }}
                        </p>
                        <p class="flex items-center text-sm text-gray-600">
                            <i class="mr-2 text-pink-400 fas fa-venus-mars"></i>{{ ucfirst($poster->gender) }}
                        </p>
                        <p class="flex items-center text-sm text-gray-500">
                            <i class="mr-2 text-blue-400 fas fa-calendar-day"></i>{{ $poster->date_lost_found->format('M d, Y') }}
                        </p>
                    </div>
                    <div class="mb-3"></div>
                @endif

                <a href="{{ route('posters.show', $poster) }}"
                   class="flex items-center justify-center w-full py-2 font-medium text-center text-white transition duration-200 bg-gradient-to-r from-purple-400 to-purple-500 rounded-xl hover:from-purple-500 hover:to-purple-600">
                    <i class="mr-2 fas fa-eye"></i>View Details
                </a>
            </div>
        </div>
    @empty
        <div class="py-12 text-center border border-pink-100 col-span-full bg-gradient-to-br from-pink-50 to-purple-50 rounded-2xl">
            <i class="mb-4 text-4xl text-purple-300 fas fa-search"></i>
            <p class="text-lg text-gray-600">{{ __('messages.No posters found matching your criteria.') }}</p>
        </div>
    @endforelse
</div>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
