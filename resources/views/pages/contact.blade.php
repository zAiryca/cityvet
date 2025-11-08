@extends('layouts.app')

@section('title', '| Contact')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Contact Us</h1>
    <p class="mb-6 text-gray-700">Have questions about adoptions, announcements, or lost pets? Reach out to our team.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Contact Info -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Get in Touch</h2>
            <p class="text-gray-700 mb-2"><strong>Email:</strong> findfurever87@gmail.com</p>
            <p class="text-gray-700 mb-2"><strong>Phone:</strong> 0998-546-5754 / 0929-798-1266</p>
            <p class="text-gray-700 mb-2"><strong>Address:</strong> Slaughterhouse Compound, Sabaro, Poblacion, Alaminos City, Pangasinan.</p>

            <div class="text-gray-700 mt-4">
                <p><strong>Hours:</strong></p>
                <ul class="list-disc list-inside">
                    <li>Monday: 8:00 AM - 6:00 PM</li>
                    <li>Tuesday: 8:00 AM - 6:00 PM</li>
                    <li>Wednesday: 8:00 AM - 6:00 PM</li>
                    <li>Thursday: 8:00 AM - 6:00 PM</li>
                    <li>Friday: 8:00 AM - 6:00 PM</li>
                    <li>Saturday: 9:00 AM - 6:00 PM</li>
                    <li>Sunday: 9:00 AM - 6:00 PM</li>
                </ul>
            </div>
        </div>

        <!-- Google Map Embed -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Find Us Here</h2>
            <div class="rounded-lg overflow-hidden">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d958.0308431851945!2d119.98556386954004!3d16.162586899033155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3393dcb8236fc1d1%3A0xc83e269f6f1ea6fd!2sAlaminos%20City%20Slaughter%20House!5e0!3m2!1sen!2sph!4v1760954234615!5m2!1sen!2sph"
                    width="100%"
                    height="450"
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
