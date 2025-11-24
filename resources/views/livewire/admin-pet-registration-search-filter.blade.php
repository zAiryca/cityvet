<div>
    <!-- Search and Filter Form -->
    <div class="p-6 mb-6 bg-white rounded-lg shadow-sm border border-gray-200">
        <!-- Single Row: Search, Species, Breed, Gender, Color (4 columns) -->
        <div class="grid grid-cols-1 gap-3 md:grid-cols-5 lg:grid-cols-5">
            <!-- Search -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Search') }}</label>
                <input type="text" wire:model.live="search" placeholder="{{ __('Any field') }}..."
                       class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
            </div>

            <!-- Species -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Species') }}</label>
                <select wire:model.live="species" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    <option value="">{{ __('All Species') }}</option>
                    <option value="Canine">{{ __('Canine') }}</option>
                    <option value="Feline">{{ __('Feline') }}</option>
                </select>
            </div>

            <!-- Breed -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Breed') }}</label>
                <select wire:model.live="breed" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
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
                <select wire:model.live="gender" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
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
                            <input type="checkbox" wire:model.live="selectedColors" value="{{ $colorOption }}" class="w-3 h-3 mr-1 border-gray-300 rounded focus:ring-indigo-500">
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

    <!-- Status Filter Tabs -->
    <div class="mb-6 border-b border-gray-200">
        <nav class="flex pb-2 space-x-4 overflow-x-auto">
            @php
                // 💡 UPDATED: Added "All" tab to show all registrations without status filter
                $statuses = [
                    'All' => null,
                    'Pending' => 'pending',
                    'Registered' => 'registered',
                    'Denied' => 'denied',
                ];
                $currentStatus = request()->get('registration_status');
            @endphp
            @foreach($statuses as $label => $statusValue)
                <a href="{{ route('admin.pet-registrations.index', array_filter(['registration_status' => $statusValue])) }}"
                   class="@if($currentStatus === $statusValue) border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 @endif whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                    {{ $label }}
                </a>
            @endforeach
        </nav>
    </div>

    <!-- Results Table -->
    @if($petRegistrations->count() > 0)
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Pet ID</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Photo / Name</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Species/Breed</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Owner</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($petRegistrations as $index => $pet)
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ ($petRegistrations->firstItem() ?? 0) + $index }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $pet->display_pet_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($pet->photo)
                                        <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->pet_name }}" class="w-10 h-10 mr-4 rounded-full object-cover">
                                    @else
                                        <div class="flex items-center justify-center w-10 h-10 mr-4 bg-gray-200 rounded-full">
                                            <span class="text-xs text-gray-500">No Photo</span>
                                        </div>
                                    @endif
                                    <span class="font-medium text-gray-900">{{ $pet->pet_name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $pet->species }} / {{ $pet->breed }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $pet->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    @if($pet->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($pet->status === 'registered') bg-green-100 text-green-800
                                    @elseif($pet->status === 'denied') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    @if($pet->status === 'pending') Pending
                                    @elseif($pet->status === 'registered') Registered
                                    @elseif($pet->status === 'denied') Denied
                                    @else {{ ucfirst($pet->status) }} @endif
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $pet->user->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                <a href="{{ route('admin.pet-registrations.show', $pet) }}" class="mr-3 text-indigo-600 hover:text-indigo-900">View</a>
                                @if($pet->status === 'pending')
                                    <form method="POST" action="{{ route('admin.pet-registrations.approve', $pet) }}" onsubmit="return confirm('Are you sure you want to register this pet?')" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="mr-3 text-green-600 hover:text-green-900">Register</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.pet-registrations.deny', $pet) }}" onsubmit="return confirm('Are you sure you want to deny this pet registration?')" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="mr-3 text-red-600 hover:text-red-900">Deny</button>
                                    </form>
                                @endif
                                <form method="POST" action="{{ route('admin.pet-registrations.destroy', $pet) }}" onsubmit="return confirm('Are you sure you want to delete this pet registration? This action cannot be undone.')" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $petRegistrations->appends(request()->query())->links() }}
    @else
        <p class="py-8 text-center text-gray-500">No pet registrations found matching your criteria.</p>
    @endif
</div>
