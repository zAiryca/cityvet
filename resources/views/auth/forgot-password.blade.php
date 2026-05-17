<x-guest-layout>
    <div class="min-h-screen bg-slate-900 flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <!-- Header -->
            <div class="mb-8 text-center">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-emerald-600 rounded-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Forgot Password</h1>
                <p class="text-slate-400 text-sm">Enter your email to receive a reset link</p>
            </div>

            <!-- Form -->
            <div class="bg-slate-800 rounded-lg border border-slate-700 shadow-xl p-8">
                @if (session('status'))
                    <div class="mb-4 p-3 bg-emerald-900/50 border border-emerald-500/50 text-emerald-200 text-sm rounded-lg">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email Address</label>
                        <input id="email" name="email" type="email" required value="{{ old('email') }}"
                               class="w-full px-4 py-2.5 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent @error('email') border-red-500 @enderror"
                               placeholder="you@example.com" autofocus>
                        @error('email')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:ring-offset-2 focus:ring-offset-slate-900">
                        Send Reset Link
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
