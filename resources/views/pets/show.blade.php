@extends('layouts.app')

@section('title', '| ' . $pet->display_code)

@section('content')
<div class="pt-28 pb-12 bg-gradient-to-b from-blue-50 to-white">
    <div class="px-4 mx-auto max-w-5xl">
        <!-- Header -->
        <div class="flex items-start justify-between mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $pet->display_code }}</h1>
                <p class="mt-2 text-gray-600">{{ ucfirst($pet->species) }} • {{ ucfirst($pet->breed) }}</p>
            </div>
            <span class="px-4 py-2 text-sm font-semibold rounded-full whitespace-nowrap ml-4
                {{ $pet->status === 'adoptable' ? 'bg-green-100 text-green-800' :
                   ($pet->status === 'impounded' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800') }}">
                {{ ucfirst($pet->status) }}
            </span>
        </div>

        <!-- Photo & Quick Info Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Photo Section -->
            <div class="md:col-span-1">
                <div class="overflow-hidden bg-white rounded-xl shadow-md h-64 flex items-center justify-center">
                    @if($pet->photo)
                        <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="w-full h-full object-cover">
                    @else
                        <div class="flex flex-col items-center justify-center w-full h-full">
                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-400">No photo</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Info Cards -->
            <div class="md:col-span-2 space-y-3">
                <div class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow">
                    <p class="text-xs text-gray-500 font-semibold uppercase">Species & Breed</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">{{ ucfirst($pet->species) }} — {{ ucfirst($pet->breed) }}</p>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow">
                        <p class="text-xs text-gray-500 font-semibold uppercase">Gender</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ ucfirst($pet->gender) }}</p>
                    </div>
                    <div class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow">
                        <p class="text-xs text-gray-500 font-semibold uppercase">Estimated Age</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">{{ $pet->estimated_age }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow">
                    <p class="text-xs text-gray-500 font-semibol
                    d uppercase">Markings</p>
                    <p class="text-base font-semibold text-gray-900 mt-1">{{ $pet->color_markings ?? 'Not specified' }}</p>
                </div>
            </div>
        </div>

        <!-- Status & Timeline -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Status Alert -->
            <div class="md:col-span-2">
                @if($pet->status === 'impounded')
                    <div class="bg-gradient-to-r from-red-50 to-red-100 border border-red-200 rounded-xl p-6">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-red-900">Currently Impounded</h3>
                                <p class="text-red-800 text-sm mt-1">
                                    <strong>{{ $pet->remaining_days ? (int)$pet->remaining_days : '0' }} days</strong> remaining to claim this pet
                                </p>
                                <p class="text-red-800 text-xs mt-2">If you're the owner, submit a claim with proof of ownership. After the deadline, this pet becomes available for adoption only.</p>
                                <p class="text-red-700 text-xs font-semibold mt-2">Claim Fee: ₱1,025 + ₱150/day if late</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Process -->
                    <div class="mt-4 bg-white rounded-xl p-4 shadow-sm border border-gray-200">
                        <p class="text-xs font-bold text-gray-700 mb-3">CLAIM PROCESS</p>
                        <div class="flex items-center justify-between gap-2">
                            <div class="flex flex-col items-center flex-1">
                                <div class="w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center text-sm font-bold">1</div>
                                <p class="text-xs text-gray-600 mt-1 text-center">Submit Form</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            <div class="flex flex-col items-center flex-1">
                                <div class="w-8 h-8 rounded-full bg-yellow-500 text-white flex items-center justify-center text-sm font-bold">2</div>
                                <p class="text-xs text-gray-600 mt-1 text-center">Review</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            <div class="flex flex-col items-center flex-1">
                                <div class="w-8 h-8 rounded-full bg-green-600 text-white flex items-center justify-center text-sm font-bold">3</div>
                                <p class="text-xs text-gray-600 mt-1 text-center">Pickup</p>
                            </div>
                        </div>
                    </div>
                @elseif($pet->status === 'adoptable')
                    <div class="bg-gradient-to-r from-green-50 to-green-100 border border-green-200 rounded-xl p-6">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h-2m0 0H10m2 0v2m0-2v-2m7 7h-4m0 0h-4m4 0v2m0-2v-2" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-green-900">Ready for Adoption</h3>
                                <p class="text-green-800 text-sm mt-1">This sweet pet is looking for a loving home! Complete the adoption application to get started.</p>
                                <p class="text-green-700 text-xs font-semibold mt-2">5-Step Adoption Process</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Process -->
                    <div class="mt-4 bg-white rounded-xl p-4 shadow-sm border border-gray-200">
                        <div class="flex items-center justify-between gap-1 text-xs">
                            <div class="flex flex-col items-center flex-1">
                                <div class="w-7 h-7 rounded-full bg-green-600 text-white flex items-center justify-center text-xs font-bold">1</div>
                                <p class="text-gray-600 mt-1 text-center">Apply</p>
                            </div>
                            <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            <div class="flex flex-col items-center flex-1">
                                <div class="w-7 h-7 rounded-full bg-green-600 text-white flex items-center justify-center text-xs font-bold">2</div>
                                <p class="text-gray-600 mt-1 text-center">Review</p>
                            </div>
                            <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            <div class="flex flex-col items-center flex-1">
                                <div class="w-7 h-7 rounded-full bg-yellow-500 text-white flex items-center justify-center text-xs font-bold">3</div>
                                <p class="text-gray-600 mt-1 text-center">Meet</p>
                            </div>
                            <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            <div class="flex flex-col items-center flex-1">
                                <div class="w-7 h-7 rounded-full bg-green-600 text-white flex items-center justify-center text-xs font-bold">4</div>
                                <p class="text-gray-600 mt-1 text-center">Verify</p>
                            </div>
                            <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            <div class="flex flex-col items-center flex-1">
                                <div class="w-7 h-7 rounded-full bg-green-600 text-white flex items-center justify-center text-xs font-bold">5</div>
                                <p class="text-gray-600 mt-1 text-center">Adopt!</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Timeline Sidebar -->
            <div class="bg-white rounded-xl p-6 shadow-md h-fit">
                <p class="text-xs font-bold text-gray-700 mb-4 uppercase">Timeline</p>
                <div class="space-y-3">
                    @if($pet->impounded_date)
                        <div class="flex gap-3">
                            <div class="w-2 h-2 rounded-full bg-red-500 mt-1.5 flex-shrink-0"></div>
                            <div>
                                <p class="text-xs text-gray-500">Impounded</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $pet->impounded_date->format('M d, Y') }}</p>
                            </div>
                        </div>
                    @endif

                    @if($pet->decision_date)
                        <div class="flex gap-3">
                            <div class="w-2 h-2 rounded-full bg-green-500 mt-1.5 flex-shrink-0"></div>
                            <div>
                                <p class="text-xs text-gray-500">Available</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $pet->decision_date->format('M d, Y') }}</p>
                            </div>
                        </div>
                    @endif

                    @if($pet->remaining_days !== null)
                        @php $days = max(0, (int)floor($pet->remaining_days)); @endphp
                        <div class="flex gap-3">
                            <div class="w-2 h-2 rounded-full {{ $days <= 1 ? 'bg-red-500' : 'bg-yellow-500' }} mt-1.5 flex-shrink-0"></div>
                            <div>
                                <p class="text-xs text-gray-500">Remaining</p>
                                <p class="text-sm font-semibold {{ $days <= 1 ? 'text-red-600' : 'text-gray-900' }}">{{ $days }} day{{ $days !== 1 ? 's' : '' }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="pt-2 border-t border-gray-200 flex gap-3">
                        <div class="w-2 h-2 rounded-full bg-gray-400 mt-1.5 flex-shrink-0"></div>
                        <div>
                            <p class="text-xs text-gray-500">Updated</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $pet->updated_at->format('M d') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description Section -->
        <div class="bg-white rounded-xl p-6 shadow-md mb-8">
            <h2 class="text-lg font-bold text-gray-900 mb-3">Description</h2>
            <p class="text-gray-700 leading-relaxed text-sm">{{ $pet->description ?? 'No description available.' }}</p>

            @if($pet->status === 'adoptable' && !$pet->impounded_date && $pet->adoption_reason)
                @php
                    $reasons = [
                        'surrendered_by_owner' => 'Surrendered by Owner',
                        'remained_unclaimed' => 'Remained Unclaimed',
                        'found_by_citizen' => 'Found by Citizen',
                    ];
                    $reason = $reasons[$pet->adoption_reason] ?? $pet->adoption_reason;
                @endphp
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-xs text-gray-500 font-semibold">How Available</p>
                    <p class="text-sm font-semibold text-gray-900 mt-1">{{ $reason }}</p>
                </div>
            @endif
        </div>

        <!-- Action Button -->
        <div class="mb-8 flex flex-wrap gap-3">
            @auth
                @if($pet->status === 'adoptable')
                    <button onclick="openAdoptModal()" class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg transition-colors shadow-md">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Start Adoption Application
                    </button>
                    <button onclick="openClaimModalFromAdoptable()" class="px-8 py-3 bg-orange-600 hover:bg-orange-700 text-white font-bold rounded-lg transition-colors shadow-md">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        This is My Pet - Claim It
                    </button>
                @elseif($pet->status === 'impounded')
                    <button onclick="openClaimModal()" class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition-colors shadow-md">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Submit Claim Request
                    </button>
                @endif
            @else
                <a href="{{ route('login') }}" class="inline-block px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition-colors shadow-md text-center">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Log In to Continue
                </a>
            @endauth
        </div>

        <!-- Back Link -->
        <a href="{{ route('pets.' . $pet->status) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-sm">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to {{ ucfirst($pet->status) }} Pets
        </a>
    </div>
</div>

@auth
{{-- ADOPT MODAL (Retained, but for adoptable pets) --}}
@if($pet->status === 'adoptable')
<div id="adoptModal" class="fixed inset-0 z-50 hidden w-full h-full overflow-y-auto bg-gray-600 bg-opacity-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-4/5 lg:w-3/4 shadow-lg rounded-md bg-white max-h-[90vh] overflow-y-auto">
        <div class="mt-3">
            <h3 class="mb-4 text-xl font-bold text-center text-gray-900">City of Alaminos - City Veterinary Department</h3>
            <h4 class="mb-6 text-lg font-semibold text-center text-gray-800">Pet Adoption Application Form</h4>
            <p class="mb-6 text-sm text-center text-gray-600">Thank you for your interest in adopting! Please fill out this form completely and honestly.</p>

            <form action="{{ route('pets.request', $pet) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="adopt">

                <div class="mb-8">
                    <h5 class="pb-2 mb-4 text-lg font-semibold text-gray-800 border-b">Section 1: Adopter's Information</h5>
                    <div class="p-4 mb-4 border border-blue-200 rounded-lg bg-blue-50">
                        <p class="mb-2 text-sm text-blue-800"><strong>Note:</strong> The information below is auto-filled from your profile. If you need to update your information, please go to your <a href="{{ route('profile.edit') }}" class="text-blue-600 underline hover:text-blue-800">profile settings</a> first.</p>
                    </div>
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Last Name</label>
                            <input name="last_name" type="text" value="{{ auth()->user()->last_name ?? '' }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">First Name</label>
                            <input name="first_name" type="text" value="{{ auth()->user()->first_name ?? '' }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Middle Name</label>
                            <input name="middle_name" type="text" value="{{ auth()->user()->middle_name ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50" readonly>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Complete Address (House No., Street, Barangay, City)</label>
                        <input name="address" type="text" value="{{ (auth()->user()->street ?? '') . ', ' . (auth()->user()->barangay ?? '') . ', ' . (auth()->user()->city_municipality ?? '') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50" readonly>
                    </div>
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2">
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Contact Number</label>
                            <input name="contact_number" type="tel" value="{{ auth()->user()->contact_number ?? '' }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Email Address</label>
                            <input name="email" type="email" value="{{ auth()->user()->email ?? '' }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50" readonly>
                        </div>


                </div>
                    </div>
                    {{-- Previously hidden fields removed: visible inputs now have names so values are submitted from profile fields. --}}

                    {{-- ID photo block moved below Date of Birth to match impounded form layout --}}
                    {{-- <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Date of Birth (MM/DD/YYYY)</label>
                        <input type="date" name="date_of_birth" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                </div> --}}
                <div>
    <label class="block mb-1 text-sm font-medium text-gray-700">Date of Birth (MM/DD/YYYY)</label>
    <input
        type="date"
        name="date_of_birth"
        value="{{ auth()->user()->birthday ? auth()->user()->birthday->format('Y-m-d') : '' }}"
        required
        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50"
        readonly
    >
</div>

                                    @if(auth()->user()->id_photo)
                                        <div class="mb-4">
                                            <label class="block mb-1 text-sm font-medium text-gray-700">ID Photo</label>
                                            <div onclick="document.getElementById('petsShowIdPhotoModal').classList.remove('hidden')"
                                                 class="flex flex-col items-center justify-center w-24 h-16 transition duration-150 ease-in-out bg-black border-2 border-gray-400 rounded cursor-pointer hover:bg-gray-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.75 4h2.5a2 2 0 011.664.89l.812 1.22a2 2 0 001.664.89H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>

                                            <!-- Modal for Full Size ID Photo -->
                                            <div id="petsShowIdPhotoModal"
                                                 class="fixed inset-0 z-50 items-center justify-center hidden p-4 transition-opacity duration-300 bg-black bg-opacity-80"
                                                 onclick="if(event.target.id === 'petsShowIdPhotoModal') this.classList.add('hidden')">
                                                <div class="relative max-w-3xl overflow-hidden bg-white rounded-lg shadow-2xl">
                                                    <div class="sticky top-0 z-10 flex items-center justify-between p-3 bg-white border-b border-gray-200">
                                                        <h3 class="text-xl font-semibold text-gray-800">Your ID Photo</h3>
                                                        <button onclick="document.getElementById('petsShowIdPhotoModal').classList.add('hidden')"
                                                                class="p-2 text-gray-500 transition duration-150 rounded-full hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="p-6 max-h-[80vh] overflow-y-auto">
                                                        <img src="{{ asset('storage/' . auth()->user()->id_photo) }}"
                                                             alt="Full Size ID Photo"
                                                             class="w-full h-auto rounded-lg shadow-md">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id_photo_path" value="{{ auth()->user()->id_photo }}">
                                    @else
                                        <div class="p-3 mb-4 border border-yellow-200 rounded bg-yellow-50">
                                            <p class="text-sm text-yellow-800"><strong>Note:</strong> You haven't uploaded an ID photo yet. Please upload one in your <a href="{{ route('profile.edit') }}" class="text-blue-600 underline hover:text-blue-800">profile settings</a> for faster verification.</p>
                                        </div>
                                    @endif

                <div class="mb-8">
                    <h5 class="pb-2 mb-4 text-lg font-semibold text-gray-800 border-b">Section 2: Household Information</h5>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">1. Type of Dwelling:</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="dwelling_type" value="owned" required class="mr-2">
                                Owned House
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="dwelling_type" value="rented" class="mr-2">
                                Rented House
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="dwelling_type" value="apartment" class="mr-2">
                                Apartment
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">2. If you rent, do you have your landlord's permission to keep a pet?</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="landlord_permission" value="yes" class="mr-2">
                                Yes
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="landlord_permission" value="no" class="mr-2">
                                No
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="landlord_permission" value="n/a" class="mr-2">
                                N/A (I own my home)
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">3. Is your property securely fenced or gated?</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="fenced_property" value="yes" required class="mr-2">
                                Yes
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="fenced_property" value="no" class="mr-2">
                                No
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2">
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">4. How many people live in your home? Adults (18+)</label>
                            <input type="number" name="adults_count" min="1" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Children (under 18)</label>
                            <input type="number" name="children_count" min="0" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">5. Is anyone in your household allergic to animals?</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="allergies" value="yes" required class="mr-2">
                                Yes
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="allergies" value="no" class="mr-2">
                                No
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="allergies" value="unsure" class="mr-2">
                                Unsure
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">6. Do you currently have other pets?</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="other_pets" value="yes" required class="mr-2">
                                Yes
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="other_pets" value="no" class="mr-2">
                                No
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">7. If yes, please list them (e.g., "1 Dog, 5 y/o, vaccinated"; "2 Cats, vaccinated")</label>
                        <textarea name="other_pets_list" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">8. Where will this pet primarily live?</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="pet_living_area" value="indoors" required class="mr-2">
                                Indoors only
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="pet_living_area" value="outdoors" class="mr-2">
                                Outdoors only
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="pet_living_area" value="both" class="mr-2">
                                Both indoors and outdoors
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">9. Please briefly explain why you would like to adopt a pet</label>
                        <textarea name="reason" rows="4" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                    </div>
                </div>

                <div class="mb-8">
                    <h5 class="pb-2 mb-4 text-lg font-semibold text-gray-800 border-b">Section 3: Adoption Agreement</h5>
                    <p class="mb-4 text-sm text-gray-600">By submitting this application, I understand and agree to the following:</p>
                    <ul class="mb-4 space-y-1 text-sm text-gray-700">
                        <li>• I will provide the adopted pet with proper shelter, sufficient food, clean water, and all necessary medical care (including veterinary visits).</li>
                        <li>• I will ensure the pet receives its annual Anti-Rabies vaccination and other required boosters.</li>
                        <li>• I will not keep the pet permanently caged or tethered on a short leash.</li>
                        <li>• If I can no longer care for the pet for any reason, I will return it to the City Veterinary Department and will NOT abandon it.</li>
                        <li>• I will abide by all provisions of Republic Act 8485 (The Animal Welfare Act) and Republic Act 8482 (The Anti-Rabies Act).</li>
                    </ul>

                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="checkbox" name="certify_info" required class="mr-2">
                            I certify that all information in this application is true and correct.
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="agree_terms" required class="mr-2">
                            I have read and agree to all terms of the Adoption Agreement.
                        </label>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Home Environment Photos (Optional - 2-3 photos)</label>
                    <input type="file" name="photos[]" multiple accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    <p class="mt-1 text-sm text-gray-500">Upload photos of your home environment to help us assess suitability.</p>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeAdoptModal()" class="px-4 py-2 text-gray-700 bg-gray-300 rounded-md hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-6 py-3 font-semibold text-white bg-green-600 rounded-md hover:bg-green-700">Submit Adoption Application</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

{{-- CLAIM MODAL FOR ADOPTABLE PETS (when user saw it late and wants to claim it) --}}
@if($pet->status === 'adoptable')
<div id="claimModalFromAdoptable" class="fixed inset-0 z-50 hidden w-full h-full overflow-y-auto bg-gray-600 bg-opacity-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-4/5 lg:w-3/4 shadow-lg rounded-md bg-white max-h-[90vh] overflow-y-auto">
        <div class="mt-3">
            <h3 class="mb-4 text-xl font-bold text-center text-gray-900">City of Alaminos - City Veterinary Department</h3>
            <h4 class="mb-6 text-lg font-semibold text-center text-gray-800">Claim Request Form</h4>
            <p class="mb-6 text-sm text-center text-gray-600">If this is your pet, please submit a claim with proof of ownership.</p>

            <div class="p-3 mb-4 border border-orange-200 rounded-lg bg-orange-50">
                <p class="text-xs text-orange-700 text-center"><strong>⏰ Late Discovery:</strong> This pet is now in our adoptable collection. Submit your claim with proof of ownership and the vet department will help sort this out.</p>
            </div>
            <div class="p-3 mb-4 border border-blue-200 rounded-lg bg-blue-50">
                <p class="text-xs text-blue-700 text-center"><strong>⚡ Quick Process:</strong> Submit this form (takes just 2 minutes!) and visit the vet department with your proofs for instant review.</p>
            </div>
            <p class="mb-4 text-sm text-center text-gray-600">Use the website to register your claim, then visit with your proofs for verification and resolution.</p>

            <form action="{{ route('pets.request', $pet) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="claim">

                <div class="mb-6">
                    <h5 class="pb-2 mb-3 text-base font-semibold text-gray-800 border-b">Section 1: Your Information</h5>
                    <p class="mb-3 text-xs text-gray-600">Your profile info is auto-filled. Review for accuracy.</p>
                    <div class="grid grid-cols-1 gap-3 mb-3 md:grid-cols-3">
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">Last Name</label>
                            <input name="last_name" type="text" value="{{ auth()->user()->last_name ?? '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">First Name</label>
                            <input name="first_name" type="text" value="{{ auth()->user()->first_name ?? '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">Middle Name</label>
                            <input name="middle_name" type="text" value="{{ auth()->user()->middle_name ?? '' }}" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1 text-xs font-medium text-gray-700">Address</label>
                        <input name="address" type="text" value="{{ (auth()->user()->street ?? '') . ', ' . (auth()->user()->barangay ?? '') . ', ' . (auth()->user()->city_municipality ?? '') }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                    </div>
                    <div class="grid grid-cols-1 gap-3 mb-3 md:grid-cols-2">
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">Contact</label>
                            <input name="contact_number" type="tel" value="{{ auth()->user()->contact_number ?? '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">Email</label>
                            <input name="email" type="email" value="{{ auth()->user()->email ?? '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1 text-xs font-medium text-gray-700">Date of Birth</label>
                        <input name="date_of_birth" type="date" value="{{ auth()->user()->birthday ? auth()->user()->birthday->format('Y-m-d') : '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                    </div>

                    @if(auth()->user()->id_photo)
                        <div class="mb-3">
                            <label class="block mb-1 text-xs font-medium text-gray-700">ID Photo</label>
                            <div onclick="document.getElementById('petsClaimIdPhotoModalAdoptable').classList.remove('hidden')"
                                 class="flex flex-col items-center justify-center w-20 h-14 transition duration-150 ease-in-out bg-black border-2 border-gray-400 rounded cursor-pointer hover:bg-gray-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.75 4h2.5a2 2 0 011.664.89l.812 1.22a2 2 0 001.664.89H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>

                            <!-- Modal for Full Size ID Photo -->
                            <div id="petsClaimIdPhotoModalAdoptable"
                                 class="fixed inset-0 z-50 items-center justify-center hidden p-4 transition-opacity duration-300 bg-black bg-opacity-80"
                                 onclick="if(event.target.id === 'petsClaimIdPhotoModalAdoptable') this.classList.add('hidden')">
                                <div class="relative max-w-3xl overflow-hidden bg-white rounded-lg shadow-2xl">
                                    <div class="sticky top-0 z-10 flex items-center justify-between p-3 bg-white border-b border-gray-200">
                                        <h3 class="text-lg font-semibold text-gray-800">Your ID Photo</h3>
                                        <button onclick="document.getElementById('petsClaimIdPhotoModalAdoptable').classList.add('hidden')"
                                                class="p-2 text-gray-500 transition duration-150 rounded-full hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="p-4 max-h-[80vh] overflow-y-auto">
                                        <img src="{{ asset('storage/' . auth()->user()->id_photo) }}"
                                             alt="ID Photo"
                                             class="w-full h-auto rounded-lg shadow-md">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_photo_path" value="{{ auth()->user()->id_photo }}">
                    @endif
                </div>

                <div class="mb-6">
                    <h5 class="pb-2 mb-3 text-base font-semibold text-gray-800 border-b">Section 2: Proof of Ownership</h5>
                    <div class="mb-3">
                        <label class="block mb-1 text-xs font-medium text-gray-700">Describe unique features of your pet</label>
                        <textarea name="proof_of_ownership_description" rows="2" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="E.g., scar, specific mark, behavioral trait..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1 text-xs font-medium text-gray-700">Upload proof (vet records, photos, barangay reg, etc.)</label>
                        <input type="file" name="photos[]" multiple accept="image/*, .pdf" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                    </div>

                    <div class="space-y-2 text-xs">
                        <label class="flex items-center">
                            <input type="checkbox" name="certify_info" required class="mr-2">
                            <span>I confirm all information is true</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="agree_terms" required class="mr-2">
                            <span>I understand the vet department will verify my claim</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeClaimModalFromAdoptable()" class="px-4 py-2 text-gray-700 bg-gray-300 rounded-md hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-6 py-3 font-semibold text-white bg-orange-600 rounded-md hover:bg-orange-700">Submit Claim Request</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

{{-- CLAIM MODAL (Revised to be much simpler and only for claiming) --}}
@if($pet->status === 'impounded')
<div id="claimModal" class="fixed inset-0 z-50 hidden w-full h-full overflow-y-auto bg-gray-600 bg-opacity-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/5 lg:w-1/2 shadow-lg rounded-md bg-white max-h-[90vh] overflow-y-auto">
        <div class="mt-3">
            <h3 class="mb-4 text-xl font-bold text-center text-gray-900">City of Alaminos - City Veterinary Department</h3>
            <h4 class="mb-2 text-lg font-semibold text-center text-gray-800">Quick Pet Claim Request</h4>
            <div class="p-3 mb-4 border border-red-200 rounded-lg bg-red-50">
                <p class="text-xs text-red-700 text-center"><strong>💰 Claim Fees:</strong> ₱1,025 base fine + ₱150/day if delayed beyond the deadline</p>
            </div>
            <div class="p-3 mb-4 border border-blue-200 rounded-lg bg-blue-50">
                <p class="text-xs text-blue-700 text-center"><strong>⚡ Quick Process:</strong> Submit this form (takes just 2 minutes!) and you can bring your proofs directly to the vet department. Admin will approve your request instantly.</p>
            </div>
            <p class="mb-4 text-sm text-center text-gray-600">No need to wait - use the website to register your claim, then visit with your proofs for instant approval and pet release.</p>

                <form action="{{ route('pets.request', $pet) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="claim">
                {{-- Visible fields below now include name attributes so values are submitted. Hidden duplicates removed. --}}

                <div class="mb-6">
                    <h5 class="pb-2 mb-3 text-base font-semibold text-gray-800 border-b">Section 1: Your Information</h5>
                    <p class="mb-3 text-xs text-gray-600">Your profile info is auto-filled. Review for accuracy.</p>
                    <div class="grid grid-cols-1 gap-3 mb-3 md:grid-cols-3">
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">Last Name</label>
                            <input name="last_name" type="text" value="{{ auth()->user()->last_name ?? '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">First Name</label>
                            <input name="first_name" type="text" value="{{ auth()->user()->first_name ?? '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">Middle Name</label>
                            <input name="middle_name" type="text" value="{{ auth()->user()->middle_name ?? '' }}" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1 text-xs font-medium text-gray-700">Address</label>
                        <input name="address" type="text" value="{{ (auth()->user()->street ?? '') . ', ' . (auth()->user()->barangay ?? '') . ', ' . (auth()->user()->city_municipality ?? '') }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                    </div>
                    <div class="grid grid-cols-1 gap-3 mb-3 md:grid-cols-2">
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">Contact</label>
                            <input name="contact_number" type="tel" value="{{ auth()->user()->contact_number ?? '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">Email</label>
                            <input name="email" type="email" value="{{ auth()->user()->email ?? '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1 text-xs font-medium text-gray-700">Date of Birth</label>
                        <input name="date_of_birth" type="date" value="{{ auth()->user()->birthday ? auth()->user()->birthday->format('Y-m-d') : '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                    </div>

                    @if(auth()->user()->id_photo)
                        <div class="mb-3">
                            <label class="block mb-1 text-xs font-medium text-gray-700">ID Photo</label>
                            <div onclick="document.getElementById('petsShowIdPhotoModal2').classList.remove('hidden')"
                                 class="flex flex-col items-center justify-center w-20 h-14 transition duration-150 ease-in-out bg-black border-2 border-gray-400 rounded cursor-pointer hover:bg-gray-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.75 4h2.5a2 2 0 011.664.89l.812 1.22a2 2 0 001.664.89H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>

                            <!-- Modal for Full Size ID Photo -->
                            <div id="petsShowIdPhotoModal2"
                                 class="fixed inset-0 z-50 items-center justify-center hidden p-4 transition-opacity duration-300 bg-black bg-opacity-80"
                                 onclick="if(event.target.id === 'petsShowIdPhotoModal2') this.classList.add('hidden')">
                                <div class="relative max-w-3xl overflow-hidden bg-white rounded-lg shadow-2xl">
                                    <div class="sticky top-0 z-10 flex items-center justify-between p-3 bg-white border-b border-gray-200">
                                        <h3 class="text-lg font-semibold text-gray-800">Your ID Photo</h3>
                                        <button onclick="document.getElementById('petsShowIdPhotoModal2').classList.add('hidden')"
                                                class="p-2 text-gray-500 transition duration-150 rounded-full hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="p-4 max-h-[80vh] overflow-y-auto">
                                        <img src="{{ asset('storage/' . auth()->user()->id_photo) }}"
                                             alt="ID Photo"
                                             class="w-full h-auto rounded-lg shadow-md">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_photo_path" value="{{ auth()->user()->id_photo }}">
                    @endif
                </div>

                <div class="mb-6">
                    <h5 class="pb-2 mb-3 text-base font-semibold text-gray-800 border-b">Section 2: Proof of Ownership</h5>
                    <div class="mb-3">
                        <label class="block mb-1 text-xs font-medium text-gray-700">Describe unique features of your pet</label>
                        <textarea name="proof_of_ownership_description" rows="2" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="E.g., scar, specific mark, behavioral trait..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1 text-xs font-medium text-gray-700">Upload proof (vet records, photos, barangay reg, etc.)</label>
                        <input type="file" name="photos[]" multiple accept="image/*, .pdf" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>

                    <div class="space-y-2 text-xs">
                        <label class="flex items-center">
                            <input type="checkbox" name="certify_info" required class="mr-2">
                            <span>I confirm all information is true</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="agree_terms" required class="mr-2">
                            <span>I understand I must pay the settlement fee (₱1,025 + daily charges if late) and visit the vet department to pick up my pet</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeClaimModal()" class="px-4 py-2 text-gray-700 bg-gray-300 rounded-md hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-6 py-3 font-semibold text-white bg-red-600 rounded-md hover:bg-red-700">Submit Claim Request</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endauth

<script>
    // Assuming you have these JavaScript functions to control the modals
    function openAdoptModal() {
        document.getElementById('adoptModal').classList.remove('hidden');
    }
    function closeAdoptModal() {
        document.getElementById('adoptModal').classList.add('hidden');
    }
    function openClaimModal() {
        document.getElementById('claimModal').classList.remove('hidden');
    }
    function openClaimModalFromAdoptable() {
        document.getElementById('claimModalFromAdoptable').classList.remove('hidden');
    }
    function closeClaimModal() {
        document.getElementById('claimModal').classList.add('hidden');
    }
    function closeClaimModalFromAdoptable() {
        document.getElementById('claimModalFromAdoptable').classList.add('hidden');
    }
</script>
@endsection
