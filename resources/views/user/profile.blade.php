@extends('layouts.app')

@section('title', '| Profile')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-8">My Profile Settings</h1>

    @php
        // Toggle variables based on URL query parameters
        $isEditingInfo = request('edit') === 'true';
        $isChangingPassword = request('password') === 'true';
    @endphp

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-8 p-6 lg:p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Personal Information</h2>

            <div class="flex space-x-4">
                {{-- CHANGE PASSWORD BUTTON (New Location) --}}
                @if (!$isChangingPassword)
                    <a href="{{ route('profile.edit', ['password' => 'true']) }}"
                       class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Change Password
                    </a>
                @else
                    <a href="{{ route('profile.edit') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Cancel Password Change
                    </a>
                @endif

                {{-- EDIT PROFILE BUTTON --}}
                @if (!$isEditingInfo)
                    <a href="{{ route('profile.edit', ['edit' => 'true']) }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L15.232 5.232z"></path></svg>
                        Edit Profile
                    </a>
                @else
                    <a href="{{ route('profile.edit') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Cancel Edit
                    </a>
                @endif
            </div>
        </div>

        @if ($isEditingInfo)
            <div class="mt-4">
                @include('profile.partials.update-profile-information-form')
            </div>
        @else
            <div class="mt-4 border-t border-gray-200 pt-4 divide-y divide-gray-100">
                <dl>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            {{ $user->first_name ?? $user->name }}
                            {{ $user->middle_name ?? '' }}
                            {{ $user->last_name ?? '' }}
                        </dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $user->email }}</dd>
                    </div>
                </dl>
            </div>
        @endif
    </div>

    @if ($isChangingPassword)
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8" id="change-password">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Change Account Password</h2>
        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('put')

            <div>
                <x-input-label for="current_password" :value="__('Current Password')" />
                <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('New Password')" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm New Password')" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button class="bg-red-600 hover:bg-red-700">Update Password</x-primary-button>
            </div>
        </form>
    </div>
    @endif
</div>
@endsection
