<div>
    <!-- Search and Filter Form -->
    <form id="registrationFilterForm" class="px-7 py-6 mb-6 bg-white border border-gray-200 rounded-lg shadow-sm">
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
                            <input type="checkbox" wire:model.live="selectedColors" value="{{ $colorOption }}" class="w-3 h-3 mr-1 border-gray-300 rounded focus:ring-indigo-500">
                            <span class="text-xs text-gray-700">{{ $colorOption }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Clear Filters Button -->
        <div class="mt-3">
            <button type="button" wire:click="clearFilters" onclick="document.getElementById('registrationFilterForm').reset()"
                    class="px-3 py-1.5 text-xs font-medium text-gray-700 transition duration-200 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200">
                {{ __('Clear Filters') }}
            </button>
        </div>
    </form>

    <!-- Status Filter Tabs -->
    <div class="mb-4 bg-white rounded-lg shadow-lg" id="filters-container">
        <div class="px-6 py-2">
            <nav class="flex -mb-px space-x-8" aria-label="Tabs">
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
                       class="@if($currentStatus === $statusValue) border-blue-500 text-blue-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                        {{ $label }}
                    </a>
                @endforeach
            </nav>
        </div>
    </div>

    <!-- Results Table -->
    @if($petRegistrations->count() > 0)
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">#</th>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Pet ID</th>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Photo / Name</th>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Species/Breed</th>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Owner</th>
                        <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($petRegistrations as $index => $pet)
                        <tr>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900 whitespace-nowrap">{{ ($petRegistrations->firstItem() ?? 0) + $index }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $pet->display_pet_id }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($pet->photo)
                                        <img src="{{ asset('storage/' . $pet->photo) }}"
                                             alt="{{ $pet->pet_name }}"
                                             class="object-cover w-12 h-12 mr-3 transition-transform rounded-full cursor-pointer hover:scale-110 hover:shadow-lg"
                                             onclick="openPhotoModal('{{ asset('storage/' . $pet->photo) }}', '{{ $pet->pet_name }} ({{ $pet->display_pet_id }})')"
                                             title="Click to enlarge">
                                    @else
                                        <div class="flex items-center justify-center w-12 h-12 mr-3 text-sm font-medium text-gray-500 transition-all bg-gray-100 rounded-full cursor-pointer hover:bg-gray-200 hover:shadow-md"
                                             title="No photo available">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <span class="font-medium text-gray-900">{{ $pet->pet_name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">{{ $pet->species }} / {{ $pet->breed }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500 whitespace-nowrap">{{ $pet->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">
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
                            <td class="px-4 py-3 text-sm text-gray-500 whitespace-nowrap">{{ $pet->user->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-sm font-medium">
                                <div class="flex items-center space-x-3">
                                    <button onclick="window.location.href='{{ route('admin.pet-registrations.show', $pet) }}'"
                                            class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-white transition-colors bg-indigo-600 border border-indigo-600 rounded hover:bg-indigo-700 hover:border-indigo-700"
                                            title="View Registration Details">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        View
                                    </button>
                                    <form method="POST" action="{{ route('admin.pet-registrations.destroy', $pet) }}" onsubmit="return confirm('Are you sure you want to delete this pet registration? This action cannot be undone.')" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-white transition-colors bg-red-600 border border-red-600 rounded hover:bg-red-700 hover:border-red-700"
                                                title="Delete Registration">
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
        {{ $petRegistrations->appends(request()->query())->links() }}
    @else
        <p class="py-8 text-center text-gray-500">No pet registrations found matching your criteria.</p>
    @endif
</div>

<script>
    function openPhotoModal(src, alt) {
        // Create modal if it doesn't exist
        let modal = document.getElementById('photo-modal');
        if (!modal) {
            modal = document.createElement('div');
            modal.id = 'photo-modal';
            modal.className = 'fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-70';
            modal.innerHTML = `
                <button onclick="closePhotoModal()" class="absolute text-white top-6 right-6 hover:text-gray-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                <img id="modal-image" src="" alt="" class="max-w-[90vw] max-h-[90vh] object-contain rounded-lg shadow-2xl cursor-pointer" onclick="closePhotoModal()">
            `;
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closePhotoModal();
                }
            });
            document.body.appendChild(modal);
        }

        // Update modal content
        document.getElementById('modal-image').src = src;
        document.getElementById('modal-image').alt = alt;

        // Show modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closePhotoModal() {
        const modal = document.getElementById('photo-modal');
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    }

    // Close modal on escape and backspace keys
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' || e.key === 'Backspace') {
            closePhotoModal();
        }
    });
</script>
