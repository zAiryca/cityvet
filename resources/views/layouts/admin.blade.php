<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="flex min-h-screen bg-slate-50">
        <!-- Sidebar Navigation -->
        <aside class="flex-shrink-0 w-64 text-white shadow-xl bg-gradient-to-b from-slate-900 to-slate-800">
            <!-- Logo Section -->
            <div class="px-6 py-6 border-b border-slate-700">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 transition-opacity duration-200 group hover:opacity-90">
                    <!-- Logo Circle -->
                   <div class="flex items-center justify-center w-10 h-10 transition-shadow duration-200 bg-white rounded-full shadow-md group-hover:shadow-lg">
    <img
        src="https://i.ibb.co/hRbSNnGD/CV-AC-LOGO.png"
        alt="CV-AC Logo"
        class="object-contain w-6 h-6"
    />
</div>
                    <span class="text-xl font-bold tracking-tight">Admin Panel</span>
                </a>
            </div>
            <!-- Navigation -->
            <nav class="flex flex-col px-3 mt-6 space-y-1">
                @php
                function nav_link($route, $text, $svg) {
                    $active = request()->routeIs($route . '*') ? 'bg-slate-700 text-white shadow-md' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white';
                    return '<a href="' . route($route) . '" class="flex items-center px-4 py-3 text-sm font-medium transition-all duration-200 rounded-lg ' . $active . '">' . $svg . '<span>' . $text . '</span></a>';
                }
                @endphp

                {!! nav_link('admin.dashboard', 'Dashboard', '<svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>') !!}
                {!! nav_link('admin.pets.index', 'Pets', '<svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v11.494m-9-5.494h18" /></svg>') !!}
                {!! nav_link('admin.pet-registrations.index', 'Pet Registrations', '<svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>') !!}
                {!! nav_link('admin.announcements.index', 'Announcements', '<svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>') !!}
                {!! nav_link('admin.posters.index', 'Posters', '<svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>') !!}
                {!! nav_link('admin.requests.index', 'Requests', '<svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>') !!}
                <a href="{{ route('admin.adoption-claim-history') }}" class="@if(request()->routeIs('admin.adoption-claim-history')) bg-slate-700 text-white shadow-md @else text-slate-400 hover:bg-slate-700/50 hover:text-white @endif flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200">
                    <svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>Adoption & Claim History</span>
                </a>
                {!! nav_link('admin.users.index', 'Users', '<svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M7.707 9.172A4 4 0 1016.9 8.172M15.75 12.75H8.25m6 2.25a2 2 0 110-4 2 2 0 010 4z" /></svg>') !!}
                {!! nav_link('admin.reports.generate', 'Reports', '<svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V7a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>') !!}
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-col flex-1">
            <!-- Header -->
            <header class="bg-white border-b shadow-sm border-slate-200">
                <div class="flex items-center justify-end px-6 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <!-- Account Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2.5 text-sm font-medium leading-4 text-slate-700 transition duration-150 ease-in-out bg-white border border-slate-300 rounded-lg hover:bg-slate-50 hover:border-slate-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" aria-haspopup="true" aria-expanded="false">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-slate-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>{{ Auth::user()->name }}</span>
                                </div>
                                <div class="ms-2">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="text-slate-700 hover:bg-slate-50">
                                <svg class="inline w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();" class="text-slate-700 hover:bg-slate-50">
                                    <svg class="inline w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 md:p-8 bg-slate-50">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
