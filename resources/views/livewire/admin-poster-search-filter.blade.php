<div>
    <!-- Search and Filter Form -->
    <div class="p-6 mb-6 bg-white rounded-lg shadow-sm border border-gray-200">
        <!-- First Row: Search, Species, Breed, Gender -->
        <div class="grid grid-cols-1 gap-2 mb-3 md:grid-cols-2 lg:grid-cols-4">
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
        </div>

        <!-- Second Row: Color Markings (4 columns), Date From, Date To -->
        <div class="grid grid-cols-1 gap-2 mb-3 md:grid-cols-2 lg:grid-cols-6">
            <!-- Color Markings (4 columns) -->
            <div class="lg:col-span-4">
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Color Markings') }}</label>
                <div class="grid grid-cols-4 gap-1">
                    @foreach($colors as $colorOption)
                        <label class="flex items-center cursor-pointer text-xs">
                            <input type="checkbox" wire:model.live="selectedColors" value="{{ $colorOption }}" class="w-3 h-3 mr-1 border-gray-300 rounded focus:ring-blue-500">
                            <span class="text-xs text-gray-700">{{ $colorOption }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Date From -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Date From') }}</label>
                <input type="date" wire:model.live="date_from"
                       class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            </div>

            <!-- Date To -->
            <div>
                <label class="block mb-1 text-xs font-semibold text-gray-700">{{ __('Date To') }}</label>
                <input type="date" wire:model.live="date_to"
                       class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            </div>
        </div>

        <!-- Third Row: Clear Filters Button -->
        <div>
            <button wire:click="clearFilters"
                    class="px-3 py-1.5 text-xs font-medium text-gray-700 transition duration-200 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200">
                {{ __('Clear Filters') }}
            </button>
        </div>
    </div>

    <!-- Results Table with Tabs -->
    <div class="mt-6">
        <!-- Tabs above table -->
        <div class="mb-0 border-b border-gray-300">
            <div class="flex space-x-1">
                <a href="{{ route('admin.posters.index') }}"
                   class="px-4 py-3 font-semibold text-sm transition duration-200 {{ !request('tab') || request('tab') === 'all' ? 'border-b-2 border-blue-600 text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                    All
                </a>
                <a href="{{ route('admin.posters.index', ['tab' => 'lost']) }}"
                   class="px-4 py-3 font-semibold text-sm transition duration-200 {{ request('tab') === 'lost' ? 'border-b-2 border-red-600 text-red-600 bg-red-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                    Lost
                </a>
                <a href="{{ route('admin.posters.index', ['tab' => 'found']) }}"
                   class="px-4 py-3 font-semibold text-sm transition duration-200 {{ request('tab') === 'found' ? 'border-b-2 border-green-600 text-green-600 bg-green-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                    Found
                </a>
                <a href="{{ route('admin.posters.index', ['tab' => 'reunited']) }}"
                   class="px-4 py-3 font-semibold text-sm transition duration-200 {{ request('tab') === 'reunited' ? 'border-b-2 border-purple-600 text-purple-600 bg-purple-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                    Reunited
                </a>
            </div>
        </div>

        @if($posters->count() > 0)
        <div class="overflow-x-auto bg-white rounded-b-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Photo / Pet Name</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">User</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($posters as $poster)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $loop->iteration }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">#{{ $poster->id }}</div>
                            </td>

                            <td class="px-6 py-4 font-medium whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($poster->photo)
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img src="{{ asset('storage/' . $poster->photo) }}" alt="{{ $poster->pet_name ?: 'Pet' }}" class="object-cover w-10 h-10 rounded-full">
                                        </div>
                                    @endif

                                    <div class="{{ $poster->photo ? 'ml-4' : '' }}">
                                        <div class="text-sm font-medium text-gray-900">
                                            @if($poster->type === 'lost')
                                                {{ $poster->pet_name ?: 'Unknown' }}
                                            @else
                                                FND{{ str_pad($poster->id, 4, '0', STR_PAD_LEFT) }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ ucfirst($poster->type) }}</td>

                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $poster->user->name }}</td>

                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $poster->date_lost_found->format('M d, Y') }}</td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $poster->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($poster->status) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                <a href="{{ route('posters.show', $poster) }}" class="mr-4 text-indigo-600 hover:text-indigo-900" target="_blank">View</a>
                                <form action="{{ route('admin.posters.destroy', $poster) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-600 hover:text-gray-900" onclick="return confirm('Delete this poster?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $posters->links() }}
        @else
        <div class="py-12 text-center bg-white rounded-b-lg shadow">
            <p class="text-lg text-gray-500">{{ __('No posters found matching your criteria.') }}</p>
        </div>
        @endif
    </div>
</div>
