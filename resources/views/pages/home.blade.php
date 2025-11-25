@extends('layouts.app')

@section('title', '| Home')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white pt-28">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-green-600 text-white py-20 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">Welcome to City Veterinary Office</h1>
            <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">Your trusted partner for comprehensive veterinary services and animal welfare in Alaminos City</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
                <a href="{{ route('services') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold hover:bg-blue-50 transition-colors">
                    Explore Services
                </a>
                <a href="{{ route('contact') }}" class="bg-blue-700 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-800 transition-colors border border-white">
                    Contact Us
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <!-- About Overview Section -->
        <div class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">About Us</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    The City Veterinary Office is dedicated to providing exceptional veterinary services and promoting animal health and welfare throughout Alaminos City.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Vision Card -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 p-8 border-t-4 border-blue-500">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mx-auto mb-4">
                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3 text-center">Our Vision</h3>
                    <p class="text-gray-700 text-center leading-relaxed">
                        A progressive city with a healthy local economy through modernized livestock production and a healthy citizenry, all in harmony with the environment.
                    </p>
                </div>

                <!-- Mission Card -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 p-8 border-t-4 border-green-500">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mx-auto mb-4">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3 text-center">Our Mission</h3>
                    <p class="text-gray-700 text-center leading-relaxed">
                        A proactive office responsive to the needs of the animal industry, guided by standards and committed to delivering exceptional veterinary services.
                    </p>
                </div>

                <!-- Core Values Card -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 p-8 border-t-4 border-purple-500">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-purple-100 mx-auto mb-4">
                        <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3 text-center">Our Values</h3>
                    <p class="text-gray-700 text-center leading-relaxed">
                        Compassion, integrity, excellence, and community commitment guide everything we do in serving animals and their owners.
                    </p>
                </div>
            </div>
        </div>

        <!-- Services Overview Section -->
        <div class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Services</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    We provide comprehensive veterinary services for livestock, pets, and animal welfare
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Service 1 -->
                <div class="bg-gradient-to-br from-blue-50 to-white rounded-lg p-6 border border-blue-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-center h-14 w-14 rounded-lg bg-blue-100 mb-4">
                        <svg class="h-7 w-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Livestock Services</h3>
                    <p class="text-gray-600 text-sm">Health monitoring and production support for livestock animals</p>
                </div>

                <!-- Service 2 -->
                <div class="bg-gradient-to-br from-green-50 to-white rounded-lg p-6 border border-green-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-center h-14 w-14 rounded-lg bg-green-100 mb-4">
                        <svg class="h-7 w-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 4l-8 8m0 0l8 8M6 12h12" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Pet Registration</h3>
                    <p class="text-gray-600 text-sm">Comprehensive pet registration and identification programs</p>
                </div>

                <!-- Service 3 -->
                <div class="bg-gradient-to-br from-purple-50 to-white rounded-lg p-6 border border-purple-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-center h-14 w-14 rounded-lg bg-purple-100 mb-4">
                        <svg class="h-7 w-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Animal Welfare</h3>
                    <p class="text-gray-600 text-sm">Community education and animal welfare awareness programs</p>
                </div>

                <!-- Service 4 -->
                <div class="bg-gradient-to-br from-orange-50 to-white rounded-lg p-6 border border-orange-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-center h-14 w-14 rounded-lg bg-orange-100 mb-4">
                        <svg class="h-7 w-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Emergency Support</h3>
                    <p class="text-gray-600 text-sm">Quick response for veterinary emergencies and urgent needs</p>
                </div>
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('services') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-green-600 text-white px-8 py-3 rounded-lg font-bold hover:shadow-lg transition-shadow">
                    View All Services
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Why Choose Us Section -->
        <div class="bg-gradient-to-r from-blue-50 to-green-50 rounded-xl p-12 mb-20">
            <h2 class="text-4xl font-bold text-gray-900 mb-12 text-center">Why Choose City Veterinary Office</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Professional & Experienced Team</h3>
                        <p class="text-gray-700">Our dedicated veterinarians and staff are committed to providing the highest quality care</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-600 text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Affordable Services</h3>
                        <p class="text-gray-700">We provide quality veterinary care at competitive prices to serve the community</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-purple-600 text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Modern Facilities</h3>
                        <p class="text-gray-700">Equipped with modern equipment to ensure accurate diagnosis and effective treatment</p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 rounded-md bg-orange-600 text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Community Focused</h3>
                        <p class="text-gray-700">Dedicated to animal welfare education and community engagement programs</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-blue-600 to-green-600 rounded-xl p-12 text-center text-white">
            <h2 class="text-3xl font-bold mb-4">Ready to Get Started?</h2>
            <p class="text-lg text-blue-100 mb-8 max-w-2xl mx-auto">
                Contact us today to learn more about our services or schedule an appointment for your beloved animals.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold hover:bg-blue-50 transition-colors">
                    Get in Touch
                </a>
                <a href="{{ route('about') }}" class="bg-blue-700 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-800 transition-colors border border-white">
                    Learn More About Us
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
