@extends('layouts.app')

@section('title', '| About')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white pt-28">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-green-600 text-white py-16 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl font-bold mb-4">City Veterinary Office</h1>
            <p class="text-xl text-blue-100">Serving Alaminos City with Dedication to Animal Health & Welfare</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <!-- Vision Section -->
        <div class="mb-16">
            <div class="flex items-start gap-6">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-16 w-16 rounded-xl bg-blue-100">
                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">VISION</h2>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        We envision a city that is progressive with a local economy propelled by inclusive growth through sound and modernized livestock production, and a healthy citizenry through healthy animals, in harmony with the environment.
                    </p>
                </div>
            </div>
        </div>

        <!-- Mission Section -->
        <div class="mb-16">
            <div class="flex items-start gap-6">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-16 w-16 rounded-xl bg-green-100">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">MISSION</h2>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        A pro-active office that is responsive to the needs of the animal industry and animal lovers, guided with standards and committed to delivering exceptional veterinary services and support.
                    </p>
                </div>
            </div>
        </div>

        <!-- Mandate Section -->
        <div class="mb-16">
            <div class="flex items-start gap-6">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-16 w-16 rounded-xl bg-purple-100">
                        <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">MANDATE</h2>
                    <p class="text-lg text-gray-700 leading-relaxed mb-4">
                        The office of the City Veterinarian is the frontline of all veterinary-related activities whose function is central to the development of the livestock industry and other tasks relative thereto, such as but not limited to:
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <svg class="h-6 w-6 text-purple-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700"><strong>Animal Health:</strong> Monitoring and ensuring the health and wellness of animals in the city</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="h-6 w-6 text-purple-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700"><strong>Livestock Production:</strong> Supporting and developing sustainable livestock farming practices</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="h-6 w-6 text-purple-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700"><strong>Pet Registration & Impounding:</strong> Managing pet records and caring for impounded animals</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="h-6 w-6 text-purple-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700"><strong>Community Engagement:</strong> Promoting animal welfare awareness and education among citizens</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Key Services -->
        <div class="mt-20 pt-16 border-t-2 border-gray-200">
            <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center">Our Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Impound Care -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 p-6 border-t-4 border-red-500">
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-red-100 mb-4">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477A6 6 0 0015 7h-3m6 6h-3m-6 0H3m14.001 0a9 9 0 01.127-1m-5.027 1a9 9 0 01.219-1m-10.036 0a9 9 0 01.219 1m0 1a9 9 0 01.128-1m5.027 1h3m-3-9h3" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Impound Care</h3>
                    <p class="text-gray-600">Professional care and management of impounded animals with proper documentation and tracking.</p>
                </div>

                <!-- Pet Adoption -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 p-6 border-t-4 border-green-500">
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-green-100 mb-4">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pet Adoption</h3>
                    <p class="text-gray-600">Facilitating responsible pet adoption to find loving homes for animals in our care.</p>
                </div>

                <!-- Pet Registration -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 p-6 border-t-4 border-blue-500">
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-blue-100 mb-4">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pet Registration</h3>
                    <p class="text-gray-600">Comprehensive pet registration system for tracking and identification purposes.</p>
                </div>

                <!-- Lost & Found -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 p-6 border-t-4 border-purple-500">
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-purple-100 mb-4">
                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Lost & Found</h3>
                    <p class="text-gray-600">Community platform to help reunite lost pets with their owners.</p>
                </div>
            </div>
        </div>

        <!-- Platform Information -->
        <div class="mt-20 pt-16 border-t-2 border-gray-200">
            <div class="bg-white rounded-xl p-8 border border-gray-200">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">About This Platform</h2>
                <p class="text-gray-700 text-lg mb-4">
                    The <strong>Pet Recovery and Adoption System for Alaminos City</strong> is a modern web-based platform designed to support the City Veterinary Office in managing pet registration, lost and found reports, and adoption records efficiently. This system streamlines what was traditionally a manual process, reducing delays, ensuring complete documentation, and increasing public awareness about impounded and adoptable pets in our community.
                </p>
                <p class="text-gray-700 text-lg">
                    Through this platform, we are committed to supporting animal lovers, farmers, and pet owners in achieving our shared vision of a healthier, more progressive Alaminos City where both animals and people thrive together.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection


