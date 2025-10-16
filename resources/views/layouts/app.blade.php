<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CityVet @yield('title', '')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="theme-color" content="#ffffff">
</head>
<body class="antialiased bg-white">
    <!-- Navbar -->
    <nav class="bg-white shadow-md border-b-2 border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo/Brand -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-black font-bold text-2xl hover:text-gray-700 transition-colors">CityVet</a>
                </div>
                <!-- Desktop Menu - Always Visible -->
                <div class="flex items-center space-x-2">
                    <a href="{{ route('home') }}" class="text-black hover:bg-gray-100 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Home</a>
                    <a href="{{ route('pets.impounded') }}" class="text-black hover:bg-gray-100 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Impounded Pets</a>
                    <a href="{{ route('pets.adoptable') }}" class="text-black hover:bg-gray-100 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Adoptable Pets</a>
                    <a href="{{ route('posters.index') }}" class="text-black hover:bg-gray-100 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Lost & Found</a>
                    <a href="{{ route('events.index') }}" class="text-black hover:bg-gray-100 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Events</a>
                    <a href="{{ route('about') }}" class="text-black hover:bg-gray-100 px-4 py-2 rounded-lg text-sm font-medium transition-colors">About</a>
                    <a href="{{ route('contact') }}" class="text-black hover:bg-gray-100 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Contact</a>
                    <a href="{{ route('donate') }}" class="bg-green-500 text-white hover:bg-green-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">Donate</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-purple-500 text-white hover:bg-purple-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white hover:bg-red-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">Logout ({{ auth()->user()->name }})</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-500 text-white hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">Login</a>
                        <a href="{{ route('register') }}" class="bg-orange-500 text-white hover:bg-orange-600 px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Session Messages -->
        @if (session('success'))
            <div class="bg-green-50 border-2 border-green-500 text-black px-4 py-3 rounded-lg relative mb-4 shadow-sm" role="alert">
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-black cursor-pointer hover:text-gray-700" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-50 border-2 border-red-500 text-black px-4 py-3 rounded-lg relative mb-4 shadow-sm" role="alert">
                <span class="block sm:inline font-medium">{{ session('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-black cursor-pointer hover:text-gray-700" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-50 border-2 border-red-500 text-black px-4 py-3 rounded-lg relative mb-4 shadow-sm" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li class="font-medium">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t-2 border-gray-200 text-black text-center py-6 mt-8">
        <p class="font-medium">&copy; 2024 CityVet. All rights reserved. |
            <a href="{{ route('contact') }}" class="text-blue-500 hover:text-blue-700 hover:underline transition-colors">Contact Us</a> |
            <a href="{{ route('faq') }}" class="text-blue-500 hover:text-blue-700 hover:underline transition-colors">FAQ</a> |
            <a href="{{ route('location') }}" class="text-blue-500 hover:text-blue-700 hover:underline transition-colors">Location</a>
        </p>
    </footer>
</body>
</html>
