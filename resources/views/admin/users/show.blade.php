<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details: ') . $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <!-- User Info -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold mb-4">User Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div><strong>Name:</strong> {{ $user->name }}</div>
                            <div><strong>Email:</strong> {{ $user->email }}</div>
                            <div><strong>Role:</strong> {{ ucfirst($user->role) }}</div>
                            <div><strong>Joined:</strong> {{ $user->created_at->format('M j, Y') }}</div>
                            <div><strong>Contact:</strong> {{ $user->contact_number ?? 'N/A' }}</div>
                            <div><strong>Address:</strong> {{ $user->street }}, {{ $user->barangay }}, {{ $user->city_municipality }}</div>
                        </div>
                    </div>

                    <!-- Adopted Pets -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold mb-4">Adopted Pets ({{ $user->adoptedPets->count() }})</h3>
                        @if($user->adoptedPets->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Species</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Adopted</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($user->adoptedPets as $pet)
                                    <tr>
                                        <td class="px-4 py-2 text-sm">{{ $pet->name }}</td>
                                        <td class="px-4 py-2 text-sm">{{ $pet->species }}</td>
                                        <td class="px-4 py-2 text-sm">{{ $pet->updated_at->format('M j, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p class="text-gray-500">No pets adopted.</p>
                        @endif
                    </div>

                    <!-- Claimed Pets -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold mb-4">Claimed Pets ({{ $user->claimedPets->count() }})</h3>
                        @if($user->claimedPets->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Species</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Claimed</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($user->claimedPets as $pet)
                                    <tr>
                                        <td class="px-4 py-2 text-sm">{{ $pet->name }}</td>
                                        <td class="px-4 py-2 text-sm">{{ $pet->species }}</td>
                                        <td class="px-4 py-2 text-sm">{{ $pet->updated_at->format('M j, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p class="text-gray-500">No pets claimed.</p>
                        @endif
                    </div>

                    <!-- Posters -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold mb-4">Lost & Found Posters ({{ $user->posters->count() }})</h3>
                        @if($user->posters->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($user->posters as $poster)
                                    <tr>
                                        <td class="px-4 py-2 text-sm">{{ $poster->title }}</td>
                                        <td class="px-4 py-2 text-sm">{{ ucfirst($poster->type) }}</td>
                                        <td class="px-4 py-2 text-sm">{{ $poster->approved ? 'Approved' : 'Pending' }}</td>
                                        <td class="px-4 py-2 text-sm">{{ $poster->created_at->format('M j, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p class="text-gray-500">No posters created.</p>
                        @endif
                    </div>

                    <!-- Requests -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold mb-4">Pet Requests ({{ $user->requests->count() }})</h3>
                        @if($user->requests->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Pet</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($user->requests as $request)
                                    <tr>
                                        <td class="px-4 py-2 text-sm">{{ ucfirst($request->type) }}</td>
                                        <td class="px-4 py-2 text-sm">{{ $request->requestable->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 text-sm">{{ ucfirst($request->status) }}</td>
                                        <td class="px-4 py-2 text-sm">{{ $request->created_at->format('M j, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p class="text-gray-500">No requests submitted.</p>
                        @endif
                    </div>

                    <!-- Event Registrations -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold mb-4">Event Registrations ({{ $user->eventRegistrations->count() }})</h3>
                        @if($user->eventRegistrations->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Event</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Pet</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Registered</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($user->eventRegistrations as $registration)
                                    <tr>
                                        <td class="px-4 py-2 text-sm">{{ $registration->event->title }}</td>
                                        <td class="px-4 py-2 text-sm">{{ $registration->pet->name }}</td>
                                        <td class="px-4 py-2 text-sm">{{ ucfirst($registration->status) }}</td>
                                        <td class="px-4 py-2 text-sm">{{ $registration->created_at->format('M j, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p class="text-gray-500">No event registrations.</p>
                        @endif
                    </div>

                    <div class="flex justify-start">
                        <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Back to Users
                        </a>
                        <a href="{{ route('admin.users.edit', $user) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Edit User
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
