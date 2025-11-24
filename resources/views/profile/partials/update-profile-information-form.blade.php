<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form id="profile-update-form" method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-4">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" name="last_name" type="text" class="block w-full mt-1" :value="old('last_name', $user->last_name)" required autofocus autocomplete="family-name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <div>
            <x-input-label for="middle_name" :value="__('Middle Name')" />
            <x-text-input id="middle_name" name="middle_name" type="text" class="block w-full mt-1" :value="old('middle_name', $user->middle_name)" autocomplete="additional-name" />
            <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
        </div>

        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" name="first_name" type="text" class="block w-full mt-1" :value="old('first_name', $user->first_name)" required autocomplete="given-name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <div>
            <x-input-label for="gender" :value="__('Gender')" />
            <select id="gender" name="gender" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                <option value="">Select Gender</option>
                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>

        <div>
            <x-input-label for="birthday" :value="__('Birthday')" />
            <x-text-input id="birthday" name="birthday" type="date" class="block w-full mt-1" :value="old('birthday', $user->birthday ? $user->birthday->format('Y-m-d') : '')" required />
            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>

        <div>
            <x-input-label for="contact_number" :value="__('Contact Number')" />
            <x-text-input id="contact_number" name="contact_number" type="tel" class="block w-full mt-1" :value="old('contact_number', $user->contact_number)" required autocomplete="tel" maxlength="11" pattern="09[0-9]{9}" placeholder="09123456789" />
            <x-input-error class="mt-2" :messages="$errors->get('contact_number')" />
        </div>

        <div>
            <x-input-label for="emergency_contact" :value="__('Emergency Contact Number')" />
            <x-text-input id="emergency_contact" name="emergency_contact" type="tel" class="block w-full mt-1" :value="old('emergency_contact', $user->emergency_contact)" autocomplete="tel" maxlength="11" pattern="09[0-9]{9}" placeholder="09123456789" />
            <x-input-error class="mt-2" :messages="$errors->get('emergency_contact')" />
        </div>

        <div class="mt-6 space-y-6">
            <h3 class="text-lg font-medium text-gray-900">Address</h3>

            <div>
                <x-input-label for="province" :value="__('Province')" />
                <x-text-input id="province" name="province" type="text" class="block w-full mt-1" :value="$user->province ?? 'Pangasinan'" readonly />
            </div>

            <div>
                <x-input-label for="city_municipality" :value="__('City/Municipality')" />
                <x-text-input id="city_municipality" name="city_municipality" type="text" class="block w-full mt-1" :value="'Alaminos City'" readonly />
            </div>

            <div>
                <x-input-label for="barangay" :value="__('Barangay')" />
                <select id="barangay" name="barangay" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select Barangay</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('barangay')" />
            </div>

            <div>
                <x-input-label for="street" :value="__('Street')" />
                <x-text-input id="street" name="street" type="text" class="block w-full mt-1" :value="old('street', $user->street)" required autocomplete="street-address" />
                <x-input-error class="mt-2" :messages="$errors->get('street')" />
            </div>

            <div>
                <x-input-label for="zip_code" :value="__('Zip Code')" />
                <x-text-input id="zip_code" name="zip_code" type="text" class="block w-full mt-1" :value="old('zip_code', $user->zip_code)" autocomplete="postal-code" />
                <x-input-error class="mt-2" :messages="$errors->get('zip_code')" />
            </div>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="block w-full mt-1" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />


            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="mt-2 text-sm text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="id_photo" :value="__('ID Photo')" />
            <input type="file" name="id_photo" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('id_photo') border-red-500 @enderror">
            @error('id_photo') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            @if($user->id_photo)
                <div class="p-4 mt-4 border border-gray-200 rounded-lg bg-gray-50">
                    <p class="mb-3 text-sm font-medium text-gray-700">Current ID Photo:</p>
                    <div onclick="document.getElementById('profileEditIdPhotoModal').classList.remove('hidden')"
                         class="flex flex-col items-center justify-center w-32 h-32 transition duration-150 ease-in-out bg-black border-2 border-gray-400 rounded-lg cursor-pointer hover:bg-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.75 4h2.5a2 2 0 011.664.89l.812 1.22a2 2 0 001.664.89H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p class="mt-2 text-xs font-medium text-gray-500">Click to View</p>
                    </div>

                    <!-- Modal for Full Size ID Photo -->
                    <div id="profileEditIdPhotoModal"
                         class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 transition-opacity duration-300 bg-black bg-opacity-80"
                         onclick="if(event.target.id === 'profileEditIdPhotoModal') this.classList.add('hidden')">
                        <div class="relative max-w-3xl overflow-hidden bg-white rounded-lg shadow-2xl">
                            <div class="sticky top-0 z-10 flex items-center justify-between p-3 bg-white border-b border-gray-200">
                                <h3 class="text-xl font-semibold text-gray-800">Your Current ID Photo</h3>
                                <button onclick="document.getElementById('profileEditIdPhotoModal').classList.add('hidden')"
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
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 mt-6">
            <x-primary-button id="profile-save-btn">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle profile update form confirmation
        const profileForm = document.getElementById('profile-update-form');
        const profileSaveBtn = document.getElementById('profile-save-btn');

        if (profileForm && profileSaveBtn) {
            profileSaveBtn.addEventListener('click', function (e) {
                e.preventDefault();
                const confirmSave = confirm('Are you sure you want to save these profile changes?');
                if (confirmSave) {
                    profileForm.submit();
                }
            });
        }
        const citySelect = document.getElementById('city_municipality');
        const barangaySelect = document.getElementById('barangay');
        const barangayData = {
            "Alaminos City": ["Alos", "Palamis", "Amandiego", "Pandan", "Amangbangan", "Pangapisan", "Balangobong", "Poblacion", "Balayang", "Pocal-pocal", "Baleyadaan", "Pogo", "Bisocol", "Polo", "Bolaney", "Quibuar", "Bued", "Sabangan", "Cabatuan", "San Antonio", "Cayucay", "San Jose", "Dulacac", "San Roque", "Inerangan", "San Vicente", "Landoc", "Sta Maria", "Linmansangan", "Tanaytay", "Lucap", "Tangcarang", "Maawi", "Tawin-tawin", "Macatiw", "Telbang", "Magsaysay", "Victoria", "Mona"],
            "Bani": ["Ambabaay", "Aporao", "Arwas", "Ballag", "Banog Norte", "Banog Sur", "Calabeng", "Centro Toma", "Colayo", "Dacap Norte", "Dacap Sur", "Garrita", "Luac", "Macabit", "Masidem", "Poblacion", "Quinaoayanan", "Ranao", "Ranom Iloco", "San Jose", "San Miguel", "San Simon", "San Vicente", "Tiep", "Tipor", "Tugui Grande", "Tugui Norte"],
            "Mabini": ["Bacnit", "Barlo", "Caabiangaan", "Cabanaetan", "Cabinuangan", "Calzada", "Caranglaan", "De Guzman", "Luna", "Magalong", "Nibaliw", "Patar", "Poblacion", "San Pedro", "Tagudin", "Villacorta"],
            "Sual": ["Baquioen", "Baybay Norte", "Baybay Sur", "Bolaoen", "Cabalitian", "Calumbuyan", "Camagsingalan", "Caoayan", "Capantolan", "Macaycayawan", "Paitan East", "Paitan West", "Pangascasan", "Poblacion", "Santo Domingo", "Seselangen", "Sioasio East", "Sioasio West", "Victoria"]
        };

        function updateBarangayDropdown(selectedCity) {
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
            if (selectedCity && barangayData[selectedCity]) {
                // Sort barangays alphabetically A to Z
                const sortedBarangays = barangayData[selectedCity].sort();
                sortedBarangays.forEach(barangay => {
                    const option = document.createElement('option');
                    option.value = barangay;
                    option.textContent = barangay;
                    if (barangay === "{{ old('barangay', $user->barangay ?? '') }}") {
                        option.selected = true;
                    }
                    barangaySelect.appendChild(option);
                });
            }
        }

        citySelect.addEventListener('change', function () {
            updateBarangayDropdown(this.value);
        });

        // Initial population of barangay dropdown
        updateBarangayDropdown(citySelect.value);

        // Set initial barangay value
        const initialBarangay = "{{ old('barangay', $user->barangay ?? '') }}";
        if (initialBarangay) {
            document.getElementById('barangay').value = initialBarangay;
        }
    });
</script>
