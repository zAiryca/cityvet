<div class="p-6 bg-white rounded-lg shadow">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold">Profile Information</h2>
        <button type="button" id="edit-profile-btn" class="px-4 py-2 text-white transition duration-200 bg-blue-600 rounded hover:bg-blue-700">
            Edit Profile
        </button>
    </div>

    <div class="space-y-6">
        <!-- Name Section -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div>
                <label class="block text-sm font-medium text-gray-700">First Name</label>
                <p class="mt-1 text-gray-900">{{ Auth::user()->first_name ?: 'Not provided' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                <p class="mt-1 text-gray-900">{{ Auth::user()->middle_name ?: 'Not provided' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Last Name</label>
                <p class="mt-1 text-gray-900">{{ Auth::user()->last_name ?: 'Not provided' }}</p>
            </div>
        </div>

        <!-- Gender and Birthday -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
                <label class="block text-sm font-medium text-gray-700">Gender</label>
                <p class="mt-1 text-gray-900">{{ Auth::user()->gender ? ucfirst(Auth::user()->gender) : 'Not provided' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Birthday</label>
                <p class="mt-1 text-gray-900">{{ Auth::user()->birthday ? Auth::user()->birthday->format('M d, Y') : 'Not provided' }}</p>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
                <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                <p class="mt-1 text-gray-900">{{ Auth::user()->contact_number ?: 'Not provided' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Emergency Contact Number</label>
                <p class="mt-1 text-gray-900">{{ Auth::user()->emergency_contact ?: 'Not provided' }}</p>
            </div>
        </div>

        <!-- Address Section -->
        <div class="space-y-4">
            <h3 class="text-lg font-medium text-gray-900">Address</h3>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Province</label>
                    <p class="mt-1 text-gray-900">{{ Auth::user()->province ?: 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">City/Municipality</label>
                    <p class="mt-1 text-gray-900">{{ Auth::user()->city_municipality ?: 'Not provided' }}</p>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Barangay</label>
                    <p class="mt-1 text-gray-900">{{ Auth::user()->barangay ?: 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Street</label>
                    <p class="mt-1 text-gray-900">{{ Auth::user()->street ?: 'Not provided' }}</p>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Zip Code</label>
                <p class="mt-1 text-gray-900">{{ Auth::user()->zip_code ?: 'Not provided' }}</p>
            </div>
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Email Address</label>
            <p class="mt-1 text-gray-900">{{ Auth::user()->email ?: 'Not provided' }}</p>
        </div>

        <!-- ID Photo -->
        <div>
            <label class="block text-sm font-medium text-gray-700">ID Photo</label>
            @if(Auth::user()->id_photo)
                <img src="{{ asset('storage/' . Auth::user()->id_photo) }}" alt="ID Photo" class="h-auto max-w-xs mt-1 border border-gray-300 rounded">
            @else
                <p class="mt-1 text-gray-500">No ID photo uploaded</p>
            @endif
        </div>
    </div>
</div>
