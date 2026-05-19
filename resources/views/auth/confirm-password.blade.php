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
            width: 100%;
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
                    <h1 class="text-4xl font-bold text-gray-900 mb-3">Confirm Password</h1>
                    <p class="text-gray-600 text-sm">This is a secure area of the application. Please confirm your password before continuing.</p>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
                    @csrf

                    <!-- Password -->
                    <div class="fade-transition">
                        <label for="password" class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wide">Password</label>
                        <input id="password" name="password" type="password" required autocomplete="current-password"
                               class="input-field w-full @error('password') error @enderror"
                               placeholder="Enter your password">
                        @error('password')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="w-full mt-5 btn-submit fade-transition">
                        Confirm
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
