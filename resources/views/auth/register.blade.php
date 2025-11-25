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
            <div class="absolute w-64 h-64 bg-white rounded-full opacity-10 -top-20 -left-20"></div>
            <div class="absolute bg-white rounded-full w-96 h-96 opacity-10 top-1/3 -right-32"></div>
            <div class="absolute w-48 h-48 bg-white rounded-full opacity-10 bottom-10 left-1/4"></div>

            <div class="relative z-10 flex flex-col items-center justify-center h-full px-12 text-white">
                <div class="mb-8">
                    <div class="flex items-center justify-center w-32 h-32 bg-white rounded-full shadow-2xl">
                        <svg class="w-20 h-20 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                </div>

                <h1 class="mb-4 text-5xl font-bold text-center">Welcome! 🐾</h1>
                <p class="mb-2 text-xl font-semibold text-center">
                    {{ request('role') === 'admin' ? 'Employee Portal' : 'Pet Lover Community' }}
                </p>
                <p class="max-w-md text-center opacity-90">
                    {{ request('role') === 'admin'
                        ? 'Join our team to help reunite pets with their families and manage adoptions.'
                        : 'Create an account to help lost pets find their way home and discover pets looking for forever families.' }}
                </p>

                <div class="absolute text-6xl opacity-20 bottom-10 left-10">🐾</div>
                <div class="absolute text-5xl opacity-20 top-20 right-20">🐾</div>
            </div>
        </div>

        <div class="flex items-center justify-center w-full px-6 py-8 overflow-y-auto lg:w-1/2 sm:px-8">
            <div class="w-full max-w-xl">
                <div class="mb-4 text-center lg:hidden">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-2 bg-green-500 rounded-full">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Join Our Family! 🐾</h2>
                </div>

                <div class="mb-4">
                    <h2 class="mb-1 text-2xl font-bold text-gray-900">Create Account</h2>
                    <p class="text-sm text-gray-600">Please fill in your information</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-3" id="registration-form">
                    @csrf
                    <input type="hidden" name="role" value="{{ request('role') }}">

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="first_name" class="block mb-1 text-xs font-medium text-gray-700">First Name *</label>
                            <input id="first_name" name="first_name" type="text" required value="{{ old('first_name') }}"
                                   class="w-full px-3 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('first_name') border-red-500 @enderror"
                                   placeholder="Juan">
                            <p id="first_name_warning" class="hidden mt-1 text-xs text-red-500">⚠️ First name is required.</p>
                            @error('first_name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="last_name" class="block mb-1 text-xs font-medium text-gray-700">Last Name *</label>
                            <input id="last_name" name="last_name" type="text" required value="{{ old('last_name') }}"
                                   class="w-full px-3 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('last_name') border-red-500 @enderror"
                                   placeholder="Dela Cruz">
                            <p id="last_name_warning" class="hidden mt-1 text-xs text-red-500">⚠️ Last name is required.</p>
                            @error('last_name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="contact_number" class="block mb-1 text-xs font-medium text-gray-700">Contact Number *</label>
                        <input id="contact_number" name="contact_number" type="text" required value="{{ old('contact_number') }}"
                               class="w-full px-3 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('contact_number') border-red-500 @enderror"
                               placeholder="09123456789">
                        <p class="mt-0.5 text-xs text-gray-500">
                            ℹ️ Format: 09XXXXXXXXX (11 digits)
                        </p>
                        <p id="contact_warning" class="hidden mt-1 text-xs text-red-500">⚠️ Must be 11 digits, starting with 09.</p>
                        @error('contact_number')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block mb-1 text-xs font-medium text-gray-700">Email Address *</label>
                        <input id="email" name="email" type="email" required value="{{ old('email') }}"
                               class="w-full px-3 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('email') border-red-500 @enderror"
                               placeholder="juan@example.com">
                        <p id="email_warning" class="hidden mt-1 text-xs text-red-500">⚠️ Please enter a valid email address.</p>
                        @error('email')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block mb-1 text-xs font-medium text-gray-700">Password *</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" required
                                   class="w-full px-3 py-2 pr-10 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('password') border-red-500 @enderror"
                                   placeholder="Create a strong password">
                            <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>

                        <div id="password-requirements" class="mt-1 grid grid-cols-2 gap-x-3 gap-y-0.5 text-xs text-gray-600 p-2 bg-gray-50 rounded-lg">
                            <p id="req-length" class="flex items-center">
                                <span class="inline-block w-3 h-3 mr-1 text-red-500">❌</span> 8+ characters
                            </p>
                            <p id="req-uppercase" class="flex items-center">
                                <span class="inline-block w-3 h-3 mr-1 text-red-500">❌</span> Uppercase letter
                            </p>
                            <p id="req-lowercase" class="flex items-center">
                                <span class="inline-block w-3 h-3 mr-1 text-red-500">❌</span> Lowercase letter
                            </p>
                            <p id="req-number" class="flex items-center">
                                <span class="inline-block w-3 h-3 mr-1 text-red-500">❌</span> Number (0-9)
                            </p>
                            <p id="req-special" class="flex items-center">
                                <span class="inline-block w-3 h-3 mr-1 text-red-500">❌</span> Special character
                            </p>
                        </div>
                        @error('password')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block mb-1 text-xs font-medium text-gray-700">Confirm Password *</label>
                        <div class="relative">
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                   class="w-full px-3 py-2 pr-10 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                   placeholder="Re-enter your password">
                            <button type="button" id="toggle-password-confirmation" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        <p id="confirm_password_warning" class="hidden mt-1 text-xs text-red-500">⚠️ Passwords do not match.</p>
                    </div>

                    <div class="border-2 border-green-200 rounded-lg">
                        <div class="p-2 bg-green-100 border-b border-green-200">
                            <h3 class="text-xs font-bold text-green-900">📋 Terms & Conditions</h3>
                        </div>

                        <div class="p-2 border-t border-green-200 bg-gray-50">
                            <label for="terms" class="flex items-start cursor-pointer">
                                <input id="terms" name="terms" type="checkbox"
                                       class="w-4 h-4 mt-0.5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                                <span class="ml-2 text-xs text-gray-700">
                                    I agree to the
                                    <button type="button" id="open-terms-modal" class="font-medium text-green-600 underline hover:text-green-700 focus:outline-none">
                                        Terms and Conditions
                                    </button>
                                </span>
                                <p id="terms-warning" class="mt-0.5 ml-2 text-xs font-medium text-red-500 hidden">
                                    ⚠️ Please read and check the box.
                                </p>
                            </label>
                            @error('terms')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" id="submit-button"
                            class="w-full py-2.5 text-sm font-semibold text-white bg-green-500 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        Create Account
                    </button>

                    <p class="text-xs text-center text-gray-600">
                        Already have an account?
                        <a href="{{ route('login', ['role' => request('role')]) }}"
                           class="font-medium text-green-600 hover:text-green-700">
                            Sign in here
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <div id="terms-modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-600 bg-opacity-75">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-xl sm:w-full sm:p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <div>
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold leading-6 text-green-700" id="modal-headline">
                             Terms and Conditions
                        </h3>
                        <button type="button" id="close-terms-modal" class="text-gray-400 hover:text-gray-500">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="p-2 mt-4 overflow-y-auto text-sm text-gray-600 border rounded-lg max-h-96">
                        <h3 class="font-bold text-gray-800">Policy: City Vet - FindFurEver System (Alaminos City)</h3>
                        <p class="mb-3 text-xs italic text-gray-500">This policy governs the use of the City Vet - FindFurEver, which facilitates the management of pet registration, impoundment, adoption, and community lost/found reports in Alaminos City, Pangasinan.</p>

                        <h4 class="mt-2 font-bold text-gray-900">I.  User-to-Admin / City Vet Interactions</h4>
                        <ul class="pl-4 space-y-1 text-xs text-gray-700 list-disc">
                            <li>Residency: All user accounts are linked to Pangasinan Province and Alaminos City.</li>
        <li>Pet Registration: Only confirmed Alaminos City residents can submit pets for registration. The City Vet Admin will review the submission (including ID/address verification) and reserves the right to Approve or Deny.</li>
        <li>Impounding: Owners have **three (3) days** to officially claim an impounded pet.</li>
        <li>Adoptable: If unclaimed after 3 days, the pet moves to Adoptable status, visible for a maximum of **four (4) days**.</li>
        <li>Adoption Form: Approval of the form is required for pre-screening before an in-person assessment. Form approval IS NOT the final adoption.</li>
        <li class="font-semibold text-red-600">Submitting false information is grounds for account termination.</li>
                        </ul>

                        <h4 class="mt-2 font-bold text-gray-900">II. 🤝 User-to-User Interactions (Lost and Found)</h4>
                        <ul class="pl-4 space-y-1 text-xs text-gray-700 list-disc">
                           <li>Poster Submission: Must include accurate description, location, and valid contact information.</li>
        <li>Contact Information: By submitting, the user explicitly consents to have their user-provided contact information visible to other users for reunification purposes.</li>
        <li>Reunion Status: The poster creator must mark the poster as "Reunited" immediately upon pet's return.</li>
                        </ul>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6">
                    <button type="button" id="agree-and-close"
                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm">
                        I have read and agree to the Terms
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // --- Password Toggle Logic (Kept as is) ---
        function setupPasswordToggle(inputId, toggleId) {
            document.getElementById(toggleId).addEventListener('click', function() {
                const passwordInput = document.getElementById(inputId);
                const icon = this.querySelector('svg');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />';
                } else {
                    passwordInput.type = 'password';
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
                }
            });
        }
        setupPasswordToggle('password', 'toggle-password');
        setupPasswordToggle('password_confirmation', 'toggle-password-confirmation');


        // --- REAL-TIME PASSWORD VALIDATION LOGIC (Kept as is) ---
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const confirmPasswordWarning = document.getElementById('confirm_password_warning');

        const reqs = {
            length: document.getElementById('req-length'),
            uppercase: document.getElementById('req-uppercase'),
            lowercase: document.getElementById('req-lowercase'),
            number: document.getElementById('req-number'),
            special: document.getElementById('req-special')
        };

        const checkMark = '<span class="inline-block w-3 h-3 mr-1 text-green-500">✅</span>';
        const crossMark = '<span class="inline-block w-3 h-3 mr-1 text-red-500">❌</span>';

        function updateRequirement(reqElement, condition) {
            reqElement.innerHTML = condition ? reqElement.innerHTML.replace(crossMark, checkMark) : reqElement.innerHTML.replace(checkMark, crossMark);
            reqElement.classList.toggle('text-green-600', condition);
            reqElement.classList.toggle('text-red-500', !condition);
        }

        function validatePassword() {
            const password = passwordInput.value;

            updateRequirement(reqs.length, password.length >= 8);
            updateRequirement(reqs.uppercase, /[A-Z]/.test(password));
            updateRequirement(reqs.lowercase, /[a-z]/.test(password));
            updateRequirement(reqs.number, /[0-9]/.test(password));
            updateRequirement(reqs.special, /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password));

            const confirmation = confirmPasswordInput.value;
            const matchCondition = confirmation.length > 0 && password === confirmation;
            confirmPasswordWarning.classList.toggle('hidden', matchCondition);

            confirmPasswordInput.classList.toggle('border-red-500', !matchCondition && confirmation.length > 0);
            confirmPasswordInput.classList.toggle('border-gray-300', matchCondition || confirmation.length === 0);

            return password.length >= 8 &&
                   /[A-Z]/.test(password) &&
                   /[a-z]/.test(password) &&
                   /[0-9]/.test(password) &&
                   /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password) &&
                   matchCondition;
        }

        passwordInput.addEventListener('input', validatePassword);
        confirmPasswordInput.addEventListener('input', validatePassword);


        // --- GENERAL FIELD VALIDATION & FORMATTING LOGIC (UPDATED) ---

        const firstNameInput = document.getElementById('first_name');
        const lastNameInput = document.getElementById('last_name');
        const contactInput = document.getElementById('contact_number');
        const emailInput = document.getElementById('email');

        const nameWarning = {
            first: document.getElementById('first_name_warning'),
            last: document.getElementById('last_name_warning')
        };
        const contactWarning = document.getElementById('contact_warning');
        const emailWarning = document.getElementById('email_warning');

        function validateField(inputElement, condition, warningElement) {
            inputElement.classList.toggle('border-red-500', !condition);
            inputElement.classList.toggle('border-gray-300', condition);
            warningElement.classList.toggle('hidden', condition);
            return condition;
        }

        // NEW: Capitalize First Letter Function
        function capitalizeName(input) {
            let value = input.value;
            if (!value) return;

            // Trim leading/trailing spaces and capitalize the first letter
            value = value.trim();
            if (value.length > 0) {
                input.value = value.charAt(0).toUpperCase() + value.slice(1);
            }
        }

        function validateFirstName() {
            capitalizeName(firstNameInput); // Apply formatting
            return validateField(firstNameInput, firstNameInput.value.trim() !== '', nameWarning.first);
        }

        function validateLastName() {
            capitalizeName(lastNameInput); // Apply formatting
            return validateField(lastNameInput, lastNameInput.value.trim() !== '', nameWarning.last);
        }

        function validateContact() {
            // UPDATED: Regex for 11 digits starting with 09
            const contactRegex = /^09\d{9}$/;
            // Ensure only digits are allowed while typing
            contactInput.value = contactInput.value.replace(/\D/g, '');

            return validateField(contactInput, contactRegex.test(contactInput.value), contactWarning);
        }

        function validateEmail() {
            // Basic email regex
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return validateField(emailInput, emailRegex.test(emailInput.value), emailWarning);
        }

        // Add event listeners for other fields
        firstNameInput.addEventListener('blur', validateFirstName);
        lastNameInput.addEventListener('blur', validateLastName);
        contactInput.addEventListener('blur', validateContact);
        emailInput.addEventListener('blur', validateEmail);
        // Also run contact validation on input to guide the user immediately
        contactInput.addEventListener('input', validateContact);


        // --- TERMS & FINAL FORM SUBMISSION LOGIC (Kept as is) ---
        const termsModal = document.getElementById('terms-modal');
        const openTermsButton = document.getElementById('open-terms-modal');
        const closeTermsButton = document.getElementById('close-terms-modal');
        const agreeAndCloseButton = document.getElementById('agree-and-close');
        const termsCheckbox = document.getElementById('terms');
        const termsWarning = document.getElementById('terms-warning');
        const registrationForm = document.getElementById('registration-form');

        // Term modal logic
        openTermsButton.addEventListener('click', function(e) {
            e.preventDefault();
            termsModal.classList.remove('hidden');
        });

        closeTermsButton.addEventListener('click', function() {
            termsModal.classList.add('hidden');
        });

        agreeAndCloseButton.addEventListener('click', function() {
            termsCheckbox.checked = true;
            termsWarning.classList.add('hidden');
            termsModal.classList.add('hidden');
        });

        registrationForm.addEventListener('submit', function(e) {
            // Run all validations on submit
            const isFirstNameValid = validateFirstName();
            const isLastNameValid = validateLastName();
            const isContactValid = validateContact();
            const isEmailValid = validateEmail();
            const isPasswordValid = validatePassword();
            const areTermsAccepted = termsCheckbox.checked;

            if (!(isFirstNameValid && isLastNameValid && isContactValid && isEmailValid && isPasswordValid && areTermsAccepted)) {
                e.preventDefault();

                if (!areTermsAccepted) {
                    termsWarning.classList.remove('hidden');
                    const termsBox = document.querySelector('.border-2.border-green-200');
                    termsBox.classList.add('border-red-500');
                    termsBox.classList.remove('border-green-200');
                    termsCheckbox.scrollIntoView({ behavior: 'smooth', block: 'center' });

                    setTimeout(() => {
                        termsWarning.classList.add('hidden');
                        termsBox.classList.remove('border-red-500');
                        termsBox.classList.add('border-green-200');
                    }, 4000);
                }
            }
        });
    </script>
</x-guest-layout>
