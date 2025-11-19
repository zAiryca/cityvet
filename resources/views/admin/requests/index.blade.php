@extends('layouts.admin')

@section('title', '| Admin - Requests')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6">Adoption/Claim Requests ({{ $requests->count() }})</h1>

    <!-- Filters -->
    <form method="GET" action="{{ route('admin.requests.index') }}" class="bg-white p-4 rounded-lg shadow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <select name="status" class="border p-2 rounded">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="denied" {{ request('status') == 'denied' ? 'selected' : '' }}>Denied</option>
            </select>
            <select name="type" class="border p-2 rounded">
                <option value="">All Types</option>
                <option value="claim" {{ request('type') == 'claim' ? 'selected' : '' }}>Claim</option>
                <option value="adopt" {{ request('type') == 'adopt' ? 'selected' : '' }}>Adopt</option>
                <option value="register" {{ request('type') == 'register' ? 'selected' : '' }}>Event Register</option>
            </select>
            <input type="text" name="search" placeholder="Search by user/pet" value="{{ request('search') }}" class="border p-2 rounded">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
            <a href="{{ route('admin.requests.index') }}" class="ml-2 text-gray-500">Clear</a>
        </div>
    </form>

    <!-- Status Tabs -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                <a href="{{ route('admin.requests.index', array_merge(request()->query(), ['status' => ''])) }}" class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ !request('status') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    All ({{ $requests->total() }})
                </a>
                <a href="{{ route('admin.requests.index', array_merge(request()->query(), ['status' => 'pending'])) }}" class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'pending' ? 'border-yellow-500 text-yellow-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Pending ({{ $requests->where('status', 'pending')->count() }})
                </a>
                <a href="{{ route('admin.requests.index', array_merge(request()->query(), ['status' => 'approved'])) }}" class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'approved' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Approved ({{ $requests->where('status', 'approved')->count() }})
                </a>
                <a href="{{ route('admin.requests.index', array_merge(request()->query(), ['status' => 'denied'])) }}" class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'denied' ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Denied ({{ $requests->where('status', 'denied')->count() }})
                </a>
            </nav>
        </div>
    </div>

    @if($requests->count() > 0)
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">PET ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reason</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($requests as $request)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $request->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($request->requestable && $request->requestable_type === 'App\\Models\\Pet')
                                    {{ $request->requestable->display_code }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($request->type === 'adopt')
                                    {{ $request->reason ?: 'N/A' }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($request->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.requests.show', $request) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">View</a>
                                @if($request->status === 'pending')
                                    <form method="POST" action="{{ route('admin.requests.approve', $request) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-900 mr-2" onclick="return confirm('Are you sure you want to approve this request?')">Approve</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.requests.deny', $request) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-900 mr-2" onclick="return confirm('Are you sure you want to deny this request?')">Deny</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $requests->appends(request()->query())->links() }}
    @else
        <p class="text-gray-500 text-center py-8">No requests found. Check back as users submit them.</p>
    @endif
</div>
@endsection
