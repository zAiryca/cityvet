@extends('layouts.admin')

@section('title', '| Admin - Pets')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    @php
        // Define the possible statuses for the navigation tabs
        $statuses = [
            'All Pets' => null, // Link with no status filter
            'Adoptable' => 'adoptable',
            'Impounded' => 'impounded',
            'Claimed' => 'claimed',
            'Adopted' => 'adopted',
            'Unclaimed' => 'unclaimed',
            'Unadopted' => 'unadopted',
        ];

        // Define a readable title using universally supported if/elseif logic
        $pageTitle = 'All Pets'; // Default title
        if (isset($currentStatus)) { // Check if the variable exists and is not null
            if ($currentStatus === 'impounded') {
                $pageTitle = 'Impounded Pets';
            } elseif ($currentStatus === 'adoptable') {
                $pageTitle = 'Adoptable Pets';
            } elseif ($currentStatus === 'adopted') {
                $pageTitle = 'Adopted Pets';
            } elseif ($currentStatus === 'claimed') {
                $pageTitle = 'Claimed Pets';
            } elseif ($currentStatus === 'unclaimed') {
                $pageTitle = 'Unclaimed Pets';
            } elseif ($currentStatus === 'unadopted') {
                $pageTitle = 'Unadopted Pets';
            }
        }
    @endphp

    <div class="p-6 bg-white rounded-lg shadow-md">

        {{-- Dynamic Header and Create Button --}}
        <div class="flex items-center justify-between mb-6">
            {{-- This heading will now show the correct, dynamic title --}}
            <h1 class="text-3xl font-bold text-gray-800">{{ $pageTitle }}</h1>

            <a href="{{ route('admin.pets.create') }}"
               class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25">
                Add New Pet
            </a>
        </div>

        {{-- Status Filter Tabs --}}
        <div class="mb-6 border-b border-gray-200">
            <nav class="flex pb-2 space-x-4 overflow-x-auto">
                @foreach ($statuses as $label => $statusValue)
                    <a href="{{ route('admin.pets.index', ['status' => $statusValue]) }}"
                       class="@if(isset($currentStatus) && $currentStatus === $statusValue) border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 @endif whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                        {{ $label }}
                    </a>
                @endforeach
            </nav>
        </div>



        @if($pets->count() > 0)
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Species/Breed</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Impounded/Adopt Date</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pets as $pet)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $pet->display_code }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img src="{{ $pet->photo ? asset('storage/' . $pet->photo) : 'https://via.placeholder.com/40?text=' . substr($pet->display_code, 0, 1) }}" alt="{{ $pet->display_code }}" class="w-10 h-10 mr-4 rounded-full">
                                        <span class="font-medium">{{ $pet->display_code }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $pet->species }} / {{ $pet->breed }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        @if($pet->status === 'impounded') bg-red-100 text-red-800
                                        @elseif($pet->status === 'adoptable') bg-green-100 text-green-800
                                        @elseif($pet->status === 'unclaimed') bg-gray-100 text-gray-800
                                        @elseif($pet->status === 'unadopted') bg-gray-100 text-gray-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ ucfirst($pet->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $pet->impounded_date ? $pet->impounded_date->format('M d, Y') : ($pet->adoptable_date ? $pet->adoptable_date->format('M d, Y') : 'N/A') }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                    <a href="{{ route('admin.pets.show', $pet) }}" class="mr-4 text-indigo-600 hover:text-indigo-900">View</a>
                                    <a href="{{ route('admin.pets.edit', $pet) }}" class="mr-4 text-indigo-600 hover:text-indigo-900">Edit</a>
                                    @if($pet->status === 'impounded')
                                        <form action="{{ route('admin.pets.mark-claimed', $pet) }}" method="POST" class="inline mr-2">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900" onclick="return confirm('Mark this pet as claimed?')">Mark Claimed</button>
                                        </form>
                                    @elseif($pet->status === 'adoptable')
                                        <form action="{{ route('admin.pets.mark-adopted', $pet) }}" method="POST" class="inline mr-2">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900" onclick="return confirm('Mark this pet as adopted?')">Mark Adopted</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.pets.destroy', $pet) }}" method="POST" class="inline ml-4">
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
            <p class="py-8 text-center text-gray-500">No pets found for the status: **{{ $pageTitle }}**.</p>
        @endif
    </div>
</div>
@endsection
