<div>
    <!-- Search and Filter Form -->
    <form id="posterFilterForm" class="px-7 py-6 mb-6 bg-white border border-gray-200 rounded-lg shadow-sm">
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
                        <label class="flex items-center text-xs cursor-pointer">
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
            <button type="button" wire:click="clearFilters" onclick="document.getElementById('posterFilterForm').reset()"
                    class="px-3 py-1.5 text-xs font-medium text-gray-700 transition duration-200 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200">
                {{ __('Clear Filters') }}
            </button>
        </div>
    </form>

    <!-- Status Filter Tabs -->
    <div class="mb-4 bg-white rounded-lg shadow-lg" id="filters-container">
        <div class="px-6 py-2">
            <nav class="flex -mb-px space-x-8" aria-label="Tabs">
                <a href="{{ route('admin.posters.index') }}"
                   class="@if(!request('tab') || request('tab') === 'all') border-blue-500 text-blue-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                    All
                </a>
                <a href="{{ route('admin.posters.index', ['tab' => 'lost']) }}"
                   class="@if(request('tab') === 'lost') border-red-500 text-red-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                    Lost
                </a>
                <a href="{{ route('admin.posters.index', ['tab' => 'found']) }}"
                   class="@if(request('tab') === 'found') border-green-500 text-green-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                    Found
                </a>
                <a href="{{ route('admin.posters.index', ['tab' => 'reunited']) }}"
                   class="@if(request('tab') === 'reunited') border-purple-500 text-purple-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                    Reunited
                </a>
            </nav>
        </div>
    </div>

        @if($posters->count() > 0)
        <div class="overflow-x-auto bg-white rounded-b-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">#</th>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Photo / Pet Name</th>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Type</th>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">User</th>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($posters as $poster)
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $loop->iteration }}</div>
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">#{{ $poster->id }}</div>
                            </td>

                            <td class="px-4 py-3 font-medium whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($poster->photo)
                                        <div class="flex-shrink-0 w-12 h-12">
                                            <img src="{{ asset('storage/' . $poster->photo) }}" alt="{{ $poster->pet_name ?: 'Pet' }}" onclick="openPhotoModal('{{ asset('storage/' . $poster->photo) }}', '{{ $poster->pet_name ?: 'Pet' }}')" class="object-cover w-12 h-12 rounded-full cursor-pointer hover:opacity-80 transition-opacity">
                                        </div>
                                    @else
                                        <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-full">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                    @endif

                                    <div class="{{ $poster->photo ? 'ml-3' : '' }}">
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

                            <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ ucfirst($poster->type) }}</td>

                            <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $poster->user->name }}</td>

                            <td class="px-4 py-3 text-sm text-gray-500 whitespace-nowrap">{{ $poster->date_lost_found->format('M d, Y') }}</td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $poster->status === 'active' ? 'bg-green-100 text-green-800' : ($poster->status === 'reunited' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800') }}">
                                    {{ ucfirst($poster->status) }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-sm font-medium">
                                <div class="flex items-center space-x-3">
                                    <button onclick="window.location.href='{{ route('admin.posters.show', $poster) }}'"
                                            class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-white bg-indigo-600 border border-indigo-600 rounded-md hover:bg-indigo-700 hover:border-indigo-700 transition-colors"
                                            title="View Poster Details">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        View
                                    </button>
                                    <form action="{{ route('admin.posters.destroy', $poster) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-white bg-red-600 border border-red-600 rounded hover:bg-red-700 hover:border-red-700 transition-colors"
                                                title="Delete Poster"
                                                onclick="return confirm('Delete this poster?')">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
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

    <!-- Photo Modal -->
    <div id="photoModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-70">
        <button onclick="closePhotoModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors z-60">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <img id="modalImage" class="max-w-[90vw] max-h-[90vh] object-contain rounded-lg shadow-2xl cursor-pointer" onclick="closePhotoModal()" />
    </div>

    <script>
        function openPhotoModal(imageSrc, altText) {
            const modal = document.getElementById('photoModal');
            const image = document.getElementById('modalImage');
            image.src = imageSrc;
            image.alt = altText;
            modal.classList.remove('hidden');
            document.addEventListener('keydown', handlePhotoModalKeydown);
        }

        function closePhotoModal() {
            const modal = document.getElementById('photoModal');
            modal.classList.add('hidden');
            document.removeEventListener('keydown', handlePhotoModalKeydown);
        }

        function handlePhotoModalKeydown(event) {
            if (event.key === 'Escape' || event.key === 'Backspace') {
                closePhotoModal();
            }
        }
    </script>
</div>
