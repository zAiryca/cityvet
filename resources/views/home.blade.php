@extends('layouts.app')

@section('title', '| Home')

@section('content')
<div class="bg-white pt-28">
    <!-- Hero Section -->
    <div class="px-4 py-20 text-white bg-gradient-to-r from-blue-600 to-green-600">
        <div class="mx-auto text-center max-w-7xl">
            <h1 class="mb-6 text-5xl font-bold md:text-6xl">Welcome to City Vet - FindFurEver</h1>
            <p class="max-w-3xl mx-auto text-xl text-blue-100 md:text-2xl">Pet Recovery and Adoption System for Alaminos City</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="px-4 py-16 mx-auto max-w-7xl">
        <!-- Quick Navigation Summary Section -->
        <div class="mb-20">
            <h2 class="mb-12 text-4xl font-bold text-center text-gray-900">Quick Links</h2>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                <div class="transition-all duration-300 bg-white border-t-4 border-red-500 shadow-xl hover:shadow-2xl">
    <div class="flex items-center justify-center h-40 p-6 bg-red-50">
        <svg class="w-20 h-20 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            {{-- Replaced microphone icon path with a cage/bars icon path --}}
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18M3 10h18M3 14h18M3 18h18M4 6V4a2 2 0 012-2h12a2 2 0 012 2v2M4 18v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
        </svg>
    </div>
    <div class="p-6">
        <h3 class="mb-2 text-xl font-bold text-gray-900">Impounded Pets</h3>
        <p class="mb-4 text-sm text-gray-600">Pets in our care waiting to be reunited with their owners</p>
        <a href="{{ route('pets.impounded') }}" class="inline-flex items-center gap-2 font-bold text-red-600 hover:text-red-700">
            Browse Pets
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</div>

                <!-- Adoptable Pets Card -->
                <div class="transition-all duration-300 bg-white border-t-4 border-green-500 shadow-xl hover:shadow-2xl">
                    <div class="flex items-center justify-center h-40 p-6 bg-green-50">
                        <svg class="w-20 h-20 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="mb-2 text-xl font-bold text-gray-900">Adoptable Pets</h3>
                        <p class="mb-4 text-sm text-gray-600">Find your new best friend ready for a loving home</p>
                        <a href="{{ route('pets.adoptable') }}" class="inline-flex items-center gap-2 font-bold text-green-600 hover:text-green-700">
                            Find Pets
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Lost & Found Card -->
                <div class="transition-all duration-300 bg-white border-t-4 border-purple-500 shadow-xl hover:shadow-2xl">
                    <div class="flex items-center justify-center h-40 p-6 bg-purple-50">
                        <svg class="w-20 h-20 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="mb-2 text-xl font-bold text-gray-900">Lost & Found</h3>
                        <p class="mb-4 text-sm text-gray-600">Help reunite lost pets with their families</p>
                        <a href="{{ route('posters.index') }}" class="inline-flex items-center gap-2 font-bold text-purple-600 hover:text-purple-700">
                            View Posters
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Announcements Card -->
                <div class="transition-all duration-300 bg-white border-t-4 border-blue-500 shadow-xl hover:shadow-2xl">
                    <div class="flex items-center justify-center h-40 p-6 bg-blue-50">
                        <svg class="w-20 h-20 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.961 1.961 0 01-2.868 1.755l-2.823-1.977a3.882 3.882 0 00-2.12-.63H2.5A1.5 1.5 0 011 15.89V8.11A1.5 1.5 0 012.5 6.61h.69a3.882 3.882 0 002.12-.63l2.823-1.977A1.961 1.961 0 0111 5.882z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="mb-2 text-xl font-bold text-gray-900">Announcements</h3>
                        <p class="mb-4 text-sm text-gray-600">Latest updates and important news from our office</p>
                        <a href="{{ route('announcements.index') }}" class="inline-flex items-center gap-2 font-bold text-blue-600 hover:text-blue-700">
                            View All
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pet Care Information Section -->
        <div class="mb-20">
            <div class="mb-12 text-center">
                <h2 class="mb-4 text-4xl font-bold text-gray-900">Caring for Your Pets</h2>
                <div class="w-20 h-1 mx-auto bg-blue-600"></div>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <!-- Pet Health Card -->
                <div class="p-8 bg-white border-l-4 border-blue-600 shadow-lg">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-blue-600">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-2xl font-bold text-center text-gray-900">Pet Health</h3>
                    <p class="leading-relaxed text-center text-gray-700">
                        Regular veterinary check-ups, vaccinations, and preventive care ensure your pets live long, healthy lives. Schedule routine wellness exams to catch health issues early.
                    </p>
                </div>

                <!-- Pet Safety Card -->
                <div class="p-8 bg-white border-l-4 border-green-600 shadow-lg">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-green-600">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-2xl font-bold text-center text-gray-900">Pet Safety</h3>
                    <p class="leading-relaxed text-center text-gray-700">
                        Keep your pets safe with proper identification tags, microchipping, and secure living spaces. Always supervise outdoor activities and pet-proof your home environment.
                    </p>
                </div>

                <!-- Pet Nutrition Card -->
                <div class="p-8 bg-white border-l-4 border-purple-600 shadow-lg">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-purple-600">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-2xl font-bold text-center text-gray-900">Pet Nutrition</h3>
                    <p class="leading-relaxed text-center text-gray-700">
                        Proper nutrition is essential for your pet's well-being. Provide balanced meals appropriate for their age, size, and activity level. Fresh water should always be available.
                    </p>
                </div>
            </div>
        </div>



        <!-- Responsible Pet Ownership Section -->
        <div class="mb-20">
            <div class="mb-12 text-center">
                <h2 class="mb-4 text-4xl font-bold text-gray-900">Responsible Pet Ownership</h2>
                <div class="w-20 h-1 mx-auto bg-green-600"></div>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                <div class="flex items-start gap-4 p-6 bg-white border-l-4 border-blue-600 shadow-md">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center w-12 h-12 text-white bg-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="mb-2 text-lg font-bold text-gray-900">Register Your Pet</h3>
                        <p class="text-gray-700">Keep your pet registered with proper documentation and updated vaccination records for their safety and legal compliance.</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-6 bg-white border-l-4 border-green-600 shadow-md">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center w-12 h-12 text-white bg-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="mb-2 text-lg font-bold text-gray-900">Commit Time & Attention</h3>
                        <p class="text-gray-700">Dedicate quality time for exercise, play, training, and bonding. Pets need daily interaction and mental stimulation.</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-6 bg-white border-l-4 border-purple-600 shadow-md">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center w-12 h-12 text-white bg-purple-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="mb-2 text-lg font-bold text-gray-900">Provide Proper Shelter</h3>
                        <p class="text-gray-700">Ensure your pet has a safe, clean, and comfortable living space protected from extreme weather and hazards.</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-6 bg-white border-l-4 border-orange-600 shadow-md">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center w-12 h-12 text-white bg-orange-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="mb-2 text-lg font-bold text-gray-900">Show Love & Care</h3>
                        <p class="text-gray-700">Build a strong bond through patience, positive reinforcement, and understanding your pet's unique personality and needs.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Final CTA Section -->
        <div class="p-12 text-center text-white shadow-xl bg-gradient-to-r from-blue-600 to-green-600">
            <h2 class="mb-4 text-3xl font-bold">Start Your Pet Journey Today</h2>
            <p class="max-w-2xl mx-auto mb-8 text-lg text-blue-100">
                Whether you're looking to adopt, register your pet, or need veterinary services, we're here to support you every step of the way.
            </p>
            <div class="flex flex-col justify-center gap-4 sm:flex-row">
                <a href="{{ route('pets.adoptable') }}" class="px-8 py-3 font-bold text-blue-600 transition-colors bg-white hover:bg-blue-50">
                    View Adoptable Pets
                </a>
                <a href="{{ route('contact') }}" class="px-8 py-3 font-bold text-white transition-colors bg-blue-700 border-2 border-white hover:bg-blue-800">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
