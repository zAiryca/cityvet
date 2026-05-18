<x-guest-layout>
    <style>
        /* 3D Sphere Styles */
        .sphere {
            border-radius: 50%;
            position: absolute;
            filter: blur(0.5px);
        }

        .sphere-1 {
            width: 140px;
            height: 140px;
            background: radial-gradient(circle at 35% 35%, rgba(34, 197, 94, 0.8), rgba(20, 83, 78, 0.4) 50%, rgba(15, 23, 42, 0.9));
            top: 15%;
            left: 10%;
            animation: float 6s ease-in-out infinite;
        }

        .sphere-2 {
            width: 90px;
            height: 90px;
            background: radial-gradient(circle at 30% 30%, rgba(45, 212, 191, 0.7), rgba(13, 110, 107, 0.3) 50%, rgba(15, 23, 42, 0.95));
            bottom: 20%;
            right: 15%;
            animation: float 8s ease-in-out infinite reverse;
        }

        .sphere-3 {
            width: 160px;
            height: 160px;
            background: radial-gradient(circle at 40% 40%, rgba(34, 197, 94, 0.6), rgba(20, 83, 78, 0.25) 50%, rgba(15, 23, 42, 0.95));
            bottom: -50px;
            right: 5%;
            z-index: 10;
            animation: float 7s ease-in-out infinite;
        }

        .sphere-4 {
            width: 80px;
            height: 80px;
            background: radial-gradient(circle at 35% 35%, rgba(45, 212, 191, 0.6), rgba(13, 110, 107, 0.2) 50%, rgba(15, 23, 42, 0.9));
            top: 40%;
            right: 8%;
            animation: float 5s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-30px);
            }
        }

        .input-field {
            background-color: #243249;
            border: 1.5px solid #2d3f52;
            color: white;
            padding: 0.6rem 0.75rem;
            border-radius: 0.75rem;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .input-field::placeholder {
            color: #94a3b8;
        }

        .input-field:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .input-field.error {
            border-color: #ef4444;
        }

        .btn-submit {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(16, 185, 129, 0.3);
        }
    </style>

    <div class="relative flex items-center justify-center h-screen px-4 py-2 overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 sm:px-6 lg:px-8">

        <!-- Main Container -->
        <div class="grid w-full h-full grid-cols-1 gap-0 overflow-hidden shadow-2xl max-w-7xl lg:grid-cols-2 rounded-2xl">

            <!-- Left Panel - Branding & Decoration -->
            <div class="hidden lg:flex flex-col justify-between p-8 bg-gradient-to-br from-slate-950 via-[#0b121f] to-slate-900 relative overflow-hidden">

                <!-- Floating Spheres -->
                <div class="sphere sphere-1"></div>
                <div class="sphere sphere-2"></div>
                <div class="sphere sphere-3"></div>
                <div class="sphere sphere-4"></div>
            </div>

            <!-- Right Panel - Form -->
            <div class="bg-gradient-to-br from-[#162235] to-[#0f1823] p-6 lg:p-6 flex flex-col justify-center overflow-y-auto">

                <form method="POST" action="{{ route('register') }}" class="space-y-3" id="registration-form">
                    @csrf
                    <input type="hidden" name="role" value="{{ request('role') }}">

                    <!-- Name Fields Grid -->
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="block mb-1 text-xs font-medium text-slate-200">First Name</label>
                            <input id="first_name" name="first_name" type="text" required value="{{ old('first_name') }}"
                                   class="input-field w-full @error('first_name') error @enderror"
                                   placeholder="Juan">
                            @error('first_name')
                                <p class="mt-1 text-xs text-red-400\">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label for="last_name" class="block mb-1 text-xs font-medium text-slate-200">Last Name</label>
                            <input id="last_name" name="last_name" type="text" required value="{{ old('last_name') }}"
                                   class="input-field w-full @error('last_name') error @enderror"
                                   placeholder="Dela Cruz">
                            @error('last_name')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Contact Number -->
                    <div>
                        <label for="contact_number" class="block mb-1 text-xs font-medium text-slate-200">Contact Number</label>
                        <input id="contact_number" name="contact_number" type="text" required value="{{ old('contact_number') }}"
                               class="input-field w-full @error('contact_number') error @enderror"
                               placeholder="09123456789">
                        <p class="mt-0.5 text-xs text-slate-400">Format: 09XXXXXXXXX (11 digits)</p>
                        @error('contact_number')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block mb-1 text-xs font-medium text-slate-200">Email Address</label>
                        <input id="email" name="email" type="email" required value="{{ old('email') }}"
                               class="input-field w-full @error('email') error @enderror"
                               placeholder="juandelacruz2@gmail.com">
                        @error('email')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Fields Grid -->
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block mb-1 text-xs font-medium text-slate-200">Password</label>
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
                        <div>
                            <label for="password_confirmation" class="block mb-1 text-xs font-medium text-slate-200">Confirm Password</label>
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
                    <div id="password-requirements" class="grid grid-cols-3 gap-1 p-2 text-xs border rounded-lg text-slate-400 bg-slate-800/30 border-slate-700/30">
                        <div id="req-length" class="flex items-center"><span class="w-2 h-2 mr-2 bg-red-500 rounded-full"></span>8+ characters</div>
                        <div id="req-uppercase" class="flex items-center"><span class="w-2 h-2 mr-2 bg-red-500 rounded-full"></span>Uppercase</div>
                        <div id="req-lowercase" class="flex items-center"><span class="w-2 h-2 mr-2 bg-red-500 rounded-full"></span>Lowercase</div>
                        <div id="req-number" class="flex items-center"><span class="w-2 h-2 mr-2 bg-red-500 rounded-full"></span>Number</div>
                        <div id="req-special" class="flex items-center"><span class="w-2 h-2 mr-2 bg-red-500 rounded-full"></span>Special char</div>
                    </div>

                    <!-- Terms -->
                    <div class="p-2 border rounded-lg bg-slate-800/50 border-slate-700/50">
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
                    <button type="submit" id="submit-button" class="w-full mt-2 btn-submit">
                        Create Account
                    </button>

                </form>

                <!-- Sign In Link -->
                <div class="pt-2 mt-2 text-center border-t border-slate-700/50">
                    <p class="text-slate-400 text-xs\">
                        Already have an account?
                        <a href="{{ route('login', ['role' => request('role')]) }}" class="font-semibold transition text-emerald-400 hover:text-emerald-300">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Terms Modal -->
    <div id="terms-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 overflow-y-auto bg-black/60 backdrop-blur-sm">
        <div class="w-full max-w-md overflow-y-auto border shadow-2xl bg-gradient-to-br from-slate-800 to-slate-900 border-slate-700/50 rounded-xl max-h-96">
            <div class="sticky top-0 flex items-center justify-between p-6 border-b bg-slate-800/80 backdrop-blur border-slate-700/50">
                <h3 class="text-lg font-bold text-white">Terms and Conditions</h3>
                <button type="button" id="close-terms-modal" class="transition text-slate-400 hover:text-slate-200">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-6 space-y-4 text-sm text-slate-300">
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

            <div class="sticky bottom-0 p-6 border-t bg-slate-800/80 backdrop-blur border-slate-700/50">
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
            updateReq(reqs.length, pwd.length >= 8, '8+ characters');
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
