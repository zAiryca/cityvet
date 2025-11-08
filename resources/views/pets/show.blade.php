@extends('layouts.app')

@section('title', '| ' . $pet->name)

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Pet Images Gallery -->
        <div class="relative">
            @if($pet->photo)
                <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->name }}" class="w-full h-96 object-cover">
            @else
                <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500 text-xl">No Photo Available</span>
                </div>
            @endif
        </div>

        <div class="p-8">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $pet->name }}</h1>
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <h2 class="text-xl font-semibold mb-4">Pet Details</h2>
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
                        @endif
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date Added:</span>
                            <span class="font-medium">{{ $pet->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-semibold mb-4">Description</h2>
                    <p class="text-gray-700 leading-relaxed">{{ $pet->description ?? 'No description available.' }}</p>
                </div>
            </div>

            <!-- Action Button -->
            <div class="border-t pt-8">
                @auth
                    @if($pet->status === 'adoptable')
                        <button onclick="openAdoptModal()" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-semibold text-lg transition duration-200">
                            Adopt {{ $pet->name }}
                        </button>
                    @elseif($pet->status === 'impounded')
                        <button onclick="openClaimModal()" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-semibold text-lg transition duration-200">
                            Claim {{ $pet->name }}
                        </button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold text-lg inline-block transition duration-200">
                        Login to {{ $pet->status === 'adoptable' ? 'Adopt' : 'Claim' }}
                    </a>
                @endauth

                <a href="{{ route('pets.' . $pet->status) }}" class="ml-4 text-gray-600 hover:text-gray-800 font-medium">
                    ← Back to {{ ucfirst($pet->status) }} Pets
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Adoption Modal -->
<div id="adoptModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-4/5 lg:w-3/4 shadow-lg rounded-md bg-white max-h-[90vh] overflow-y-auto">
        <div class="mt-3">
            <h3 class="text-xl font-bold text-gray-900 mb-4 text-center">City of [City Name] - City Veterinary Department</h3>
            <h4 class="text-lg font-semibold text-gray-800 mb-6 text-center">Pet Adoption Application Form</h4>
            <p class="text-sm text-gray-600 mb-6 text-center">Thank you for your interest in adopting! Please fill out this form completely and honestly.</p>

            <form action="{{ route('pets.request', $pet) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="adopt">

                <!-- Section 1: Adopter's Information -->
                <div class="mb-8">
                    <h5 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Section 1: Adopter's Information</h5>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <input type="text" name="last_name" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <input type="text" name="first_name" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
                            <input type="text" name="middle_name" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Complete Address (House No., Street, Barangay, City)</label>
                        <input type="text" name="address" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                            <input type="tel" name="contact_number" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" name="email" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth (MM/DD/YYYY)</label>
                        <input type="date" name="date_of_birth" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                </div>

                <!-- Section 2: Household Information -->
                <div class="mb-8">
                    <h5 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Section 2: Household Information</h5>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">1. Type of Dwelling:</label>
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
                        <label class="block text-sm font-medium text-gray-700 mb-2">2. If you rent, do you have your landlord's permission to keep a pet?</label>
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
                        <label class="block text-sm font-medium text-gray-700 mb-2">3. Is your property securely fenced or gated?</label>
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

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">4. How many people live in your home? Adults (18+)</label>
                            <input type="number" name="adults_count" min="1" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Children (under 18)</label>
                            <input type="number" name="children_count" min="0" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">5. Is anyone in your household allergic to animals?</label>
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
                        <label class="block text-sm font-medium text-gray-700 mb-2">6. Do you currently have other pets?</label>
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
                        <label class="block text-sm font-medium text-gray-700 mb-1">7. If yes, please list them (e.g., "1 Dog, 5 y/o, vaccinated"; "2 Cats, vaccinated")</label>
                        <textarea name="other_pets_list" rows="3" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">8. Where will this pet primarily live?</label>
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
                        <label class="block text-sm font-medium text-gray-700 mb-1">9. Please briefly explain why you would like to adopt a pet</label>
                        <textarea name="reason" rows="4" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                    </div>
                </div>

                <!-- Section 3: Adoption Agreement -->
                <div class="mb-8">
                    <h5 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Section 3: Adoption Agreement</h5>
                    <p class="text-sm text-gray-600 mb-4">By submitting this application, I understand and agree to the following:</p>
                    <ul class="text-sm text-gray-700 mb-4 space-y-1">
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
                    <label class="block text-sm font-medium text-gray-700 mb-2">Home Environment Photos (Optional - 2-3 photos)</label>
                    <input type="file" name="photos[]" multiple accept="image/*" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <p class="text-sm text-gray-500 mt-1">Upload photos of your home environment to help us assess suitability.</p>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeAdoptModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-md hover:bg-green-700 font-semibold">Submit Adoption Application</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Claim Modal -->
<div id="claimModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-4/5 lg:w-3/4 shadow-lg rounded-md bg-white max-h-[90vh] overflow-y-auto">
        <div class="mt-3">
            <h3 class="text-xl font-bold text-gray-900 mb-4 text-center">City of [City Name] - City Veterinary Department</h3>
            <h4 class="text-lg font-semibold text-gray-800 mb-6 text-center">Impounded Pet Claim Form</h4>
            <p class="text-sm text-gray-600 mb-6 text-center">Please use this form to start the process of reclaiming your impounded pet. After submission, a staff member will contact you to verify your ownership and provide details on the total fees and the schedule for release.</p>
            <p class="text-sm text-red-600 mb-6 text-center font-medium">Note: Pets not claimed within the mandatory holding period (e.g., 3 days) may be placed for adoption.</p>

            <form action="{{ route('pets.request', $pet) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="claim">

                <!-- Section 1: Owner's Information -->
                <div class="mb-8">
                    <h5 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Section 1: Owner's Information</h5>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <input type="text" name="last_name" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <input type="text" name="first_name" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
                            <input type="text" name="middle_name" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Complete Address (House No., Street, Barangay, City)</label>
                        <input type="text" name="address" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                            <input type="tel" name="contact_number" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" name="email" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Proof of Ownership -->
                <div class="mb-8">
                    <h5 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Section 2: Proof of Ownership</h5>
                    <p class="text-sm text-gray-600 mb-4">Please upload at least one (1) proof of ownership:</p>
                    <p class="text-sm text-gray-700 mb-4">(Examples: Pet's vaccination/medical record, clear photos of you with your pet, barangay pet registration.)</p>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload Proof Documents/Photos</label>
                        <input type="file" name="photos[]" multiple accept="image/*,.pdf,.doc,.docx" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <p class="text-sm text-gray-500 mt-1">Upload photos showing you with the pet or other proof of ownership. At least one file is required.</p>
                    </div>
                </div>

                <!-- Section 3: Owner's Affidavit and Agreement -->
                <div class="mb-8">
                    <h5 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Section 3: Owner's Affidavit and Agreement</h5>
                    <p class="text-sm text-gray-600 mb-4">By submitting this claim, I understand and agree to the following:</p>
                    <ul class="text-sm text-gray-700 mb-4 space-y-1">
                        <li>• I declare under penalty of law that I am the true and legal owner of the pet described above.</li>
                        <li>• I understand that my pet was impounded for violating city ordinances (e.g., being a "stray animal").</li>
                        <li>• I agree to pay all corresponding Impounding Fees as mandated by the city ordinance before my pet is released.</li>
                        <li>• I promise to keep my pet securely within my property and will not allow it to roam freely in public again.</li>
                        <li>• I agree to have my pet vaccinated against Rabies (if not up-to-date) as a condition of its release and will cover any associated costs.</li>
                    </ul>

                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="checkbox" name="certify_info" required class="mr-2">
                            I certify that all information in this application is true and correct.
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="agree_terms" required class="mr-2">
                            I have read and agree to all terms for claiming my pet.
                        </label>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeClaimModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-md hover:bg-red-700 font-semibold">Submit Claim Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
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

// Close modals when clicking outside
window.onclick = function(event) {
    const adoptModal = document.getElementById('adoptModal');
    const claimModal = document.getElementById('claimModal');

    if (event.target === adoptModal) {
        closeAdoptModal();
    }
    if (event.target === claimModal) {
        closeClaimModal();
    }
}
</script>
@endsection
