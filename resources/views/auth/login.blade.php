<x-guest-layout>
    <style>
        /* Light Color Palette */
        :root {
            --bg-primary: #f8f9fa;
            --bg-card: #ffffff;
            --bg-form: #f3f4f6;
            --border-subtle: #e5e7eb;
            --accent-primary: #111827;
            --accent-hover: #059669;
        }

        body {
            background-color: var(--bg-primary);
        }

        /* Solid Color Decoration Spheres */
        .sphere {
            border-radius: 50%;
            position: absolute;
            filter: blur(0.4px);
            opacity: 0.08;
        }

        .sphere-1 {
            width: 220px;
            height: 220px;
            background: #111827;
            top: 10%;
            left: 5%;
            animation: float-slow 8s ease-in-out infinite;
        }

        .sphere-2 {
            width: 150px;
            height: 150px;
            background: #111827;
            bottom: 15%;
            left: 12%;
            animation: float-fast 6s ease-in-out infinite reverse;
        }

        .sphere-3 {
            width: 280px;
            height: 280px;
            background: #111827;
            bottom: -80px;
            right: 8%;
            animation: float-medium 7s ease-in-out infinite;
        }

        .sphere-4 {
            width: 120px;
            height: 120px;
            background: #111827;
            top: 35%;
            right: 5%;
            animation: float-slow 9s ease-in-out infinite reverse;
        }

        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) translateX(0px); }
            50% { transform: translateY(-40px) translateX(10px); }
        }

        @keyframes float-fast {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-35px); }
        }

        @keyframes float-medium {
            0%, 100% { transform: translateY(0px) translateX(0px); }
            50% { transform: translateY(-45px) translateX(-15px); }
        }

        /* Light Input Fields */
        .input-field {
            background-color: var(--bg-form);
            border: 1px solid var(--border-subtle);
            color: #1f2937;
            padding: 0.7rem 0.9rem;
            border-radius: 0.625rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .input-field::placeholder {
            color: #9ca3af;
        }

        .input-field:focus {
            outline: none;
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
            background-color: #ffffff;
        }

        .input-field.error {
            border-color: #ef4444;
        }

        /* Light Button */
        .btn-submit {
            background: var(--accent-primary);
            color: white;
            padding: 0.8rem 1.8rem;
            border-radius: 0.625rem;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .btn-submit:hover {
            background: var(--accent-hover);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-submit:active {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* Light Card Container */
        .card-container {
            background: #ffffff;
            border: 1px solid var(--border-subtle);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .brand-accent {
            color: var(--accent-primary);
        }

        /* View Transition Animation */
        .fade-transition {
            animation: fade-in 0.3s ease-out;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="relative flex items-center justify-center min-h-screen px-4 py-4 overflow-hidden sm:px-6 lg:px-8" style="background-color: var(--bg-primary);">

        <!-- Background Spheres -->
        <div class="fixed inset-0 z-0 pointer-events-none">
            <div class="sphere sphere-1"></div>
            <div class="sphere sphere-2"></div>
            <div class="sphere sphere-3"></div>
            <div class="sphere sphere-4"></div>
        </div>

        <!-- Main Container -->
        {{-- <div class="relative z-10 w-full max-w-5xl card-container rounded-2xl min-h-[580px] grid grid-cols-1 md:grid-cols-5 gap-0 overflow-hidden"> --}}
            <d class="relative z-10 w-full max-w-5xl card-container rounded-2xl min-h-[580px] grid grid-cols-1 md:grid-cols-2 gap-0 overflow-hidden">

             <!-- Left Panel (Now 50% width) -->
    <div class="md:col-span-1 bg-white p-6 lg:p-8 flex flex-col justify-center overflow-y-auto max-h-[calc(100vh-2rem)]">

        <form class="space-y-4" method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="fade-transition">
                        <label for="email" class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">Email Address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                               class="input-field w-full @error('email') error @enderror"
                               placeholder="juandelacruz2@gmail.com">
                        @error('email')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="fade-transition">
                        <label for="password" class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">Password</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                   class="input-field w-full @error('password') error @enderror"
                                   placeholder="Enter your password">
                            <button type="button" id="toggle-password" class="absolute transition right-3 top-3 text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between">
                        <label for="remember" class="flex items-center text-xs text-gray-700">
                            <input id="remember" name="remember" type="checkbox" class="w-4 h-4 rounded bg-white border-gray-300 text-green-600 focus:ring-green-500">
                            <span class="ml-2">Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-green-600 hover:text-green-700">Forgot password?</a>
                        @endif
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="w-full mt-4 mb-3 btn-submit fade-transition">
                        Sign In
                    </button>
                </form>

                <!-- Sign Up Link -->
                <div class="pt-3 border-t border-gray-200">
                    <p class="text-xs text-center text-gray-600">
                        New to City Vet?
                        <a href="{{ route('register') }}" class="font-semibold transition text-green-600 hover:text-green-700">Create an account</a>
                    </p>
                </div>
            </div>

            <!-- Right Panel (Now 50% width) -->

    <div class="relative flex-col justify-between hidden p-8 overflow-hidden md:flex md:col-span-1 lg:p-10 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
                <!-- Floating Background Spheres (Decorative) -->
                <div class="absolute inset-0 z-0">
                    <div class="sphere sphere-1" style="opacity: 0.1; animation-duration: 12s;"></div>
                    <div class="sphere sphere-2" style="opacity: 0.08; animation-duration: 10s;"></div>
                </div>

                <!-- Branding Header -->
                <div class="relative z-10">
                    <div class="flex items-center">
                        <svg class="w-6 h-6" style="color: #ffffff;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-hidden="true">
                            <path fill="currentColor" d="M234.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5 .3-86.2 32.6-96.8 70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3-14.3-70.1 10.2-84.1 59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5l0 1.6c0 25.8-20.9 46.7-46.7 46.7-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2-25.8 0-46.7-20.9-46.7-46.7l0-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3 29.1 51.7 10.2 84.1-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5 46.9 53.9 32.6 96.8-52.1 69.1-84.4 58.5z"/>
                        </svg>
                        <div class="ml-2">
                            <h1 class="text-2xl font-bold text-white">City Vet</h1>
                            <p class="text-xs tracking-widest uppercase text-gray-400">FindFurEver</p>
                        </div>
                    </div>
                </div>

                <!-- Centered Hero Message -->
                <div class="relative z-10 text-center">
                    <h2 class="mb-4 text-4xl font-bold leading-tight text-white">
                        Welcome <span class="text-green-400">back!</span>
                    </h2>

                    <p class="text-base leading-relaxed text-gray-300">
                        Log in to connect with your fur-fect match.
                    </p>
                </div>

                <!-- Footer Space (Clean) -->
                <div class="relative z-10">
                    <p class="text-xs text-gray-400">Securing pets, building bonds.</p>
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

