
<x-guest-layout>
    <div class="min-h-screen bg-slate-900 flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <!-- Header -->
            <div class="mb-8 text-center">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-emerald-600 rounded-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Verify Email</h1>
                <p class="text-slate-400 text-sm">Check your inbox to confirm your email address</p>
            </div>

            <!-- Content -->
            <div class="bg-slate-800 rounded-lg border border-slate-700 shadow-xl p-8">
                <p class="text-slate-300 text-sm mb-6">
                    A verification link has been sent to <span class="font-semibold text-emerald-400">{{ Auth::user()->email }}</span>. Click the link to verify your email address.
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 p-3 bg-emerald-900/50 border border-emerald-500/50 text-emerald-200 text-sm rounded-lg">
                        A new verification link has been sent to your email.
                    </div>
                @endif

                <form method="POST" action="{{ route('verification.send') }}" class="space-y-4 mb-4">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:ring-offset-2 focus:ring-offset-slate-900">
                        Resend Verification Email
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2.5 bg-slate-700 hover:bg-slate-600 text-slate-200 font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:ring-offset-2 focus:ring-offset-slate-900">
                        Sign Out
                    </button>
                </form>

                <div class="mt-6 pt-6 border-t border-slate-700">
                    <p class="text-center text-slate-400 text-xs">
                        Didn't receive the email? Check your spam folder.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
