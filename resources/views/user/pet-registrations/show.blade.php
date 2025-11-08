<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pet Pre-Registration Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">{{ $pet->name }}</h3>
                        <div class="flex space-x-2">
                            @if($pet->registration_status === 'pre-registered')
                                <a href="{{ route('pet-registrations.edit', $pet) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('pet-registrations.destroy', $pet) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this pre-registration?')">
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
                            <h4 class="text-md font-semibold mb-4">Pet Information</h4>
                            <div class="space-y-3">
                                <div>
                                    <strong>Name:</strong> {{ $pet->name }}
                                </div>
                                <div>
                                    <strong>Species:</strong> {{ $pet->species }}
                                </div>
                                <div>
                                    <strong>Breed:</strong> {{ $pet->breed }}
                                </div>
                                <div>
                                    <strong>Birth Date:</strong> {{ $pet->birth_date ? $pet->birth_date->format('M d, Y') : 'N/A' }}
                                </div>
                                <div>
                                    <strong>Gender:</strong> {{ $pet->gender }}
                                </div>
                                <div>
                                    <strong>Color Markings:</strong> {{ $pet->color_markings }}
                                </div>
                                <div>
                                    <strong>Description:</strong> {{ $pet->description ?: 'N/A' }}
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-md font-semibold mb-4">Registration Status</h4>
                            <div class="space-y-3">
                                <div>
                                    <strong>Status:</strong>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($pet->registration_status === 'pre-registered') bg-yellow-100 text-yellow-800
                                        @elseif($pet->registration_status === 'approved') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst(str_replace('-', ' ', $pet->registration_status)) }}
                                    </span>
                                </div>
                                @if($pet->admin_notes)
                                    <div>
                                        <strong>Admin Notes:</strong>
                                        <p class="mt-1 text-sm text-gray-600">{{ $pet->admin_notes }}</p>
                                    </div>
                                @endif
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
                            <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->name }}" class="max-w-xs rounded-lg shadow-md">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
