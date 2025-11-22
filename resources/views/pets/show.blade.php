@extends('layouts.app')

@section('title', '| ' . $pet->display_code)

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <div class="overflow-hidden bg-white rounded-lg shadow-lg">
        <div class="relative">
            @if($pet->photo)
                <img src="{{ $pet->photo ? asset('storage/' . $pet->photo) : 'https://via.placeholder.com/800x600?text=' . $pet->display_code }}" alt="{{ $pet->display_code }}" class="object-contain w-full h-96 md:h-[500px] bg-gray-100 p-4">
            @else
                <div class="flex items-center justify-center w-full bg-gray-200 h-96 md:h-[500px]">
                    <span class="text-xl text-gray-500">No Photo Available</span>
                </div>
            @endif
        </div>

        <div class="p-8">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h1 class="mb-2 text-3xl font-bold text-gray-900">{{ $pet->display_code }}</h1>
                    <p class="text-lg text-gray-600">{{ ucfirst($pet->species) }} • {{ ucfirst($pet->breed) }}</p>
                </div>
                <div class="text-right">
                    <span class="px-3 py-1 text-sm font-semibold rounded-full
                        {{ $pet->status === 'adoptable' ? 'bg-green-100 text-green-800' :
                           ($pet->status === 'impounded' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800') }}">
                        {{ ucfirst($pet->status) }}
                    </span>
                </div>
            </div>

            {{-- Updated Claim Flow wording for Impounded pets --}}
            @if($pet->status === 'impounded')
            <div class="p-6 mb-8 border border-red-300 rounded-lg bg-red-50">
                <h2 class="mb-4 text-2xl font-bold text-red-800">🚨 How to Claim an Impounded Pet</h2>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    <div class="text-center">
                        <div class="flex items-center justify-center w-10 h-10 mx-auto mb-2 text-xl font-bold text-white bg-red-600 rounded-full">1</div>
                        <p class="font-semibold text-red-700">Start the Claim</p>
                        <p class="text-sm text-gray-600">Click <strong>Claim Pet</strong> and complete the online claim form with your contact and ownership details.</p>
                    </div>
                    <div class="text-center">
                        <div class="flex items-center justify-center w-10 h-10 mx-auto mb-2 text-xl font-bold text-white bg-red-600 rounded-full">2</div>
                        <p class="font-semibold text-red-700">We Verify</p>
                        <p class="text-sm text-gray-600">Our team will review your information, contact you for verification, and advise any applicable fees or requirements.</p>
                    </div>
                    <div class="text-center">
                        <div class="flex items-center justify-center w-10 h-10 mx-auto mb-2 text-xl font-bold text-white bg-red-600 rounded-full">3</div>
                        <p class="font-semibold text-red-700">Complete Release</p>
                        <p class="text-sm text-gray-600">Visit the City Veterinary Department to complete paperwork, pay fees, and collect your pet once verified.</p>
                    </div>
                </div>
                <p class="p-3 mt-4 text-sm font-medium text-center text-red-800 bg-red-200 rounded-md">
                    ⚠️ Please submit your claim promptly. "Days Remaining" shows how long the current holding period lasts — if the period expires the pet may be moved to the adoptable list.
                </p>
            </div>
            @endif

            {{-- Updated Adoption Flow wording for Adoptable pets --}}
            @if($pet->status === 'adoptable')
            <div class="p-6 mb-8 border border-green-300 rounded-lg bg-green-50">
                <h2 class="mb-4 text-2xl font-bold text-green-800">✅ How to Adopt This Pet</h2>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <div class="text-center">
                        <div class="flex items-center justify-center w-10 h-10 mx-auto mb-2 text-xl font-bold text-white bg-green-600 rounded-full">1</div>
                        <p class="font-semibold text-green-700">Express Interest</p>
                        <p class="text-sm text-gray-600">Click <strong>Adopt</strong> and complete the adoption form to express your interest.</p>
                    </div>
                    <div class="text-center">
                        <div class="flex items-center justify-center w-10 h-10 mx-auto mb-2 text-xl font-bold text-white bg-green-600 rounded-full">2</div>
                        <p class="font-semibold text-green-700">Application Review</p>
                        <p class="text-sm text-gray-600">Our team reviews your submission to check basic eligibility and match with the pet's needs.</p>
                    </div>
                    <div class="text-center">
                        <div class="flex items-center justify-center w-10 h-10 mx-auto mb-2 text-xl font-bold text-white bg-green-600 rounded-full">3</div>
                        <p class="font-semibold text-green-700">Screening/Interview</p>
                        <p class="text-sm text-gray-600">We may schedule a short interview or home check to confirm a good fit.</p>
                    </div>
                    <div class="text-center">
                        <div class="flex items-center justify-center w-10 h-10 mx-auto mb-2 text-xl font-bold text-white bg-green-600 rounded-full">4</div>
                        <p class="font-semibold text-green-700">Finalize Adoption</p>
                        <p class="text-sm text-gray-600">If approved, complete adoption paperwork and arrange pickup with the department.</p>
                    </div>
                </div>
                <p class="p-3 mt-4 text-sm font-medium text-center text-green-800 bg-green-200 rounded-md">
                    💡 Tip: Completing the form online speeds up processing. The department will contact you about next steps if your application is shortlisted.
                </p>
            </div>
            @endif

            <div class="grid grid-cols-1 gap-8 mb-8 md:grid-cols-2">
                <div>
                    <h2 class="mb-4 text-xl font-semibold">Pet Details</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Gender:</span>
                            <span class="font-medium">{{ ucfirst($pet->gender) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Age:</span>
                            <span class="font-medium">{{ $pet->age ?? 'Unknown' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Color/Markings:</span>
                            <span class="font-medium">{{ $pet->color_markings ?? 'Not specified' }}</span>
                        </div>
                        @if($pet->status === 'impounded')
                            <div class="flex justify-between">
                                <span class="text-gray-600">Impounded Date:</span>
                                <span class="font-medium">{{ $pet->impounded_date ? $pet->impounded_date->format('M d, Y') : 'N/A' }}</span>
                            </div>
                        @elseif($pet->status === 'adoptable')
                            <div class="flex justify-between">
                                <span class="text-gray-600">Adoptable Date:</span>
                                <span class="font-medium">{{ $pet->created_at->format('M d, Y') }}</span>
                            </div>
                        @endif
                        @if($pet->remaining_days !== null)
                        <div class="flex justify-between">
                            <span class="text-gray-600">Days Remaining to Claim:</span>
                            <span class="font-medium {{ (int)$pet->remaining_days <= 1 ? 'text-red-600 font-bold' : 'text-orange-600' }}">{{ (int)$pet->remaining_days }} day{{ (int)$pet->remaining_days !== 1 ? 's' : '' }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date Added:</span>
                            <span class="font-medium">{{ $pet->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="mb-4 text-xl font-semibold">Description</h2>
                    <p class="leading-relaxed text-gray-700">{{ $pet->description ?? 'No description available.' }}</p>
                    @if($pet->status === 'impounded')
                        <div class="p-4 mt-4 border border-red-200 rounded-lg bg-red-50">
                            <h3 class="mb-2 text-lg font-semibold text-red-800">Important Claim Notice</h3>
                            <p class="text-red-700">This pet is currently **impounded**. If you are the rightful owner, please **submit a claim request** as soon as possible before the claim period expires and it becomes adoptable.</p>
                        </div>
                    @elseif($pet->status === 'adoptable')
                        <div class="p-4 mt-4 border border-green-200 rounded-lg bg-green-50">
                            <h3 class="mb-2 text-lg font-semibold text-green-800">Ready for Adoption</h3>
                            <p class="text-green-700">This pet is available for adoption. Fill out the adoption form to start the process. Must submit adoption form through system. Direct pickup not available.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="pt-8 border-t">
                @auth
                    @if($pet->status === 'adoptable')
                        <button onclick="openAdoptModal()" class="px-8 py-3 text-lg font-semibold text-white transition duration-200 bg-green-600 rounded-lg hover:bg-green-700">
                            Adopt {{ $pet->display_code }}
                        </button>
                    @elseif($pet->status === 'impounded')
                        <button onclick="openClaimModal()" class="px-8 py-3 text-lg font-semibold text-white transition duration-200 bg-red-600 rounded-lg hover:bg-red-700">
                            Claim {{ $pet->display_code }}
                        </button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="inline-block px-8 py-3 text-lg font-semibold text-white transition duration-200 bg-blue-600 rounded-lg hover:bg-blue-700">
                        Login to {{ $pet->status === 'adoptable' ? 'Adopt' : 'Claim' }}
                    </a>
                @endauth

                <a href="{{ route('pets.' . $pet->status) }}" class="ml-4 font-medium text-gray-600 hover:text-gray-800">
                    ← Back to {{ ucfirst($pet->status) }} Pets
                </a>
            </div>
        </div>
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
                            <input type="text" value="{{ auth()->user()->last_name ?? '' }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" value="{{ auth()->user()->first_name ?? '' }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Middle Name</label>
                            <input type="text" value="{{ auth()->user()->middle_name ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50" readonly>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Complete Address (House No., Street, Barangay, City)</label>
                        <input type="text" value="{{ (auth()->user()->street ?? '') . ', ' . (auth()->user()->barangay ?? '') . ', ' . (auth()->user()->city_municipality ?? '') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50" readonly>
                    </div>
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2">
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Contact Number</label>
                            <input type="tel" value="{{ auth()->user()->contact_number ?? '' }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" value="{{ auth()->user()->email ?? '' }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50" readonly>
                        </div>


                </div>
                    </div>
                    {{-- Hidden fields to pass auto-filled data to controller --}}
                    <input type="hidden" name="last_name" value="{{ auth()->user()->last_name ?? '' }}">
                    <input type="hidden" name="first_name" value="{{ auth()->user()->first_name ?? '' }}">
                    <input type="hidden" name="middle_name" value="{{ auth()->user()->middle_name ?? '' }}">
                    <input type="hidden" name="address" value="{{ (auth()->user()->street ?? '') . ', ' . (auth()->user()->barangay ?? '') . ', ' . (auth()->user()->city_municipality ?? '') }}">
                    <input type="hidden" name="contact_number" value="{{ auth()->user()->contact_number ?? '' }}">
                    <input type="hidden" name="email" value="{{ auth()->user()->email ?? '' }}">
                    <input type="hidden" name="birthday" value="{{ auth()->user()->birthday ?? '' }}">

                    @if(auth()->user()->id_photo)
                        <div class="mb-4">
                            <label class="block mb-1 text-sm font-medium text-gray-700">ID Photo</label>
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset('storage/' . auth()->user()->id_photo) }}" alt="Your ID Photo" class="object-cover w-24 h-16 border border-gray-300 rounded">
                                <span class="text-sm text-gray-600">Your uploaded ID photo will be used for verification.</span>
                            </div>
                        </div>
                        <input type="hidden" name="id_photo_path" value="{{ auth()->user()->id_photo }}">
                    @else
                        <div class="p-3 mb-4 border border-yellow-200 rounded bg-yellow-50">
                            <p class="text-sm text-yellow-800"><strong>Note:</strong> You haven't uploaded an ID photo yet. Please upload one in your <a href="{{ route('profile.edit') }}" class="text-blue-600 underline hover:text-blue-800">profile settings</a> for faster verification.</p>
                        </div>
                    @endif
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

{{-- CLAIM MODAL (Revised to be much simpler and only for claiming) --}}
@if($pet->status === 'impounded')
<div id="claimModal" class="fixed inset-0 z-50 hidden w-full h-full overflow-y-auto bg-gray-600 bg-opacity-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/5 lg:w-1/2 shadow-lg rounded-md bg-white max-h-[90vh] overflow-y-auto">
        <div class="mt-3">
            <h3 class="mb-4 text-xl font-bold text-center text-gray-900">City of Alaminos - City Veterinary Department</h3>
            <h4 class="mb-6 text-lg font-semibold text-center text-gray-800">Impounded Pet Claim Request</h4>
            <p class="mb-6 text-sm text-center text-gray-600">Please use this form to start the process of **reclaiming your impounded pet**. After submission, a staff member will contact you to verify your ownership, determine required fees/fines, and schedule the release.</p>
            <p class="mb-6 text-sm font-medium text-center text-red-600">Note: Pets not claimed within the mandatory holding period ({{ $pet->remaining_days ? (int)$pet->remaining_days : 'N/A' }} days remaining) will be placed for adoption.</p>

            <form action="{{ route('pets.request', $pet) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="claim">
                <input type="hidden" name="last_name" value="{{ auth()->user()->last_name ?? '' }}">
                <input type="hidden" name="first_name" value="{{ auth()->user()->first_name ?? '' }}">
                <input type="hidden" name="middle_name" value="{{ auth()->user()->middle_name ?? '' }}">
                <input type="hidden" name="address" value="{{ (auth()->user()->street ?? '') . ', ' . (auth()->user()->barangay ?? '') . ', ' . (auth()->user()->city_municipality ?? '') }}">
                <input type="hidden" name="contact_number" value="{{ auth()->user()->contact_number ?? '' }}">
                <input type="hidden" name="email" value="{{ auth()->user()->email ?? '' }}">
                @if(auth()->user()->id_photo)
                    <input type="hidden" name="id_photo_path" value="{{ auth()->user()->id_photo }}">
                @endif

                <div class="mb-8">
                    <h5 class="pb-2 mb-4 text-lg font-semibold text-gray-800 border-b">Section 1: Owner's Information</h5>
                    <div class="p-4 mb-4 border border-blue-200 rounded-lg bg-blue-50">
                        <p class="mb-2 text-sm text-blue-800"><strong>Note:</strong> Your profile information is auto-filled below. Please ensure it is up-to-date as this is what we will use to contact you.</p>
                    </div>
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" value="{{ auth()->user()->last_name ?? '' }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" value="{{ auth()->user()->first_name ?? '' }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Middle Name</label>
                            <input type="text" value="{{ auth()->user()->middle_name ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Complete Address</label>
                        <input type="text" value="{{ (auth()->user()->street ?? '') . ', ' . (auth()->user()->barangay ?? '') . ', ' . (auth()->user()->city_municipality ?? '') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" readonly>
                    </div>
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2">
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Contact Number</label>
                            <input type="tel" value="{{ auth()->user()->contact_number ?? '' }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" value="{{ auth()->user()->email ?? '' }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                    </div>

                    <h5 class="pb-2 mt-6 mb-4 text-lg font-semibold text-gray-800 border-b">Section 2: Proof of Ownership</h5>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">1. Describe the unique features of the pet (e.g., small scar near right eye, specific bark, behavioral trait) *Required for verification*</label>
                        <textarea name="proof_of_ownership_description" rows="3" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">2. Upload Proof of Ownership/Care (Optional but highly recommended)</label>
                        <input type="file" name="photos[]" multiple accept="image/*, .pdf" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                        <p class="mt-1 text-sm text-gray-500">Examples: Vet records, photo of you with the pet, barangay registration, etc.</p>
                    </div>

                    <div class="mb-4 space-y-3">
                        <label class="flex items-center">
                            <input type="checkbox" name="certify_info" required class="mr-2">
                            I certify that the information I provided in this claim request is true and correct.
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="agree_terms" required class="mr-2">
                            I have read and agree to the terms and procedures for reclaiming an impounded pet.
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
    function closeClaimModal() {
        document.getElementById('claimModal').classList.add('hidden');
    }
</script>
@endsection
