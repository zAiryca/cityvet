@extends('layouts.admin')

@section('title', '| Admin - Requests')

@section('content')
<div class="px-4 py-6 mx-auto max-w-7xl">
    <div class="p-6 bg-white rounded-lg shadow-md">

        {{-- Dynamic Header --}}
        <div class="flex items-center justify-between mb-6">
            @php
                $pageTitle = 'Pending Requests';
                if ($requestStatus === 'approved') {
                    $pageTitle = 'Approved Requests';
                } elseif ($requestStatus === 'denied') {
                    $pageTitle = 'Denied Requests';
                }
            @endphp
            <h1 class="text-3xl font-bold text-gray-800">{{ $pageTitle }}</h1>
        </div>

        {{-- Request Status Filter Tabs --}}
        <div class="mb-6 border-b border-gray-200">
            <nav class="flex pb-2 space-x-4 overflow-x-auto">
                <a href="{{ route('admin.requests.index', ['status' => 'pending']) }}"
                   class="@if($requestStatus === 'pending') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 @endif whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                    Pending
                </a>
                <a href="{{ route('admin.requests.index', ['status' => 'approved']) }}"
                   class="@if($requestStatus === 'approved') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 @endif whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                    Approved
                </a>
                <a href="{{ route('admin.requests.index', ['status' => 'denied']) }}"
                   class="@if($requestStatus === 'denied') border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 @endif whitespace-nowrap py-2 px-3 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
                    Denied
                </a>
            </nav>
        </div>

        @if($pets->count() > 0)
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Pet Code</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Photo</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Species/Breed</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Requester(s)</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pets as $pet)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $pet->display_code }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ $pet->photo ? asset('storage/' . $pet->photo) : 'https://via.placeholder.com/40?text=' . substr($pet->display_code, 0, 1) }}" alt="{{ $pet->display_code }}" class="w-10 h-10 rounded-full">
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $pet->species }} / {{ $pet->breed }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        @if($pet->status === 'impounded') bg-red-100 text-red-800
                                        @elseif($pet->status === 'adoptable') bg-green-100 text-green-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ ucfirst($pet->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span class="text-gray-500">{{ $pet->requests->count() }} requester(s)</span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                    <a href="{{ route('admin.pets.show', $pet) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $pets->appends(request()->query())->links() }}
        @else
            <p class="py-8 text-center text-gray-500">No pets with {{ strtolower($pageTitle) }}.</p>
        @endif
    </div>
</div>
@endsection
