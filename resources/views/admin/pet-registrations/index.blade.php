@extends('layouts.admin')

@section('title', 'Pet Registrations Management')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    @php
        // Define the possible statuses for the navigation tabs
        $statuses = [
            'Pending' => 'pending',
            'Registered' => 'registered',
            'Denied' => 'denied',
        ];

        // Define a readable title using universally supported if/elseif logic
        $pageTitle = 'Pet Registrations';
        if (isset($currentRegistrationStatus)) {
            if ($currentRegistrationStatus === 'pending') {
                $pageTitle = 'Pending Pet Registrations';
            } elseif ($currentRegistrationStatus === 'registered') {
                $pageTitle = 'Registered Pets';
            } elseif ($currentRegistrationStatus === 'denied') {
                $pageTitle = 'Denied Pet Registrations';
            }
        }
    @endphp

    <div class="p-6 bg-white shadow-md rounded-lg">

        {{-- Dynamic Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $pageTitle }}</h1>
        </div>

        {{-- Search and Filter Form --}}
        <div class="bg-gray-50 p-4 rounded-lg mb-6">
            <form method="GET" action="{{ route('admin.pet-registrations.index') }}" class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @if(isset($currentRegistrationStatus))
                    <input type="hidden" name="registration_status" value="{{ $currentRegistrationStatus }}">
                @endif

                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search Pet ID</label>
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Pet ID..."
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Species -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Species</label>
                    <select name="species" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">All Species</option>
                        <option value="Canine" {{ ($species ?? '') === 'Canine' ? 'selected' : '' }}>Canine</option>
                        <option value="Feline" {{ ($species ?? '') === 'Feline' ? 'selected' : '' }}>Feline</option>
                    </select>
                </div>

                <!-- Breed -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Breed</label>
                    <select name="breed" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">All Breeds</option>
                        @php
                            $breeds = [
                                'Canine' => [
                                    'Aspin',
                                    'Poodle',
                                    'Shih Tzu',
                                    'Maltese',
                                    'Pug',
                                    'Beagle',
                                    'Cocker Spaniel',
                                    'Labrador Retriever',
                                    'German Shepherd',
                                    'Golden Retriever'
                                ],
                                'Feline' => [
                                    'Philippine Domestic Cat',
                                    'Siamese',
                                    'Persian',
                                    'Maine Coon',
                                    'British Shorthair',
                                    'Ragdoll',
                                    'Bengal',
                                    'Scottish Fold',
                                    'Abyssinian',
                                    'Russian Blue'
                                ]
                            ];
                        @endphp
                        @if(isset($species) && $species && isset($breeds[$species]))
                            @foreach($breeds[$species] as $breedOption)
                                <option value="{{ $breedOption }}" {{ ($breed ?? '') === $breedOption ? 'selected' : '' }}>{{ $breedOption }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <!-- Gender -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                    <select name="gender" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">All Genders</option>
                        <option value="male" {{ ($gender ?? '') === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ ($gender ?? '') === 'female' ? 'selected' : '' }}>Female</option>
                        <option value="unknown" {{ ($gender ?? '') === 'unknown' ? 'selected' : '' }}>Unknown</option>
                    </select>
                </div>

                <!-- Color -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Color Markings</label>
                    <div class="mt-1 grid grid-cols-5 gap-2">
                        @php
                            $colors = ['Black', 'White', 'Brown', 'Gray', 'Orange'];
                        @endphp
                        @foreach($colors as $colorOption)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="selectedColors[]" value="{{ $colorOption }}" @if(in_array($colorOption, $selectedColors ?? [])) checked @endif class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm">{{ $colorOption }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-end space-x-2">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Filter</button>
                    <a href="{{ route('admin.pet-registrations.index', array_filter(['registration_status' => $currentRegistrationStatus ?? null])) }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Clear</a>
                </div>
            </form>
        </div>

        {{-- Status Filter Tabs --}}
        <div class="border-b border-gray-200 mb-6">
            <nav class="flex space-x-4 overflow-x-auto pb-2">
                @foreach($statuses as $label => $status)
                    <a href="{{ route('admin.pet-registrations.index', ['registration_status' => $status]) }}"
                       class="@if($currentRegistrationStatus === $status) border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 @endif whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                       {{ $label }}
                    </a>
                @endforeach
            </nav>
        </div>

        {{-- Pet Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pet ID</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">(Photo) Name</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Species</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Breed</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owner</th>
                        <th class="px-6 py-3 bg-gray-50">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($pets as $index => $pet)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $pet->display_pet_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($pet->photo)
                                        <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->pet_name }}" class="w-10 h-10 mr-3 rounded-full object-cover">
                                    @else
                                        <div class="w-10 h-10 mr-3 bg-gray-200 rounded-full flex items-center justify-center">
                                            <span class="text-xs text-gray-500">No Photo</span>
                                        </div>
                                    @endif
                                    <span class="text-sm font-medium text-gray-900">{{ $pet->pet_name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pet->species }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pet->breed }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pet->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $pet->user->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.pet-registrations.show', $pet) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">View</a>
                                @if($pet->status === 'pending')
                                    <form method="POST" action="{{ route('admin.pet-registrations.approve', $pet) }}" onsubmit="return confirm('Are you sure you want to register this pet?')" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-900 mr-3">Register</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.pet-registrations.deny', $pet) }}" onsubmit="return confirm('Are you sure you want to deny this pet registration?')" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-900 mr-3">Deny</button>
                                    </form>
                                @endif
                                <form method="POST" action="{{ route('admin.pet-registrations.destroy', $pet) }}" onsubmit="return confirm('Are you sure you want to delete this pet registration? This action cannot be undone.')" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-gray-500">No pet registrations found for the status: **{{ $pageTitle }}**.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Links --}}
        <div class="mt-4">
            {{ $pets->withQueryString()->links() }}
        </div>
    </div>

</div>
@endsection
