@extends('layouts.app')

@section('title', '| Dashboard')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Welcome, {{ auth()->user()->name }}!</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-blue-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-blue-800">Registered Pets</h3>
            <p class="text-3xl font-bold">{{ auth()->user()->pets()->where('status', 'registered')->count() }}</p>
            <a href="{{ route('profile') }}" class="text-blue-600 hover:underline">Manage Pets</a>
        </div>
        <div class="bg-green-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-green-800">Event Registrations</h3>
            <p class="text-3xl font-bold">{{ auth()->user()->eventRegistrations()->count() }}</p>
            <a href="{{ route('events.index') }}" class="text-green-600 hover:underline">View Events</a>
        </div>
        <div class="bg-purple-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-purple-800">My Posters</h3>
            <p class="text-3xl font-bold">{{ auth()->user()->posters()->count() }}</p>
            <a href="{{ route('posters.create') }}" class="text-purple-600 hover:underline">Create Poster</a>
        </div>
        <div class="bg-yellow-50 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold text-yellow-800">Pending Requests</h3>
            <p class="text-3xl font-bold">{{ auth()->user()->requests()->where('status', 'pending')->count() }}</p>
            <a href="{{ route('user.requests') }}" class="text-yellow-600 hover:underline">View Requests</a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('profile') }}" class="bg-blue-600 text-white p-4 rounded text-center hover:bg-blue-700">Profile & Pets</a>
            <a href="{{ route('posters.create') }}" class="bg-purple-600 text-white p-4 rounded text-center hover:bg-purple-700">Post Lost/Found</a>
            <a href="{{ route('events.index') }}" class="bg-green-600 text-white p-4 rounded text-center hover:bg-green-700">Browse Events</a>
        </div>
    </div>
</div>
@endsection
