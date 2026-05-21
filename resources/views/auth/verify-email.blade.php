
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
            width: 100%;
        }

        .btn-submit:hover {
            background: var(--accent-hover);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-submit:active {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary {
            background-color: #e5e7eb;
            color: #374151;
            padding: 0.8rem 1.8rem;
            border-radius: 0.625rem;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border: 1px solid #d1d5db;
            cursor: pointer;
            width: 100%;
        }

        .btn-secondary:hover {
            background-color: #d1d5db;
            border-color: #9ca3af;
        }

        /* Light Card Container */
        .card-container {
            background: #ffffff;
            border: 1px solid var(--border-subtle);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* Alert Styling */
        .alert-success {
            background: #d1fae5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            padding: 0.75rem 1rem;
            border-radius: 0.625rem;
            font-size: 0.9rem;
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

    <div class="min-h-screen flex items-center justify-center px-4 py-4 sm:px-6 lg:px-8 relative overflow-hidden" style="background-color: var(--bg-primary);">

        <!-- Background Spheres -->
        <div class="fixed inset-0 z-0 pointer-events-none">
            <div class="sphere sphere-1"></div>
            <div class="sphere sphere-2"></div>
            <div class="sphere sphere-3"></div>
            <div class="sphere sphere-4"></div>
        </div>

        <!-- Main Container -->
        <div class="relative z-10 w-full max-w-md card-container rounded-2xl overflow-hidden">

            <!-- Content -->
            <div class="p-8 lg:p-10 flex flex-col justify-center">

                <!-- Header -->
                <div class="mb-8 text-center fade-transition">
                    <h1 class="text-4xl font-bold text-gray-900 mb-3">Verify Email</h1>
                    <p class="text-gray-600 text-sm">Check your inbox to confirm your email address</p>
                </div>

                <!-- Message -->
                <p class="text-gray-600 text-sm mb-6 fade-transition">
                    A verification link has been sent to <span class="font-semibold text-green-600">{{ Auth::user()->email }}</span>. Click the link to verify your email address.
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert-success mb-6 fade-transition">
                        A new verification link has been sent to your email.
                    </div>
                @endif

                <!-- Resend Button -->
                <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
                    @csrf
                    <button type="submit" class="btn-submit fade-transition">
                        Resend Verification Email
                    </button>
                </form>

                <!-- Sign Out Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-secondary fade-transition">
                        Sign Out
                    </button>
                </form>

                <!-- Footer -->
                <div class="mt-6 pt-6 border-t border-slate-700/30">
                    <p class="text-center text-slate-400 text-xs">
                        Didn't receive the email? Check your spam folder.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
