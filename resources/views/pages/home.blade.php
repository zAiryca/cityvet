@extends('layouts.app')

@section('title', '| Home')

@section('content')
<div class="min-h-screen bg-white pt-28">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-green-600 text-white py-20 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">Welcome to City Veterinary Office</h1>
            <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">Your trusted partner for comprehensive veterinary services and animal welfare in Alaminos City</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
                <a href="{{ route('services') }}" class="bg-white text-blue-600 px-8 py-3 font-bold hover:bg-blue-50 transition-colors">
                    Explore Services
                </a>
                <a href="{{ route('contact') }}" class="bg-blue-700 text-white px-8 py-3 font-bold hover:bg-blue-800 transition-colors border-2 border-white">
                    Contact Us
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <!-- About Overview Section -->
        <div class="mb-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Vision Card -->
                <div class="bg-white shadow-lg p-8 border-l-4 border-blue-600">
                    <div class="flex items-center justify-center h-16 w-16 bg-blue-600 mx-auto mb-4">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <div class="bg-white shadow-lg p-8 border-l-4 border-green-600">
                    <div class="flex items-center justify-center h-16 w-16 bg-green-600 mx-auto mb-4">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3 text-center">Our Mission</h3>
                    <p class="text-gray-700 text-center leading-relaxed">
                        A proactive office responsive to the needs of the animal industry, guided by standards and committed to delivering exceptional veterinary services.
                    </p>
                </div>

                <!-- Core Values Card -->
                <div class="bg-white shadow-lg p-8 border-l-4 border-purple-600">
                    <div class="flex items-center justify-center h-16 w-16 bg-purple-600 mx-auto mb-4">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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



    </div>
</div>
@endsection
