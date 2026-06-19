@extends('layouts.app')

@section('title', '| About')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white">
    <!-- Header Section -->
    <div class="px-4 py-16 text-white bg-gradient-to-r from-blue-600 to-green-600" style="font-family: Georgia, serif;">
        <div class="mx-auto text-center max-w-7xl">
            <h1 class="mb-4 text-5xl font-bold">City Veterinary Office</h1>
            <p class="text-xl text-blue-100">Serving Alaminos City with Dedication to Animal Health & Welfare</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="px-4 py-16 mx-auto max-w-7xl">
        <!-- Vision Section -->
        <div class="mb-16">
            <div class="flex items-start gap-6">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-16 h-16 bg-blue-100 rounded-xl">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h2 class="mb-4 text-3xl font-bold text-gray-900" style="font-family: Georgia, serif;">VISION</h2>
                    <p class="text-lg leading-relaxed text-gray-700">
                        We envision a city that is progressive with a local economy propelled by inclusive growth through sound and modernized livestock production, and a healthy citizenry through healthy animals, in harmony with the environment.
                    </p>
                </div>
            </div>
        </div>

        <!-- Mission Section -->
        <div class="mb-16">
            <div class="flex items-start gap-6">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-16 h-16 bg-green-100 rounded-xl">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h2 class="mb-4 text-3xl font-bold text-gray-900" style="font-family: Georgia, serif;">MISSION</h2>
                    <p class="text-lg leading-relaxed text-gray-700">
                        A pro-active office that is responsive to the needs of the animal industry and animal lovers, guided with standards and committed to delivering exceptional veterinary services and support.
                    </p>
                </div>
            </div>
        </div>

        <!-- Mandate Section -->
        <div class="mb-16">
            <div class="flex items-start gap-6">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-16 h-16 bg-purple-100 rounded-xl">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h2 class="mb-4 text-3xl font-bold text-gray-900" style="font-family: Georgia, serif;">MANDATE</h2>
                    <p class="mb-4 text-lg leading-relaxed text-gray-700">
                        The office of the City Veterinarian is the frontline of all veterinary-related activities whose function is central to the development of the livestock industry and other tasks relative thereto, such as but not limited to:
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <svg class="flex-shrink-0 w-6 h-6 mt-1 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700"><strong style="font-family: Georgia, serif;">Animal Health:</strong> Monitoring and ensuring the health and wellness of animals in the city</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="flex-shrink-0 w-6 h-6 mt-1 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700"><strong style="font-family: Georgia, serif;">Livestock Production:</strong> Supporting and developing sustainable livestock farming practices</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="flex-shrink-0 w-6 h-6 mt-1 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700"><strong style="font-family: Georgia, serif;">Pet Registration & Impounding:</strong> Managing pet records and caring for impounded animals</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="flex-shrink-0 w-6 h-6 mt-1 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700"><strong style="font-family: Georgia, serif;">Community Engagement:</strong> Promoting animal welfare awareness and education among citizens</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Key Services -->
        <div class="pt-16 mt-20 border-t-2 border-gray-200">
            <h2 class="mb-12 text-3xl font-bold text-center text-gray-900" style="font-family: Georgia, serif;">Our Services</h2>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                <!-- Impound Care -->
                <div class="p-6 transition-shadow duration-200 bg-white border-t-4 border-red-500 rounded-lg shadow-md hover:shadow-lg">
                    <div class="flex items-center justify-center w-12 h-12 mb-4 bg-red-100 rounded-lg">
                        <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-hidden="true">
    <path fill="currentColor" d="M234.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5 .3-86.2 32.6-96.8 70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3-14.3-70.1 10.2-84.1 59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5l0 1.6c0 25.8-20.9 46.7-46.7 46.7-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2-25.8 0-46.7-20.9-46.7-46.7l0-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3 29.1 51.7 10.2 84.1-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5 46.9 53.9 32.6 96.8-52.1 69.1-84.4 58.5z"/>
</svg>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-gray-900" style="font-family: Georgia, serif;">Impound Care</h3>
                    <p class="text-gray-600">Professional care and management of impounded animals with proper documentation and tracking.</p>
                </div>

                <!-- Pet Adoption -->
                <div class="p-6 transition-shadow duration-200 bg-white border-t-4 border-green-500 rounded-lg shadow-md hover:shadow-lg">
                    <div class="flex items-center justify-center w-12 h-12 mb-4 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-gray-900" style="font-family: Georgia, serif;">Pet Adoption</h3>
                    <p class="text-gray-600">Facilitating responsible pet adoption to find loving homes for animals in our care.</p>
                </div>

                <!-- Pet Registration -->
                <div class="p-6 transition-shadow duration-200 bg-white border-t-4 border-blue-500 rounded-lg shadow-md hover:shadow-lg">
                    <div class="flex items-center justify-center w-12 h-12 mb-4 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-gray-900" style="font-family: Georgia, serif;">Pet Registration</h3>
                    <p class="text-gray-600">Comprehensive pet registration system for tracking and identification purposes.</p>
                </div>

                <!-- Lost & Found -->
                <div class="p-6 transition-shadow duration-200 bg-white border-t-4 border-purple-500 rounded-lg shadow-md hover:shadow-lg">
                    <div class="flex items-center justify-center w-12 h-12 mb-4 bg-purple-100 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-gray-900" style="font-family: Georgia, serif;">Lost & Found</h3>
                    <p class="text-gray-600">Community platform to help reunite lost pets with their owners.</p>
                </div>
            </div>
        </div>

        <!-- Platform Information -->
        <div class="pt-16 mt-20 border-t-2 border-gray-200">
            <div class="p-8 bg-white border border-gray-200 rounded-xl">
                <h2 class="mb-4 text-3xl font-bold text-gray-900" style="font-family: Georgia, serif;">About This Platform</h2>
                <p class="mb-4 text-lg text-gray-700">
                    The <strong>Pet Recovery and Adoption System for Alaminos City</strong> is a modern web-based platform designed to support the City Veterinary Office in managing pet registration, lost and found reports, and adoption records efficiently. This system streamlines what was traditionally a manual process, reducing delays, ensuring complete documentation, and increasing public awareness about impounded and adoptable pets in our community.
                </p>
                <p class="text-lg text-gray-700">
                    Through this platform, we are committed to supporting animal lovers, farmers, and pet owners in achieving our shared vision of a healthier, more progressive Alaminos City where both animals and people thrive together.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection


