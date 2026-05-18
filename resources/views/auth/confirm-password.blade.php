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
            width: 100%;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, var(--accent-hover) 0%, #00905f 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 184, 128, 0.35);
        }

        .btn-submit:active {
            transform: translateY(-1px);
        }

        /* Premium Card Container */
        .card-container {
            background: linear-gradient(135deg, rgba(17, 28, 42, 0.9) 0%, rgba(17, 28, 42, 0.85) 100%);
            backdrop-filter: blur(var(--glass-blur));
            border: 1px solid rgba(42, 59, 80, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4), 0 0 1px rgba(0, 184, 128, 0.1);
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
                    <h1 class="text-4xl font-bold text-white mb-3">Confirm Password</h1>
                    <p class="text-slate-300 text-sm">This is a secure area of the application. Please confirm your password before continuing.</p>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
                    @csrf

                    <!-- Password -->
                    <div class="fade-transition">
                        <label for="password" class="block text-xs font-semibold text-slate-200 mb-1.5 uppercase tracking-wide">Password</label>
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
