@if (Auth::user()->isAdmin())
    {{-- Admin Dashboard Layout --}}
    <x-admin-layout>
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Admin Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
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
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Home') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Welcome Message -->
                <div class="mb-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("Welcome back, " . Auth::user()->name . "!") }}
                    </div>
                </div>

                <!-- Announcements Section -->
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="mb-4 text-2xl font-bold">{{ __('Latest Announcements') }}</h3>

                        @php
                            $recentAnnouncements = \App\Models\Announcement::latest()->take(5)->get();
                        @endphp

                        @if($recentAnnouncements->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentAnnouncements as $announcement)
                                <div class="p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                                    <h4 class="text-lg font-semibold text-gray-800">{{ $announcement->title }}</h4>
                                    <p class="mt-2 text-gray-600">{{ Str::limit($announcement->description, 150) }}</p>
                                    <div class="flex items-center justify-between mt-3">
                                        <span class="text-sm text-gray-500">
                                            {{ __('Date: ') . $announcement->date_when }}
                                        </span>
                                        <a href="{{ route('announcements.show', $announcement) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">
                                            {{ __('View Details') }}
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="mt-6 text-center">
                                <a href="{{ route('announcements.index') }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                    {{ __('View All Announcements') }}
                                </a>
                            </div>
                        @else
                            <p class="text-gray-500">{{ __('No announcements available at the moment.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif

