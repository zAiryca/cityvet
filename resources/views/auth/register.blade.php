<x-guest-layout>
    <div class="min-h-screen bg-slate-900 flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <!-- Header -->



            <div class="mb-8 text-center">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-emerald-600 rounded-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">City Vet</h1>
                <p class="text-slate-400 text-sm">
                    {{ request('role') === 'admin' ? 'Employee Portal' : 'Pet Lover Community' }}
                </p>
            </div>

            <!-- Register Form -->
            <div class="bg-slate-800 rounded-lg border border-slate-700 shadow-xl p-8">
                <h2 class="text-2xl font-bold text-white mb-1">Create Account</h2>
                <p class="text-slate-400 text-sm mb-6">
                    {{ request('role') === 'admin' ? 'Join our team' : 'Join our community' }}
                </p>

                <form method="POST" action="{{ route('register') }}" class="space-y-4" id="registration-form">
                    @csrf
                    <input type="hidden" name="role" value="{{ request('role') }}">

                    <!-- First Name & Last Name -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-slate-300 mb-2">First Name</label>
                            <input id="first_name" name="first_name" type="text" required value="{{ old('first_name') }}"
                                   class="w-full px-4 py-2.5 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent @error('first_name') border-red-500 @enderror"
                                   placeholder="Juan">
                            @error('first_name')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-medium text-slate-300 mb-2">Last Name</label>
                            <input id="last_name" name="last_name" type="text" required value="{{ old('last_name') }}"
                                   class="w-full px-4 py-2.5 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent @error('last_name') border-red-500 @enderror"
                                   placeholder="Dela Cruz">
                            @error('last_name')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Contact Number -->
                    <div>
                        <label for="contact_number" class="block text-sm font-medium text-slate-300 mb-2">Contact Number</label>
                        <input id="contact_number" name="contact_number" type="text" required value="{{ old('contact_number') }}"
                               class="w-full px-4 py-2.5 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent @error('contact_number') border-red-500 @enderror"
                               placeholder="09123456789">
                        <p class="mt-1 text-xs text-slate-500">Format: 09XXXXXXXXX (11 digits)</p>
                        @error('contact_number')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email Address</label>
                        <input id="email" name="email" type="email" required value="{{ old('email') }}"
                               class="w-full px-4 py-2.5 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent @error('email') border-red-500 @enderror"
                               placeholder="you@example.com">
                        @error('email')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" required
                                   class="w-full px-4 py-2.5 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent @error('password') border-red-500 @enderror"
                                   placeholder="Create a strong password">
                            <button type="button" id="toggle-password" class="absolute right-3 top-2.5 text-slate-400 hover:text-slate-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        <div id="password-requirements" class="mt-2 grid grid-cols-2 gap-2 text-xs text-slate-400">
                            <div id="req-length" class="flex items-center"><span class="w-2 h-2 mr-2 bg-red-500 rounded-full"></span>8+ characters</div>
                            <div id="req-uppercase" class="flex items-center"><span class="w-2 h-2 mr-2 bg-red-500 rounded-full"></span>Uppercase</div>
                            <div id="req-lowercase" class="flex items-center"><span class="w-2 h-2 mr-2 bg-red-500 rounded-full"></span>Lowercase</div>
                            <div id="req-number" class="flex items-center"><span class="w-2 h-2 mr-2 bg-red-500 rounded-full"></span>Number</div>
                            <div id="req-special" class="flex items-center"><span class="w-2 h-2 mr-2 bg-red-500 rounded-full"></span>Special char</div>
                        </div>
                        @error('password')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-2">Confirm Password</label>
                        <div class="relative">
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                   class="w-full px-4 py-2.5 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent"
                                   placeholder="Re-enter your password">
                            <button type="button" id="toggle-password-confirmation" class="absolute right-3 top-2.5 text-slate-400 hover:text-slate-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        <p id="confirm_password_warning" class="hidden mt-1 text-xs text-red-400">Passwords do not match</p>
                    </div>

                    <!-- Terms -->
                    <div class="bg-slate-700/50 border border-slate-600 rounded-lg p-4">
                        <label for="terms" class="flex items-start text-sm text-slate-300 cursor-pointer">
                            <input id="terms" name="terms" type="checkbox" class="w-4 h-4 mt-0.5 rounded bg-slate-600 border-slate-500 text-emerald-600 focus:ring-emerald-600">
                            <span class="ml-3">
                                I agree to the
                                <button type="button" id="open-terms-modal" class="text-emerald-400 hover:text-emerald-300 underline">
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
                    <button type="submit" id="submit-button" class="w-full px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:ring-offset-2 focus:ring-offset-slate-900">
                        Create Account
                    </button>
                </form>

                <!-- Sign In Link -->
                <div class="mt-6 pt-6 border-t border-slate-700">
                    <p class="text-center text-slate-400 text-sm">
                        Already have an account?
                        <a href="{{ route('login', ['role' => request('role')]) }}" class="text-emerald-400 hover:text-emerald-300 font-medium">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Terms Modal -->
    <div id="terms-modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 flex items-center justify-center p-4">
        <div class="bg-slate-800 border border-slate-700 rounded-lg max-w-md w-full max-h-96 overflow-y-auto">
            <div class="sticky top-0 bg-slate-800 border-b border-slate-700 p-4 flex items-center justify-between">
                <h3 class="text-lg font-bold text-white">Terms and Conditions</h3>
                <button type="button" id="close-terms-modal" class="text-slate-400 hover:text-slate-300">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-4 text-sm text-slate-300 space-y-3">
                <h4 class="font-semibold text-white">City Vet - Pet Recovery & Adoption System</h4>
                <p class="text-xs text-slate-400">This policy governs the use of City Vet system which facilitates pet registration, adoption, and community lost/found reports.</p>

                <h5 class="font-semibold text-white text-sm">1. User Interactions</h5>
                <ul class="text-xs space-y-1 text-slate-400 list-disc list-inside">
                    <li>All accounts are linked to Alaminos City, Pangasinan</li>
                    <li>Pet registration requires verified residency</li>
                    <li>Impounded pets may be claimed within 3 days</li>
                    <li>Adoptable pets are visible for maximum 4 days</li>
                    <li>Submitting false information results in account termination</li>
                </ul>

                <h5 class="font-semibold text-white text-sm">2. Community Submissions</h5>
                <ul class="text-xs space-y-1 text-slate-400 list-disc list-inside">
                    <li>Posters must include accurate description and location</li>
                    <li>Contact information will be visible to other users</li>
                    <li>Mark pets as reunited immediately upon recovery</li>
                </ul>
            </div>

            <div class="sticky bottom-0 bg-slate-800 border-t border-slate-700 p-4">
                <button type="button" id="agree-and-close" class="w-full px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg">
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
