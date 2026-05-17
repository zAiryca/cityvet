<x-guest-layout>
    <div class="min-h-screen bg-slate-900 flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <!-- Header -->
            <div class="mb-8 text-center">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-emerald-600 rounded-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Reset Password</h1>
                <p class="text-slate-400 text-sm">Create a new password for your account</p>
            </div>

            <!-- Form -->
            <div class="bg-slate-800 rounded-lg border border-slate-700 shadow-xl p-8">
                <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email Address</label>
                        <input id="email" name="email" type="email" required value="{{ old('email', $request->email) }}"
                               class="w-full px-4 py-2.5 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent @error('email') border-red-500 @enderror"
                               placeholder="you@example.com">
                        @error('email')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-300 mb-2">New Password</label>
                        <input id="password" name="password" type="password" required
                               class="w-full px-4 py-2.5 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent @error('password') border-red-500 @enderror"
                               placeholder="Create a strong password">
                        @error('password')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-2">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                               class="w-full px-4 py-2.5 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent @error('password_confirmation') border-red-500 @enderror"
                               placeholder="Re-enter your password">
                        @error('password_confirmation')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:ring-offset-2 focus:ring-offset-slate-900">
                        Reset Password
                    </button>
                </form>

                <div class="mt-6 pt-6 border-t border-slate-700">
                    <p class="text-center text-slate-400 text-sm">
                        Remember your password?
                        <a href="{{ route('login') }}" class="text-emerald-400 hover:text-emerald-300 font-medium">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
