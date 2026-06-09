<div>
    <!-- Search and Filter Form -->
    <form id="adoptableFilterForm" class="px-7 py-6 mb-6 bg-white border border-gray-200 rounded-lg shadow-sm">
        <!-- Single Row: Search, Species, Breed, Gender, Color Markings (4 columns) -->
        <div class="grid grid-cols-1 gap-3 md:grid-cols-5 lg:grid-cols-5">
            <!-- Search -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Search') }}</label>
                <input type="text" wire:model.live="search" placeholder="{{ __('Any field') }}..."
                    class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 transition">
            </div>

            <!-- Species -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Species') }}</label>
                <select wire:model.live="species"
                    class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                    <option value="">{{ __('All Species') }}</option>
                    <option value="Canine">{{ __('Canine') }}</option>
                    <option value="Feline">{{ __('Feline') }}</option>
                </select>
            </div>

            <!-- Breed -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Breed') }}</label>
                <select wire:model.live="breed"
                    class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 transition">
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
                <select wire:model.live="gender"
                    class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                    <option value="">{{ __('All Genders') }}</option>
                    <option value="male">{{ __('Male') }}</option>
                    <option value="female">{{ __('Female') }}</option>
                    <option value="unknown">{{ __('Unknown') }}</option>
                </select>
            </div>

            <!-- Color Markings (4 columns) -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Color Markings') }}</label>
                <div class="grid grid-cols-4 gap-2">
                    @foreach($colors as $colorOption)
                        <label class="flex items-center text-xs cursor-pointer select-none">
                            <input type="checkbox" wire:model.live="selectedColors" value="{{ $colorOption }}"
                                class="w-3.5 h-3.5 mr-1.5 border-gray-300 rounded focus:ring-green-500 text-green-600 transition">
                            <span class="text-xs font-medium text-gray-700">{{ $colorOption }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Clear Filters Button -->
        <div class="mt-3">
            <button type="button" wire:click="clearFilters"
                onclick="document.getElementById('adoptableFilterForm').reset()"
                class="px-3 py-1.5 text-xs font-medium text-gray-700 transition duration-200 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200">
                {{ __('Clear Filters') }}
            </button>
        </div>
    </form>

    <!-- Results -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

        @forelse($pets as $pet)

            <div class="overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-md rounded-xl hover:shadow-xl hover:scale-105 flex flex-col h-full">

                <!-- Photo Section with Status Badge -->
                <div class="relative h-48 overflow-hidden bg-gray-100">
                    @if($pet->photo)
                        <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->name ?: 'Pet' }}"
                            class="object-cover w-full h-full">
                    @else
                        <div class="flex items-center justify-center w-full h-full">
                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                    <div class="absolute top-3 right-3">
                        <span
                            class="inline-flex items-center px-3 py-1 text-xs font-bold text-green-800 bg-green-100 rounded-full">
                            <span class="w-2 h-2 mr-1.5 bg-green-600 rounded-full animate-pulse"></span>
                            Adoptable
                        </span>
                    </div>
                </div>

                <div class="p-4 flex flex-col flex-1">
                    <!-- ID and Species -->
                    <div class="mb-3">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-900">{{ $pet->display_code }}</h3>
                            @if($pet->remaining_days !== null && $pet->remaining_days > 0)
                                <span class="text-xs font-semibold text-red-700 bg-red-100 px-2 py-1 rounded">
                                    ⏰ {{ (int)$pet->remaining_days }} day{{ (int)$pet->remaining_days !== 1 ? 's' : '' }} left
                                </span>
                            @endif
                        </div>
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
                        <div class="text-xs">
                            <p class="font-semibold text-gray-500 uppercase">Color Markings</p>
                            <p class="font-semibold text-gray-900">{{ str_replace(',', ', ', $pet->color_markings) ?: 'N/A' }}</p>
                        </div>
                        @if($pet->shouldShowCaughtLocation())
                            <div class="text-xs">
                                <p class="font-semibold text-gray-500 uppercase">Caught Location</p>
                                <p class="font-semibold text-gray-900">{{ $pet->caught_location }}</p>
                            </div>
                        @endif
                        @if($pet->description)
                            <div class="text-xs">
                                <p class="font-semibold text-gray-500 uppercase">Description</p>
                                <p class="font-semibold text-gray-900 line-clamp-2">{{ $pet->description }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Available Info -->
                    <div class="p-2 mb-4 border border-green-200 rounded-lg bg-green-50">
                        @php
                            $adoptionReasonLabels = [
                                'surrendered_by_owner' => 'Surrendered by Owner',
                                'remained_unclaimed' => 'Remained Unclaimed',
                                'found_by_citizen' => 'Found by Citizen',
                            ];
                            $returnReasonLabels = [
                                'owner_relocation' => 'Owner Relocation/Moving',
                                'owner_illness_death' => 'Owner Illness/Death',
                                'financial_hardship' => 'Financial Hardship',
                                'housing_restriction' => 'Housing Restriction',
                                'lifestyle_change' => 'Lifestyle Change',
                                'incompatibility_pets' => 'Incompatibility with Pets',
                                'incompatibility_children' => 'Incompatibility with Children',
                                'allergies' => 'Allergies',
                                'space_exercise' => 'Lack of Space/Exercise',
                                'behavioral_issues' => 'Behavioral Issues',
                                'other' => 'Other',
                            ];

                            if ($pet->mostRecentReturn && $pet->mostRecentReturn->return_date) {
                                $reason = $returnReasonLabels[$pet->mostRecentReturn->return_reason] ?? ucfirst(str_replace('_', ' ', $pet->mostRecentReturn->return_reason));
                            } else {
                                $reason = $pet->adoption_reason ? ($adoptionReasonLabels[$pet->adoption_reason] ?? ucfirst(str_replace('_', ' ', $pet->adoption_reason))) : 'Remained Unclaimed';
                            }
                        @endphp
                        <p class="text-xs font-semibold text-green-700">
                            Ready for adoption
                        </p>
                        <p class="mt-1 text-xs text-gray-700">
                            <strong>Reason:</strong> {{ $reason }}
                        </p>
                        @if($pet->mostRecentReturn && $pet->mostRecentReturn->return_date)
                            <p class="mt-2 text-xs text-orange-700">
                                <strong>↩ Returned Pet</strong><br>
                                Previous owner returned this pet. Click "Adopt" to see details.
                            </p>
                        @endif
                    </div>

                    <!-- Spacer -->
                    <div class="flex-1"></div>

                    <!-- Action Buttons -->
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('pets.show', $pet) }}"
                            class="block px-3 py-2 text-sm font-bold text-center text-white transition-colors bg-green-600 rounded-lg shadow-sm hover:bg-green-700">
                            Adopt
                        </a>
                        <a href="{{ route('pets.show', $pet) }}"
                            class="block px-3 py-2 text-sm font-bold text-center text-white transition-colors bg-orange-600 rounded-lg shadow-sm hover:bg-orange-700">
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