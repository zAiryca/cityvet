@extends('layouts.admin')

@section('title', '| Pet Registration Details')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Pet Registration Details</h1>
        <div class="flex space-x-2">
            @if($pet->status === 'pending')
                <form method="POST" action="{{ route('admin.pet-registrations.approve', $pet) }}" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Approve & Register
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.pet-registrations.deny', $pet) }}" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to deny this registration?')">
                        Deny
                    </button>
                </form>
            @endif
            <form method="POST" action="{{ route('admin.pet-registrations.destroy', $pet) }}" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this registration?')">
                    Delete
                </button>
            </form>
            <a href="{{ route('admin.pet-registrations.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pet Information -->
                <div>
                    <h4 class="text-md font-semibold mb-4">Pet Information</h4>
                    <div class="space-y-3">
                        <div>
                            <strong>Name:</strong> {{ $pet->pet_name }}
                        </div>
                        <div>
                            <strong>Species:</strong> {{ $pet->species }}
                        </div>
                        <div>
                            <strong>Breed:</strong> {{ $pet->breed }}
                        </div>
                        <div>
                            <strong>Birth Date:</strong> {{ $pet->birthday ? $pet->birthday->format('M d, Y') : 'N/A' }}
                        </div>
                        <div>
                            <strong>Gender:</strong> {{ ucfirst($pet->gender) }}
                        </div>
                        <div>
                            <strong>Color Markings:</strong> {{ is_array($pet->color_markings) ? implode(', ', $pet->color_markings) : $pet->color_markings }}
                        </div>
                        <div>
                            <strong>Description:</strong> {{ $pet->description ?: 'N/A' }}
                        </div>
                    </div>
                </div>

                <!-- Registration & Owner Information -->
                <div>
                    <h4 class="text-md font-semibold mb-4">Registration & Owner Information</h4>
                    <div class="space-y-3">
                        <div>
                            <strong>Status:</strong>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($pet->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($pet->status === 'registered') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($pet->status) }}
                            </span>
                        </div>
                        <div>
                            <strong>Owner:</strong> {{ $pet->user->name }}
                        </div>
                        <div>
                            <strong>Owner Email:</strong> {{ $pet->user->email }}
                        </div>
                        <div>
                            <strong>Submitted:</strong> {{ $pet->created_at->format('M d, Y H:i') }}
                        </div>
                        <div>
                            <strong>Last Updated:</strong> {{ $pet->updated_at->format('M d, Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>

            @if($pet->photo)
                <div class="mt-6">
                    <h4 class="text-md font-semibold mb-4">Photo</h4>
                    <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->pet_name }}" class="max-w-xs rounded-lg shadow-md">
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
