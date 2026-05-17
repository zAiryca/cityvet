@extends('layouts.app')

@section('title', '| Home')

<div class="container px-8 mb-32 content">
    <div class="row">
  <div class="text-center col-md-6 logo-section" style="margin-top: 8rem">
    <img src="{{ asset('image/overall.png')}}" alt="Overall Logo">
  </div>



      <div class="col-md-6" style="margin-top: 6rem">
        <h3 style="font-size: 23px; font-family: 'Poppins', sans-serif;">FindFurEver - Connecting Pets with Loving Homes</h3>
        <p style="font-family: 'Poppins', sans-serif;">FindFurEver helps you reunite with lost pets and adopt those in urgent need of a home.</p>
        <ul style="font-family: 'Poppins', sans-serif;">
          <li><b>Impounded Pets:</b> Search for pets caught by the city authorities.</li>
          <li><b>Urgent Adoptions:</b> Unclaimed pets in need of a forever home—time is running out!</li>
          <li><b>Lost & Found:</b> A community-driven feature for reconnecting lost pets with their owners.</li>
        </ul>
        <p style="font-family: 'Poppins', sans-serif;">Every pet deserves a second chance at love and safety.</p>

        <a href="{{ route('pets.adoptable') }}" class="inline-block px-4 py-2 mt-6 mr-4 font-sans font-semibold text-white transition duration-300 rounded-lg hover:scale-105" style="background-color: #f39c12;">Adopt a Pet</a>
        <a href="{{ route('pets.impounded') }}" class="inline-block px-4 py-2 mr-4 font-sans font-semibold text-white transition duration-300 rounded-lg hover:scale-105" style="background-color: rgb(241, 50, 82);">City Vet Impounded</a>
        <a href="{{ route('posters.index') }}" class="inline-block px-4 py-2 font-sans font-semibold text-white transition duration-300 rounded-lg hover:scale-105" style="background-color: #23bd04d2;">Lost & Found</a>
      </div>
    </div>
  </div>

@section('content')
<div class="pt-64 " style="background-color: #f8f9fa">
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="px-4 py-3 mx-auto mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg max-w-7xl" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="px-4 py-3 mx-auto mb-6 text-red-800 bg-red-100 border border-red-200 rounded-lg max-w-7xl" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Main Content -->
    <div class="px-4 py-16 mx-auto max-w-7xl">

        <!-- Pet Care Information Section -->
        <div class="mb-16">
            <div class="mb-12 text-center">
                <h2 class="mb-4 text-4xl font-bold text-gray-900" style="margin-bottom:-10rem; margin-top: -7rem;font-size:30px">Caring for <span style="color:#f39c12"> Your</span> Pets</h2>
                <div class="w-20 h-1 mx-auto bg-blue-600"></div>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <!-- Pet Health Card -->
                <div class="p-8 bg-white border-l-4 border-blue-600 shadow-lg" style="margin: 30px">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-blue-600">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-2xl font-bold text-center text-gray-900">Pet Health</h3>
                    <p class="leading-relaxed text-gray-700">
                        Regular veterinary check-ups, vaccinations, and preventive care ensure your pets live long, healthy lives. Schedule routine wellness exams to catch health issues early.
                    </p>
                </div>

                <!-- Pet Safety Card -->
                <div class="p-4 bg-white border-l-4 border-green-600 shadow-lg" style="margin: 30px">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-green-600">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-2xl font-bold text-center text-gray-900">Pet Safety</h3>
                    <p class="leading-relaxed text-gray-700">
                        Keep your pets safe with proper identification tags, microchipping, and secure living spaces. Always supervise outdoor activities and pet-proof your home environment.
                    </p>
                </div>

                <!-- Pet Nutrition Card -->
                <div class="p-8 bg-white border-l-4 border-purple-600 shadow-lg" style="margin: 30px; padding: -150px">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-purple-600">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                        </svg>
                    </div>
                    <h3 class="mb-3 text-2xl font-bold text-center text-gray-900">Pet Nutrition</h3>
                    <p class="leading-relaxed text-gray-700">
                        Proper nutrition is essential for your pet's well-being. Provide balanced meals appropriate for their age, size, and activity level. Fresh water should always be available.
                    </p>
                </div>
            </div>
        </div>



        <!-- Responsible Pet Ownership Section -->
        <div class="mb-16">
            <div class="mb-12 text-center">
                <h2 class="mb-4 text-4xl font-bold text-gray-900" style="font-size:30px">Responsible <span style="color:#f39c12"> Pet Ownership</span></h2>
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
       <div class="p-10 text-center bg-gradient-to-br from-pink-50 to-purple-50" style="font-family: 'Poppins', sans-serif;">
    <h2 class="mb-3 text-3xl font-extrabold text-pink-600" style="font-family: 'Poppins', sans-serif;">
        Ready for a Paw-some Adventure?
    </h2>
    <p class="max-w-2xl mx-auto mb-6 text-lg text-gray-600" style="font-family: 'Poppins', sans-serif;">
        Find your new best friend, keep track of their health, and join a community that loves pets as much as you do!
    </p>
    <div class="flex flex-col justify-center gap-4 sm:flex-row">
        <a href="{{ route('contact') }}"
            class="inline-flex items-center justify-center px-10 py-3 text-lg font-bold text-white transition duration-300 ease-in-out transform bg-pink-500 border-4 border-white rounded-full shadow-lg hover:bg-pink-600 hover:shadow-xl hover:scale-105"
            style="font-family: 'Poppins', sans-serif;">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            Contact Us
        </a>
    </div>
</div>
    </div>
</div>
@endsection
