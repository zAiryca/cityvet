@extends('layouts.app')

@section('title', '| Home')

@section('content')
<div class="bg-gradient-to-b from-blue-50 to-white pt-28">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-green-600 text-white py-20 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">Welcome to City Veterinary Office</h1>
            <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">Your trusted partner for comprehensive veterinary services and animal welfare in Alaminos City</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <!-- Quick Navigation Summary Section -->
        <div class="mb-20">
            <h2 class="text-4xl font-bold text-gray-900 mb-12 text-center">Explore Our Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Impounded Pets Card -->
                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border-t-4 border-red-500 group">
                    <div class="bg-gradient-to-br from-red-50 to-orange-50 p-6 h-40 flex items-center justify-center">
                        <svg class="h-20 w-20 text-red-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 016 0v6a3 3 0 01-3 3z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">🏥 Impounded Pets</h3>
                        <p class="text-gray-600 text-sm mb-4">Pets in our care waiting to be reunited with their owners</p>
                        <a href="{{ route('pets.impounded') }}" class="inline-flex items-center gap-2 text-red-600 font-bold hover:text-red-700 group-hover:gap-3 transition-all">
                            Browse Pets
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Adoptable Pets Card -->
                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border-t-4 border-green-500 group">
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-6 h-40 flex items-center justify-center">
                        <svg class="h-20 w-20 text-green-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h-2m0 0H10m2 0v2m0-2v-2m7 7h-4m0 0h-4m4 0v2m0-2v-2m3-6h.01M3 7a6 6 0 1112 0A6 6 0 013 7z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">❤️ Adoptable Pets</h3>
                        <p class="text-gray-600 text-sm mb-4">Find your new best friend ready for a loving home</p>
                        <a href="{{ route('pets.adoptable') }}" class="inline-flex items-center gap-2 text-green-600 font-bold hover:text-green-700 group-hover:gap-3 transition-all">
                            Find Pets
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Lost & Found Card -->
                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border-t-4 border-purple-500 group">
                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-6 h-40 flex items-center justify-center">
                        <svg class="h-20 w-20 text-purple-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">📍 Lost & Found</h3>
                        <p class="text-gray-600 text-sm mb-4">Help reunite lost pets with their families</p>
                        <a href="{{ route('posters.index') }}" class="inline-flex items-center gap-2 text-purple-600 font-bold hover:text-purple-700 group-hover:gap-3 transition-all">
                            View Posters
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Announcements Card -->
                <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border-t-4 border-blue-500 group">
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-6 h-40 flex items-center justify-center">
                        <svg class="h-20 w-20 text-blue-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.961 1.961 0 01-2.868 1.755m0 0L5.309 18.72M9.13 19.24l3.308 2.316m0 0l3.308-2.316m0 0a1.961 1.961 0 00-2.868-1.755m0 0L15.75 19.24M4.5 12.857V11a6 6 0 0112 0v1.857m-6-4h.008v.008H10.5v-.008z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">📢 Announcements</h3>
                        <p class="text-gray-600 text-sm mb-4">Latest updates and important news from our office</p>
                        <a href="{{ route('announcements.index') }}" class="inline-flex items-center gap-2 text-blue-600 font-bold hover:text-blue-700 group-hover:gap-3 transition-all">
                            View All
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- About Section -->
        <div class="mb-20 bg-white rounded-xl p-12 shadow-md">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">About Us</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    The City Veterinary Office is dedicated to providing exceptional veterinary services and promoting animal health and welfare throughout Alaminos City.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Vision Card -->
                <div class="border-l-4 border-blue-500 pl-6 py-4">
                    <div class="flex items-center mb-4">
                        <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-blue-100 mr-3">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Our Vision</h3>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        A progressive city with a healthy local economy through modernized livestock production and a healthy citizenry.
                    </p>
                </div>

                <!-- Mission Card -->
                <div class="border-l-4 border-green-500 pl-6 py-4">
                    <div class="flex items-center mb-4">
                        <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-green-100 mr-3">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Our Mission</h3>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        A proactive office responsive to animal industry needs, guided by standards and committed to exceptional veterinary services.
                    </p>
                </div>

                <!-- Values Card -->
                <div class="border-l-4 border-purple-500 pl-6 py-4">
                    <div class="flex items-center mb-4">
                        <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-purple-100 mr-3">
                            <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Our Values</h3>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        Compassion, integrity, excellence, and community commitment guide everything we do.
                    </p>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('about') }}" class="inline-flex items-center gap-2 text-blue-600 font-bold hover:text-blue-700">
                    Learn More About Us
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="mb-20 bg-gradient-to-r from-blue-50 to-green-50 rounded-xl p-12">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Get in Touch</h2>
                <p class="text-lg text-gray-600">Have questions? We're here to help!</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Phone Card -->
                <div class="bg-white rounded-lg p-8 shadow-md hover:shadow-lg transition-shadow border-l-4 border-blue-500">
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-blue-100 mb-4">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Phone</h3>
                    <p class="text-gray-600 mb-2">
                        <a href="tel:0998-546-5754" class="hover:text-blue-600 font-semibold">0998-546-5754</a>
                    </p>
                    <p class="text-gray-600">
                        <a href="tel:0929-798-1266" class="hover:text-blue-600 font-semibold">0929-798-1266</a>
                    </p>
                </div>

                <!-- Email Card -->
                <div class="bg-white rounded-lg p-8 shadow-md hover:shadow-lg transition-shadow border-l-4 border-green-500">
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-green-100 mb-4">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Email</h3>
                    <p class="text-gray-600">
                        <a href="mailto:acp.cityvet@gmail.com" class="hover:text-green-600 font-semibold">acp.cityvet@gmail.com</a>
                    </p>
                    <p class="text-gray-500 text-sm mt-2">We respond within 24 hours</p>
                </div>

                <!-- Address Card -->
                <div class="bg-white rounded-lg p-8 shadow-md hover:shadow-lg transition-shadow border-l-4 border-purple-500">
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-purple-100 mb-4">
                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Location</h3>
                    <p class="text-gray-600 font-semibold">City Veterinary Office</p>
                    <p class="text-gray-600 text-sm">Slaughterhouse Compound, Sabaro</p>
                    <p class="text-gray-600 text-sm">Poblacion, Alaminos City</p>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-green-600 text-white px-8 py-3 rounded-lg font-bold hover:shadow-lg transition-shadow">
                    Contact Us
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Features Section -->
        <div class="mb-20">
            <h2 class="text-4xl font-bold text-gray-900 mb-12 text-center">Why Choose Us</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow border-t-4 border-blue-500">
                    <div class="text-4xl mb-4">🏥</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Professional Team</h3>
                    <p class="text-gray-600 text-sm">Experienced veterinarians dedicated to animal care</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow border-t-4 border-green-500">
                    <div class="text-4xl mb-4">💰</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Affordable Prices</h3>
                    <p class="text-gray-600 text-sm">Quality care at competitive prices</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow border-t-4 border-purple-500">
                    <div class="text-4xl mb-4">🏢</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Modern Facilities</h3>
                    <p class="text-gray-600 text-sm">State-of-the-art equipment and technology</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow border-t-4 border-orange-500">
                    <div class="text-4xl mb-4">🤝</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Community First</h3>
                    <p class="text-gray-600 text-sm">Dedicated to animal welfare education</p>
                </div>
            </div>
        </div>

        <!-- Final CTA Section -->
        <div class="bg-gradient-to-r from-blue-600 to-green-600 rounded-xl p-12 text-center text-white">
            <h2 class="text-3xl font-bold mb-4">Ready to Help Your Pet?</h2>
            <p class="text-lg text-blue-100 mb-8 max-w-2xl mx-auto">
                Whether you need to find a lost pet, adopt a new family member, or get veterinary services, we're here to help!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('pets.impounded') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold hover:bg-blue-50 transition-colors">
                    Browse Pets
                </a>
                <a href="{{ route('contact') }}" class="bg-blue-700 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-800 transition-colors border border-white">
                    Get in Touch
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
