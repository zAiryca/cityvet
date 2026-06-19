@extends('layouts.app')

@section('title', '| Contact Us')

@section('content')
<div class="min-h-screen bg-gray-50" style="font-family: 'Poppins', sans-serif;">
    <!-- Hero Section -->
    <div class="px-4 py-20 text-white shadow-lg bg-gradient-to-r from-blue-600 to-purple-600" style="font-family: 'Poppins', sans-serif;">
        <div class="mx-auto text-center max-w-7xl">
            <h1 class="mb-6 text-5xl md:text-6xl font-extrabold tracking-tight" style="font-family: 'Poppins', sans-serif;">
                Contact Us
            </h1>
            <p class="text-lg md:text-xl text-white opacity-95 max-w-2xl mx-auto" style="font-family: 'Poppins', sans-serif;">
                Get in touch with the City Veterinary Office. We're here to help you and your furry friends!
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="px-4 py-20 mx-auto max-w-7xl">

        <!-- Contact Information Grid -->
        <div class="grid grid-cols-1 gap-8 mb-24 md:grid-cols-2 lg:grid-cols-3">

            <!-- Phone Contact -->
            <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 p-12 border-t-4 border-teal-500 transform hover:scale-[1.03]">
                <div class="flex items-center justify-center w-20 h-20 mx-auto mb-8 bg-teal-100 rounded-full group-hover:bg-teal-200 transition-colors">
                    <svg class="w-10 h-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
                <h3 class="mb-8 text-2xl font-bold text-center text-gray-900" style="font-family: 'Poppins', sans-serif;">Phone</h3>
                <div class="space-y-5">
                    <a href="tel:0998-546-5754" class="block p-4 text-center text-teal-600 bg-teal-50 rounded-xl hover:bg-teal-100 transition-colors">
                        <span class="text-lg font-semibold">0998-546-5754</span>
                    </a>
                    <a href="tel:0929-798-1266" class="block p-4 text-center text-teal-600 bg-teal-50 rounded-xl hover:bg-teal-100 transition-colors">
                        <span class="text-lg font-semibold">0929-798-1266</span>
                    </a>
                </div>
            </div>

            <!-- Email Contact -->
            <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 p-12 border-t-4 border-pink-500 transform hover:scale-[1.03]">
                <div class="flex items-center justify-center w-20 h-20 mx-auto mb-8 bg-pink-100 rounded-full group-hover:bg-pink-200 transition-colors">
                    <svg class="w-10 h-10 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="mb-8 text-2xl font-bold text-center text-gray-900" style="font-family: 'Poppins', sans-serif;">Email</h3>
                <a href="mailto:acp.cityvet@gmail.com" class="block p-5 text-center text-pink-600 bg-pink-50 rounded-xl hover:bg-pink-100 transition-colors">
                    <span class="text-lg font-semibold">acp.cityvet@gmail.com</span>
                    <div class="text-sm text-pink-500 mt-2">Click to send email</div>
                </a>
            </div>

            <!-- Address Contact -->
            <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 p-12 border-t-4 border-indigo-500 transform hover:scale-[1.03]">
                <div class="flex items-center justify-center w-20 h-20 mx-auto mb-8 bg-indigo-100 rounded-full group-hover:bg-indigo-200 transition-colors">
                    <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="mb-8 text-2xl font-bold text-center text-gray-900" style="font-family: 'Poppins', sans-serif;">Location</h3>
                <div class="space-y-3 text-center">
                    <p class="text-xl font-semibold text-gray-800">City Veterinary Office</p>
                    <div class="space-y-2 text-gray-600 text-base">
                        <p>Slaughterhouse Compound, Sabaro</p>
                        <p>Poblacion, Alaminos City</p>
                        <p>Pangasinan, Philippines</p>
                    </div>
                    <a href="https://maps.google.com/?q=Alaminos+City+Slaughter+House" target="_blank" class="inline-block mt-4 px-6 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors">
                        Open in Maps
                    </a>
                </div>
            </div>
        </div>

        <!-- Business Hours Section -->
        <div class="mb-24 bg-white rounded-3xl shadow-lg border border-gray-200 p-12 md:p-16">
            <div class="mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-2" style="font-family: 'Poppins', sans-serif;">Business Hours</h2>
                <div class="w-20 h-1 bg-gradient-to-r from-teal-500 to-blue-500 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <!-- Monday to Friday -->
                <div class="bg-gradient-to-br from-teal-50 to-teal-100 rounded-2xl p-8 border-l-4 border-teal-500">
                    <h3 class="text-xl font-bold text-teal-900 mb-4">Monday - Friday</h3>
                    <p class="text-3xl font-bold text-teal-600 mb-2">8:00 AM</p>
                    <p class="text-gray-600 mb-4">to</p>
                    <p class="text-3xl font-bold text-teal-600">6:00 PM</p>
                </div>

                <!-- Saturday -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 border-l-4 border-blue-500">
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Saturday</h3>
                    <p class="text-3xl font-bold text-blue-600 mb-2">9:00 AM</p>
                    <p class="text-gray-600 mb-4">to</p>
                    <p class="text-3xl font-bold text-blue-600">6:00 PM</p>
                </div>

                <!-- Sunday -->
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-8 border-l-4 border-purple-500">
                    <h3 class="text-xl font-bold text-purple-900 mb-4">Sunday</h3>
                    <p class="text-3xl font-bold text-purple-600 mb-2">9:00 AM</p>
                    <p class="text-gray-600 mb-4">to</p>
                    <p class="text-3xl font-bold text-purple-600">6:00 PM</p>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="mb-12">
            <div class="mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-2 text-center" style="font-family: 'Poppins', sans-serif;">LOCATION MAP</h2>
            </div>
            <div class="overflow-hidden bg-white border-4 border-gray-200 shadow-2xl rounded-3xl">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d958.0308431851945!2d119.98556386954004!3d16.162586899033155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3393dcb8236fc1d1%3A0xc83e269f6f1ea6fd!2sAlaminos%20City%20Slaughter%20House!5e0!3m2!1sen!2sph!4v1760954234615!5m2!1sen!2sph"
                    width="100%"
                    height="600"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

    </div>
</div>
@endsection
