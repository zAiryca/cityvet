
<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen px-4 py-12 bg-gradient-to-br from-orange-50 via-amber-100 to-yellow-50">
        <div class="w-full max-w-md p-8 text-center bg-white border border-orange-100 shadow-xl rounded-2xl">
            <!-- Pet-themed illustration -->
            <div class="flex justify-center mb-6">
                <div class="flex items-center justify-center w-24 h-24 rounded-full shadow-lg bg-gradient-to-br from-orange-400 to-amber-500">
                    <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
            </div>
            <h1 class="mb-2 text-2xl font-bold text-gray-900">Verify Your Email Address</h1>
            <p class="mb-4 text-sm text-gray-700">Thank you for joining the Pet Recovery & Adoption System! 🐾<br>To continue, please check your inbox and click the verification link we sent to <span class="font-semibold text-orange-600">{{ Auth::user()->email }}</span>.</p>


            @if (session('unverified'))
                <div class="mb-4 text-sm font-bold text-red-600">
                    {{ session('unverified') }}
                </div>
            @endif

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-sm font-medium text-green-600">
                    {{ __('A new verification link has been sent to your email address.') }}
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
                @csrf
                <button type="submit" class="w-full px-4 py-2 font-semibold text-white transition-all rounded-lg shadow bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                    Resend Verification Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full px-4 py-2 font-semibold text-orange-600 transition-all bg-white border border-orange-200 rounded-lg shadow hover:bg-orange-50 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                    Log Out
                </button>
            </form>

            <div class="mt-6 text-xs text-gray-500">
                <span>Didn't get the email? Check your spam folder or click "Resend Verification Email" above.</span>
            </div>
        </div>
        <div class="mt-8 text-xs text-center text-gray-400">
            "Every pet deserves a loving home" 🏡❤️
        </div>
    </div>
</x-guest-layout>
