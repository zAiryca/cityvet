<div>
    <!-- Search and Filter Form -->
    <div class="p-6 mb-6 bg-white border border-gray-200 rounded-lg shadow-sm">
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
                        <label class="flex items-center text-xs cursor-pointer">
                            <input type="checkbox" wire:model.live="selectedColors" value="{{ $colorOption }}" class="flex-shrink-0 w-3 h-3 mr-1.5 border-gray-300 rounded focus:ring-indigo-500">
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
                // 💡 UPDATED: Show active pets and denied status separately
                $statuses = [
                    'All Pets' => null,
                    'Adoptable' => 'adoptable',
                    'Impounded' => 'impounded',
                    'Denied' => 'denied',
                ];
                $currentStatus = request()->get('status');
            @endphp
            @foreach($statuses as $label => $statusValue)
                <a href="{{ route('admin.pets.index', array_filter(['status' => $statusValue])) }}"
                   class="@if($currentStatus === $statusValue) border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 @endif whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                    {{ $label }}
                </a>
            @endforeach
        </nav>
    </div>

    <!-- Results Table -->
    @if($pets->count() > 0)
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Photo / Name</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Species/Breed</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Impounded/Adopt Date</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($pets as $index => $pet)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ ($pets->firstItem() ?? 0) + $index }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $pet->display_code }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="{{ $pet->photo ? asset('storage/' . $pet->photo) : 'https://via.placeholder.com/40?text=' . substr($pet->display_code, -2) }}" alt="{{ $pet->name }}" class="w-10 h-10 mr-4 rounded-full">
                                    <span class="font-medium">{{ $pet->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $pet->species }} / {{ $pet->breed }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    @if($pet->status === 'impounded') bg-red-100 text-red-800
                                    @elseif($pet->status === 'adoptable') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($pet->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                @php
                                    $impounded = $pet->impounded_date;
                                    $adoptable = $pet->decision_date ?? $pet->adoptable_date ?? null;
                                @endphp

                                @if($pet->status === 'impounded')
                                    {{ $impounded ? $impounded->format('M d, Y') : 'N/A' }}
                                @elseif($pet->status === 'adoptable')
                                    {{ $adoptable ? $adoptable->format('M d, Y') : ($impounded ? $impounded->format('M d, Y') : 'N/A') }}
                                @else
                                    @if($impounded && $adoptable)
                                        {{ $impounded->format('M d, Y') }} → {{ $adoptable->format('M d, Y') }}
                                    @elseif($impounded)
                                        {{ $impounded->format('M d, Y') }}
                                    @elseif($adoptable)
                                        {{ $adoptable->format('M d, Y') }}
                                    @else
                                        N/A
                                    @endif
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                <a href="{{ route('admin.pets.show', $pet) }}" class="mr-4 text-indigo-600 hover:text-indigo-900">View</a>
                                <a href="{{ route('admin.pets.edit', $pet) }}" class="mr-4 text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('admin.pets.destroy', $pet) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Delete this pet?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $pets->appends(request()->query())->links() }}
    @else
        <p class="py-8 text-center text-gray-500">No pets found matching your criteria.</p>
    @endif
</div>
