@extends('layouts.admin')

@section('title', 'Pet Registrations Management')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">

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

    <div class="p-6 bg-white rounded-lg shadow-md">

        {{-- Dynamic Header --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $pageTitle }}</h1>
        </div>

        {{-- Search and Filter Form --}}
        <div class="p-4 mb-6 rounded-lg bg-gray-50">
            <form method="GET" action="{{ route('admin.pet-registrations.index') }}" class="grid grid-cols-1 gap-4 md:grid-cols-4 lg:grid-cols-6">
                @if(isset($currentRegistrationStatus))
                    <input type="hidden" name="registration_status" value="{{ $currentRegistrationStatus }}">
                @endif

                <!-- Search -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Search Pet ID</label>
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Pet ID..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- Species -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Species</label>
                    <select name="species" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">All Species</option>
                        <option value="Canine" {{ ($species ?? '') === 'Canine' ? 'selected' : '' }}>Canine</option>
                        <option value="Feline" {{ ($species ?? '') === 'Feline' ? 'selected' : '' }}>Feline</option>
                    </select>
                </div>

                <!-- Breed -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Breed</label>
                    <select name="breed" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
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
                    <label class="block mb-1 text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">All Genders</option>
                        <option value="male" {{ ($gender ?? '') === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ ($gender ?? '') === 'female' ? 'selected' : '' }}>Female</option>
                        <option value="unknown" {{ ($gender ?? '') === 'unknown' ? 'selected' : '' }}>Unknown</option>
                    </select>
                </div>

                <!-- Color -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Color Markings</label>
                    <div class="grid grid-cols-5 gap-2 mt-1">
                        @php
                            $colors = ['Black', 'White', 'Brown', 'Gray', 'Orange'];
                        @endphp
                        @foreach($colors as $colorOption)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="selectedColors[]" value="{{ $colorOption }}" @if(in_array($colorOption, $selectedColors ?? [])) checked @endif class="text-indigo-600 border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm">{{ $colorOption }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-end space-x-2">
                    <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700">Filter</button>
                    <a href="{{ route('admin.pet-registrations.index', array_filter(['registration_status' => $currentRegistrationStatus ?? null])) }}" class="px-4 py-2 text-white bg-gray-500 rounded-md hover:bg-gray-600">Clear</a>
                </div>
            </form>
        </div>

        {{-- Status Filter Tabs --}}
        <div class="mb-6 border-b border-gray-200">
            <nav class="flex pb-2 space-x-4 overflow-x-auto">
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
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">#</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">Pet ID</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">Photo / Name</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">Species</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">Breed</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">Date</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">Status</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">Owner</th>
                        <th class="px-6 py-3 bg-gray-50">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($pets as $index => $pet)
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $pet->display_pet_id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($pet->photo)
                                        <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->pet_name }}" class="object-cover w-10 h-10 mr-3 rounded-full">
                                    @else
                                        <div class="flex items-center justify-center w-10 h-10 mr-3 bg-gray-200 rounded-full">
                                            <span class="text-xs text-gray-500">No Photo</span>
                                        </div>
                                    @endif
                                    <span class="text-sm font-medium text-gray-900">{{ $pet->pet_name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $pet->species }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $pet->breed }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $pet->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm whitespace-nowrap">
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
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $pet->user->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
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
