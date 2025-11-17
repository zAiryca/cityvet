<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Profile Information</h2>
        <button type="button" id="edit-profile-btn" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
            Edit Profile
        </button>
    </div>

    <div class="space-y-6">
        <!-- Name Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Province</label>
                    <p class="mt-1 text-gray-900">{{ Auth::user()->province ?: 'Not provided' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">City/Municipality</label>
                    <p class="mt-1 text-gray-900">{{ Auth::user()->city_municipality ?: 'Not provided' }}</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
    </div>
</div>
