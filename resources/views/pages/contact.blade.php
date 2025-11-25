@extends('layouts.app')

@section('title', '| Contact')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white pt-28">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-green-600 text-white py-16 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl font-bold mb-4">Contact Us</h1>
            <p class="text-xl text-blue-100">Get in touch with the City Veterinary Office. We're here to help with your questions and concerns.</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <!-- Contact Information Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            <!-- Phone Contact -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 p-8 border-l-4 border-blue-500">
                <div class="flex items-center mb-4">
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-blue-100 mr-4">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Phone</h3>
                </div>
                <p class="text-gray-600 mb-2">
                    <a href="tel:0998-546-5754" class="hover:text-blue-600 transition-colors font-semibold">0998-546-5754</a>
                </p>
                <p class="text-gray-600">
                    <a href="tel:0929-798-1266" class="hover:text-blue-600 transition-colors font-semibold">0929-798-1266</a>
                </p>
            </div>

            <!-- Email Contact -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 p-8 border-l-4 border-green-500">
                <div class="flex items-center mb-4">
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-green-100 mr-4">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Email</h3>
                </div>
                <p class="text-gray-600">
                    <a href="mailto:acp.cityvet@gmail.com" class="hover:text-green-600 transition-colors font-semibold">acp.cityvet@gmail.com</a>
                </p>
                <p class="text-gray-500 text-sm mt-2">We typically respond within 24 hours</p>
            </div>

            <!-- Address Contact -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 p-8 border-l-4 border-purple-500">
                <div class="flex items-center mb-4">
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-purple-100 mr-4">
                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Location</h3>
                </div>
                <p class="text-gray-600 font-semibold">City Veterinary Office</p>
                <p class="text-gray-600">Slaughterhouse Compound, Sabaro</p>
                <p class="text-gray-600">Poblacion, Alaminos City</p>
                <p class="text-gray-600">Pangasinan, Philippines</p>
            </div>
        </div>

        <!-- Business Hours Section -->
        <div class="bg-white rounded-xl p-8 border border-gray-200 mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Business Hours</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-900">Monday - Friday</span>
                        <span class="text-gray-600">8:00 AM - 6:00 PM</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-900">Saturday</span>
                        <span class="text-gray-600">9:00 AM - 6:00 PM</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-900">Sunday</span>
                        <span class="text-gray-600">9:00 AM - 6:00 PM</span>
                    </div>
                </div>
                <div class="bg-blue-50 rounded-lg p-4 border-l-4 border-blue-500">
                    <div class="flex items-start gap-2">
                        <svg class="h-5 w-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-sm text-gray-700">
                            <strong>Note:</strong> We're open seven days a week to serve you better. For emergency veterinary services, please call us directly.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Find Us on the Map</h2>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d958.0308431851945!2d119.98556386954004!3d16.162586899033155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3393dcb8236fc1d1%3A0xc83e269f6f1ea6fd!2sAlaminos%20City%20Slaughter%20House!5e0!3m2!1sen!2sph!4v1760954234615!5m2!1sen!2sph"
                    width="100%"
                    height="500"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <!-- Quick Links Section -->
        <div class="mt-16 pt-16 border-t-2 border-gray-200">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Quick Help</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('pets.impounded') }}" class="bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-200 p-6 text-center border-t-4 border-red-500">
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-red-100 mb-4 mx-auto">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477A6 6 0 0015 7h-3m6 6h-3m-6 0H3m14.001 0a9 9 0 01.127-1m-5.027 1a9 9 0 01.219-1m-10.036 0a9 9 0 01.219 1m0 1a9 9 0 01.128-1m5.027 1h3m-3-9h3" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Impounded Pets</h3>
                    <p class="text-gray-600 text-sm">Find or claim impounded pets</p>
                </a>

                <a href="{{ route('pets.adoptable') }}" class="bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-200 p-6 text-center border-t-4 border-green-500">
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-green-100 mb-4 mx-auto">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Adoptable Pets</h3>
                    <p class="text-gray-600 text-sm">Adopt your new companion</p>
                </a>

                <a href="{{ route('posters.index') }}" class="bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-200 p-6 text-center border-t-4 border-purple-500">
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-purple-100 mb-4 mx-auto">
                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Lost & Found</h3>
                    <p class="text-gray-600 text-sm">Help reunite lost pets</p>
                </a>

                <a href="{{ route('announcements.index') }}" class="bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-200 p-6 text-center border-t-4 border-blue-500">
                    <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-blue-100 mb-4 mx-auto">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.961 1.961 0 01-2.868 1.755m0 0L5.309 18.72M9.13 19.24l3.308 2.316m0 0l3.308-2.316m0 0a1.961 1.961 0 00-2.868-1.755m0 0L15.75 19.24M4.5 12.857V11a6 6 0 0112 0v1.857m-6-4h.008v.008H10.5v-.008z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Announcements</h3>
                    <p class="text-gray-600 text-sm">Stay updated with us</p>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection


