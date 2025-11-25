<nav x-data="{ open: false }" class="fixed top-0 w-full z-50 bg-gray-900 border-b-2 border-gray-800 shadow-xl">
    <div class="px-6 mx-auto max-w-7xl sm:px-8 lg:px-10">
        <!-- Single Row Navigation -->
        <div class="flex items-center justify-between h-20">
            <!-- Left Side: Logo -->
            <div class="flex items-center">
    <a href="{{ route('home') }}" class="flex items-center">
        <div class="rounded-2xl p-2.5 shadow-lg border-2 border-gray-700">
            <img src="{{ asset('storage/logo/Logos.png') }}" alt="Alaminos City Veterinary Office" class="object-contain w-auto h-12">
        </div>
    </a>
</div>

            <!-- Center: Navigation Links -->
            <div class="hidden lg:flex lg:items-center lg:gap-2">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')"
                    class="text-base font-semibold text-white hover:text-gray-300 transition-all duration-200 px-4 py-2.5 rounded-lg {{ request()->routeIs('home') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800' }}">
                    <i class="fas fa-home mr-2"></i>Home
                </x-nav-link>
                <x-nav-link :href="route('pets.impounded')" :active="request()->routeIs('pets.impounded')"
                    class="text-base font-semibold text-white hover:text-gray-300 transition-all duration-200 px-4 py-2.5 rounded-lg {{ request()->routeIs('pets.impounded') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800' }}">
                    <i class="fas fa-shield-heart mr-2"></i>Impounded
                </x-nav-link>
                <x-nav-link :href="route('pets.adoptable')" :active="request()->routeIs('pets.adoptable')"
                    class="text-base font-semibold text-white hover:text-gray-300 transition-all duration-200 px-4 py-2.5 rounded-lg {{ request()->routeIs('pets.adoptable') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800' }}">
                    <i class="fas fa-heart mr-2"></i>Adoptable
                </x-nav-link>
                <x-nav-link :href="route('posters.index')" :active="request()->routeIs('posters.index')"
                    class="text-base font-semibold text-white hover:text-gray-300 transition-all duration-200 px-4 py-2.5 rounded-lg whitespace-nowrap {{ request()->routeIs('posters.index') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800' }}">
                    <i class="fas fa-paw mr-2"></i>Lost & Found
                </x-nav-link>
                <x-nav-link :href="route('announcements.index')" :active="request()->routeIs('announcements.index')"
                    class="text-base font-semibold text-white hover:text-gray-300 transition-all duration-200 px-4 py-2.5 rounded-lg {{ request()->routeIs('announcements.index') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800' }}">
                    <i class="fas fa-bullhorn mr-2"></i>Announcements
                </x-nav-link>
                <x-nav-link :href="route('about')" :active="request()->routeIs('about')"
                    class="text-base font-semibold text-white hover:text-gray-300 transition-all duration-200 px-4 py-2.5 rounded-lg {{ request()->routeIs('about') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800' }}">
                    <i class="fas fa-info-circle mr-2"></i>About
                </x-nav-link>
                <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')"
                    class="text-base font-semibold text-white hover:text-gray-300 transition-all duration-200 px-4 py-2.5 rounded-lg {{ request()->routeIs('contact') ? 'bg-gray-800 text-white shadow-md' : 'hover:bg-gray-800' }}">
                    <i class="fas fa-phone mr-2"></i>Contact
                </x-nav-link>
            </div>

            <!-- Right Side: Auth Only -->
            <div class="hidden lg:flex lg:items-center lg:gap-3">
                @guest
                    <!-- Login Button -->
                    <a href="{{ route('login') }}" class="inline-flex items-center px-5 py-2.5 text-base font-bold text-gray-900 transition duration-150 ease-in-out bg-white border-2 border-white rounded-lg shadow-lg hover:bg-gray-100 hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                @else
                    <!-- User Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 text-base font-medium leading-4 text-white transition duration-150 ease-in-out bg-gray-800 border border-gray-700 rounded-xl hover:bg-gray-700 focus:outline-none">
                                <i class="fas fa-user-circle mr-2"></i>
                                <span>{{ Auth::user()->first_name }}</span>
                                <i class="fas fa-chevron-down ml-2 text-sm"></i>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Dropdown content with pastel styling -->
                            <div class="bg-gradient-to-br from-pink-50 to-purple-50 border border-pink-200 rounded-xl shadow-lg">
                                <x-dropdown-link :href="route('profile.edit')" class="text-gray-700 hover:bg-pink-100 transition-colors">
                                    <i class="fas fa-user mr-2 text-pink-400"></i>Profile
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('pet-registrations.index')" class="text-gray-700 hover:bg-purple-100 transition-colors">
                                    <i class="fas fa-paw mr-2 text-purple-400"></i>My Pets
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('user.posters')" class="text-gray-700 hover:bg-blue-100 transition-colors">
                                    <i class="fas fa-search mr-2 text-blue-400"></i>Lost & Found Posters
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('user.requests')" class="text-gray-700 hover:bg-green-100 transition-colors">
                                    <i class="fas fa-clipboard-list mr-2 text-green-400"></i>My Requests
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('user.adopted-claimed-pets')" class="text-gray-700 hover:bg-yellow-100 transition-colors">
                                    <i class="fas fa-heart mr-2 text-yellow-400"></i>Claimed or Adopted Pets
                                </x-dropdown-link>
                                <div class="border-t border-pink-200"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();"
                                            class="text-red-600 hover:bg-red-100 transition-colors">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Log Out
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
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Responsive Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden bg-gray-900 border-t border-gray-800">
        <div class="px-4 pt-4 pb-3 space-y-2">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')"
                class="text-white hover:text-gray-300 text-base font-semibold transition-colors px-4 py-3 rounded-lg hover:bg-gray-800">
                <i class="fas fa-home mr-3"></i>Home
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pets.impounded')" :active="request()->routeIs('pets.impounded')"
                class="text-white hover:text-gray-300 text-base font-semibold transition-colors px-4 py-3 rounded-lg hover:bg-gray-800">
                <i class="fas fa-shield-heart mr-3"></i>Impounded
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pets.adoptable')" :active="request()->routeIs('pets.adoptable')"
                class="text-white hover:text-gray-300 text-base font-semibold transition-colors px-4 py-3 rounded-lg hover:bg-gray-800">
                <i class="fas fa-heart mr-3"></i>Adoptable
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('posters.index')" :active="request()->routeIs('posters.index')"
                class="text-white hover:text-gray-300 text-base font-semibold transition-colors px-4 py-3 rounded-lg hover:bg-gray-800">
                <i class="fas fa-paw mr-3"></i>Lost & Found
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('announcements.index')" :active="request()->routeIs('announcements.index')"
                class="text-white hover:text-gray-300 text-base font-semibold transition-colors px-4 py-3 rounded-lg hover:bg-gray-800">
                <i class="fas fa-bullhorn mr-3"></i>Announcements
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')"
                class="text-white hover:text-gray-300 text-base font-semibold transition-colors px-4 py-3 rounded-lg hover:bg-gray-800">
                <i class="fas fa-info-circle mr-3"></i>About
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')"
                class="text-white hover:text-gray-300 text-base font-semibold transition-colors px-4 py-3 rounded-lg hover:bg-gray-800">
                <i class="fas fa-phone mr-3"></i>Contact
            </x-responsive-nav-link>
        </div>

        <!-- Mobile Auth Section -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-800">
                <div class="px-4">
                    <div class="text-base font-semibold text-white">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                    <div class="text-sm font-medium text-gray-400">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:text-gray-300 text-base font-semibold px-4 py-3 hover:bg-gray-800">
                        <i class="fas fa-user mr-3"></i>Profile
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('pet-registrations.index')" class="text-white hover:text-gray-300 text-base font-semibold px-4 py-3 hover:bg-gray-800">
                        <i class="fas fa-paw mr-3"></i>My Pets
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('user.posters')" class="text-white hover:text-gray-300 text-base font-semibold px-4 py-3 hover:bg-gray-800">
                        <i class="fas fa-search mr-3"></i>Lost & Found Posters
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('user.requests')" class="text-white hover:text-gray-300 text-base font-semibold px-4 py-3 hover:bg-gray-800">
                        <i class="fas fa-clipboard-list mr-3"></i>My Requests
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('user.adopted-claimed-pets')" class="text-white hover:text-gray-300 text-base font-semibold px-4 py-3 hover:bg-gray-800">
                        <i class="fas fa-heart mr-3"></i>Claimed or Adopted Pets
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="text-white hover:text-gray-300 text-base font-semibold px-4 py-3 hover:bg-gray-800">
                            <i class="fas fa-sign-out-alt mr-3"></i>Log Out
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <!-- Mobile Guest Links -->
            <div class="pt-4 pb-1 border-t border-gray-800">
                <div class="px-2 space-y-2">
                    <x-responsive-nav-link :href="route('login')" class="text-white hover:text-gray-300 text-base font-semibold px-4 py-3 hover:bg-gray-800">
                        <i class="fas fa-sign-in-alt mr-3"></i>Login
                    </x-responsive-nav-link>
                    @if (Route::has('register'))
                        <x-responsive-nav-link :href="route('register')" class="text-white hover:text-gray-300 text-base font-semibold px-4 py-3 hover:bg-gray-800">
                            <i class="fas fa-user-plus mr-3"></i>Register
                        </x-responsive-nav-link>
                    @endif
                </div>
            </div>
        @endauth
    </div>
</nav>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
