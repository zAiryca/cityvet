@extends('layouts.app')

@section('title', '| All Pets')

@section('content')
<div class="px-4 pt-24 pb-8 mx-auto max-w-7xl" style="font-family: 'Poppins', sans-serif;">
    <h1 class="mb-6 text-3xl font-bold text-center text-gray-900" style="font-family: 'Poppins', sans-serif;">Our Pets</h1>

    @if($pets->count() > 0)
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($pets as $pet)
                <div class="overflow-hidden transition-shadow duration-300 bg-white border border-gray-100 rounded-lg shadow-lg hover:shadow-xl">
                    <img src="{{ $pet->photo ? asset('storage/' . $pet->photo) : 'https://via.placeholder.com/300x200?text=' . $pet->display_code }}" alt="{{ $pet->display_code }}" class="object-cover w-full h-48">
                    <div class="p-6">
                        <h3 class="mb-2 text-xl font-bold text-gray-900" style="font-family: 'Poppins', sans-serif;">{{ $pet->display_code }}</h3>
                        <p class="mb-3 text-gray-600" style="font-family: 'Poppins', sans-serif;">{{ ucfirst($pet->species) }} • {{ $pet->breed ?: 'Unknown' }} • {{ $pet->estimated_age_years ? $pet->estimated_age_years . 'y' : '' }} {{ $pet->estimated_age_months ? $pet->estimated_age_months . 'm' : '' }}</p>
                        @if($pet->status === 'adoptable')
                            <span class="inline-block px-3 py-1 text-sm font-semibold text-white bg-green-500 rounded-full">
                                {{ ucfirst($pet->status) }}
                            </span>
                        @elseif($pet->status === 'impounded')
                            <span class="inline-block px-3 py-1 text-sm font-semibold text-white bg-red-500 rounded-full">
                                {{ ucfirst($pet->status) }}
                            </span>
                        @elseif($pet->status === 'claimed')
                            <span class="inline-block px-3 py-1 text-sm font-semibold text-white bg-blue-500 rounded-full">
                                {{ ucfirst($pet->status) }}
                            </span>
                        @else
                            <span class="inline-block px-3 py-1 text-sm font-semibold text-white bg-gray-500 rounded-full">
                                {{ ucfirst($pet->status) }}
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $pets->links() }}
        </div>
    @else
        <p class="py-8 text-center text-gray-500" style="font-family: 'Poppins', sans-serif;">There are no pets listed.</p>
    @endif
</div>
@endsection
