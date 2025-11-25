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

    <!-- Results -->
<div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
    @forelse($posters as $poster)
        <div class="overflow-hidden transition duration-300 bg-white rounded-2xl shadow-lg hover:shadow-xl border border-pink-100 transform hover:-translate-y-1">
            <!-- Image Section -->
            <div class="bg-gradient-to-br from-blue-50 to-green-50 p-4">
                @if($poster->photo)
                    <div class="rounded-xl overflow-hidden border-2 border-white shadow-md">
                        <img src="{{ asset('storage/' . $poster->photo) }}" alt="{{ $poster->pet_name ?: 'Pet' }}" class="object-cover w-full h-40">
                    </div>
                @else
                    <div class="flex items-center justify-center w-full h-40 bg-gradient-to-br from-pink-50 to-purple-50 rounded-xl border-2 border-white">
                        <div class="text-center">
                            <i class="fas fa-paw text-3xl text-purple-300 mb-2"></i>
                            <p class="text-purple-400 text-sm">No Photo</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Content Section -->
            <div class="p-4 bg-gradient-to-br from-pink-50 to-purple-50">
                @if($poster->type === 'lost')
                    @if($poster->pet_name)
                        <h3 class="mb-2 text-base font-bold text-gray-800 flex items-center">
                            <i class="fas fa-search mr-2 text-red-400"></i>{{ $poster->pet_name }}
                        </h3>
                    @endif
                    <div class="space-y-1 mb-3">
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-tag mr-2 text-purple-400"></i>Lost - {{ $poster->species }}
                        </p>
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-dna mr-2 text-yellow-400"></i>{{ $poster->breed }}
                        </p>
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-venus-mars mr-2 text-pink-400"></i>{{ ucfirst($poster->gender) }}
                        </p>
                        <p class="text-sm text-gray-500 flex items-center">
                            <i class="fas fa-calendar-day mr-2 text-blue-400"></i>{{ $poster->date_lost_found->format('M d, Y') }}
                        </p>
                    </div>
                    @if($poster->reward)
                        <div class="mb-3 p-2 bg-gradient-to-r from-green-100 to-green-50 rounded-lg border border-green-200">
                            <p class="text-sm font-semibold text-green-700 flex items-center justify-center">
                                <i class="fas fa-gift mr-2"></i>₱{{ $poster->reward }} Reward
                            </p>
                        </div>
                    @else
                        <div class="mb-3"></div>
                    @endif
                @else
                    <h3 class="mb-2 text-base font-bold text-gray-800 flex items-center">
                        <i class="fas fa-home mr-2 text-green-400"></i>FND{{ str_pad($poster->id, 4, '0', STR_PAD_LEFT) }}
                    </h3>
                    <div class="space-y-1 mb-3">
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-tag mr-2 text-purple-400"></i>Found - {{ $poster->species }}
                        </p>
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-dna mr-2 text-yellow-400"></i>{{ $poster->breed }}
                        </p>
                        <p class="text-sm text-gray-600 flex items-center">
                            <i class="fas fa-venus-mars mr-2 text-pink-400"></i>{{ ucfirst($poster->gender) }}
                        </p>
                        <p class="text-sm text-gray-500 flex items-center">
                            <i class="fas fa-calendar-day mr-2 text-blue-400"></i>{{ $poster->date_lost_found->format('M d, Y') }}
                        </p>
                    </div>
                    <div class="mb-3"></div>
                @endif

                <a href="{{ route('posters.show', $poster) }}"
                   class="block w-full py-2 text-center text-white transition duration-200 bg-gradient-to-r from-purple-400 to-purple-500 rounded-xl hover:from-purple-500 hover:to-purple-600 font-medium flex items-center justify-center">
                    <i class="fas fa-eye mr-2"></i>View Details
                </a>
            </div>
        </div>
    @empty
        <div class="py-12 text-center col-span-full bg-gradient-to-br from-pink-50 to-purple-50 rounded-2xl border border-pink-100">
            <i class="fas fa-search text-4xl text-purple-300 mb-4"></i>
            <p class="text-lg text-gray-600">{{ __('messages.No posters found matching your criteria.') }}</p>
        </div>
    @endforelse
</div>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
