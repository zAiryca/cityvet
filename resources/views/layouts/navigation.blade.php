<nav x-data="{ open: false }" class="fixed top-0 z-50 w-full bg-gray-900 border-b-2 border-gray-800 shadow-xl">
    <div class="px-6 mx-auto max-w-7xl sm:px-8 lg:px-10">
        <!-- Single Row Navigation -->
        <div class="flex items-center justify-between h-20">

            <!-- Navigation Links - Centered with better spacing -->
            <div class="hidden lg:flex lg:items-center lg:justify-center lg:flex-1 lg:space-x-1">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')"
                    class="text-sm font-semibold text-white hover:text-gray-300 transition-all duration-200 px-3 py-2.5 rounded-lg {{ request()->routeIs('home') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800' }}">
                    <svg class="flex-shrink-0 w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>Home
                </x-nav-link>
                <x-nav-link :href="route('pets.impounded')" :active="request()->routeIs('pets.impounded')"
                    class="text-sm font-semibold text-white hover:text-gray-300 transition-all duration-200 px-3 py-2.5 rounded-lg {{ request()->routeIs('pets.impounded') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800' }}">
                    <svg class="flex-shrink-0 w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#ffffff" d="M234.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5 .3-86.2 32.6-96.8 70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3-14.3-70.1 10.2-84.1 59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5l0 1.6c0 25.8-20.9 46.7-46.7 46.7-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2-25.8 0-46.7-20.9-46.7-46.7l0-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3 29.1 51.7 10.2 84.1-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5 46.9 53.9 32.6 96.8-52.1 69.1-84.4 58.5z"/></svg>Impounded
                </x-nav-link>
                <x-nav-link :href="route('pets.adoptable')" :active="request()->routeIs('pets.adoptable')"
                    class="text-sm font-semibold text-white hover:text-gray-300 transition-all duration-200 px-3 py-2.5 rounded-lg {{ request()->routeIs('pets.adoptable') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800' }}">
                    <svg class="flex-shrink-0 w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>Adoptable
                </x-nav-link>
                <x-nav-link :href="route('posters.index')" :active="request()->routeIs('posters.index')"
                    class="text-sm font-semibold text-white hover:text-gray-300 transition-all duration-200 px-3 py-2.5 rounded-lg {{ request()->routeIs('posters.index') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800' }}">
                    <svg class="flex-shrink-0 w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>Lost & Found
                </x-nav-link>
                <x-nav-link :href="route('announcements.index')" :active="request()->routeIs('announcements.index')"
                    class="text-sm font-semibold text-white hover:text-gray-300 transition-all duration-200 px-3 py-2.5 rounded-lg {{ request()->routeIs('announcements.index') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800' }}">
                    <svg class="flex-shrink-0 w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>Announcements
                </x-nav-link>
                <x-nav-link :href="route('about')" :active="request()->routeIs('about')"
                    class="text-sm font-semibold text-white hover:text-gray-300 transition-all duration-200 px-3 py-2.5 rounded-lg {{ request()->routeIs('about') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800' }}">
                    <svg class="flex-shrink-0 w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>About
                </x-nav-link>
                <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')"
                    class="text-sm font-semibold text-white hover:text-gray-300 transition-all duration-200 px-3 py-2.5 rounded-lg whitespace-nowrap {{ request()->routeIs('contact') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800' }}">
                    <svg class="flex-shrink-0 w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>Contact Us
                </x-nav-link>
            </div>

            <!-- Right Side: Auth Only -->
            <div class="hidden lg:flex lg:items-center lg:gap-3">
                @guest
                    <!-- Login Button -->
                    <a href="{{ route('login') }}" class="inline-flex items-center px-5 py-2.5 text-base font-bold text-gray-900 transition duration-150 ease-in-out bg-white border-2 border-white rounded-lg shadow-lg hover:bg-gray-100 hover:shadow-xl transform hover:-translate-y-0.5">
                        <svg class="flex-shrink-0 w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>Login
                    </a>
                @else
                    <!-- User Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 text-base font-medium leading-4 text-white transition duration-150 ease-in-out bg-gray-800 border border-gray-700 rounded-xl hover:bg-gray-700 focus:outline-none">
                                <svg class="flex-shrink-0 w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>{{ auth()->user()->first_name }}</span>
                                <svg class="flex-shrink-0 w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="border border-pink-200 shadow-lg bg-gradient-to-br from-pink-50 to-purple-50 rounded-xl">
                                <x-dropdown-link :href="route('profile.edit')" class="flex items-center text-gray-700 transition-colors hover:bg-pink-100">
                                    <svg class="flex-shrink-0 w-5 h-5 mr-2 text-pink-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>Profile
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('pet-registrations.index')" class="flex items-center text-gray-700 transition-colors hover:bg-purple-100">
                                    <svg class="flex-shrink-0 w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#B197FC" d="M234.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5 .3-86.2 32.6-96.8 70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3-14.3-70.1 10.2-84.1 59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5l0 1.6c0 25.8-20.9 46.7-46.7 46.7-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2-25.8 0-46.7-20.9-46.7-46.7l0-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3 29.1 51.7 10.2 84.1-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5 46.9 53.9 32.6 96.8-52.1 69.1-84.4 58.5z"/></svg>My Pets
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('user.posters')" class="flex items-center text-gray-700 transition-colors hover:bg-blue-100">
                                    <svg class="flex-shrink-0 w-5 h-5 mr-2 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>Lost & Found Posters
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('user.requests')" class="flex items-center text-gray-700 transition-colors hover:bg-green-100">
                                    <svg class="flex-shrink-0 w-5 h-5 mr-2 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>My Requests
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('user.adopted-claimed-pets')" class="flex items-center text-gray-700 transition-colors hover:bg-yellow-100">
                                    <svg class="flex-shrink-0 w-5 h-5 mr-2 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>Claimed or Adopted Pets
                                </x-dropdown-link>
                                <div class="border-t border-pink-200"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="if(!confirm('Are you sure you want to log out?')) { event.preventDefault(); } else { event.preventDefault(); this.closest('form').submit(); }"
                                            class="flex items-center text-red-600 transition-colors hover:bg-red-100">
                                        <svg class="flex-shrink-0 w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>Log Out
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                @endguest
            </div>

            <!-- Mobile Hamburger -->
            <div class="flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-3 text-white transition duration-150 ease-in-out rounded-lg hover:text-gray-300 hover:bg-gray-800 focus:outline-none">
                    <i class="text-xl fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Responsive Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden bg-gray-900 border-t border-gray-800 lg:hidden">
        <div class="px-4 pt-4 pb-3 space-y-2">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')"
                class="px-4 py-3 text-base font-semibold text-white transition-colors rounded-lg hover:text-gray-300 hover:bg-gray-800">
                <svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>Home
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pets.impounded')" :active="request()->routeIs('pets.impounded')"
                class="px-4 py-3 text-base font-semibold text-white transition-colors rounded-lg hover:text-gray-300 hover:bg-gray-800">
                <svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M234.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5 .3-86.2 32.6-96.8 70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3-14.3-70.1 10.2-84.1 59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5l0 1.6c0 25.8-20.9 46.7-46.7 46.7-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2-25.8 0-46.7-20.9-46.7-46.7l0-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3 29.1 51.7 10.2 84.1-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5 46.9 53.9 32.6 96.8-52.1 69.1-84.4 58.5z"/></svg>Impounded
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pets.adoptable')" :active="request()->routeIs('pets.adoptable')"
                class="px-4 py-3 text-base font-semibold text-white transition-colors rounded-lg hover:text-gray-300 hover:bg-gray-800">
                <svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>Adoptable
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('posters.index')" :active="request()->routeIs('posters.index')"
                class="px-4 py-3 text-base font-semibold text-white transition-colors rounded-lg hover:text-gray-300 hover:bg-gray-800">
                <svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>Lost & Found
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('announcements.index')" :active="request()->routeIs('announcements.index')"
                class="px-4 py-3 text-base font-semibold text-white transition-colors rounded-lg hover:text-gray-300 hover:bg-gray-800">
                <svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>Announcements
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')"
                class="px-4 py-3 text-base font-semibold text-white transition-colors rounded-lg hover:text-gray-300 hover:bg-gray-800">
                <svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>About
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')"
                class="px-4 py-3 text-base font-semibold text-white transition-colors rounded-lg hover:text-gray-300 hover:bg-gray-800">
                <svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>Contact
            </x-responsive-nav-link>
        </div>

        <!-- Mobile Auth Section -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-800">
                <div class="px-4">
                    <div class="text-base font-semibold text-white">Account Menu</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="px-4 py-3 text-base font-semibold text-white hover:text-gray-300 hover:bg-gray-800">
                        <svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>Profile
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('pet-registrations.index')" class="px-4 py-3 text-base font-semibold text-white hover:text-gray-300 hover:bg-gray-800">
                        <svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#B197FC" d="M234.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5 .3-86.2 32.6-96.8 70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3-14.3-70.1 10.2-84.1 59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5l0 1.6c0 25.8-20.9 46.7-46.7 46.7-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2-25.8 0-46.7-20.9-46.7-46.7l0-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3 29.1 51.7 10.2 84.1-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5 46.9 53.9 32.6 96.8-52.1 69.1-84.4 58.5z"/></svg>My Pets
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('user.posters')" class="px-4 py-3 text-base font-semibold text-white hover:text-gray-300 hover:bg-gray-800">
                        <svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>Lost & Found Posters
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('user.requests')" class="px-4 py-3 text-base font-semibold text-white hover:text-gray-300 hover:bg-gray-800">
                        <svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>My Requests
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('user.adopted-claimed-pets')" class="px-4 py-3 text-base font-semibold text-white hover:text-gray-300 hover:bg-gray-800">
                        <svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>Claimed or Adopted Pets
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="if(!confirm('Are you sure you want to log out?')) { event.preventDefault(); } else { event.preventDefault(); this.closest('form').submit(); }"
                                class="px-4 py-3 text-base font-semibold text-white hover:text-gray-300 hover:bg-gray-800">
                            <svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>Log Out
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-800">
                <div class="px-2 space-y-2">
                    <x-responsive-nav-link :href="route('login')" class="px-4 py-3 text-base font-semibold text-white hover:text-gray-300 hover:bg-gray-800">
                        <svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>Login
                    </x-responsive-nav-link>
                    @if (Route::has('register'))
                        <x-responsive-nav-link :href="route('register')" class="px-4 py-3 text-base font-semibold text-white hover:text-gray-300 hover:bg-gray-800">
                            <svg class="flex-shrink-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>Register
                        </x-responsive-nav-link>
                    @endif
                </div>
            </div>
        @endauth
    </div>
</nav>
