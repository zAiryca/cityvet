@extends('layouts.app')

@section('title', '| About')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">About Pet Recovery and Adoption System for Alaminos City</h1>
    <p class="text-gray-700 mb-4">The study, "Pet Recovery and Adoption System for Alaminos City," was conducted to design and develop a web-based platform that assists the City Veterinary Office in managing pet registration, lost and found reports, and adoption records more efficiently. The traditional manual process of handling these activities caused delays, incomplete documentation, and limited public awareness regarding impounded and adoptable pets.</p>
    <p class="text-gray-700">Founded in 2020, we've helped over 1,000 pets. Our team of vets and volunteers works tirelessly to ensure every pet gets the care it needs.</p>
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-blue-50 p-4 rounded">
            <h3 class="font-bold text-blue-800">Our Mission</h3>
            <p class="text-gray-600">Promote animal welfare through adoption and community engagement.</p>
        </div>
        <div class="bg-green-50 p-4 rounded">
            <h3 class="font-bold text-green-800">Services</h3>
            <p class="text-gray-600">Impound, adoption, announcements, lost & found.</p>
        </div>
        <div class="bg-purple-50 p-4 rounded">
            <h3 class="font-bold text-purple-800">Contact</h3>
            <p class="text-gray-600">Reach us at info@cityvet.com or visit our location.</p>
        </div>
    </div>
</div>
@endsection
