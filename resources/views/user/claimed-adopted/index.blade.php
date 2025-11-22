@extends('layouts.app')

@section('title', '| Claimed or Adopted Pets')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                <h1 class="text-3xl font-bold text-white">🐾 Claimed & Adopted Pets</h1>
                <p class="text-blue-100 mt-2">Pets that were marked claimed or adopted and completed for your account.</p>
            </div>

            {{-- Visible tab bar under the header --}}
            <div class="px-8 py-4 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <nav class="bg-white rounded-md shadow-sm p-1 flex items-center space-x-1">
                            <a href="{{ route('user.adopted-claimed-pets') }}" class="px-4 py-2 text-sm rounded-md {{ empty($tab) ? 'bg-blue-50 text-blue-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">All</a>
                            <a href="{{ route('user.adopted-claimed-pets', ['tab' => 'adopted']) }}" class="px-4 py-2 text-sm rounded-md {{ ($tab === 'adopted') ? 'bg-blue-50 text-blue-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">Adopted</a>
                            <a href="{{ route('user.adopted-claimed-pets', ['tab' => 'claimed']) }}" class="px-4 py-2 text-sm rounded-md {{ ($tab === 'claimed') ? 'bg-blue-50 text-blue-700 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">Claimed</a>
                        </nav>
                    </div>

                    <div>
                        <a href="{{ route('user.adopted-claimed-pets') }}" class="bg-gray-600 text-white px-6 py-3 rounded-xl hover:bg-gray-700 transition duration-200 font-semibold shadow-lg hover:shadow-xl">
                            🔄 Refresh
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @php
            $isAll = empty($tab);
        @endphp

        {{-- If server returned only one tab, render grid directly; otherwise split --}}
        @if($isAll)
            @php
                $adopted = $pets->filter(fn($p) => $p->status === 'adopted');
                $claimed = $pets->filter(fn($p) => $p->status === 'claimed');
            @endphp

            @if($adopted->count() > 0)
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold mb-4">Adopted Pets</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($adopted as $pet)
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden border hover:shadow-xl transition duration-300">
                                @if($pet->photo)
                                    <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <div class="text-center">
                                            <span class="text-4xl">🐾</span>
                                            <p class="text-gray-500 text-sm mt-2">No Photo</p>
                                        </div>
                                    </div>
                                @endif

                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="text-xl font-bold text-gray-900">{{ $pet->display_code }}</h3>
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">Adopted</span>
                                    </div>

                                    <p class="text-sm text-gray-600 mb-2">{{ ucfirst($pet->species) }} - {{ $pet->breed ?: 'Unknown' }}</p>
                                    <p class="text-sm text-gray-500 mb-3">{{ $pet->estimated_age_years ? $pet->estimated_age_years . 'y' : '' }} {{ $pet->estimated_age_months ? $pet->estimated_age_months . 'm' : '' }}</p>

                                    <div class="flex space-x-2">
                                        <a href="{{ route('user.adopted-claimed-pets.show', $pet) }}" class="flex-1 bg-purple-600 text-white py-2 rounded text-center hover:bg-purple-700 transition duration-200 text-sm">View</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($claimed->count() > 0)
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold mb-4">Claimed Pets</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($claimed as $pet)
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden border hover:shadow-xl transition duration-300">
                                @if($pet->photo)
                                    <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <div class="text-center">
                                            <span class="text-4xl">🐾</span>
                                            <p class="text-gray-500 text-sm mt-2">No Photo</p>
                                        </div>
                                    </div>
                                @endif

                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="text-xl font-bold text-gray-900">{{ $pet->display_code }}</h3>
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-200">Claimed</span>
                                    </div>

                                    <p class="text-sm text-gray-600 mb-2">{{ ucfirst($pet->species) }} - {{ $pet->breed ?: 'Unknown' }}</p>
                                    <p class="text-sm text-gray-500 mb-3">{{ $pet->estimated_age_years ? $pet->estimated_age_years . 'y' : '' }} {{ $pet->estimated_age_months ? $pet->estimated_age_months . 'm' : '' }}</p>

                                    <div class="flex space-x-2">
                                        <a href="{{ route('user.adopted-claimed-pets.show', $pet) }}" class="flex-1 bg-purple-600 text-white py-2 rounded text-center hover:bg-purple-700 transition duration-200 text-sm">View</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @else
            {{-- Server returned only the selected tab's pets --}}
            <div class="mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($pets as $pet)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border hover:shadow-xl transition duration-300">
                            @if($pet->photo)
                                <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <div class="text-center">
                                        <span class="text-4xl">🐾</span>
                                        <p class="text-gray-500 text-sm mt-2">No Photo</p>
                                    </div>
                                </div>
                            @endif

                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $pet->display_code }}</h3>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $pet->status === 'adopted' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-blue-100 text-blue-800 border border-blue-200' }}">{{ ucfirst($pet->status) }}</span>
                                </div>

                                <p class="text-sm text-gray-600 mb-2">{{ ucfirst($pet->species) }} - {{ $pet->breed ?: 'Unknown' }}</p>
                                <p class="text-sm text-gray-500 mb-3">{{ $pet->estimated_age_years ? $pet->estimated_age_years . 'y' : '' }} {{ $pet->estimated_age_months ? $pet->estimated_age_months . 'm' : '' }}</p>

                                <div class="flex space-x-2">
                                    <a href="{{ route('user.adopted-claimed-pets.show', $pet) }}" class="flex-1 bg-purple-600 text-white py-2 rounded text-center hover:bg-purple-700 transition duration-200 text-sm">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($pets->count() == 0)
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <p class="text-gray-500 mb-4">You haven't claimed or adopted any pets yet.</p>
                <a href="{{ route('pets.adoptable') }}" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Browse Adoptable Pets</a>
            </div>
        @endif

        @if($pets->hasPages())
            <div class="mt-8">
                {{ $pets->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
