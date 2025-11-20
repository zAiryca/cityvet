<x-guest-layout>
    <!-- Background with subtle pet pattern -->
    <div class="relative min-h-screen overflow-hidden bg-gradient-to-br from-orange-50 via-amber-50 to-yellow-50">
        <!-- Decorative paw prints background -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="paw-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <path d="M10 5c0-1.1-.9-2-2-2s-2 .9-2 2c0 .7.4 1.4 1 1.7V9c0 .6.4 1 1 1s1-.4 1-1V6.7c.6-.3 1-1 1-1.7zM8 12c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" fill="currentColor"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#paw-pattern)"/>
            </svg>
        </div>

        <div class="relative z-10 flex items-center justify-center min-h-screen px-4 py-12 sm:px-6 lg:px-8">
            <div class="w-full max-w-lg space-y-8">
                <!-- Hero Section with Pet Theme -->
                <div class="text-center">
                    <!-- Cute pet illustration -->
                    <div class="relative mx-auto mb-6">
                        <div class="flex items-center justify-center w-32 h-32 transition-transform duration-300 transform rounded-full shadow-lg bg-gradient-to-br from-green-400 to-emerald-500 hover:scale-105">
                            <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <!-- Floating stars -->
                        <div class="absolute flex items-center justify-center w-8 h-8 bg-yellow-400 rounded-full -top-2 -right-2 animate-bounce">
                            <span class="text-sm text-white">⭐</span>
                        </div>
                        <div class="absolute flex items-center justify-center w-6 h-6 bg-blue-400 rounded-full -bottom-1 -left-1 animate-pulse">
                            <span class="text-xs text-white">🌟</span>
                        </div>
                    </div>

                    <h1 class="mb-2 text-4xl font-bold text-gray-900">
                        Join Our Family! 🐾
                    </h1>
                    <h2 class="mb-3 text-xl font-semibold text-green-600">
                        {{ request('role') === 'admin' ? 'Employee Registration' : 'Pet Lover Registration' }}
                    </h2>
                    <p class="max-w-sm mx-auto text-sm text-gray-600">
                        {{ request('role') === 'admin' ? 'Create an account to help manage our pet recovery and adoption system.' : 'Join our community to help reunite pets with their families and find loving homes.' }}
                    </p>
                </div>

                <!-- Registration Form -->
                <div class="px-6 py-8 border border-green-100 shadow-xl bg-white/90 backdrop-blur-sm rounded-2xl">
                    <div class="mb-6 text-center">
                        <h3 class="text-2xl font-bold text-gray-900">Create Account</h3>
                        <p class="mt-1 text-sm text-gray-600">Start your pet-loving journey today</p>
                    </div>
            <form class="space-y-6" method="POST" action="{{ route('register') }}">
                @csrf
                <input type="hidden" name="role" value="{{ request('role') }}">

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div class="sm:col-span-1">
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input id="last_name" name="last_name" type="text" autocomplete="family-name" required
                               value="{{ old('last_name') }}"
                               class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none {{ request('role') === 'admin' ? 'focus:ring-blue-500 focus:border-blue-500' : 'focus:ring-green-500 focus:border-green-500' }} focus:z-10 sm:text-sm @error('last_name') border-red-500 @enderror"
                               placeholder="Last name">
                        @error('last_name')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="sm:col-span-1">
                        <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name</label>
                        <input id="middle_name" name="middle_name" type="text" autocomplete="additional-name"
                               value="{{ old('middle_name') }}"
                               class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none {{ request('role') === 'admin' ? 'focus:ring-blue-500 focus:border-blue-500' : 'focus:ring-green-500 focus:border-green-500' }} focus:z-10 sm:text-sm @error('middle_name') border-red-500 @enderror"
                               placeholder="Middle name (optional)">
                        @error('middle_name')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="sm:col-span-1">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input id="first_name" name="first_name" type="text" autocomplete="given-name" required
                               value="{{ old('first_name') }}"
                               class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none {{ request('role') === 'admin' ? 'focus:ring-blue-500 focus:border-blue-500' : 'focus:ring-green-500 focus:border-green-500' }} focus:z-10 sm:text-sm @error('first_name') border-red-500 @enderror"
                               placeholder="First name">
                        @error('first_name')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <input id="contact_number" name="contact_number" type="text" autocomplete="tel" required
                           value="{{ old('contact_number') }}"
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none {{ request('role') === 'admin' ? 'focus:ring-blue-500 focus:border-blue-500' : 'focus:ring-green-500 focus:border-green-500' }} focus:z-10 sm:text-sm @error('contact_number') border-red-500 @enderror"
                           placeholder="e.g. 09171234567">
                    @error('contact_number')
                        <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                           value="{{ old('email') }}"
                           class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none {{ request('role') === 'admin' ? 'focus:ring-blue-500 focus:border-blue-500' : 'focus:ring-green-500 focus:border-green-500' }} focus:z-10 sm:text-sm @error('email') border-red-500 @enderror"
                           placeholder="your.email@example.com">
                    @error('email')
                        <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                               class="mt-1 appearance-none relative block w-full px-3 py-2 pr-10 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none {{ request('role') === 'admin' ? 'focus:ring-blue-500 focus:border-blue-500' : 'focus:ring-green-500 focus:border-green-500' }} focus:z-10 sm:text-sm @error('password') border-red-500 @enderror"
                               placeholder="At least 8 characters">
                        <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <div class="relative">
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                               class="mt-1 appearance-none relative block w-full px-3 py-2 pr-10 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none {{ request('role') === 'admin' ? 'focus:ring-blue-500 focus:border-blue-500' : 'focus:ring-green-500 focus:border-green-500' }} focus:z-10 sm:text-sm"
                               placeholder="Confirm your password">
                        <button type="button" id="toggle-password-confirmation" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div>
                    <div class="p-4 border border-blue-200 rounded-md bg-blue-50">
                        <label for="terms" class="flex items-start">
                            <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 mt-0.5 {{ request('role') === 'admin' ? 'text-blue-600 focus:ring-blue-500' : 'text-green-600 focus:ring-green-500' }} border-gray-300 rounded">
                            <span class="ml-2 text-sm text-gray-700">
                                <strong class="text-gray-900">I agree to the Terms and Conditions</strong><br>
                                By registering, you agree to our terms of service and privacy policy. Please read them carefully before proceeding.
                            </span>
                        </label>
                    </div>
                    @error('terms')
                        <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white {{ request('role') === 'admin' ? 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500' : 'bg-green-600 hover:bg-green-700 focus:ring-green-500' }} focus:outline-none focus:ring-2 focus:ring-offset-2">
                        Create Account
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">Already have an account?
                        <a href="{{ route('login', ['role' => request('role')]) }}" class="font-medium {{ request('role') === 'admin' ? 'text-blue-600 hover:text-blue-500' : 'text-green-600 hover:text-green-500' }}">Sign in here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('svg');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />';
            } else {
                passwordInput.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        });

        document.getElementById('toggle-password-confirmation').addEventListener('click', function() {
            const passwordInput = document.getElementById('password_confirmation');
            const icon = this.querySelector('svg');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />';
            } else {
                passwordInput.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        });
    </script>
</x-guest-layout>
