<nav x-data="{ open: false }" class="fixed top-0 z-50 w-full bg-gray-900 border-b border-gray-800 shadow-xl">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Single Row Navigation -->
        <div class="flex items-center justify-between h-20">

            <!-- Logo: Mobile & Tablet only (hidden on lg+) -->
            <div class="flex items-center lg:hidden">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('image/overall.png') }}" alt="City Veterinary Office" class="h-12 w-auto object-contain">
                </a>
            </div>

            <!-- Desktop Navigation Links (Centered, visible on lg and up) -->
            <div class="hidden lg:flex lg:items-center lg:justify-center lg:flex-1 lg:space-x-1 xl:space-x-2 px-6">
                <!-- Home -->
                <a href="{{ route('home') }}"
                    class="inline-flex items-center text-xs xl:text-sm font-semibold transition-all duration-200 px-2 xl:px-3 py-2.5 rounded-lg {{ request()->routeIs('home') ? 'bg-gray-800 text-white shadow-md' : 'text-gray-300 hover:text-white hover:bg-gray-800' }}">
                    <svg class="hidden xl:block flex-shrink-0 w-4 h-4 mr-1.5 {{ request()->routeIs('home') ? 'text-white' : 'text-gray-400' }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>Home
                </a>

                <!-- Impounded -->
                <a href="{{ route('pets.impounded') }}"
                    class="inline-flex items-center text-xs xl:text-sm font-semibold transition-all duration-200 px-2 xl:px-3 py-2.5 rounded-lg {{ request()->routeIs('pets.impounded') ? 'bg-gray-800 text-white shadow-md' : 'text-gray-300 hover:text-white hover:bg-gray-800' }}">
                    <svg class="hidden xl:block flex-shrink-0 w-4 h-4 mr-1.5 {{ request()->routeIs('pets.impounded') ? 'fill-white' : 'fill-gray-400' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M234.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5 .3-86.2 32.6-96.8 70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3-14.3-70.1 10.2-84.1 59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5l0 1.6c0 25.8-20.9 46.7-46.7 46.7-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2-25.8 0-46.7-20.9-46.7-46.7l0-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3 29.1 51.7 10.2 84.1-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5 46.9 53.9 32.6 96.8-52.1 69.1-84.4 58.5z" />
                    </svg>Impounded
                </a>

                <!-- Adoptable -->
                <a href="{{ route('pets.adoptable') }}"
                    class="inline-flex items-center text-xs xl:text-sm font-semibold transition-all duration-200 px-2 xl:px-3 py-2.5 rounded-lg {{ request()->routeIs('pets.adoptable') ? 'bg-gray-800 text-white shadow-md' : 'text-gray-300 hover:text-white hover:bg-gray-800' }}">
                    <svg class="hidden xl:block flex-shrink-0 w-4 h-4 mr-1.5 {{ request()->routeIs('pets.adoptable') ? 'text-white' : 'text-gray-400' }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>Adoptable
                </a>

                <!-- Lost & Found -->
                <a href="{{ route('posters.index') }}"
                    class="inline-flex items-center text-xs xl:text-sm font-semibold transition-all duration-200 px-2 xl:px-3 py-2.5 rounded-lg {{ request()->routeIs('posters.index') ? 'bg-gray-800 text-white shadow-md' : 'text-gray-300 hover:text-white hover:bg-gray-800' }}">
                    <svg class="hidden xl:block flex-shrink-0 w-4 h-4 mr-1.5 {{ request()->routeIs('posters.index') ? 'text-white' : 'text-gray-400' }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>Lost & Found
                </a>

                <!-- Announcements -->
                <a href="{{ route('announcements.index') }}"
                    class="inline-flex items-center text-xs xl:text-sm font-semibold transition-all duration-200 px-2 xl:px-3 py-2.5 rounded-lg {{ request()->routeIs('announcements.index') ? 'bg-gray-800 text-white shadow-md' : 'text-gray-300 hover:text-white hover:bg-gray-800' }}">
                    <svg class="hidden xl:block flex-shrink-0 w-4 h-4 mr-1.5 {{ request()->routeIs('announcements.index') ? 'text-white' : 'text-gray-400' }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                    </svg>Announcements
                </a>

                <!-- About -->
                <a href="{{ route('about') }}"
                    class="inline-flex items-center text-xs xl:text-sm font-semibold transition-all duration-200 px-2 xl:px-3 py-2.5 rounded-lg {{ request()->routeIs('about') ? 'bg-gray-800 text-white shadow-md' : 'text-gray-300 hover:text-white hover:bg-gray-800' }}">
                    <svg class="hidden xl:block flex-shrink-0 w-4 h-4 mr-1.5 {{ request()->routeIs('about') ? 'text-white' : 'text-gray-400' }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>About
                </a>

                <!-- Contact Us -->
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center text-xs xl:text-sm font-semibold transition-all duration-200 px-2 xl:px-3 py-2.5 rounded-lg whitespace-nowrap {{ request()->routeIs('contact') ? 'bg-gray-800 text-white shadow-md' : 'text-gray-300 hover:text-white hover:bg-gray-800' }}">
                    <svg class="hidden xl:block flex-shrink-0 w-4 h-4 mr-1.5 {{ request()->routeIs('contact') ? 'text-white' : 'text-gray-400' }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>Contact Us
                </a>
            </div>

            <!-- Desktop Auth Section (Visible on lg and up) -->
            <div class="hidden lg:flex lg:items-center lg:gap-3 flex-shrink-0">
                @guest
                    <!-- Login Button -->
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center px-5 py-2.5 text-base font-bold text-gray-900 transition duration-150 ease-in-out bg-white border-2 border-white rounded-lg shadow-lg hover:bg-gray-100 hover:shadow-xl transform hover:-translate-y-0.5 whitespace-nowrap">
                        <svg class="flex-shrink-0 w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>Login
                    </a>
                @else
                    <!-- User Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-4 py-2 text-base font-medium leading-4 text-white transition duration-150 ease-in-out bg-gray-800 border border-gray-700 rounded-xl hover:bg-gray-700 focus:outline-none">
                                <svg class="flex-shrink-0 w-5 h-5 mr-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="max-w-[120px] truncate">{{ auth()->user()->first_name }}</span>
                                <svg class="flex-shrink-0 w-4 h-4 ml-2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="border border-pink-200 shadow-lg bg-gradient-to-br from-pink-50 to-purple-50 rounded-xl">
                                <x-dropdown-link :href="route('profile.edit')"
                                    class="flex items-center text-gray-700 transition-colors hover:bg-pink-100">
                                    <svg class="flex-shrink-0 w-5 h-5 mr-2 text-pink-400" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>Profile
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('pet-registrations.index')"
                                    class="flex items-center text-gray-700 transition-colors hover:bg-purple-100">
                                    <svg class="flex-shrink-0 w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512">
                                        <path fill="#B197FC"
                                            d="M234.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5 .3-86.2 32.6-96.8 70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3-14.3-70.1 10.2-84.1 59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5l0 1.6c0 25.8-20.9 46.7-46.7 46.7-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2-25.8 0-46.7-20.9-46.7-46.7l0-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3 29.1 51.7 10.2 84.1-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5 46.9 53.9 32.6 96.8-52.1 69.1-84.4 58.5z" />
                                    </svg>My Pets
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('user.posters')"
                                    class="flex items-center text-gray-700 transition-colors hover:bg-blue-100">
                                    <svg class="flex-shrink-0 w-5 h-5 mr-2 text-blue-400" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>Lost & Found Posters
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('user.requests')"
                                    class="flex items-center text-gray-700 transition-colors hover:bg-green-100">
                                    <svg class="flex-shrink-0 w-5 h-5 mr-2 text-green-400"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                    </svg>My Requests
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('user.adopted-claimed-pets')"
                                    class="flex items-center text-gray-700 transition-colors hover:bg-yellow-100">
                                    <svg class="flex-shrink-0 w-5 h-5 mr-2 text-yellow-400"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>Claimed or Adopted Pets
                                </x-dropdown-link>
                                <div class="border-t border-pink-200"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); window.dispatchEvent(new CustomEvent('open-logout-modal'));"
                                        class="flex items-center text-red-600 transition-colors hover:bg-red-100">
                                        <svg class="flex-shrink-0 w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>Log Out
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                @endguest
            </div>

            <!-- Mobile Hamburger Button (Visible on tablet/mobile < 1024px) -->
            <div class="flex items-center lg:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2.5 text-gray-400 hover:text-white transition duration-150 ease-in-out rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-gray-700">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path :class="{'hidden': open, 'inline-flex': ! open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Menu (Visible on tablet/mobile < 1024px, toggled via open state) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden bg-gray-900 border-t border-gray-800 max-h-[calc(100vh-5rem)] overflow-y-auto shadow-2xl transition-all duration-300 ease-in-out">
        <div class="px-3 pt-3 pb-4 space-y-1.5">
            <!-- Home -->
            <a href="{{ route('home') }}"
                class="flex items-center px-4 py-3 text-base font-semibold rounded-lg transition-all duration-200 {{ request()->routeIs('home') ? 'bg-gray-800 text-white border-l-4 border-indigo-500 shadow-md' : 'text-gray-300 hover:text-white hover:bg-gray-800 border-l-4 border-transparent' }}">
                <svg class="flex-shrink-0 w-5 h-5 mr-3 {{ request()->routeIs('home') ? 'text-white' : 'text-gray-400' }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>Home
            </a>

            <!-- Impounded -->
            <a href="{{ route('pets.impounded') }}"
                class="flex items-center px-4 py-3 text-base font-semibold rounded-lg transition-all duration-200 {{ request()->routeIs('pets.impounded') ? 'bg-gray-800 text-white border-l-4 border-indigo-500 shadow-md' : 'text-gray-300 hover:text-white hover:bg-gray-800 border-l-4 border-transparent' }}">
                <svg class="flex-shrink-0 w-5 h-5 mr-3 {{ request()->routeIs('pets.impounded') ? 'fill-white' : 'fill-gray-400' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M234.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5 .3-86.2 32.6-96.8 70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3-14.3-70.1 10.2-84.1 59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5l0 1.6c0 25.8-20.9 46.7-46.7 46.7-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2-25.8 0-46.7-20.9-46.7-46.7l0-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3 29.1 51.7 10.2 84.1-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5 46.9 53.9 32.6 96.8-52.1 69.1-84.4 58.5z" />
                </svg>Impounded
            </a>

            <!-- Adoptable -->
            <a href="{{ route('pets.adoptable') }}"
                class="flex items-center px-4 py-3 text-base font-semibold rounded-lg transition-all duration-200 {{ request()->routeIs('pets.adoptable') ? 'bg-gray-800 text-white border-l-4 border-indigo-500 shadow-md' : 'text-gray-300 hover:text-white hover:bg-gray-800 border-l-4 border-transparent' }}">
                <svg class="flex-shrink-0 w-5 h-5 mr-3 {{ request()->routeIs('pets.adoptable') ? 'text-white' : 'text-gray-400' }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>Adoptable
            </a>

            <!-- Lost & Found -->
            <a href="{{ route('posters.index') }}"
                class="flex items-center px-4 py-3 text-base font-semibold rounded-lg transition-all duration-200 {{ request()->routeIs('posters.index') ? 'bg-gray-800 text-white border-l-4 border-indigo-500 shadow-md' : 'text-gray-300 hover:text-white hover:bg-gray-800 border-l-4 border-transparent' }}">
                <svg class="flex-shrink-0 w-5 h-5 mr-3 {{ request()->routeIs('posters.index') ? 'text-white' : 'text-gray-400' }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>Lost & Found
            </a>

            <!-- Announcements -->
            <a href="{{ route('announcements.index') }}"
                class="flex items-center px-4 py-3 text-base font-semibold rounded-lg transition-all duration-200 {{ request()->routeIs('announcements.index') ? 'bg-gray-800 text-white border-l-4 border-indigo-500 shadow-md' : 'text-gray-300 hover:text-white hover:bg-gray-800 border-l-4 border-transparent' }}">
                <svg class="flex-shrink-0 w-5 h-5 mr-3 {{ request()->routeIs('announcements.index') ? 'text-white' : 'text-gray-400' }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                </svg>Announcements
            </a>

            <!-- About -->
            <a href="{{ route('about') }}"
                class="flex items-center px-4 py-3 text-base font-semibold rounded-lg transition-all duration-200 {{ request()->routeIs('about') ? 'bg-gray-800 text-white border-l-4 border-indigo-500 shadow-md' : 'text-gray-300 hover:text-white hover:bg-gray-800 border-l-4 border-transparent' }}">
                <svg class="flex-shrink-0 w-5 h-5 mr-3 {{ request()->routeIs('about') ? 'text-white' : 'text-gray-400' }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>About
            </a>

            <!-- Contact -->
            <a href="{{ route('contact') }}"
                class="flex items-center px-4 py-3 text-base font-semibold rounded-lg transition-all duration-200 {{ request()->routeIs('contact') ? 'bg-gray-800 text-white border-l-4 border-indigo-500 shadow-md' : 'text-gray-300 hover:text-white hover:bg-gray-800 border-l-4 border-transparent' }}">
                <svg class="flex-shrink-0 w-5 h-5 mr-3 {{ request()->routeIs('contact') ? 'text-white' : 'text-gray-400' }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>Contact Us
            </a>
        </div>

        <!-- Mobile Account / Auth Section -->
        <div class="pt-4 pb-4 border-t border-gray-800 bg-gray-950/40">
            @auth
                <div class="px-4 mb-3">
                    <div class="text-xs font-bold text-gray-500 uppercase tracking-wider">Account Menu</div>
                    <div class="text-sm font-medium text-white truncate mt-0.5">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
                </div>

                <div class="px-2 space-y-1">
                    <!-- Profile -->
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-semibold rounded-lg text-gray-300 hover:text-white hover:bg-gray-800 transition-all duration-200 {{ request()->routeIs('profile.edit') ? 'bg-gray-800 text-white' : '' }}">
                        <svg class="flex-shrink-0 w-4 h-4 mr-3 text-pink-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>Profile
                    </a>

                    <!-- My Pets -->
                    <a href="{{ route('pet-registrations.index') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-semibold rounded-lg text-gray-300 hover:text-white hover:bg-gray-800 transition-all duration-200 {{ request()->routeIs('pet-registrations.index') ? 'bg-gray-800 text-white' : '' }}">
                        <svg class="flex-shrink-0 w-4 h-4 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="#B197FC"
                                d="M234.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5 .3-86.2 32.6-96.8 70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3-14.3-70.1 10.2-84.1 59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5l0 1.6c0 25.8-20.9 46.7-46.7 46.7-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2-25.8 0-46.7-20.9-46.7-46.7l0-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3 29.1 51.7 10.2 84.1-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5 46.9 53.9 32.6 96.8-52.1 69.1-84.4 58.5z" />
                        </svg>My Pets
                    </a>

                    <!-- Lost & Found Posters -->
                    <a href="{{ route('user.posters') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-semibold rounded-lg text-gray-300 hover:text-white hover:bg-gray-800 transition-all duration-200 {{ request()->routeIs('user.posters') ? 'bg-gray-800 text-white' : '' }}">
                        <svg class="flex-shrink-0 w-4 h-4 mr-3 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>Lost & Found Posters
                    </a>

                    <!-- My Requests -->
                    <a href="{{ route('user.requests') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-semibold rounded-lg text-gray-300 hover:text-white hover:bg-gray-800 transition-all duration-200 {{ request()->routeIs('user.requests') ? 'bg-gray-800 text-white' : '' }}">
                        <svg class="flex-shrink-0 w-4 h-4 mr-3 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>My Requests
                    </a>

                    <!-- Claimed or Adopted Pets -->
                    <a href="{{ route('user.adopted-claimed-pets') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-semibold rounded-lg text-gray-300 hover:text-white hover:bg-gray-800 transition-all duration-200 {{ request()->routeIs('user.adopted-claimed-pets') ? 'bg-gray-800 text-white' : '' }}">
                        <svg class="flex-shrink-0 w-4 h-4 mr-3 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>Claimed or Adopted Pets
                    </a>

                    <!-- Log Out -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); window.dispatchEvent(new CustomEvent('open-logout-modal'));"
                            class="flex items-center px-4 py-2.5 text-sm font-semibold rounded-lg text-red-400 hover:text-red-300 hover:bg-red-950/30 transition-all duration-200">
                            <svg class="flex-shrink-0 w-4 h-4 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>Log Out
                        </a>
                    </form>
                </div>
            @else
                <div class="px-3 space-y-2">
                    <!-- Login -->
                    <a href="{{ route('login') }}"
                        class="flex items-center justify-center w-full px-4 py-2.5 text-base font-bold text-center text-gray-900 bg-white hover:bg-gray-100 transition-all duration-200 rounded-lg shadow">
                        <svg class="flex-shrink-0 w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>Login
                    </a>
                    <!-- Register -->
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="flex items-center justify-center w-full px-4 py-2.5 text-base font-bold text-center text-white border-2 border-gray-700 hover:bg-gray-800 transition-all duration-200 rounded-lg">
                            <svg class="flex-shrink-0 w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>Register
                        </a>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</nav>