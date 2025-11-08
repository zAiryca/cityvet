@extends('layouts.app')

@section('title', '| Location')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Our Location</h1>
    <p class="mb-6 text-gray-700">Visit us at CityVet Shelter for adoptions, announcements, or to drop off found pets.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Address & Directions</h2>
            <p class="text-gray-700 mb-2"><strong>123 Main St</strong><br>Anytown, USA 12345</p>
            <p class="text-gray-700 mb-4">Ample parking available. Wheelchair accessible.</p>
            <div class="space-y-2 text-sm">
                <p><strong>By Car:</strong> Exit Hwy 101 at Main St, head north 2 miles.</p>
                <p><strong>By Bus:</strong> Line 5 stops at our door.</p>
                <p><strong>Hours:</strong> Mon-Fri 9AM-5PM, Sat 10AM-4PM (Closed Sun).</p>
            </div>
        </div>

        <!-- Map Placeholder -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Map</h2>
            <div class="bg-gray-200 h-64 rounded flex items-center justify-center">
                <p class="text-gray-500">Google Maps Embed Here<br>(Latitude: 40.7128, Longitude: -74.0060)</p>
            </div>
            <p class="mt-2 text-sm text-gray-500">Pro tip: Search "CityVet Shelter" on Google Maps for directions.</p>
        </div>
    </div>
    <a href="{{ route('contact') }}" class="block mt-8 text-center bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700 w-48 mx-auto">Get Directions</a>
</div>
@endsection
