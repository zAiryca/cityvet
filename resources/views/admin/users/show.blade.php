@extends('layouts.admin')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <!-- Back Button at Top -->
    <div class="mb-6">
        <a href="javascript:void(0)" onclick="history.back()" class="bg-gray-500 text-white hover:bg-gray-700 px-4 py-2 rounded">
            Back
        </a>
    </div>

    <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <div class="p-6 bg-white lg:p-8">
            <h2 class="mb-8 text-3xl font-bold text-gray-900">User Profile</h2>

            <!-- User Information Section -->
            <div class="mb-8">
                <h3 class="pb-3 mb-6 text-2xl font-bold text-gray-900 border-b-2 border-indigo-500">Profile Information</h3>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <!-- First Name -->
                    <div class="p-4 rounded-lg bg-gray-50">
                        <p class="text-sm font-medium tracking-wide text-gray-600 uppercase">First Name</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $user->first_name }}</p>
                    </div>

                    <!-- Middle Name -->
                    <div class="p-4 rounded-lg bg-gray-50">
                        <p class="text-sm font-medium tracking-wide text-gray-600 uppercase">Middle Name</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $user->middle_name ?? 'N/A' }}</p>
                    </div>

                    <!-- Last Name -->
                    <div class="p-4 rounded-lg bg-gray-50">
                        <p class="text-sm font-medium tracking-wide text-gray-600 uppercase">Last Name</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $user->last_name }}</p>
                    </div>

                    <!-- Email -->
                    <div class="p-4 rounded-lg bg-gray-50">
                        <p class="text-sm font-medium tracking-wide text-gray-600 uppercase">Email</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900 break-all">{{ $user->email }}</p>
                    </div>

                    <!-- Contact Number -->
                    <div class="p-4 rounded-lg bg-gray-50">
                        <p class="text-sm font-medium tracking-wide text-gray-600 uppercase">Contact Number</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $user->contact_number ?? 'N/A' }}</p>
                    </div>

                    <!-- Emergency Contact -->
                    <div class="p-4 rounded-lg bg-gray-50">
                        <p class="text-sm font-medium tracking-wide text-gray-600 uppercase">Emergency Contact</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $user->emergency_contact ?? 'N/A' }}</p>
                    </div>

                    <!-- Role -->
                    <div class="p-4 rounded-lg bg-gray-50">
                        <p class="text-sm font-medium tracking-wide text-gray-600 uppercase">Role</p>
                        <p class="mt-2">
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </p>
                    </div>

                    <!-- Verification Status -->
                    <div class="p-4 rounded-lg bg-gray-50">
                        <p class="text-sm font-medium tracking-wide text-gray-600 uppercase">Verification Status</p>
                        <p class="mt-2">
                            @if($user->email_verified_at)
                                <span class="inline-flex px-3 py-1 text-sm font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                    ✓ Verified
                                </span>
                            @else
                                <span class="inline-flex px-3 py-1 text-sm font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                    ✗ Not Verified
                                </span>
                            @endif
                        </p>
                    </div>

                    <!-- Member Since -->
                    <div class="p-4 rounded-lg bg-gray-50">
                        <p class="text-sm font-medium tracking-wide text-gray-600 uppercase">Member Since</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">{{ $user->created_at->format('M j, Y') }}</p>
                    </div>
                </div>

                <!-- Address and ID Photo Row -->
                <div class="grid grid-cols-1 gap-6 mt-6 lg:grid-cols-5">
                    <!-- ID Photo (Left Side - 1 column) -->
                    <div class="p-3 border border-gray-200 rounded-lg shadow-sm bg-gray-50">
                        <h4 class="mb-2 text-xs font-semibold tracking-wider text-gray-700 uppercase">Identity Verification</h4>

                        <div class="flex flex-col items-center justify-center">

                            @if($user->id_photo)
                                <div onclick="document.getElementById('idPhotoModal').classList.remove('hidden')"
                                     class="flex flex-col items-center justify-center w-24 h-24 transition duration-150 ease-in-out bg-black border-4 border-gray-400 rounded-lg cursor-pointer hover:bg-gray-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.75 4h2.5a2 2 0 011.664.89l.812 1.22a2 2 0 001.664.89H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center w-24 h-24 transition duration-150 ease-in-out bg-gray-200 border-4 border-gray-400 rounded-lg cursor-pointer hover:bg-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.75 4h2.5a2 2 0 011.664.89l.812 1.22a2 2 0 001.664.89H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <p class="mt-1 text-xs font-medium text-gray-700">No Photo</p>
                                </div>
                            @endif

                            @if($user->id_photo)
                                <p class="mt-2 text-xs font-medium text-indigo-600 cursor-pointer hover:text-indigo-800"
                                   onclick="document.getElementById('idPhotoModal').classList.remove('hidden')">
                                   Click to Verify
                                </p>
                            @else
                                <p class="mt-2 text-xs font-medium text-gray-400">No ID Photo</p>
                            @endif
                        </div>
                    </div>

                    @if($user->id_photo)
                    <!-- Modal for Full Size ID Photo -->
                    <div id="idPhotoModal"
                         class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 transition-opacity duration-300 bg-black bg-opacity-80"
                         onclick="if(event.target.id === 'idPhotoModal') this.classList.add('hidden')">

                        <div class="relative max-w-3xl overflow-hidden bg-white rounded-lg shadow-2xl">

                            <div class="sticky top-0 z-10 flex items-center justify-between p-3 bg-white border-b border-gray-200">
                                <h3 class="text-xl font-semibold text-gray-800">User ID Photo Verification</h3>
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

                    <!-- Full Address (Right Side - spans 4 columns) -->
                    <div class="p-4 rounded-lg bg-gray-50 lg:col-span-4">
                        <p class="mb-2 text-sm font-medium tracking-wide text-gray-600 uppercase">Full Address</p>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ collect([
                                $user->street ?? null,
                                $user->barangay ?? null,
                                $user->city_municipality ?? null,
                                $user->province ?? null,
                                $user->zip_code ?? null
                            ])->filter()->implode(', ') ?: 'N/A' }}
                        </p>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

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
</script>
@endsection
