@extends('layouts.app')

@section('title', '| Profile')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <h1 class="mb-8 text-3xl font-extrabold text-gray-900">My Profile Settings</h1>

    @php
        // Toggle variables based on URL query parameters
        $isEditingInfo = request('edit') === 'true';
        $isChangingPassword = request('password') === 'true';
    @endphp

    <div class="p-6 mb-8 overflow-hidden bg-white shadow-xl sm:rounded-lg lg:p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Personal Information</h2>

            <div class="flex space-x-4">
                {{-- CHANGE PASSWORD BUTTON (New Location) --}}
                @if (!$isChangingPassword)
                    <a href="{{ route('profile.edit', ['password' => 'true']) }}"
                       class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Change Password
                    </a>
                @else
                    <a href="{{ route('profile.edit') }}"
                       class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-800 uppercase transition duration-150 ease-in-out bg-gray-200 border border-gray-300 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Cancel Password Change
                    </a>
                @endif

                {{-- EDIT PROFILE BUTTON --}}
                @if (!$isEditingInfo)
                    <a href="{{ route('profile.edit', ['edit' => 'true']) }}"
                       class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L15.232 5.232z"></path></svg>
                        Edit Profile
                    </a>
                @else
                    <a href="{{ route('profile.edit') }}"
                       class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-800 uppercase transition duration-150 ease-in-out bg-gray-200 border border-gray-300 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Cancel Edit
                    </a>
                @endif
            </div>
        </div>

        @if ($isEditingInfo)
            <div class="mt-4">
                @include('profile.partials.update-profile-information-form')
            </div>
        @else
            <div class="pt-4 mt-4 border-t border-gray-200 divide-y divide-gray-100">
                <dl>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            {{ $user->first_name ?? $user->name }}
                            {{ $user->middle_name ?? '' }}
                            {{ $user->last_name ?? '' }}
                        </dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $user->email }}</dd>
                    </div>
                    @if($user->id_photo)
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium text-gray-500">ID Photo</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            <img src="{{ asset('storage/' . $user->id_photo) }}" alt="ID Photo" class="object-cover w-48 h-32 border border-gray-300 rounded">
                        </dd>
                    </div>
                    @endif
                </dl>
            </div>
        @endif
    </div>

    @if ($isChangingPassword)
    <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg lg:p-8" id="change-password">
        <h2 class="mb-6 text-2xl font-semibold text-gray-900">Change Account Password</h2>
        <form id="password-update-form" method="post" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('put')

            <div>
                <x-input-label for="current_password" :value="__('Current Password')" />
                <div class="relative">
                    <x-text-input id="current_password" name="current_password" type="password" class="block w-full mt-1 pr-10" autocomplete="current-password" />
                    <button type="button" id="toggle-current-password" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('New Password')" />
                <div class="relative">
                    <x-text-input id="password" name="password" type="password" class="block w-full mt-1 pr-10" autocomplete="new-password" />
                    <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>

                <!-- Password Requirements -->
                <div id="password-requirements" class="mt-2 grid grid-cols-2 gap-x-3 gap-y-1 text-xs text-gray-600 p-3 bg-gray-50 rounded-lg">
                    <p id="req-length" class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-2 text-red-500">❌</span> 8+ characters
                    </p>
                    <p id="req-uppercase" class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-2 text-red-500">❌</span> Uppercase letter
                    </p>
                    <p id="req-lowercase" class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-2 text-red-500">❌</span> Lowercase letter
                    </p>
                    <p id="req-number" class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-2 text-red-500">❌</span> Number (0-9)
                    </p>
                    <p id="req-special" class="flex items-center">
                        <span class="inline-block w-3 h-3 mr-2 text-red-500">❌</span> Special character
                    </p>
                </div>

                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm New Password')" />
                <div class="relative">
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="block w-full mt-1 pr-10" autocomplete="new-password" />
                    <button type="button" id="toggle-password-confirmation" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                <p id="confirm_password_warning" class="hidden mt-2 text-xs text-red-500">⚠️ Passwords do not match.</p>
                <p id="confirm_password_success" class="hidden mt-2 text-xs text-green-600">✅ Passwords match.</p>
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button id="password-update-btn" class="bg-red-600 hover:bg-red-700">Update Password</x-primary-button>
            </div>
        </form>
    </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Toggle password visibility for current password
        const toggleCurrentPassword = document.getElementById('toggle-current-password');
        const currentPasswordInput = document.getElementById('current_password');

        if (toggleCurrentPassword && currentPasswordInput) {
            toggleCurrentPassword.addEventListener('click', function (e) {
                e.preventDefault();
                const type = currentPasswordInput.type === 'password' ? 'text' : 'password';
                currentPasswordInput.type = type;
            });
        }

        // Toggle password visibility for new password
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function (e) {
                e.preventDefault();
                const type = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = type;
            });
        }

        // Toggle password visibility for confirm password
        const togglePasswordConfirmation = document.getElementById('toggle-password-confirmation');
        const passwordConfirmationInput = document.getElementById('password_confirmation');

        if (togglePasswordConfirmation && passwordConfirmationInput) {
            togglePasswordConfirmation.addEventListener('click', function (e) {
                e.preventDefault();
                const type = passwordConfirmationInput.type === 'password' ? 'text' : 'password';
                passwordConfirmationInput.type = type;
            });
        }

        // Real-time password validation
        if (passwordInput) {
            passwordInput.addEventListener('input', function () {
                const password = this.value;

                // Check length (8+ characters)
                const lengthValid = password.length >= 8;
                updateRequirement('req-length', lengthValid);

                // Check uppercase
                const uppercaseValid = /[A-Z]/.test(password);
                updateRequirement('req-uppercase', uppercaseValid);

                // Check lowercase
                const lowercaseValid = /[a-z]/.test(password);
                updateRequirement('req-lowercase', lowercaseValid);

                // Check number
                const numberValid = /[0-9]/.test(password);
                updateRequirement('req-number', numberValid);

                // Check special character
                const specialValid = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);
                updateRequirement('req-special', specialValid);

                // Check password match
                validatePasswordMatch();
            });
        }

        // Real-time password match validation
        if (passwordConfirmationInput) {
            passwordConfirmationInput.addEventListener('input', validatePasswordMatch);
        }

        function validatePasswordMatch() {
            const password = passwordInput.value;
            const confirmPassword = passwordConfirmationInput.value;
            const warningElement = document.getElementById('confirm_password_warning');
            const successElement = document.getElementById('confirm_password_success');

            if (confirmPassword) {
                if (password === confirmPassword) {
                    warningElement.classList.add('hidden');
                    successElement.classList.remove('hidden');
                } else {
                    warningElement.classList.remove('hidden');
                    successElement.classList.add('hidden');
                }
            } else {
                warningElement.classList.add('hidden');
                successElement.classList.add('hidden');
            }
        }

        function updateRequirement(elementId, isValid) {
            const element = document.getElementById(elementId);
            if (element) {
                const icon = element.querySelector('span');
                if (isValid) {
                    icon.textContent = '✅';
                    icon.className = 'inline-block w-3 h-3 mr-2 text-green-600';
                } else {
                    icon.textContent = '❌';
                    icon.className = 'inline-block w-3 h-3 mr-2 text-red-500';
                }
            }
        }

        // Handle password update form confirmation
        const passwordForm = document.getElementById('password-update-form');
        const passwordUpdateBtn = document.getElementById('password-update-btn');

        if (passwordForm && passwordUpdateBtn) {
            passwordUpdateBtn.addEventListener('click', function (e) {
                e.preventDefault();

                // Check if all requirements are met
                const allRequirementsMet = checkAllPasswordRequirements();
                const passwordsMatch = document.getElementById('password').value === document.getElementById('password_confirmation').value;

                if (!allRequirementsMet) {
                    alert('❌ Your password does not meet all requirements. Please review the password requirements above.');
                    return;
                }

                if (!passwordsMatch) {
                    alert('❌ Passwords do not match. Please ensure both password fields are identical.');
                    return;
                }

                const confirmChange = confirm('Are you sure you want to change your password? This action cannot be undone.');
                if (confirmChange) {
                    passwordForm.submit();
                }
            });
        }

        function checkAllPasswordRequirements() {
            const password = document.getElementById('password').value;
            return password.length >= 8 &&
                   /[A-Z]/.test(password) &&
                   /[a-z]/.test(password) &&
                   /[0-9]/.test(password) &&
                   /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);
        }
    });
</script>
@endsection
