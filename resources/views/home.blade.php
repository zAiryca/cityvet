<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<!-- Hero -->
<div class="relative bg-gradient-to-r from-blue-600 to-green-600 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Welcome to CityVet</h1>
        <p class="text-xl mb-8">Helping pets find homes and owners reunite. Explore impounded pets, adoptions, lost & found, and announcements.</p>
        <div class="space-x-4">
            <a href="{{ route('pets.impounded') }}" class="bg-white text-blue-600 px-6 py-3 rounded-md font-semibold hover:bg-gray-100">Impounded Pets</a>
            <a href="{{ route('pets.adoptable') }}" class="border-2 border-white text-white px-6 py-3 rounded-md font-semibold hover:bg-white hover:text-blue-600">Adoptable Pets</a>
        </div>
    </div>
</div>

<!-- Previews -->
<div class="max-w-7xl mx-auto py-12 px-4">
    <h2 class="text-3xl font-bold text-center mb-12">Featured</h2>

    <!-- Impounded Preview -->
    <section class="mb-12">
        <h3 class="text-2xl font-semibold mb-4">Impounded Pets</h3>
        @if(isset($impounded) && $impounded->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($impounded as $pet)
                    <div class="bg-white rounded-lg shadow-md p-4 text-center">
                        <img src="{{ $pet->photo ?? 'https://via.placeholder.com/150?text=' . $pet->name }}" alt="{{ $pet->name }}" class="w-full h-32 object-cover rounded mb-2">
                        <h4 class="font-bold">{{ $pet->name }}</h4>
                        <p class="text-gray-600">{{ $pet->species }}</p>
                        <a href="{{ route('pets.impounded') }}" class="text-blue-600">View All</a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No impounded pets currently.</p>
        @endif
    </section>

    <!-- Adoptable Preview -->
    <section class="mb-12">
        <h3 class="text-2xl font-semibold mb-4">Adoptable Pets</h3>
        @if(isset($adoptable) && $adoptable->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($adoptable as $pet)
                    <div class="bg-white rounded-lg shadow-md p-4 text-center">
                        <img src="{{ $pet->photo ?? 'https://via.placeholder.com/150?text=' . $pet->name }}" alt="{{ $pet->name }}" class="w-full h-32 object-cover rounded mb-2">
                        <h4 class="font-bold">{{ $pet->name }}</h4>
                        <p class="text-gray-600">{{ $pet->species }}</p>
                        @if($pet->urgent_deadline)
                            <p class="text-yellow-600">Urgent!</p>
                        @endif
                        <a href="{{ route('pets.adoptable') }}" class="text-green-600">View All</a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No adoptable pets currently.</p>
        @endif
    </section>

    <!-- Announcements Preview -->
    <section class="mb-12">
        <h3 class="text-2xl font-semibold mb-4">Upcoming Announcements</h3>
        @if(isset($announcements) && $announcements->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($announcements as $announcement)
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <h4 class="font-bold">{{ $announcement->title }}</h4>
                        <p class="text-gray-600">{{ $announcement->event_date->format('M d') }}</p>
                        <a href="{{ route('announcements.show', $announcement) }}" class="text-blue-600">Details</a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No upcoming announcements.</p>
        @endif
        <a href="{{ route('announcements.index') }}" class="block text-center mt-4 text-blue-600">View All Announcements</a>
    </section>

    <!-- Posters Preview -->
    <section>
        <h3 class="text-2xl font-semibold mb-4">Lost & Found</h3>
        @if(isset($posters) && $posters->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($posters as $poster)
                    <div class="bg-white rounded-lg shadow-md p-4 text-center">
                        <img src="{{ $poster->photo ?? 'https://via.placeholder.com/150?text=' . $poster->pet_name }}" alt="{{ $poster->pet_name }}" class="w-full h-32 object-cover rounded mb-2">
                        <h4 class="font-bold">{{ $poster->pet_name }}</h4>
                        <p class="text-gray-600">{{ ucfirst($poster->type) }}</p>
                        <a href="{{ route('posters.show', $poster) }}" class="text-purple-600">View</a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No posters currently.</p>
        @endif
        <a href="{{ route('posters.index') }}" class="block text-center mt-4 text-purple-600">View All Posters</a>
    </section>
        </div>
    </div>
</x-app-layout>
