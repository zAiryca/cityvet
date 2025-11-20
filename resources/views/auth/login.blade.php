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
            <div class="w-full max-w-md space-y-8">
                <!-- Hero Section with Pet Theme -->
                <div class="text-center">
                    <!-- Cute pet illustration -->
                    <div class="relative mx-auto mb-6">
                        <div class="flex items-center justify-center w-32 h-32 transition-transform duration-300 transform rounded-full shadow-lg bg-gradient-to-br from-orange-400 to-amber-500 hover:scale-105">
                            <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                        <!-- Floating hearts -->
                        <div class="absolute flex items-center justify-center w-8 h-8 bg-red-400 rounded-full -top-2 -right-2 animate-bounce">
                            <span class="text-sm text-white">💕</span>
                        </div>
                        <div class="absolute flex items-center justify-center w-6 h-6 bg-pink-400 rounded-full -bottom-1 -left-1 animate-pulse">
                            <span class="text-xs text-white">🐾</span>
                        </div>
                    </div>

                    <h1 class="mb-2 text-4xl font-bold text-gray-900">
                        Welcome Back! 🐕
                    </h1>
                    <h2 class="mb-3 text-xl font-semibold text-orange-600">
                        Pet Recovery & Adoption System
                    </h2>
                    <p class="max-w-sm mx-auto text-sm text-gray-600">
                        Sign in to reunite with your furry friends and help pets find their forever homes in Alaminos City.
                    </p>
                </div>

                <!-- Login Form -->
                <div class="px-6 py-8 border border-orange-100 shadow-xl bg-white/90 backdrop-blur-sm rounded-2xl">
                    <div class="mb-6 text-center">
                        <h3 class="text-2xl font-bold text-gray-900">Sign In</h3>
                        <p class="mt-1 text-sm text-gray-600">Access your pet-loving account</p>
                    </div>

                    <form class="space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div>
                            <label for="email" class="block mb-2 text-sm font-semibold text-gray-700">
                                📧 Email Address
                            </label>
                            <div class="relative">
                                <input id="email" name="email" type="email" autocomplete="email" required
                                       value="{{ old('email') }}"
                                       class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 @error('email') border-red-300 @enderror"
                                       placeholder="your.email@example.com">
                                <div class="absolute right-3 top-3.5 text-orange-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                </div>
                            </div>
                            @error('email')
                                <span class="flex items-center mt-1 text-sm text-red-500">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block mb-2 text-sm font-semibold text-gray-700">
                                🔒 Password
                            </label>
                            <div class="relative">
                                <input id="password" name="password" type="password" autocomplete="current-password" required
                                       class="w-full px-4 py-3 pr-12 border-2 border-orange-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 @error('password') border-red-300 @enderror"
                                       placeholder="Enter your password">
                                <button type="button" id="toggle-password" class="absolute right-3 top-3.5 text-orange-400 hover:text-orange-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <span class="flex items-center mt-1 text-sm text-red-500">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember" name="remember" type="checkbox"
                                       class="w-4 h-4 text-orange-600 border-orange-300 rounded focus:ring-orange-500">
                                <label for="remember" class="block ml-2 text-sm font-medium text-gray-700">
                                    🧠 Remember me
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="text-sm">
                                    <a href="{{ route('password.request') }}" class="font-medium text-orange-600 transition-colors hover:text-orange-500">
                                        Forgot password? 🤔
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div>
                            <button type="submit" class="relative flex justify-center w-full px-4 py-3 text-sm font-bold text-white transition-all duration-200 transform border border-transparent shadow-lg group rounded-xl bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 hover:scale-105">
                                <span class="flex items-center">
                                    🚀 Sign In
                                    <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                            </button>
                        </div>

                        <div class="text-center">
                            <p class="text-sm text-gray-600">
                                New to our pet community?
                                <a href="{{ route('register') }}" class="ml-1 font-bold text-orange-600 transition-colors hover:text-orange-500">
                                    🐾 Join us here!
                                </a>
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Fun footer message -->
                <div class="text-center">
                    <p class="text-xs text-gray-500">
                        "Every pet deserves a loving home" 🏡❤️
                    </p>
                </div>
            </div>
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
    </script>
</x-guest-layout>
