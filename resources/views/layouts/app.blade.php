<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/b3dd8eb464.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            /* Using !important less is better, but kept for consistency */
            font-family: 'Poppins', sans-serif !important;
            background-color: #ffffff;
            margin: 0;
            /* Padding for fixed navigation bar */
            padding-top: 70px;
        }

        * {
            font-family: 'Poppins', sans-serif !important;
        }

        /* Nav styles */
        nav {
            position: fixed;
            z-index: 1000;
        }

        /* Keep hover animation consistent */
        .navbar-nav .nav-link {
            position: relative;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        /* Hover color */
        .navbar-nav .nav-link:hover {
            color: #ff6600;
        }

        /* Animated underline */
        .navbar-nav .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0%;
            height: 2px;
            background-color: #ff6600;
            transition: width 0.3s ease-in-out;
        }

        /* Hover underline animation */
        .navbar-nav .nav-link:hover::after {
            width: 100%;
        }

        /* Active link stays highlighted */
        .navbar-nav .nav-link.active {
            color: #ff6600;
            background-color: rgba(255, 102, 0, 0.1);
            border-radius: 4px;
            padding: 6px 10px;
        }

        .navbar-nav .nav-link.active::after {
            width: 100%;
        }


        /*3logo*/
        .img {
            margin: -20px;
            height: 200px;
            width: 200px;
            z-index: -1;
        }

        .img2 {
            margin: -50px;
            height: 225px;
            width: 225px;
            z-index: 1;
            background: transparent;
        }

        .img4 {
            height: 245px;
            z-index: -1;
            margin: -25px;
        }

        .content {
            padding: 50px 20px;
        }

        .content h3 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .content p {
            font-size: 16px;
            line-height: 1.5;
        }

        .content ul {
            margin-top: 10px;
        }

        .logo-section {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            margin: 40px 0;
        }

        .logo-section img {
            max-width: 100%;
            height: auto;
            border-radius: 0;
            background: transparent;
            padding: 0;
            box-shadow: none;
        }

        .btn-custom {
            margin-right: 10px;
            margin-top: 20px;
        }

        .chat-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #00d1c7;
            border: none;
            border-radius: 50%;
            padding: 15px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.3);
        }

        .chat-btn i {
            color: white;
            font-size: 24px;
        }


        .hero-text {
            margin-top: -2rem;
            text-align: center;
        }

        .hero-text h2 {
            font-weight: bold;
            margin-bottom: -5rem;
        }

        .hero-text h2 span {
            color: #f39c12;
        }

        .btn-custom {
            transition: transform 0.25s ease-in-out;
        }

        .btn-custom:hover {
            transform: scale(1.12);
        }


        /* Responsive Breakpoints */
        @media (max-width: 992px) {
            .lostpet {
                flex: 0 0 calc(50% - 1.5rem);
                max-width: calc(50% - 1.5rem);
            }
        }

        @media (max-width: 576px) {
            .lostpet {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
    <title>City Vet @yield('title', '')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta name="theme-color" content="#ffffff">
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        @if (isset($header))
            <header class="bg-white shadow">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main>
            @yield('content')
        </main>
    </div>

    <footer class="py-4 text-white bg-gray-800">
        <div class="px-4 mx-auto text-center max-w-7xl">
            <p>&copy; {{ date('Y') }} Alaminos City Veterinary Office. All rights reserved.</p>
        </div>
        <!-- Logout Confirmation Modal -->
        <div x-data="{ showLogoutModal: false }" @open-logout-modal.window="showLogoutModal = true"
            x-show="showLogoutModal" class="fixed inset-0 z-[9999] overflow-y-auto" style="display: none;"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

            <!-- Modal Wrapper -->
            <div class="flex min-h-screen items-center justify-center p-4 text-center">
                <div x-show="showLogoutModal" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-2xl bg-white p-6 text-center shadow-2xl transition-all sm:my-8 w-full sm:max-w-md border border-slate-100"
                    @click.away="showLogoutModal = false">

                    <!-- Close Button -->
                    <button type="button" @click="showLogoutModal = false"
                        class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 transition focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="text-center w-full">
                        <!-- Centered Icon -->
                        <div
                            class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-red-50 text-red-500 mb-4 shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl font-bold text-slate-900 mb-2">{{ __('Confirm Logout') }}</h3>

                        <!-- Paragraph -->
                        <p class="text-sm text-slate-500 leading-relaxed max-w-xs mx-auto mb-6">
                            {{ __('Are you sure you want to log out of your account?') }}
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex items-center justify-between gap-3 w-full">
                        <button type="button" @click="showLogoutModal = false"
                            class="flex-1 justify-center rounded-xl bg-white px-4 py-3 text-sm font-bold text-slate-700 border border-slate-200 hover:bg-slate-50 hover:text-slate-800 transition active:scale-98 shadow-sm">
                            {{ __('Cancel') }}
                        </button>
                        <form id="globalLogoutForm" method="POST" action="{{ route('logout') }}" class="flex-1">
                            @csrf
                            <button type="submit"
                                class="w-full justify-center rounded-xl bg-red-600 px-4 py-3 text-sm font-bold text-white hover:bg-red-700 transition active:scale-98 shadow-md shadow-red-100 hover:shadow-lg hover:shadow-red-200">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>