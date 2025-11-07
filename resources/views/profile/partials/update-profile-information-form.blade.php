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

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" required autofocus autocomplete="family-name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <div>
            <x-input-label for="middle_name" :value="__('Middle Name')" />
            <x-text-input id="middle_name" name="middle_name" type="text" class="mt-1 block w-full" :value="old('middle_name', $user->middle_name)" autocomplete="additional-name" />
            <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
        </div>

        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)" required autocomplete="given-name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <div>
            <x-input-label for="contact_number" :value="__('Contact Number')" />
            <x-text-input id="contact_number" name="contact_number" type="text" class="mt-1 block w-full" :value="old('contact_number', $user->contact_number)" required autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('contact_number')" />
        </div>

        <div>
            <x-input-label for="emergency_contact" :value="__('Emergency Contact Number')" />
            <x-text-input id="emergency_contact" name="emergency_contact" type="text" class="mt-1 block w-full" :value="old('emergency_contact', $user->emergency_contact)" autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('emergency_contact')" />
        </div>

        <div class="mt-6 space-y-6">
            <h3 class="text-lg font-medium text-gray-900">Address</h3>

            <div>
                <x-input-label for="province" :value="__('Province')" />
                <x-text-input id="province" name="province" type="text" class="mt-1 block w-full" :value="$user->province ?? 'Pangasinan'" readonly />
            </div>

            <div>
                <x-input-label for="city_municipality" :value="__('City/Municipality')" />
                <select id="city_municipality" name="city_municipality" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">Select City/Municipality</option>
                    <option value="Alaminos City" @if(old('city_municipality', $user->city_municipality) == 'Alaminos City') selected @endif>Alaminos City</option>
                    <option value="Bani" @if(old('city_municipality', $user->city_municipality) == 'Bani') selected @endif>Bani</option>
                    <option value="Mabini" @if(old('city_municipality', $user->city_municipality) == 'Mabini') selected @endif>Mabini</option>
                    <option value="Sual" @if(old('city_municipality', $user->city_municipality) == 'Sual') selected @endif>Sual</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('city_municipality')" />
            </div>

            <div>
                <x-input-label for="barangay" :value="__('Barangay')" />
                <select id="barangay" name="barangay" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">Select Barangay</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('barangay')" />
            </div>

            <div>
                <x-input-label for="street" :value="__('Street')" />
                <x-text-input id="street" name="street" type="text" class="mt-1 block w-full" :value="old('street', $user->street)" required autocomplete="street-address" />
                <x-input-error class="mt-2" :messages="$errors->get('street')" />
            </div>

            <div>
                <x-input-label for="zip_code" :value="__('Zip Code')" />
                <x-text-input id="zip_code" name="zip_code" type="text" class="mt-1 block w-full" :value="old('zip_code', $user->zip_code)" autocomplete="postal-code" />
                <x-input-error class="mt-2" :messages="$errors->get('zip_code')" />
            </div>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />


            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

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
                barangayData[selectedCity].forEach(barangay => {
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
    });
</script>
