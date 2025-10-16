@extends('layouts.app')

@section('title', '| Contact')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Contact Us</h1>
    <p class="mb-6 text-gray-700">Have questions about adoptions, events, or lost pets? Reach out to our team.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Contact Info -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Get in Touch</h2>
            <p class="text-gray-700 mb-2"><strong>Email:</strong> info@cityvet.com</p>
            <p class="text-gray-700 mb-2"><strong>Phone:</strong> (555) 123-4567</p>
            <p class="text-gray-700 mb-2"><strong>Address:</strong> 123 Main St, Anytown, USA</p>
            <p class="text-gray-700 mb-4"><strong>Hours:</strong> Mon-Fri 9AM-5PM, Sat 10AM-4PM</p>
            <a href="{{ route('location') }}" class="text-blue-600 hover:underline">View Our Location</a>
        </div>

        <!-- Contact Form (Placeholder - Add POST route for real submission) -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Send a Message</h2>
            {{-- BABALIKAN  --}}
         {{-- <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">  <!-- Add this route if needed --> --}}


            @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea name="message" rows="4" required class="mt-1 block w-full border border-gray-300 rounded-md p-2"></textarea>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Send Message</button>
            </form>
        </div>
    </div>
</div>
@endsection
