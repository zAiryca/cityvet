<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen px-4 py-12 bg-gradient-to-br from-orange-50 via-amber-100 to-yellow-50">
        <div class="w-full max-w-md p-8 text-center bg-white border border-orange-100 shadow-xl rounded-2xl">
            <!-- Password Reset Icon -->
            <div class="flex justify-center mb-6">
                <div class="flex items-center justify-center w-24 h-24 rounded-full shadow-lg bg-gradient-to-br from-orange-400 to-amber-500">
                    <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18 8h-1V6c0-2.76-2.24-5-5-5s-5 2.24-5 5v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                    </svg>
                </div>
            </div>

            <h1 class="mb-2 text-2xl font-bold text-gray-900">Create New Password</h1>
            <p class="mb-6 text-sm text-gray-700">Please enter your email and create a new password to regain access to your account.</p>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="mb-6 text-left">
                    <x-input-label for="email" :value="__('Email Address')" />
                    <x-text-input id="email" class="block w-full mt-2 border-orange-200 rounded-lg focus:border-orange-500 focus:ring-orange-500" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-6 text-left">
                    <x-input-label for="password" :value="__('New Password')" />
                    <x-text-input id="password" class="block w-full mt-2 border-orange-200 rounded-lg focus:border-orange-500 focus:ring-orange-500" type="password" name="password" required autocomplete="new-password" />
                    <div class="mt-2 text-xs text-gray-600">
                        <div id="password-requirements" class="space-y-1">
                            <div id="length-check" class="flex items-center">
                                <span class="w-2 h-2 mr-2 bg-gray-300 rounded-full" id="length-indicator"></span>
                                At least 8 characters
                            </div>
                            <div id="mixed-case-check" class="flex items-center">
                                <span class="w-2 h-2 mr-2 bg-gray-300 rounded-full" id="mixed-case-indicator"></span>
                                Mixed case letters
                            </div>
                            <div id="number-check" class="flex items-center">
                                <span class="w-2 h-2 mr-2 bg-gray-300 rounded-full" id="number-indicator"></span>
                                At least one number
                            </div>
                            <div id="symbol-check" class="flex items-center">
                                <span class="w-2 h-2 mr-2 bg-gray-300 rounded-full" id="symbol-indicator"></span>
                                At least one symbol
                            </div>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6 text-left">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block w-full mt-2 border-orange-200 rounded-lg focus:border-orange-500 focus:ring-orange-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <div id="password-match" class="hidden mt-2 text-xs text-red-600">Passwords do not match</div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button type="submit" class="w-full px-4 py-2 font-semibold text-white transition-all rounded-lg shadow bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                    {{ __('Reset Password') }}
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    {{ __('Remember your password?') }}
                    <a href="{{ route('login') }}" class="font-semibold text-orange-600 hover:text-orange-700">
                        {{ __('Sign in here') }}
                    </a>
                </p>
            </div>

            <div class="mt-6 text-xs text-gray-500">
                <span>Didn't request a reset? You can safely ignore this.</span>
            </div>
        </div>

        <div class="mt-8 text-xs text-center text-gray-400">
            "Every pet deserves a loving home" 🏡❤️
        </div>
    </div>
</x-guest-layout>
