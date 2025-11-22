@extends('layouts.admin')

@section('title', '| Admin - Pet Details & Request Workflow')

@section('content')
<div class="min-h-screen py-8 bg-gray-50">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Header with Pet Info -->
        <div class="mb-8 overflow-hidden bg-white rounded-lg shadow-md">
            <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-indigo-600">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        @if($pet->photo)
                            <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}" class="object-cover w-20 h-20 border-4 border-white rounded-lg shadow-md">
                        @else
                            <div class="flex items-center justify-center w-20 h-20 bg-white rounded-lg">
                                <span class="text-2xl font-bold text-blue-600">{{ substr($pet->display_code, 0, 1) }}</span>
                            </div>
                        @endif
                        <div>
                            <h1 class="text-3xl font-bold text-white">{{ $pet->display_code }}</h1>
                            <p class="text-blue-100">{{ $pet->species }} • {{ $pet->breed }} • {{ $pet->estimated_age }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold
                            @if($pet->status === 'impounded') bg-red-200 text-red-900
                            @elseif($pet->status === 'adoptable') bg-green-200 text-green-900
                            @elseif($pet->status === 'claimed') bg-blue-200 text-blue-900
                            @elseif($pet->status === 'adopted') bg-purple-200 text-purple-900
                            @else bg-gray-200 text-gray-900 @endif">
                            {{ ucfirst(str_replace('_', ' ', $pet->status)) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <!-- Main Content Area -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Pet Details Card -->
                <div class="overflow-hidden bg-white rounded-lg shadow-md">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900">📋 Pet Information</h2>
                    </div>
                    <div class="px-6 py-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Species</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $pet->species }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Breed</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $pet->breed }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Gender</p>
                                <p class="text-lg font-semibold text-gray-900">{{ ucfirst($pet->gender) }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Age</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $pet->estimated_age }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Color Markings</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $pet->color_markings ?: 'Not specified' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Current Owner</p>
                                <p class="text-lg font-semibold text-gray-900">
                                    @if($pet->user)
                                        {{ $pet->user->name }}
                                    @else
                                        <span class="text-red-600">Unassigned</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        @if($pet->description)
                            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                                <p class="text-sm font-medium text-gray-600">Description</p>
                                <p class="text-gray-900 mt-2">{{ $pet->description }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Requests Timeline Card -->
                <div class="overflow-hidden bg-white rounded-lg shadow-md">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900">📊 Claim/Adoption Requests</h2>
                    </div>
                    <div class="px-6 py-6">
                        @php
                            $allRequests = $pet->requests()->get();
                            $pendingRequests = $allRequests->where('status', 'pending');
                            $approvedRequests = $allRequests->where('status', 'approved');
                            $deniedRequests = $allRequests->where('status', 'denied');
                        @endphp

                        @if($allRequests->isEmpty())
                            <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                                <p class="text-yellow-800">ℹ️ No requests yet for this pet.</p>
                            </div>
                        @else
                            <!-- Approved Requests Section (list all if any) -->
                            @if($approvedRequests->count() > 0)
                                <div class="mb-6 space-y-4">
                                    @foreach($approvedRequests as $approvedRequest)
                                        <div class="p-6 bg-green-50 border-2 border-green-500 rounded-lg">
                                            <div class="flex items-center mb-4 justify-between">
                                                <div class="flex items-center">
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-green-500 text-white">
                                                        ✅ APPROVED
                                                    </span>
                                                    <span class="ml-3 text-sm text-gray-600">
                                                        {{ $approvedRequest->type === 'claim' ? 'Claim Request' : 'Adoption Request' }} - {{ $approvedRequest->user->name }}
                                                    </span>
                                                </div>
                                                <div class="text-sm text-gray-500">Submitted {{ $approvedRequest->updated_at->diffForHumans() }}</div>
                                            </div>

                                            @php
                                                $additionalData = is_array($approvedRequest->additional_data) ? $approvedRequest->additional_data : json_decode($approvedRequest->additional_data, true);
                                            @endphp

                                            {{-- Action buttons for approved request --}}
                                            <div class="mb-4 flex gap-2">
                                                @if($approvedRequest->type === 'claim')
                                                    <form method="POST" action="{{ route('admin.requests.finalize', $approvedRequest) }}" class="inline">
                                                        @csrf
                                                        <button type="submit" class="px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700" onclick="return confirm('Mark pet as CLAIMED?')">
                                                            ✅ Mark as Claimed
                                                        </button>
                                                    </form>
                                                @elseif($approvedRequest->type === 'adopt')
                                                    <form method="POST" action="{{ route('admin.requests.finalize', $approvedRequest) }}" class="inline">
                                                        @csrf
                                                        <button type="submit" class="px-3 py-1 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-700" onclick="return confirm('Mark pet as ADOPTED?')">
                                                            🏠 Mark as Adopted
                                                        </button>
                                                    </form>
                                                @endif
                                                <a href="{{ route('admin.requests.show', $approvedRequest) }}" class="px-3 py-1 text-sm font-medium text-indigo-600 hover:text-indigo-900">
                                                    View Details
                                                </a>
                                            </div>

                                            <div class="grid grid-cols-2 gap-4 mb-4">
                                                <div>
                                                    <p class="text-xs font-medium text-gray-600">Name</p>
                                                    <p class="font-semibold text-gray-900">
                                                        {{ $additionalData['first_name'] ?? $approvedRequest->user->name }}
                                                        {{ $additionalData['last_name'] ?? '' }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <p class="text-xs font-medium text-gray-600">Email</p>
                                                    <p class="font-semibold text-gray-900">{{ $approvedRequest->user->email }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-xs font-medium text-gray-600">Contact</p>
                                                    <p class="font-semibold text-gray-900">{{ $additionalData['contact_number'] ?? $approvedRequest->contact_info ?? 'N/A' }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-xs font-medium text-gray-600">Address</p>
                                                    <p class="font-semibold text-gray-900">{{ $additionalData['address'] ?? 'N/A' }}</p>
                                                </div>
                                            </div>

                                            @if($approvedRequest->type === 'adopt' && isset($additionalData['dwelling_type']))
                                                <div class="p-3 bg-white rounded border border-green-200">
                                                    <p class="text-xs font-medium text-gray-600 mb-2">Adoption Details</p>
                                                    <div class="grid grid-cols-2 gap-2 text-sm">
                                                        <div><span class="font-medium">Dwelling:</span> {{ ucfirst(str_replace('_', ' ', $additionalData['dwelling_type'])) }}</div>
                                                        <div><span class="font-medium">Fenced Property:</span> {{ ucfirst($additionalData['fenced_property']) }}</div>
                                                        <div><span class="font-medium">Adults:</span> {{ $additionalData['adults_count'] ?? 'N/A' }}</div>
                                                        <div><span class="font-medium">Children:</span> {{ $additionalData['children_count'] ?? 'N/A' }}</div>
                                                        <div><span class="font-medium">Other Pets:</span> {{ $additionalData['other_pets'] ?? 'N/A' }}</div>
                                                        @if($approvedRequest->reason)
                                                            <div class="col-span-2"><span class="font-medium">Reason:</span> {{ $approvedRequest->reason }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @elseif($approvedRequest->type === 'claim')
                                                @if($approvedRequest->reason)
                                                    <div class="p-3 bg-white rounded border border-green-200">
                                                        <p class="text-xs font-medium text-gray-600 mb-2">Claim Details</p>
                                                        <p class="text-sm text-gray-900">{{ $approvedRequest->reason }}</p>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Pending Requests -->
                            @if($pendingRequests->count() > 0)
                                <div class="mb-6 overflow-x-auto">
                                    <h3 class="text-lg font-semibold text-yellow-900 mb-4">⏳ Pending Requests ({{ $pendingRequests->count() }})</h3>
                                    <table class="w-full text-sm">
                                        <thead>
                                            <tr class="border-b border-yellow-300">
                                                <th class="px-3 py-2 text-left font-medium text-gray-700">Requester</th>
                                                <th class="px-3 py-2 text-left font-medium text-gray-700">Type</th>
                                                <th class="px-3 py-2 text-left font-medium text-gray-700">Date</th>
                                                <th class="px-3 py-2 text-center font-medium text-gray-700">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-yellow-200">
                                            @foreach($pendingRequests as $req)
                                                <tr class="bg-yellow-50 hover:bg-yellow-100">
                                                    <td class="px-3 py-2 font-semibold text-gray-900">{{ $req->user->name }}</td>
                                                    <td class="px-3 py-2">
                                                        <span class="px-2 py-1 text-xs font-semibold rounded {{ $req->type === 'adopt' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                                            {{ ucfirst($req->type) }}
                                                        </span>
                                                    </td>
                                                    <td class="px-3 py-2 text-gray-600">{{ $req->created_at->format('M d, Y') }}</td>
                                                    <td class="px-3 py-2 text-center space-x-2 flex justify-center">
                                                        <a href="{{ route('admin.requests.show', $req) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">View</a>
                                                        <form method="POST" action="{{ route('admin.requests.approve', $req) }}" class="inline">
                                                            @csrf
                                                            <button type="submit" class="text-green-600 hover:text-green-900 font-medium" onclick="return confirm('Approve this request?')">Approve</button>
                                                        </form>
                                                        <form method="POST" action="{{ route('admin.requests.deny', $req) }}" class="inline">
                                                            @csrf
                                                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium" onclick="return confirm('Deny this request?')">Deny</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            <!-- Denied Requests -->
                            @if($deniedRequests->count() > 0)
                                <div>
                                    <h3 class="text-lg font-semibold text-red-900 mb-4">❌ Denied Requests ({{ $deniedRequests->count() }})</h3>
                                    <div class="space-y-2">
                                        @foreach($deniedRequests as $req)
                                            <div class="p-3 bg-red-50 border border-red-200 rounded text-sm">
                                                <p class="font-semibold text-gray-900">{{ $req->user->name }}</p>
                                                <p class="text-gray-600">{{ ucfirst($req->type) }} Request - {{ $req->created_at->format('M d, Y') }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar: Quick Actions -->
            <div class="space-y-6">
                <!-- Action Buttons -->
                <div class="overflow-hidden bg-white rounded-lg shadow-md">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h2 class="text-lg font-bold text-gray-900">⚡ Actions</h2>
                    </div>
                    <div class="px-6 py-6 space-y-3">
                        @php
                            $approvedRequests = $pet->requests->where('status', 'approved');
                        @endphp

                        @if(in_array($pet->status, ['impounded', 'adoptable']) && $approvedRequests->count() > 0)
                            @if($approvedRequests->count() === 1)
                                @php $approvedRequest = $approvedRequests->first(); @endphp
                                @if($approvedRequest->type === 'claim')
                                    <form action="{{ route('admin.pets.mark-claimed', $pet) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="pet_request_id" value="{{ $approvedRequest->id }}">
                                        <button type="submit" class="w-full px-4 py-3 font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition"
                                                onclick="return confirm('Mark this pet as CLAIMED and transfer ownership to {{ $approvedRequest->user->name }}?')">
                                            ✅ Mark as Claimed
                                        </button>
                                    </form>
                                @elseif($approvedRequest->type === 'adopt')
                                    <form action="{{ route('admin.pets.mark-adopted', $pet) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="pet_request_id" value="{{ $approvedRequest->id }}">
                                        <button type="submit" class="w-full px-4 py-3 font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700 transition"
                                                onclick="return confirm('Mark this pet as ADOPTED and transfer ownership to {{ $approvedRequest->user->name }}?')">
                                            🏠 Mark as Adopted
                                        </button>
                                    </form>
                                @endif
                            @else
                                {{-- Multiple approved requests: choose which to finalize --}}
                                <div class="mb-4">
                                    <label for="pet_request_id" class="block mb-2 text-sm font-medium text-gray-700">Select Approved Requester</label>
                                    <form action="{{ $pet->status === 'impounded' ? route('admin.pets.mark-claimed', $pet) : route('admin.pets.mark-adopted', $pet) }}" method="POST">
                                        @csrf
                                        <select name="pet_request_id" id="pet_request_id" class="w-full p-2 mb-3 border rounded">
                                            @foreach($approvedRequests as $req)
                                                <option value="{{ $req->id }}">{{ $req->user->name }} — {{ ucfirst($req->type) }} (submitted {{ $req->updated_at->diffForHumans() }})</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="w-full px-4 py-3 font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition"
                                                onclick="return confirm('Finalize selected approved requester and transfer ownership?')">
                                            ✅ Finalize Selected Requester
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @elseif(in_array($pet->status, ['impounded', 'adoptable']))
                            <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                                <p class="text-sm text-yellow-800">⚠️ No approved request yet. Admin approval required before marking pet as adopted/claimed.</p>
                            </div>
                        @endif

                        <a href="{{ route('admin.pets.edit', $pet) }}" class="w-full px-4 py-3 font-semibold text-center text-gray-700 bg-white border-2 border-gray-300 rounded-lg hover:bg-gray-50 transition block">
                            ✏️ Edit Pet
                        </a>

                        <form action="{{ route('admin.pets.destroy', $pet) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full px-4 py-3 font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 transition"
                                    onclick="return confirm('Delete this pet? This action cannot be undone.')">
                                🗑️ Delete Pet
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Pet Timeline -->
                <div class="overflow-hidden bg-white rounded-lg shadow-md">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h2 class="text-lg font-bold text-gray-900">📅 Timeline</h2>
                    </div>
                    <div class="px-6 py-6 space-y-3">
                        <div>
                            <p class="text-xs font-medium text-gray-600">Created</p>
                            <p class="font-semibold text-gray-900">{{ $pet->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        @if($pet->impounded_date)
                            <div>
                                <p class="text-xs font-medium text-gray-600">Impounded</p>
                                <p class="font-semibold text-gray-900">{{ $pet->impounded_date->format('M d, Y') }}</p>
                                <p class="text-sm text-gray-600">Days: {{ $pet->impounded_date->diffInDays(now()) }}</p>
                            </div>
                        @endif
                        @if($pet->decision_date)
                            <div>
                                <p class="text-xs font-medium text-gray-600">Decision Date</p>
                                <p class="font-semibold text-gray-900">{{ $pet->decision_date->format('M d, Y') }}</p>
                            </div>
                        @endif
                        <div>
                            <p class="text-xs font-medium text-gray-600">Last Updated</p>
                            <p class="font-semibold text-gray-900">{{ $pet->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8">
            <a href="{{ route('admin.pets.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                ← Back to Pets
            </a>
        </div>
    </div>
</div>
@endsection
