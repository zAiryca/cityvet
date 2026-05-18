<x-guest-layout>
    <style>
        /* Premium Color Palette */
        :root {
            --bg-primary: #080c14;
            --bg-card: #111c2a;
            --bg-form: #1d2a3a;
            --border-subtle: #2a3b50;
            --accent-primary: #00b880;
            --accent-hover: #02a170;
            --glass-blur: 12px;
        }

        body {
            background-color: var(--bg-primary);
        }

        /* Animated 3D Glass Spheres */
        .sphere {
            border-radius: 50%;
            position: absolute;
            filter: blur(0.4px);
            box-shadow: 0 8px 32px rgba(0, 184, 128, 0.15), inset -2px -2px 8px rgba(0, 0, 0, 0.3);
        }

        .sphere-1 {
            width: 220px;
            height: 220px;
            background: radial-gradient(circle at 30% 30%, rgba(0, 184, 128, 0.4), rgba(0, 100, 70, 0.15) 50%, transparent);
            top: 10%;
            left: 5%;
            animation: float-slow 8s ease-in-out infinite;
        }

        .sphere-2 {
            width: 150px;
            height: 150px;
            background: radial-gradient(circle at 35% 35%, rgba(0, 200, 140, 0.35), rgba(0, 110, 80, 0.1) 50%, transparent);
            bottom: 15%;
            left: 12%;
            animation: float-fast 6s ease-in-out infinite reverse;
        }

        .sphere-3 {
            width: 280px;
            height: 280px;
            background: radial-gradient(circle at 40% 40%, rgba(0, 184, 128, 0.25), rgba(0, 90, 60, 0.08) 50%, transparent);
            bottom: -80px;
            right: 8%;
            animation: float-medium 7s ease-in-out infinite;
            box-shadow: 0 12px 48px rgba(0, 184, 128, 0.2), inset -3px -3px 12px rgba(0, 0, 0, 0.4);
        }

        .sphere-4 {
            width: 120px;
            height: 120px;
            background: radial-gradient(circle at 32% 32%, rgba(0, 200, 140, 0.3), rgba(0, 120, 85, 0.1) 50%, transparent);
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

        /* Premium Input Fields */
        .input-field {
            background-color: var(--bg-form);
            border: 1px solid var(--border-subtle);
            color: white;
            padding: 0.7rem 0.9rem;
            border-radius: 0.625rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .input-field::placeholder {
            color: #6b7280;
        }

        .input-field:focus {
            outline: none;
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px rgba(0, 184, 128, 0.15), inset 0 1px 2px rgba(0, 184, 128, 0.1);
            background-color: rgba(29, 42, 58, 0.8);
        }

        .input-field.error {
            border-color: #ef4444;
        }

        /* Premium Button */
        .btn-submit {
            background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-hover) 100%);
            color: white;
            padding: 0.8rem 1.8rem;
            border-radius: 0.625rem;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 184, 128, 0.25);
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, var(--accent-hover) 0%, #00905f 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 184, 128, 0.35);
        }

        .btn-submit:active {
            transform: translateY(-1px);
        }

        /* Toast Notification */
        .toast-notification {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: rgba(17, 28, 42, 0.95);
            backdrop-filter: blur(var(--glass-blur));
            border: 1px solid var(--border-subtle);
            border-left: 3px solid var(--accent-primary);
            border-radius: 0.625rem;
            padding: 1rem 1.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            animation: slide-in 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: 50;
            max-width: 320px;
            color: white;
            font-size: 0.9rem;
        }

        @keyframes slide-in {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Paw Icon */
        .paw-icon {
            display: inline-block;
            width: 1.5rem;
            height: 1.5rem;
            margin-right: 0.5rem;
            color: var(--accent-primary);
        }

        /* Premium Card Container */
        .card-container {
            background: linear-gradient(135deg, rgba(17, 28, 42, 0.9) 0%, rgba(17, 28, 42, 0.85) 100%);
            backdrop-filter: blur(var(--glass-blur));
            border: 1px solid rgba(42, 59, 80, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4), 0 0 1px rgba(0, 184, 128, 0.1);
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
        <div class="relative z-10 w-full max-w-5xl card-container rounded-2xl min-h-[580px] grid grid-cols-1 md:grid-cols-5 gap-0 overflow-hidden">

            <!-- Left Panel (40%) - Branding & Hero Message -->
            <div class="relative flex-col justify-between hidden p-8 overflow-hidden md:flex md:col-span-2 lg:p-10 bg-gradient-to-br from-slate-950/40 via-slate-900/20 to-slate-950/30">

                <!-- Floating Background Spheres (Decorative) -->
                <div class="absolute inset-0 z-0">
                    <div class="sphere sphere-1" style="opacity: 0.3; animation-duration: 12s;"></div>
                    <div class="sphere sphere-2" style="opacity: 0.2; animation-duration: 10s;"></div>
                </div>

                <!-- Branding Header -->
                <div class="relative z-10">
                    <div class="flex items-center">
                        <svg class="w-6 h-6" style="color: var(--accent-primary);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-hidden="true">
                            <path fill="currentColor" d="M234.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5 .3-86.2 32.6-96.8 70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3-14.3-70.1 10.2-84.1 59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5l0 1.6c0 25.8-20.9 46.7-46.7 46.7-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2-25.8 0-46.7-20.9-46.7-46.7l0-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3 29.1 51.7 10.2 84.1-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5 46.9 53.9 32.6 96.8-52.1 69.1-84.4 58.5z"/>
                        </svg>
                        <div class="ml-2">
                            <h1 class="text-2xl font-bold text-white">City Vet</h1>
                            <p class="text-xs uppercase tracking-widest text-slate-400">FindFurEver</p>
                        </div>
                    </div>
                </div>

                <!-- Centered Hero Message -->
                <div class="relative z-10 text-center">
                    <h2 class="mb-4 text-4xl font-bold leading-tight text-white">
                        Find Your <span class="brand-accent">FurEver</span>
                    </h2>

                    <p class="text-base leading-relaxed text-slate-300">
                        Open your heart and your home. Sign up today to find your fur-fect match.
                    </p>
                </div>

                <!-- Footer Space (Clean) -->
                <div class="relative z-10">
                    <p class="text-xs text-slate-500">Securing pets, building bonds.</p>
                </div>
            </div>

            <!-- Right Panel (60%) - Interactive Form -->
            <div class="md:col-span-3 bg-gradient-to-br from-slate-900/40 to-slate-950/40 p-6 lg:p-8 flex flex-col justify-center overflow-y-auto max-h-[calc(100vh-2rem)]">

                <form method="POST" action="{{ route('register') }}" class="space-y-3" id="registration-form">
                    @csrf
                    <input type="hidden" name="role" value="{{ request('role') }}">

                    <!-- Name Fields Grid -->
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <!-- First Name -->
                        <div class="fade-transition">
                            <label for="first_name" class="block text-xs font-semibold text-slate-200 mb-1.5 uppercase tracking-wide">First Name</label>
                            <input id="first_name" name="first_name" type="text" required value="{{ old('first_name') }}"
                                   class="input-field w-full @error('first_name') error @enderror"
                                   placeholder="Juan">
                            @error('first_name')
                                <p class="mt-1 text-xs text-red-400\">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Last Name -->
                        <div class="fade-transition">
                            <label for="last_name" class="block text-xs font-semibold text-slate-200 mb-1.5 uppercase tracking-wide">Last Name</label>
                            <input id="last_name" name="last_name" type="text" required value="{{ old('last_name') }}"
                                   class="input-field w-full @error('last_name') error @enderror"
                                   placeholder="Dela Cruz">
                            @error('last_name')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Contact Number -->
                    <div class="fade-transition">
                        <label for="contact_number" class="block text-xs font-semibold text-slate-200 mb-1.5 uppercase tracking-wide">Contact Number</label>
                        <input id="contact_number" name="contact_number" type="text" required value="{{ old('contact_number') }}"
                               class="input-field w-full @error('contact_number') error @enderror"
                               placeholder="09123456789">
                        <p class="mt-0.5 text-xs text-slate-400">Format: 09XXXXXXXXX (11 digits)</p>
                        @error('contact_number')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="fade-transition">
                        <label for="email" class="block text-xs font-semibold text-slate-200 mb-1.5 uppercase tracking-wide">Email Address</label>
                        <input id="email" name="email" type="email" required value="{{ old('email') }}"
                               class="input-field w-full @error('email') error @enderror"
                               placeholder="juandelacruz2@gmail.com">
                        @error('email')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Fields Grid -->
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <!-- Password -->
                        <div class="fade-transition">
                            <label for="password" class="block text-xs font-semibold text-slate-200 mb-1.5 uppercase tracking-wide">Password</label>
                            <div class="relative">
                                <input id="password" name="password" type="password" required
                                       class="input-field w-full @error('password') error @enderror"
                                       placeholder="Create a strong password">
                                <button type="button" id="toggle-password" class="absolute transition right-3 top-3 text-slate-400 hover:text-slate-200">
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

                        <!-- Confirm Password -->
                        <div class="fade-transition">
                            <label for="password_confirmation" class="block text-xs font-semibold text-slate-200 mb-1.5 uppercase tracking-wide">Confirm Password</label>
                            <div class="relative">
                                <input id="password_confirmation" name="password_confirmation" type="password" required
                                       class="w-full input-field"
                                       placeholder="Re-enter your password">
                                <button type="button" id="toggle-password-confirmation" class="absolute transition right-3 top-3 text-slate-400 hover:text-slate-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            <p id="confirm_password_warning" class="hidden mt-1 text-xs text-red-400">Passwords do not match</p>
                        </div>
                    </div>

                    <!-- Password Requirements -->
                    <div class="p-3 space-y-2 border rounded-lg bg-slate-800/20 border-slate-700/30">
                        <p class="mb-2 text-xs font-semibold tracking-wide uppercase text-slate-400">Password Requirements</p>
                        <div id="password-requirements" class="grid grid-cols-2 gap-2 sm:grid-cols-3">
                            <div id="req-length" class="flex items-center text-xs text-slate-400"><span class="flex-shrink-0 w-2 h-2 mr-2 bg-red-500 rounded-full"></span>8+ chars</div>
                            <div id="req-uppercase" class="flex items-center text-xs text-slate-400"><span class="flex-shrink-0 w-2 h-2 mr-2 bg-red-500 rounded-full"></span>Uppercase</div>
                            <div id="req-lowercase" class="flex items-center text-xs text-slate-400"><span class="flex-shrink-0 w-2 h-2 mr-2 bg-red-500 rounded-full"></span>Lowercase</div>
                            <div id="req-number" class="flex items-center text-xs text-slate-400"><span class="flex-shrink-0 w-2 h-2 mr-2 bg-red-500 rounded-full"></span>Number</div>
                            <div id="req-special" class="flex items-center text-xs text-slate-400"><span class="flex-shrink-0 w-2 h-2 mr-2 bg-red-500 rounded-full"></span>Special char</div>
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="p-3 border rounded-lg bg-slate-800/20 border-slate-700/30">
                        <label for="terms" class="flex items-start text-xs cursor-pointer text-slate-300">
                            <input id="terms" name="terms" type="checkbox" class="w-4 h-4 mt-0.5 rounded bg-slate-700 border-slate-600 text-emerald-600 focus:ring-emerald-600">
                            <span class="ml-3">
                                I agree to the
                                <button type="button" id="open-terms-modal" class="underline transition text-emerald-400 hover:text-emerald-300">
                                    Terms and Conditions
                                </button>
                            </span>
                        </label>
                        <p id="terms-warning" class="hidden mt-2 text-xs text-red-400">Please read and accept the terms</p>
                        @error('terms')
                            <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <button type="submit" id="submit-button" class="w-full mt-4 mb-3 btn-submit fade-transition">
                        Create Account
                    </button>

                </form>

                <!-- Sign In Link -->
                <div class="pt-3 border-t border-slate-700/30">
                    <p class="text-xs text-center text-slate-400">
                        Already have an account?
                        <a href="{{ route('login', ['role' => request('role')]) }}" class="font-semibold transition text-emerald-400 hover:text-emerald-300">Sign in here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Terms Modal -->
    <div id="terms-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 overflow-y-auto bg-black/60 backdrop-blur-sm">
        <div class="w-full max-w-md overflow-y-auto border rounded-lg shadow-2xl bg-gradient-to-br from-slate-800 to-slate-900 border-slate-700/50 max-h-96 fade-transition">
            <div class="sticky top-0 flex items-center justify-between p-5 border-b bg-slate-800/80 backdrop-blur border-slate-700/50">
                <h3 class="text-lg font-bold text-white">Terms and Conditions</h3>
                <button type="button" id="close-terms-modal" class="transition text-slate-400 hover:text-slate-200">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-5 space-y-4 text-sm text-slate-300">
                <h4 class="text-base font-semibold text-white">City Vet - Pet Recovery & Adoption System</h4>
                <p class="text-xs text-slate-400">This policy governs the use of City Vet system which facilitates pet registration, adoption, and community lost/found reports.</p>

                <div>
                    <h5 class="mb-2 text-sm font-semibold text-white">1. User Interactions</h5>
                    <ul class="space-y-1 text-xs list-disc list-inside text-slate-400">
                        <li>All accounts are linked to Alaminos City, Pangasinan</li>
                        <li>Pet registration requires verified residency</li>
                        <li>Impounded pets may be claimed within 3 days</li>
                        <li>Adoptable pets are visible for maximum 4 days</li>
                        <li>Submitting false information results in account termination</li>
                    </ul>
                </div>

                <div>
                    <h5 class="mb-2 text-sm font-semibold text-white">2. Community Submissions</h5>
                    <ul class="space-y-1 text-xs list-disc list-inside text-slate-400">
                        <li>Posters must include accurate description and location</li>
                        <li>Contact information will be visible to other users</li>
                        <li>Mark pets as reunited immediately upon recovery</li>
                    </ul>
                </div>
            </div>

            <div class="sticky bottom-0 p-5 border-t bg-slate-800/80 backdrop-blur border-slate-700/50">
                <button type="button" id="agree-and-close" class="w-full px-4 py-2.5 bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-500 hover:to-emerald-400 text-white font-semibold rounded-lg transition duration-300">
                    I Agree
                </button>
            </div>
        </div>
    </div>

    <script>
        // Password toggles
        function setupPasswordToggle(inputId, toggleId) {
            document.getElementById(toggleId).addEventListener('click', function() {
                const input = document.getElementById(inputId);
                const icon = this.querySelector('svg');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />';
                } else {
                    input.type = 'password';
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
                }
            });
        }
        setupPasswordToggle('password', 'toggle-password');
        setupPasswordToggle('password_confirmation', 'toggle-password-confirmation');

        // Password validation
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('password_confirmation');
        const confirmWarning = document.getElementById('confirm_password_warning');
        const reqs = {
            length: document.getElementById('req-length'),
            uppercase: document.getElementById('req-uppercase'),
            lowercase: document.getElementById('req-lowercase'),
            number: document.getElementById('req-number'),
            special: document.getElementById('req-special')
        };

        function validatePassword() {
            const pwd = passwordInput.value;
            updateReq(reqs.length, pwd.length >= 8, '8+ chars');
            updateReq(reqs.uppercase, /[A-Z]/.test(pwd), 'Uppercase');
            updateReq(reqs.lowercase, /[a-z]/.test(pwd), 'Lowercase');
            updateReq(reqs.number, /[0-9]/.test(pwd), 'Number');
            updateReq(reqs.special, /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(pwd), 'Special char');

            const match = confirmInput.value.length > 0 && pwd === confirmInput.value;
            confirmWarning.classList.toggle('hidden', match);
            confirmInput.classList.toggle('border-red-500', !match && confirmInput.value.length > 0);
        }

        function updateReq(elem, condition, text) {
            const indicator = elem.querySelector('.w-2');
            indicator.classList.toggle('bg-red-500', !condition);
            indicator.classList.toggle('bg-emerald-500', condition);
        }

        passwordInput.addEventListener('input', validatePassword);
        confirmInput.addEventListener('input', validatePassword);

        // Terms modal
        document.getElementById('open-terms-modal').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('terms-modal').classList.remove('hidden');
        });
        document.getElementById('close-terms-modal').addEventListener('click', () => {
            document.getElementById('terms-modal').classList.add('hidden');
        });
        document.getElementById('agree-and-close').addEventListener('click', () => {
            document.getElementById('terms').checked = true;
            document.getElementById('terms-warning').classList.add('hidden');
            document.getElementById('terms-modal').classList.add('hidden');
        });

        // Form submission
        document.getElementById('registration-form').addEventListener('submit', function(e) {
            const terms = document.getElementById('terms').checked;
            if (!terms) {
                e.preventDefault();
                document.getElementById('terms-warning').classList.remove('hidden');
            }
        });
    </script>
</x-guest-layout>
