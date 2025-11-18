@extends('layouts.app')

@section('title', '| Pet Pre-Registration Details')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold">{{ $petRegistration->pet_name }}</h3>
                    <div class="flex space-x-2">
                        @if($petRegistration->status === 'pending')
                            <a href="{{ route('pet-registrations.edit', $petRegistration) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('pet-registrations.destroy', $petRegistration) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this registration?')">
                                    Delete
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('pet-registrations.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to List
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-md font-semibold mb-4">Owner Information</h4>
                        <div class="space-y-3">
                            <div>
                                <strong>Name:</strong> {{ $petRegistration->user->name }}
                            </div>
                            <div>
                                <strong>Email:</strong> {{ $petRegistration->user->email }}
                            </div>
                            <div>
                                <strong>Phone:</strong> {{ $petRegistration->user->phone ?? 'Not provided' }}
                            </div>
                            <div>
                                <strong>Address:</strong> {{ $petRegistration->user->address ?? 'Not provided' }}
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-md font-semibold mb-4">Registration Status</h4>
                        <div class="space-y-3">
                            <div>
                                <strong>Status:</strong>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($petRegistration->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($petRegistration->status === 'registered') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($petRegistration->status) }}
                                </span>
                            </div>
                            <div>
                                <strong>Submitted:</strong> {{ $petRegistration->created_at->format('M d, Y H:i') }}
                            </div>
                            <div>
                                <strong>Last Updated:</strong> {{ $petRegistration->updated_at->format('M d, Y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <h4 class="text-md font-semibold mb-4">Pet Information</h4>
                        <div class="space-y-3">
                            <div>
                                <strong>Name:</strong> {{ $petRegistration->pet_name }}
                            </div>
                            <div>
                                <strong>Species:</strong> {{ $petRegistration->species }}
                            </div>
                            <div>
                                <strong>Breed:</strong> {{ $petRegistration->breed }}
                            </div>
                            <div>
                                <strong>Birth Date:</strong> {{ $petRegistration->birthday ? $petRegistration->birthday->format('M d, Y') : 'N/A' }}
                            </div>
                            <div>
                                <strong>Gender:</strong> {{ ucfirst($petRegistration->gender) }}
                            </div>
                            <div>
                                <strong>Color Markings:</strong> {{ is_array($petRegistration->color_markings) ? implode(', ', $petRegistration->color_markings) : $petRegistration->color_markings }}
                            </div>
                            <div>
                                <strong>Description:</strong> {{ $petRegistration->description ?: 'N/A' }}
                            </div>
                        </div>
                    </div>
                </div>

                @if($petRegistration->photo)
                    <div class="mt-6">
                        <h4 class="text-md font-semibold mb-4">Photo</h4>
                        <img src="{{ asset('storage/' . $petRegistration->photo) }}" alt="{{ $petRegistration->pet_name }}" class="max-w-xs rounded-lg shadow-md">
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
