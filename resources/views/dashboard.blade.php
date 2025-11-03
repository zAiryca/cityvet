@if (Auth::user()->isAdmin())
    {{-- Admin Dashboard Layout --}}
    <x-admin-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("Welcome, Admin! You're logged in.") }}
                    </div>
                </div>
            </div>
        </div>
    </x-admin-layout>
@else
    {{-- User Dashboard Layout --}}
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Welcome Message -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        {{ __("Welcome back, " . Auth::user()->name . "!") }}
                    </div>
                </div>

                <!-- Announcements/Events Section -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-4">{{ __('Latest Announcements & Events') }}</h3>

                        @php
                            $recentEvents = \App\Models\Event::latest()->take(5)->get();
                        @endphp

                        @if($recentEvents->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentEvents as $event)
                                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                    <h4 class="text-lg font-semibold text-gray-800">{{ $event->title }}</h4>
                                    <p class="text-gray-600 mt-2">{{ Str::limit($event->description, 150) }}</p>
                                    <div class="mt-3 flex justify-between items-center">
                                        <span class="text-sm text-gray-500">
                                            {{ __('Date: ') . $event->event_date->format('M j, Y') }}
                                        </span>
                                        <a href="{{ route('events.show', $event) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                            {{ __('View Details') }}
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="mt-6 text-center">
                                <a href="{{ route('events.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    {{ __('View All Events') }}
                                </a>
                            </div>
                        @else
                            <p class="text-gray-500">{{ __('No announcements or events available at the moment.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif

