@extends('layouts.admin')

@section('title', '| Admin - My Profile Settings')

@section('content')
<div class="max-w-4xl px-4 py-6 mx-auto">
    <h1 class="mb-6 text-3xl font-bold text-gray-900">My Profile Settings</h1>

    <!-- Profile Information Section -->
    <div class="mb-6 bg-white rounded-lg shadow-sm">
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Personal Information</h2>
            <button onclick="toggleEditMode()" id="edit-btn"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors rounded-md bg-blue-600 hover:bg-blue-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L15.232 5.232z"></path>
                </svg>
                Edit Profile
            </button>
        </div>

        <!-- View Mode -->
        <div id="view-mode" class="p-4">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                <!-- Personal Information -->
                <div class="space-y-3">
                    <h4 class="text-sm font-semibold tracking-wide text-gray-700 uppercase">Personal Info</h4>
                    <div>
                        <label class="block text-xs font-medium text-gray-500">Full Name</label>
                        <p class="text-sm text-gray-900">{{ $user->first_name ?? $user->name }} {{ $user->middle_name ?? '' }} {{ $user->last_name ?? '' }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500">Gender</label>
                        <p class="text-sm text-gray-900">{{ ucfirst($user->gender ?? 'Not specified') }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500">Birthday</label>
                        <p class="text-sm text-gray-900">{{ $user->birthday ? $user->birthday->format('M d, Y') : 'Not specified' }}</p>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="space-y-3">
                    <h4 class="text-sm font-semibold tracking-wide text-gray-700 uppercase">Contact</h4>
                    <div>
                        <label class="block text-xs font-medium text-gray-500">Email</label>
                        <p class="text-sm text-gray-900">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500">Contact Number</label>
                        <p class="text-sm text-gray-900">{{ $user->contact_number ?? 'Not specified' }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500">Emergency Contact</label>
                        <p class="text-sm text-gray-900">{{ $user->emergency_contact ?? 'Not specified' }}</p>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="space-y-3">
                    <h4 class="text-sm font-semibold tracking-wide text-gray-700 uppercase">Address</h4>
                    <div>
                        <label class="block text-xs font-medium text-gray-500">Street</label>
                        <p class="text-sm text-gray-900">{{ $user->street ?? 'Not specified' }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500">Barangay</label>
                        <p class="text-sm text-gray-900">{{ $user->barangay ?? 'Not specified' }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500">City/Municipality</label>
                        <p class="text-sm text-gray-900">{{ $user->city_municipality ?? 'Not specified' }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Province</label>
                            <p class="text-sm text-gray-900">{{ $user->province ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">ZIP Code</label>
                            <p class="text-sm text-gray-900">{{ $user->zip_code ?? 'N/A' }}</p>
                        </div>
                    </div>
                    @if($user->id_photo)
                    <div class="pt-2 border-t border-gray-200">
                        <label class="block text-xs font-medium text-gray-500">ID Photo</label>
                        <div onclick="openIdPhotoModal()"
                             class="inline-flex items-center p-2 mt-2 transition-colors duration-200 bg-orange-100 rounded-lg cursor-pointer hover:bg-orange-200">
                            <svg class="w-6 h-6 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                            </svg>
                            <span class="font-medium">View ID Photo</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Edit Mode -->
        <div id="edit-mode" class="hidden p-4 border-t border-gray-200">
            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('patch')

                <!-- Name Fields -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">First Name *</label>
                        <input type="text" name="first_name" value="{{ $user->first_name ?? $user->name }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Middle Name</label>
                        <input type="text" name="middle_name" value="{{ $user->middle_name }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Last Name *</label>
                        <input type="text" name="last_name" value="{{ $user->last_name }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                </div>

                <!-- Personal Info -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Gender</label>
                        <select name="gender" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                            <option value="">Select Gender</option>
                            <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ $user->gender === 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Birthday *</label>
                        <input type="date" name="birthday" value="{{ $user->birthday ? $user->birthday->format('Y-m-d') : '' }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Email Address *</label>
                        <input type="email" name="email" value="{{ $user->email }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Contact Number *</label>
                        <input type="tel" name="contact_number" value="{{ $user->contact_number }}" required placeholder="09123456789"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Emergency Contact</label>
                        <input type="tel" name="emergency_contact" value="{{ $user->emergency_contact }}" placeholder="09123456789"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                </div>

                <!-- Address -->
                <div class="space-y-3">
                    <h4 class="text-sm font-semibold tracking-wide text-gray-700 uppercase">Address Information</h4>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Province</label>
                            <select name="province" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                                <option value="Pangasinan" selected>Pangasinan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">City/Municipality</label>
                            <select name="city_municipality" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                                <option value="Alaminos City" selected>Alaminos City</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Barangay</label>
                            <select name="barangay" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                                <option value="">Select Barangay</option>
                                <option value="Alos" {{ $user->barangay === 'Alos' ? 'selected' : '' }}>Alos</option>
                                <option value="Amandiego" {{ $user->barangay === 'Amandiego' ? 'selected' : '' }}>Amandiego</option>
                                <option value="Amangbangan" {{ $user->barangay === 'Amangbangan' ? 'selected' : '' }}>Amangbangan</option>
                                <option value="Balangobong" {{ $user->barangay === 'Balangobong' ? 'selected' : '' }}>Balangobong</option>
                                <option value="Balayang" {{ $user->barangay === 'Balayang' ? 'selected' : '' }}>Balayang</option>
                                <option value="Baleyadaan" {{ $user->barangay === 'Baleyadaan' ? 'selected' : '' }}>Baleyadaan</option>
                                <option value="Bisocol" {{ $user->barangay === 'Bisocol' ? 'selected' : '' }}>Bisocol</option>
                                <option value="Bolaney" {{ $user->barangay === 'Bolaney' ? 'selected' : '' }}>Bolaney</option>
                                <option value="Bued" {{ $user->barangay === 'Bued' ? 'selected' : '' }}>Bued</option>
                                <option value="Cabatuan" {{ $user->barangay === 'Cabatuan' ? 'selected' : '' }}>Cabatuan</option>
                                <option value="Cayucay" {{ $user->barangay === 'Cayucay' ? 'selected' : '' }}>Cayucay</option>
                                <option value="Dulacac" {{ $user->barangay === 'Dulacac' ? 'selected' : '' }}>Dulacac</option>
                                <option value="Inerangan" {{ $user->barangay === 'Inerangan' ? 'selected' : '' }}>Inerangan</option>
                                <option value="Landoc" {{ $user->barangay === 'Landoc' ? 'selected' : '' }}>Landoc</option>
                                <option value="Linmansangan" {{ $user->barangay === 'Linmansangan' ? 'selected' : '' }}>Linmansangan</option>
                                <option value="Lucap" {{ $user->barangay === 'Lucap' ? 'selected' : '' }}>Lucap</option>
                                <option value="Maawi" {{ $user->barangay === 'Maawi' ? 'selected' : '' }}>Maawi</option>
                                <option value="Macatiw" {{ $user->barangay === 'Macatiw' ? 'selected' : '' }}>Macatiw</option>
                                <option value="Magsaysay" {{ $user->barangay === 'Magsaysay' ? 'selected' : '' }}>Magsaysay</option>
                                <option value="Mona" {{ $user->barangay === 'Mona' ? 'selected' : '' }}>Mona</option>
                                <option value="Palamis" {{ $user->barangay === 'Palamis' ? 'selected' : '' }}>Palamis</option>
                                <option value="Pandan" {{ $user->barangay === 'Pandan' ? 'selected' : '' }}>Pandan</option>
                                <option value="Pangapisan" {{ $user->barangay === 'Pangapisan' ? 'selected' : '' }}>Pangapisan</option>
                                <option value="Pocal-pocal" {{ $user->barangay === 'Pocal-pocal' ? 'selected' : '' }}>Pocal-pocal</option>
                                <option value="Poblacion" {{ $user->barangay === 'Poblacion' ? 'selected' : '' }}>Poblacion</option>
                                <option value="Pogo" {{ $user->barangay === 'Pogo' ? 'selected' : '' }}>Pogo</option>
                                <option value="Polo" {{ $user->barangay === 'Polo' ? 'selected' : '' }}>Polo</option>
                                <option value="Quibuar" {{ $user->barangay === 'Quibuar' ? 'selected' : '' }}>Quibuar</option>
                                <option value="Sabangan" {{ $user->barangay === 'Sabangan' ? 'selected' : '' }}>Sabangan</option>
                                <option value="San Antonio" {{ $user->barangay === 'San Antonio' ? 'selected' : '' }}>San Antonio</option>
                                <option value="San Jose" {{ $user->barangay === 'San Jose' ? 'selected' : '' }}>San Jose</option>
                                <option value="San Roque" {{ $user->barangay === 'San Roque' ? 'selected' : '' }}>San Roque</option>
                                <option value="San Vicente" {{ $user->barangay === 'San Vicente' ? 'selected' : '' }}>San Vicente</option>
                                <option value="Sta Maria" {{ $user->barangay === 'Sta Maria' ? 'selected' : '' }}>Sta Maria</option>
                                <option value="Tanaytay" {{ $user->barangay === 'Tanaytay' ? 'selected' : '' }}>Tanaytay</option>
                                <option value="Tangcarang" {{ $user->barangay === 'Tangcarang' ? 'selected' : '' }}>Tangcarang</option>
                                <option value="Tawin-tawin" {{ $user->barangay === 'Tawin-tawin' ? 'selected' : '' }}>Tawin-tawin</option>
                                <option value="Telbang" {{ $user->barangay === 'Telbang' ? 'selected' : '' }}>Telbang</option>
                                <option value="Victoria" {{ $user->barangay === 'Victoria' ? 'selected' : '' }}>Victoria</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Street</label>
                            <input type="text" name="street" value="{{ $user->street }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                        </div>
                    </div>
                    <div class="md:w-1/2">
                        <label class="block mb-1 text-sm font-medium text-gray-700">ZIP Code</label>
                        <select name="zip_code" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                            <option value="2404" selected>2404</option>
                        </select>
                    </div>
                </div>

                <!-- ID Photo Upload -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">ID Photo</label>
                    <input type="file" name="id_photo" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <p class="mt-1 text-xs text-gray-500">Upload a clear photo of your government-issued ID (max 50MB)</p>
                    @if($user->id_photo)
                        <div class="mt-2">
                            <p class="mb-2 text-xs text-green-600">✓ Current ID photo:</p>
                            <img src="{{ asset('storage/' . $user->id_photo) }}" alt="Current ID Photo"
                                 class="h-auto max-w-xs border border-gray-300 rounded">
                        </div>
                    @else
                        <p class="mt-1 text-xs text-gray-500">No ID photo uploaded yet.</p>
                    @endif
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="submit"
                            class="px-6 py-2 font-medium text-white transition-colors rounded-md bg-blue-600 hover:bg-blue-700">
                        Save Changes
                    </button>
                    <button type="button" onclick="toggleEditMode()"
                            class="px-6 py-2 font-medium text-white transition-colors bg-gray-600 hover:bg-gray-700">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Password Change Section -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">Change Password</h2>
                <p class="mt-1 text-sm text-gray-600">Update your account password for security</p>
            </div>
            <button onclick="togglePasswordMode()" id="password-btn"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors rounded-md bg-red-600 hover:bg-red-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L15.232 5.232z"></path>
                </svg>
                Change Password
            </button>
        </div>

        <div id="password-mode" class="hidden p-4">
            <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                @csrf
                @method('put')

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Current Password *</label>
                        <input type="password" name="current_password" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div></div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">New Password *</label>
                        <input type="password" name="password" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Confirm New Password *</label>
                        <input type="password" name="password_confirmation" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                </div>

                <button type="submit"
                        class="px-6 py-2 font-medium text-white transition-colors bg-red-600 rounded-md hover:bg-red-700">
                    Update Password
                </button>
            </form>
        </div>
    </div>
</div>

<!-- ID Photo Modal -->
@if($user->id_photo)
<div id="idPhotoModal"
     class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 transition-opacity duration-300 bg-black bg-opacity-80"
     onclick="if(event.target.id === 'idPhotoModal') this.classList.add('hidden')">

    <div class="relative max-w-3xl overflow-hidden bg-white rounded-lg shadow-2xl">

        <div class="sticky top-0 z-10 flex items-center justify-between p-3 bg-white border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-800">Your ID Photo</h3>
            <button onclick="document.getElementById('idPhotoModal').classList.add('hidden')"
                    class="p-2 text-gray-500 transition duration-150 rounded-full hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-6 max-h-[80vh] overflow-y-auto">
            <img src="{{ asset('storage/' . $user->id_photo) }}"
                 alt="Full Size ID Photo"
                 class="w-full h-auto rounded-lg shadow-md">
        </div>

    </div>
</div>
@endif

<script>
@if($user->id_photo)
document.addEventListener('keydown', function(event) {
    if (event.key === 'Backspace') {
        const modal = document.getElementById('idPhotoModal');
        if (modal && !modal.classList.contains('hidden')) {
            modal.classList.add('hidden');
            return;
        }
    }

    if (event.key === 'Escape') {
        const modal = document.getElementById('idPhotoModal');
        if (modal) {
            modal.classList.add('hidden');
        }
    }
});
@endif

function toggleEditMode() {
    const viewMode = document.getElementById('view-mode');
    const editMode = document.getElementById('edit-mode');
    const editBtn = document.getElementById('edit-btn');

    if (viewMode.classList.contains('hidden')) {
        viewMode.classList.remove('hidden');
        editMode.classList.add('hidden');
        editBtn.innerHTML = `
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L15.232 5.232z"></path>
            </svg>
            Edit Profile
        `;
    } else {
        viewMode.classList.add('hidden');
        editMode.classList.remove('hidden');
        editBtn.innerHTML = `
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            Cancel Edit
        `;
    }
}

function openIdPhotoModal() {
    document.getElementById('idPhotoModal').classList.remove('hidden');
}

function closeIdPhotoModal() {
    document.getElementById('idPhotoModal').classList.add('hidden');
}

function togglePasswordMode() {
    const passwordMode = document.getElementById('password-mode');
    const passwordBtn = document.getElementById('password-btn');

    if (passwordMode.classList.contains('hidden')) {
        passwordMode.classList.remove('hidden');
        passwordBtn.innerHTML = `
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            Cancel
        `;
    } else {
        passwordMode.classList.add('hidden');
        passwordBtn.innerHTML = `
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L15.232 5.232z"></path>
            </svg>
            Change Password
        `;
    }
}
</script>
@endsection
