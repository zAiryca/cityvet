<div>

    <!-- Search and Filter Form -->

    <div class="p-4 mb-6 bg-white rounded-lg shadow">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-4 lg:grid-cols-8">

            <!-- Search -->
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">{{ __('Search ') }}</label>
                <input type="text" wire:model.live="search" placeholder="{{ __('Name or FND Code') }}..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>



            <!-- Type -->

            <div>

                <label class="block mb-1 text-sm font-medium text-gray-700">{{ __('messages.Type') }}</label>

                <select wire:model.live="type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">

                    <option value="">{{ __('messages.All Types') }}</option>

                    <option value="lost">{{ __('messages.Lost') }}</option>

                    <option value="found">{{ __('messages.Found') }}</option>

                </select>

            </div>



            <!-- Species -->

            <div>

                <label class="block mb-1 text-sm font-medium text-gray-700">{{ __('messages.Species') }}</label>

                <select wire:model.live="species" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">

                    <option value="">{{ __('messages.Species') }}</option>

                    <option value="Canine">{{ __('messages.Canine') }}</option>

                    <option value="Feline">{{ __('messages.Feline') }}</option>

                </select>

            </div>



            <!-- Breed -->

            <div>

                <label class="block mb-1 text-sm font-medium text-gray-700">{{ __('messages.Breed') }}</label>

                <select wire:model.live="breed" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">

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

                <select wire:model.live="gender" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">

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



            <!-- Date From -->

            <div>

                <label class="block mb-1 text-sm font-medium text-gray-700">{{ __('messages.Date From') }}</label>

                <input type="date" wire:model.live="date_from"

                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">

            </div>



            <!-- Date To -->

            <div>

                <label class="block mb-1 text-sm font-medium text-gray-700">{{ __('messages.Date To') }}</label>

                <input type="date" wire:model.live="date_to"

                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">

            </div>

        </div>



        <!-- Clear Filters Button -->

        <div class="mt-4">

            <button wire:click="clearFilters"

                    class="px-4 py-2 text-white transition duration-200 bg-gray-500 rounded-md hover:bg-gray-600">

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

